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
		$data['user']=getuser();
		$this->template->load('bookings','bookingform',$data);
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
		$this->template->load('bookings','bookinglist',$data);
	}
	
	public function savebooking(){
		if($this->input->post('savebooking')!==NULL){
            $user=getuser();
			$data=$this->input->post();
            $data = array_map('strip_tags', $data);
            $data = array_map('htmlspecialchars', $data);
            //print_pre($data);
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
            print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}