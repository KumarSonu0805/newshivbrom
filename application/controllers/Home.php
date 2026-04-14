<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
		parent::__construct();
        //logrequest();
	}
    
    public function index(){
        checklogin();
        $this->wallet->addallcommission();
		$data['title']="Home";    
        if($this->session->role=='member'){
            $data['user']=getuser();
            $regid=$data['user']['id'];
            //$this->wallet->addcommission($regid);
            $memberdetails=$this->member->getalldetails($regid);
            $data['member']=$memberdetails['member'];
            $homedata=$this->common->homedata($regid);
            
            $date=date('Y-m-d');
            $status=0;
            
            $message="";
            if($memberdetails['member']['status']==1){
                $status=1;
            }
            $data['status']=$status;
            $data['message']=$message;
            $where="(t1.regid='$regid' || t1.regid='0') and t1.to_regid!='$regid'";
            //$data['donations']=$this->deposit->getpendingdonation($where);
            //print_pre($data,true);
            $data['datatable']=true;
        }
        else{
            //$this->addallcommission();
            //$this->deletetokens();
            //$this->deleteinactivemembers();
            //$this->clearlogs();
            //$this->wallet->addallcommission();
            $homedata=$this->common->adminhomedata();
        }
        $data=array_merge($data,$homedata);
		$this->template->load('pages','home',$data);  
    }
    
	public function changepassword(){
        $data['user']=getuser();
        $data['title']="Edit Password";
        //$data['subtitle']="Sample Subtitle";
        $data['breadcrumb']=array();
        $data['alertify']=true;
		$this->template->load('pages','changepassword',$data);
	}
    
    public function updatepassword(){
        if($this->input->post('updatepassword')!==NULL){
            $old_password=$this->input->post('old_password');
            $password=$this->input->post('password');
            $repassword=$this->input->post('repassword');
            $user=getuser();
            if(password_verify($old_password.SITE_SALT.$user['salt'],$user['password'])){
                $user=$this->session->user;
                if($password==$repassword){
                    $result=$this->account->updatepassword(array("password"=>$password),array("md5(id)"=>$user));
                    if($result['status']===true){
                        $this->session->set_flashdata('msg',$result['message']);
                    }
                    else{
                        $error=$result['message'];
                        $this->session->set_flashdata('err_msg',$error);
                    }
                }
                else{
                    $error=$result['message'];
                    $this->session->set_flashdata('err_msg',"Password Do not Match!");
                }
            }
            else{
                $this->session->set_flashdata('err_msg',"Old Password Does not Match!");
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function addallcommission(){
		$time1 = microtime(true);
        $date=date('Y-m-d');
		$this->wallet->addallcommission($date);
		$time2 = microtime(true);
		$time=$time2-$time1;
        echo "\nInterval Cron Success in $time seconds. Date : ".date('Y-m-d H:i:s');
    }
    
    public function template(){
        $data['title']="Template";
        $data['content']="admin/pages/test.php";
        $this->load->view('admin/includes/top-section',$data);       
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/includes/wrapper');
        $this->load->view('admin/includes/footer');
        $this->load->view('admin/includes/bottom-section'); 
    }
    
	public function checkbillpaymentlimit(){
        $this->session->set_userdata('user',md5('7'));
        checkbillpaymentlimit(getuser());
    }
    
	public function fundincome(){
        $this->wallet->fundincome(date('Y-m-d'));
    }
    
	public function register(){
        $this->load->view('test2');
    }
    
    public function recharge(){
        $this->load->helper('recharge');
        $result=requestrecharge();
        print_pre($result);
    }
    
    public function assign_scratch_cards(){
        $this->common->assign_scratch_cards();
    }
    
    public function phpinfo(){
        phpinfo();
    }
    
    public function caches(){
        $this->load->helper('file');

        $files = get_filenames(APPPATH . 'cache/');

        echo '<pre>';
        print_r($files);
        echo '</pre>';
    }
    
    public function clearallcache(){
        var_dump($this->cache->clean());
        var_dump($this->cache->cache_info());
    }
    
    public function localtest(){
        $this->load->view('admin/test');       
    }
    
	public function getusers(){     
        checklogin();
        $total=$this->db->get_where('users',['role'=>'member'])->num_rows();
        $active=$this->db->get_where('users',"role='member' and id in (SELECT regid from ".TP."members where status='1')")->num_rows();
        $today=$this->db->get_where('users',['role'=>'member','date(created_on)'=>date('Y-m-d')])->num_rows();
        $result=array('total'=>$total,'active'=>$active,'today'=>$today);
        echo json_encode($result);
    }
    
	public function testcache(){
        $this->load->library('CacheManager');
        $caches=getCacheNames();
        if(!empty($caches)){
            foreach($caches as $key=>$cache){
                $key=array('key'=>$key,'name'=>$cache,'type'=>'file','time'=>900);
                $this->cachemanager->cache('file')->savekeys($key);
            }
        }
        
        //$result=$this->cachemanager->cache('file')->getkeys();
        //print_pre($result);
        //$result=$this->cachemanager->cache('file')->savekeys($key);
        //print_pre($result);
        //$result=$this->cachemanager->cache('file')->setkey('cache_key')->get();
        //print_pre($result);
    }
    
	public function cleardata($all=false){
        $query=array(
            'DELETE FROM `sc_users` WHERE id>1;',
            'TRUNCATE `sc_acc_details`;',
            'TRUNCATE `sc_members`;',
            'TRUNCATE `sc_member_ranks`;',
            'TRUNCATE `sc_nominee`;',
            'TRUNCATE `sc_wallet`;',
            'TRUNCATE `sc_wallet_transfers`;',
            'TRUNCATE `sc_withdrawals`;',
            'ALTER TABLE `sc_users` auto_increment = 1;',
            'ALTER TABLE `sc_member_tree` auto_increment = 1;'
        );
        if($all=='all'){
            $query[]='TRUNCATE `sc_bookings`';
            $query[]='TRUNCATE `sc_booking_details`';
            $query[]='TRUNCATE `sc_booking_kyc`';
            $query[]='TRUNCATE `sc_booking_payment`';
            $query[]='TRUNCATE `sc_db_operations`';
            $query[]='TRUNCATE `sc_level_members`;';
        }
        foreach($query as $sql){
            if(!$this->db->query($sql)){
                print_r($this->db->error());
            }
        }
    }
    
	public function loadolddata(){
        $testdb = $this->load->database('testdb', TRUE);
        $array=$testdb->get('users')->result_array();
        if($this->input->get('test')=='test'){
            print_pre($array,true);
        }
        $members=array();
        if(!empty($array) && $this->input->get('import')=='impor'){
            if($this->input->get('clear')=='clear'){
                $this->cleardata('all');
            }
            foreach($array as $key=>$row){
                $userdata=$memberdata=$accountdata=$treedata=$nomineedata=array();
                $getuser=$this->db->get_where('users',['username'=>$row['username']]);
                if($getuser->num_rows()==0){
                    $userdata['username']=$row['username'];
                    $userdata['mobile']=$row['phone'];
                    $userdata['name']=$row['name'];
                    $userdata['email']=$row['email'];
                    $userdata['password']=$row['lpassword']??'12345';
                    $userdata['role']="member";
                    $userdata['status']="1";
                    $userdata['old_id']=$row['id'];
                    $userdata['created_on']=$row['created_at'];
                    $userdata['updated_on']=$row['created_at'];


                    $memberdata['name']=$row['name'];
                    $memberdata['dob']=$row['dob']??NULL;
                    $memberdata['father']=$row['father']??'';
                    $memberdata['occupation']=$row['occupation']??'';
                    $memberdata['gender']=$row['gender']??'';
                    $memberdata['mstatus']=$row['mstatus']??'';
                    $memberdata['mobile']=$row['phone'];
                    $memberdata['a_mobile']=$row['a_mobile']??'';
                    $memberdata['email']=$row['email'];
                    $memberdata['aadhar']=$row['aadhar']??'';
                    $memberdata['pan']=$row['pan']??'';
                    $memberdata['address']=$row['address']??'';
                    $memberdata['district']=$row['district']??'';
                    $memberdata['state']=$row['state']??'';
                    $memberdata['pincode']=$row['pincode']??'';
                    $memberdata['refid']=$row['sponsor_id'];
                    $memberdata['date']=date('Y-m-d',strtotime($row['created_at']));
                    $memberdata['time']=date('H:i:s',strtotime($row['created_at']));
                    $memberdata['status']=0;

                    $treedata['parent_id']=$row['parent_id'];
                    $treedata['position']=empty($row['position'])?'L':$row['position'];

                    $data=array("userdata"=>$userdata,"memberdata"=>$memberdata,"accountdata"=>$accountdata,
                                "treedata"=>$treedata,"nomineedata"=>$nomineedata);
                    $result=$this->member->addmember($data);
                    //print_pre($result);
                }
                else{
                    $user=$getuser->unbuffered_row('array');
                    $result=array('regid'=>$user['id']);
                }
                
                $members[]=array('regid'=>$result['regid'],'name'=>$row['name'],'old_id'=>$row['id'],
                                 'status'=>$row['is_active'],'activated_on'=>$row['activated_at']);
                
            }
            //print_pre($members);
            if(!empty($members)){
                foreach($members as $member){
                    $getbooking=$testdb->get_where('bookings',['user_id'=>$member['old_id']]);
                    if($getbooking->num_rows()>0){
                        $bookings=$getbooking->result_array();
                        //print_pre($bookings);
                        if(!empty($bookings)){
                            foreach($bookings as $booking){
                                $getpayment=$testdb->get_where('booking_payment_histories',['booking_id'=>$booking['id']]);
                                $payments=$getpayment->result_array();
                                //print_pre($payments);
                                //echo $member['name'].':'.$booking['name'].':'.comparenames($member['name'],$booking['name']).'<br>';
                                $bdata=array('regid'=>$member['regid']);
                                
                                $bdata['date']=date('Y-m-d',strtotime($booking['created_at']));
                                $bdata['type']=$booking['booking_payment_status'];
                                $bdata['due_date']=date('Y-m-d',strtotime($booking['payment_due_date']));
                                $bdata['booking_type']=$booking['type'];
                                $bdata['project_id']=!empty($booking['project_id'])?$booking['project_id']:1;
                                $bdata['plot_no']=!empty($booking['property_number'])?$booking['property_number']:'';
                                $bdata['b_address']=!empty($booking['property_address'])?$booking['property_address']:'';
                                
                                $city=$booking['property_city'];
                                //Find City
                                $bdata['b_state_id']=1;
                                $bdata['b_district_id']=1;
                                $bdata['b_city_id']=1;
                                $bdata['landmark']=!empty($booking['property_landmark'])?$booking['property_landmark']:''; 
                                $bdata['price']=$booking['price'];
                                $bdata['other_price']=empty($booking['other_price'])?0:$booking['other_price'];
                                $bdata['total_amount']=$booking['total_amount'];
                                $bdata['bv']=$booking['business_value'];
                                $bdata['old_b_id']=$booking['id'];
                                
                                
                                $for=comparenames($member['name'],$booking['name'])?'Self':'Other';
                                $bdata['booking_for']=$for;
                                $bdata['name']=$booking['name'];
                                $bdata['father']=$booking['guardian_name'];
                                $bdata['grand_father']=$booking['grand_father_name'];
                                $bdata['mobile']=$booking['mobile'];
                                $bdata['a_mobile']=!empty($booking['alternate_mobile'])?$booking['alternate_mobile']:'';
                                $bdata['email']=$booking['email'];
                                $bdata['address']=$booking['address'];
                                $bdata['pincode']=$booking['pin_code'];
                                $bdata['photo']=!empty($booking['photo'])?$booking['photo']:'';
                                $bdata['details']=json_encode($booking);
                                $bdata['added_on']=date('Y-m-d H:i:s',strtotime($booking['created_at']));
                                $bdata['updated_on']=date('Y-m-d H:i:s',strtotime($booking['updated_at']));
                                
                                $bdata['old_id']=$member['old_id'];
                                $payment=array();
                                if(!empty($payments)){
                                    foreach($payments as $row){
                                        $single=array('regid'=>$member['regid'],'booking_id'=>'');
                                        $single['payment_type']=$row['payment_type']=='full'?
                                                                'full_payment':$row['payment_type'];
                                        $single['date']=date('Y-m-d',strtotime($row['created_at']));
                                        $single['payment_mode']=$row['payment_mode']=='check'?'cheque':$row['payment_mode'];
                                        $paid=$single['amount']=$row['amount'];
                                        if($paid>$booking['price']){
                                            $paid=$booking['price'];
                                        }
                                        $single['bv']=calculatebv($booking['price'],$paid);
                                        if(!empty($row['cheque_receiver_name'])){
                                            $single['receiver_name']=$row['cheque_receiver_name'];
                                        }
                                        elseif(!empty($row['cash_receiver_name'])){
                                            $single['receiver_name']=$row['cash_receiver_name'];
                                        }
                                        $single['utr_no']=$row['utr_no'];
                                        $single['cheque_no']=$row['cheque_no'];
                                        $single['details']=json_encode($row);
                                        $single['added_on']=date('Y-m-d H:i:s',strtotime($row['created_at']));
                                        $single['updated_on']=date('Y-m-d H:i:s',strtotime($row['updated_at']));
                                        $payment[]=$single;
                                    }
                                }
                                
                                $kyc=array('regid'=>$member['regid'],'booking_id'=>'');
                                $kyc['aadhar']=$booking['aadhaar_no'];
                                $kyc['pan']=$booking['pan_no'];
                                $kyc['voter_id']=!empty($booking['voter_no'])?$booking['voter_no']:'';
                                $kyc['driving_license']=!empty($booking['driving_license'])?$booking['driving_license']:'';
                                $kyc['aadhar1']=!empty($booking['aadhaar_card_photo'])?$booking['aadhaar_card_photo']:'';
                                $kyc['aadhar2']='';
                                $kyc['pan_image']=!empty($booking['pan_card_photo'])?$booking['pan_card_photo']:'';
                                $kyc['added_on']=date('Y-m-d H:i:s',strtotime($booking['created_at']));
                                $kyc['updated_on']=date('Y-m-d H:i:s',strtotime($booking['updated_at']));
                                
                                $nominee=array('regid'=>$member['regid'],'booking_id'=>'');
                                $nominee['name']=$booking['nominee_name'];
                                $nominee['father']=$booking['nominee_guardian_name'];
                                $nominee['mobile']=$booking['nominee_mobile'];
                                $nominee['email']=$booking['nominee_email'];
                                $nominee['address']=$booking['nominee_address'];
                                $nominee['photo']=!empty($booking['nominee_photo'])?$booking['nominee_photo']:'';
                                
                                $data=array("bdata"=>$bdata,"payment"=>$payment,"kyc"=>$kyc,"nominee"=>$nominee);
                                print_pre($data);
                                $result=$this->booking->importdata($data);
                                print_pre($result);
                            }
                        }
                        echo '<br>----------------------------------------------------------<br>';
                    }
                }
            }
        }
        
    }
    
	public function showprocess(){
        $sql="SHOW PROCESSLIST;";
        $query=$this->db->query($sql);
        $array=$query->result_array();
        //print_pre($array);
        echo '<table border="1"><tr><th>' . implode('</th><th>', array_keys($array[0])) . '</th></tr><tr><td>' . implode('</td></tr><tr><td>', array_map(fn($row) => implode('</td><td>', $row), $array)) . '</td></tr></table>';

    }

	
    public function runquery(){
        $query=array(
            "ALTER TABLE `sc_projects` ADD `distance` VARCHAR(200) NOT NULL AFTER `project_status`, ADD `discount` DECIMAL(5,2) NOT NULL AFTER `distance`, ADD `final_price` DECIMAL(16,2) NOT NULL AFTER `discount`;",
            "ALTER TABLE `sc_projects` CHANGE `thumb_image` `thumbnail_image` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;"
        );
        foreach($query as $sql){
            if(!$this->db->query($sql)){
                print_r($this->db->error());
            }
        }
    }
    
    public function clearlogs($all=false){
        if($all===false){
            $sql="DELETE from of_request_log where date(added_on)<'".date('Y-m-d',strtotime('-7 days'))."'";
        }
        elseif($all=='all'){
            $sql='TRUNCATE of_request_log';
        }
        else{
            $sql='';
        }
        $query=array($sql);
        foreach($query as $sql){
            if(!$this->db->query($sql)){
                print_r($this->db->error());
            }
        }
    }
    
    public function matchcolumns(){
        $tables=$this->db->query("show tables;")->result_array();
        echo "<h1>Tables : ".count($tables)."</h1>";
        foreach($tables as $table){
            $tablename=$table['Tables_in_'.DB_NAME];
            $columns=$this->db->query("DESC $tablename;")->result_array();
            echo "<h1>$tablename</h1>";
            echo "<h3>Columns : ".count($columns)."</h3>";
            echo "<h3>Rows : ".$this->db->get($tablename)->num_rows()."</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>";
            echo "<tr>";
            foreach($columns[0] as $key=>$value){
                echo "<td>$key</td>";
            }
            echo "</tr>";
            foreach($columns as $column){
                echo "<tr>";
                foreach($column as $key=>$value){
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
	public function error(){
        $data['title']='Page Not Found';
        if($this->session->user!==NULL){
            $this->load->library('template');
            $this->template->load('pages','error',$data);
        }
        else{
            $this->load->view('website/includes/top-section',$data);
            $this->load->view('website/error404');
            $this->load->view('website/includes/bottom-section');
        }
	}
    
}
