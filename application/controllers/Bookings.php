<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends MY_Controller {
    
	function __construct(){
		parent::__construct();
		checklogin();
	}
	
	public function index(){
		if($this->session->role=='admin'){ redirect('/'); }
		$data['title']="New Booking";
		$data['breadcrumb']=array("/"=>"Home");
        $data['styles']=array('file'=>'includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css');
		$data['user']=getuser();
        $data['f_type']='new';
		$this->template->load('bookings','bookingform',$data);
	}
	
	public function bookingform($id){
		if($this->session->role=='admin'){ redirect('/'); }
        $where=array("md5(concat('booking-id-',t1.id))"=>$id);
        $booking=$this->booking->getbookingdetails($where,'single');
        $data['booking']=$booking;
        //print_pre($data,true);
		$data['title']="Booking Form";
		$data['breadcrumb']=array("/"=>"Home");
        $data['styles']=array('file'=>'includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css');
		$data['user']=getuser();
        $memberdetails=$this->member->getmemberdetails($data['user']['id']);
        $data['member']=$memberdetails;
        $data['districts']=district_dropdown(['t1.state_id'=>$booking['state_id'],]);
        $data['cities']=city_dropdown(['t1.district_id'=>$booking['district_id'],]);
        $data['b_districts']=district_dropdown(['t1.state_id'=>$booking['b_state_id'],]);
        $data['b_cities']=city_dropdown(['t1.district_id'=>$booking['b_district_id'],]);
        if($this->uri->segment(2)=='bookingkyc'){
            $data['f_type']='kyc';
        }
        elseif($this->uri->segment(2)=='bookingnominee'){
            $data['f_type']='nominee';
        }
        
		$this->template->load('bookings','bookingform',$data);
	}
	
	public function o(){
		if($this->session->role=='admin'){ redirect('/'); }
		$data['title']="New Booking";
		$data['breadcrumb']=array("/"=>"Home");
		$data['user']=getuser();
		$this->template->load('bookings','old-bookingform',$data);
	}
	
	public function bookinglist(){
		$data['title']="My Bookings";
		$data['breadcrumb']=array("/"=>"Home");
		$data['user']=getuser();
        $where=array();
        if($this->session->role!='admin'){
            $where['t1.regid']=$data['user']['id'];
        }
        else{
            $data['title']="Member Bookings";
        }
        $data['bookings']=$this->booking->getbookings($where);
        $data['datatable']=true;
		$this->template->load('bookings','bookinglist',$data);
	}
	
	public function bookingpayments(){
        if($this->session->role!='admin'){
            redirect('/');
        }
		$data['title']="Booking Payments";
		$data['breadcrumb']=array("/"=>"Home");
		$data['user']=getuser();
        $where=array();
        $data['bookings']=$this->booking->getbookingpayments($where);
        //print_pre($data,true);
        $data['datatable']=true;
		$this->template->load('bookings','paymentlist',$data);
	}
	
	public function details($id){
		$data['title']="Booking Details";
        $where=array("md5(concat('booking-id-',t1.id))"=>$id);
        $booking=$this->booking->getbookingdetails($where,'single');
        if(empty($booking)){
            redirect('bookings/bookinglist/');
        }
        $data['booking']=$booking;
        $getuser=$this->account->getuser(array("id"=>$booking['regid']));
        $data['user']=$getuser['user'];
        //print_pre($data,true);
		$data['title']="Booking Form";
		$data['breadcrumb']=array("/"=>"Home");
        $data['styles']=array('file'=>'includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css');
        $memberdetails=$this->member->getmemberdetails($booking['regid']);
        $data['member']=$memberdetails;
        $data['districts']=district_dropdown(['t1.state_id'=>$booking['state_id'],]);
        $data['cities']=city_dropdown(['t1.district_id'=>$booking['district_id'],]);
        $data['b_districts']=district_dropdown(['t1.state_id'=>$booking['b_state_id'],]);
        $data['b_cities']=city_dropdown(['t1.district_id'=>$booking['b_district_id'],]);
        $data['f_type']='none';
        
		$this->template->load('bookings','bookingform',$data);
	}
	
	public function savebooking(){
		if($this->input->post('savebooking')!==NULL){
            $user=getuser();
			$data=$this->input->post();
            unset($data['savebooking']);
            //print_pre($data);
            $bdata=$data;
            $bdata['date']=!empty($data['date'])?$data['date']:date('Y-m-d');
            $bdata['due_date']=!empty($data['due_date'])?$data['due_date']:NULL;
            $bdata['bv']=$this->bv;
            unset($bdata['payment_type'],$bdata['payment_date'],$bdata['payment_mode'],$bdata['paid_amount']);
            unset($bdata['receiver_name'],$bdata['utr_no'],$bdata['cheque_no'],$bdata['cheque_date']);
            
            $payment=array('regid'=>$data['regid'],'booking_id'=>'');
            $payment['payment_type']=$data['payment_type'];
            $payment['date']=$data['payment_date'];
            $payment['payment_mode']=$data['payment_mode'];
            $payment['amount']=$data['paid_amount'];
            $paid=$data['paid_amount'];
            if($paid>$data['price']){
                $paid=$data['price'];
            }
            $payment['bv']=calculatebv($data['price'],$paid);
            $payment['receiver_name']=!empty($data['receiver_name'])?$data['receiver_name']:NULL;
            $payment['utr_no']=!empty($data['utr_no'])?$data['utr_no']:NULL;
            $payment['cheque_no']=!empty($data['cheque_no'])?$data['cheque_no']:NULL;
            $payment['cheque_date']=!empty($data['cheque_date'])?$data['cheque_date']:NULL;
            //print_pre($payment,true);
            
            $upload_path="./assets/uploads/bookings/payment/";
            $allowed_types="jpg|jpeg|png";
            $file_name=$user['name'].date('-dmyhis-');
            $upload=upload_file('screenshot',$upload_path,$allowed_types,$file_name.'pay_image');
            if($upload['status']===true){
                $payment['screenshot']=$data['screenshot'];
            }
            
            $data=array("bdata"=>$bdata,"payment"=>$payment);
            //print_pre($data,true);
            $result=$this->booking->savebooking($data);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
                redirect('bookings/bookingkyc/'.md5('booking-id-'.$result['booking_id']));
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
		}
		elseif($this->input->post('savekycdetails')!==NULL){
            $user=getuser();
			$data=$this->input->post();
            unset($data['savekycdetails']);
            //print_pre($data);
            $id=$data['id'];
            $where=array("md5(concat('booking-id-',t1.id))"=>$id);
            $booking=$this->booking->getbookingdetails($where,'single');
            
            $bdata=$data;
            $kyc=array('regid'=>$booking['regid'],'booking_id'=>$booking['id'],);
            $kyc['aadhar']=$bdata['aadhar'];
            $kyc['pan']=$bdata['pan'];
            $kyc['voter_id']=$bdata['voter_id'];
            $kyc['driving_license']=$bdata['driving_license'];
            unset($bdata['id'],$bdata['aadhar'],$bdata['pan'],$bdata['voter_id'],$bdata['driving_license']);
            //print_pre($payment,true);
            
            $upload_path="./assets/uploads/member/documents/";
            $allowed_types="jpg|jpeg|png";
            $file_name=$user['name'].date('-dmyhis-');
            $upload=upload_file('aadhar1',$upload_path,$allowed_types,$file_name.'aadhar1');
            if($upload['status']===true){
                $kyc['aadhar1']=$upload['path'];
            }
            $upload=upload_file('aadhar2',$upload_path,$allowed_types,$file_name.'aadhar2');
            if($upload['status']===true){
                $kyc['aadhar2']=$upload['path'];
            }
            $upload=upload_file('pan_image',$upload_path,$allowed_types,$file_name.'pan_image');
            if($upload['status']===true){
                $kyc['pan_image']=$upload['path'];
            }
            
            $data=array("bdata"=>$bdata,"kyc"=>$kyc);
            //print_pre($data,true);
            $result=$this->booking->updatebooking($data,$booking['id']);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
                redirect('bookings/bookingnominee/'.md5('booking-id-'.$result['booking_id']));
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
		}
		elseif($this->input->post('savenomineedetails')!==NULL){
            $user=getuser();
			$data=$this->input->post();
            //print_pre($data);
            $id=$data['id'];
            $where=array("md5(concat('booking-id-',t1.id))"=>$id);
            $booking=$this->booking->getbookingdetails($where,'single');
            //print_pre($booking,true);
            unset($data['savenomineedetails'],$data['id']);
            //print_pre($payment,true);
            
            $upload_path="./assets/uploads/member/documents/";
            $allowed_types="jpg|jpeg|png";
            $file_name=$data['name'].date('-dmyhis-');
            $upload=upload_file('photo',$upload_path,$allowed_types,$file_name.'photo');
            if($upload['status']===true){
                $data['photo']=$upload['path'];
            }
            $data['regid']=$booking['regid'];
            $data['booking_id']=$booking['id'];
            //print_pre($data,true);
            $result=$this->booking->updatenominee($data);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
                redirect('bookings/bookinglist/');
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function oldsavebooking(){
		if($this->input->post('savebooking')!==NULL){
            $user=getuser();
			$data=$this->input->post();
            print_pre($data);
            $bdata=$data;
            unset($bdata['refid']);
            $bdata['regid']=$user['id'];
            $details=array('regid'=>$user['id']);
            $details['type']=$data['b_type'];
            $details['project_id']=$data['project_id'];
            $details['plot_number']=$data['plot_number'];
            $details['payment_type']=$data['payment_type'];
            $details['price']=$data['price'];
            $details['other_price']=$data['other_price'];
            $details['total_amount']=$data['price']+$data['other_price'];
            $details['token_amount']=$data['token_amount'];
            $details['bv']=$this->bv;
            $details['payment_mode']=$data['payment_mode'];
            $details['address']=$data['b_address'];
            $details['city']=$data['b_city'];
            $details['landmark']=$data['landmark'];
            unset($bdata['b_type'],$bdata['project_id'],$bdata['plot_number'],$bdata['payment_type'],$bdata['price'],
                  $bdata['other_price'],$bdata['total_amount'],$bdata['token_amount'],$bdata['payment_mode'],
                  $bdata['b_address'],$bdata['b_city'],$bdata['landmark'],$bdata['savebooking']);
            
            $nomineedata=array();
            $nomineedata['regid']=$user['id'];
            $nomineedata['name']=$data['nom_name']??'';
            $nomineedata['father']=$data['nom_father']??'';
            $nomineedata['mobile']=$data['nom_mobile']??'';
            $nomineedata['email']=$data['nom_email']??'';
            $nomineedata['address']=$data['nom_address']??'';
            unset($bdata['nom_name'],$bdata['nom_father'],$bdata['nom_mobile'],$bdata['nom_email'],$bdata['nom_address']);
            //print_pre($data,true);
			unset($data['savebooking']);
            $upload_path="./assets/uploads/bookings/";
            $allowed_types="jpg|jpeg|png";
            $file_name=$user['name'];
            $upload=upload_file('photo',$upload_path,$allowed_types,$file_name.'_photo');
            if($upload['status']===true){
                $bdata['photo']=$upload['path'];
            }
            $upload=upload_file('passbook',$upload_path,$allowed_types,$file_name.'_passbook');
            if($upload['status']===true){
                $bdata['passbook']=$upload['path'];
            }
            $upload=upload_file('aadhar_image',$upload_path,$allowed_types,$file_name.'_aadhar_image');
            if($upload['status']===true){
                $bdata['aadhar_image']=$upload['path'];
            }
            $upload=upload_file('nom_photo',$upload_path,$allowed_types,$nomineedata['name'].'_nom_photo');
            if($upload['status']===true){
                $nomineedata['photo']=$upload['path'];
            }
            $upload=upload_file('document',$upload_path,$allowed_types,$nomineedata['name'].'_document');
            if($upload['status']===true){
                $details['document']=$upload['path'];
            }
            $data=array("bdata"=>$bdata,"details"=>$details,"nomineedata"=>$nomineedata);
            //print_pre($data,true);
            $result=$this->booking->savebooking($data);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function approvebooking(){
        $id=$this->input->post('id');
        $where=array("md5(concat('booking-id-',t1.id))"=>$id);
        $booking=$this->booking->getbookings($where,'single');
        if($booking['status']==0){
            $result=$this->booking->approvebooking($booking['id'],$booking['regid']);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
        }
	}
	
}