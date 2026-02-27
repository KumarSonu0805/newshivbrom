<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_Controller {
	var $epin_status=false; //false : No E-pin; 1 : E-pin Required; 2 : E-pin Not Required
	var $tree='position'; //false : No Tree; auto : Auto Position; position : Select Position; pool : Auto pool
	var $acc_details=false; // Show account details in form
	var $reject_kyc=true;
	
	function __construct(){
		parent::__construct();
	}
	
	public function index(){
        $this->memberlist();
		/*if($this->session->user===NULL){
			$this->register();
		}else{
			$this->registration();
		}*/
	}
	
	public function registration(){
		checklogin();
		$data['title']="Member Registration";
		$data['breadcrumb']=array("/"=>"Home");
		$data['user']=getuser();
		$regid=$data['user']['id'];
		
		$data['parent_id']='';
		$options=array(""=>"Select Bank","xyz"=>"Others");
		$banks=$this->member->getbanks();
		if(is_array($banks)){
			foreach($banks as $bank){
				$options[$bank['name']]=$bank['name'];
			}
		}
		$data['banks']=$options;
		$data['epin_status']=$this->epin_status;
		$data['tree']=$this->tree;
		$data['acc_details']=$this->acc_details;
		$this->template->load("members","registration",$data);
	}
    	
	public function register(){
		$data['title']="Member Registration";
		$data['parent_id']='';
		$data['user']['username']='';
		$data['user']['id']='';
		$data['user']['name']='';
		$options=array(""=>"Select Bank","xyz"=>"Others");
		$banks=$this->member->getbanks();
		if(is_array($banks)){
			foreach($banks as $bank){
				$options[$bank['name']]=$bank['name'];
			}
		}
		$data['banks']=$options;
		$data['epin_status']=$this->epin_status;
		$data['tree']=$this->tree;
		$data['acc_details']=$this->acc_details;  
        $this->load->view('website/register',$data);   
	}
    
	public function registered(){
		if($this->session->flashdata('mname')===NULL){
			redirect('members/');
		}
        /*$name=$this->session->flashdata('mname');
        $uname=$this->session->flashdata('uname');
        $pass=$this->session->flashdata('pass');
        $flash=array("mname"=>$name,"uname"=>$uname,"pass"=>$pass);
        $this->session->set_flashdata($flash);*/
		$data['title']="Registration Details";
		if($this->session->userdata('user')!==NULL){
			$data['breadcrumb']=array("/"=>"Home");
			$this->template->load('members','registered',$data);
		}
		else{
            $this->template->load('website','registered',$data,'auth');    
		}
	}
	
	public function memberlist(){
		checklogin();
		$data['title']="Downline Member List";
		$data['user']=getuser();
		$regid=$data['user']['id'];
		$members=$this->member->getmembers($regid);
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','memberlist',$data);
	}
	
	public function leftmemberlist(){
		checklogin();
		$data['title']="Left Member List";
		$data['user']=getuser();
		$regid=$data['user']['id'];
		$members=$this->member->getleftrightmembers($regid,'left');
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','memberlist',$data);
	}
	
	public function rightmemberlist(){
		checklogin();
		$data['title']="Right Member List";
		$data['user']=getuser();
		$regid=$data['user']['id'];
		$members=$this->member->getleftrightmembers($regid,'right');
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','memberlist',$data);
	}
	
	public function downline(){
		checklogin();
		$data['title']="Downline Member List";
		$data['user']=getuser();
		$regid=$data['user']['id'];
		$members=$this->member->getallmembers($regid);
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','memberlist',$data);
	}
	
	public function editmember($username=NULL){
		checklogin();
		if($this->session->role!='admin' || $username===NULL){ redirect('members/memberlist/'); }
		$member=$this->member->getmemberid($username,'all');
		if($member['regid']==0){ redirect('members/memberlist/'); }
		$regid=$member['regid'];
		$data['title']="Edit Member";
		$data['breadcrumb']=array("/"=>"Home",'members/downline/'=>"Downline Members");
		$details=$this->member->getalldetails($regid);
		
		$options=array(""=>"Select Bank");
		$banks=$this->common->getbanks();
		if(is_array($banks)){
			foreach($banks as $bank){
				$options[$bank['name']]=$bank['name'];
			}
		}
		$data['banks']=$options;
		$data=array_merge($data,$details);
		$data['relations']=relation_dropdown();
		$this->template->load('members','editmember',$data);
	}
	
	public function mydirects(){
		checklogin();
		if($this->session->role=='admin'){
			redirect('members/downline/');
		}
		$data['title']="Direct Sponsors";
		$data['user']=getuser();
		$regid=$data['user']['id'];
		$members=$this->member->getdirectmembers($regid);
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','memberlist',$data);
	}
		
	public function treeview(){
		checklogin();
		$data['title']="Tree View";
		$data['user']=getuser();
		$regid=$data['user']['id'];
        if($regid>1){
            $details=$this->member->getmemberdetails($regid);
            $data['user']['photo']=$details['photo'];
        }
        else{
            $data['user']['photo']=file_url("assets/images/male.png");
        }
        $this->load->helper('tree');
		$regids=generateTree($data['user']['id']);
		$data['packages']=$this->db->get_where('packages',array("status"=>1))->result_array();
		$data['tree']=createTree($regids);
		$this->template->load('members','tree',$data);
	}
	
	public function kyc(){
        if($this->session->role!='admin'){
            redirect('/');
        }
		checklogin();
		$data['title']="Member KYC Requests";
		$data['breadcrumb']=array("/"=>"Home");
		$members=$this->member->kyclist();
		$data['members']=$members;
		$data['datatable']=true;
		$data['reject_kyc']=$this->reject_kyc;
		$this->template->load('members','kyclist',$data);
	}
	
	public function approvedkyc(){
        if($this->session->role!='admin'){
            redirect('/');
        }
		checklogin();
		$data['title']="Approved Member KYC";
		$data['breadcrumb']=array("/"=>"Home");
		$members=$this->member->kyclist(1);
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','kyclist',$data);
	}
	
	public function activationrequests(){
		if($this->session->role!='admin'){ redirect('home/'); }
		$data['title']="Activation Request List";
		$today=date('Y-m-d');
		$where=array("t1.type"=>"activation","t1.status"=>0);
		$members=$this->deposit->getdepositlistrequest($where);
		$data['members']=$members;
		$data['datatable']=true;
		$data['datatableexport']=true;
		$this->template->load('deposits','depositlist',$data);
	}
	
	public function approvedactivations(){
		if($this->session->role!='admin'){ redirect('home/'); }
		$data['title']="Approved Activation List";
		$today=date('Y-m-d');
		$where=array("t1.type"=>"activation","t1.status"=>1);
		$members=$this->deposit->getdepositlistrequest($where);
		$data['members']=$members;
		$data['datatable']=true;
		$data['datatableexport']=true;
		$this->template->load('deposits','approvedlist',$data);
	}
    
    public function generate(){
        if($this->session->role!='admin'){ redirect('/'); }
        $data=['title'=>'Generate Members'];
        $this->template->load('members','generate',$data);
    }
	
	public function addmember(){
		if($this->input->post('addmember')!==NULL || $this->input->post('generate')==1){
			$data=$this->input->post();
			$userdata=$memberdata=$accountdata=$treedata=$familydata=array();
			if($data['refid']>0){
				$userdata['mobile']=$data['mobile'];
				$userdata['name']=$data['name'];
				$userdata['email']=$data['email'];
				$userdata['role']="member";
				$userdata['status']="1";
				
				if(isset($data['epin'])){
					$memberdata['epin']=$data['epin'];
				}
				$memberdata['name']=$data['name'];
				$memberdata['dob']=$data['dob']??NULL;
				$memberdata['father']=$data['father']??'';
				$memberdata['occupation']=$data['occupation']??'';
				$memberdata['gender']=$data['gender']??'';
				$memberdata['mstatus']=$data['mstatus']??'';
				$memberdata['mobile']=$data['mobile'];
				$memberdata['email']=$data['email'];
				$memberdata['aadhar']=$data['aadhar']??'';
				$memberdata['pan']=$data['pan']??'';
				$memberdata['address']=$data['address']??'';
				$memberdata['district']=$data['district']??'';
				$memberdata['state']=$data['state']??'';
				$memberdata['pincode']=$data['pincode']??'';
				$memberdata['refid']=$data['refid'];
				$memberdata['date']=$data['date']??date('Y-m-d');
				$memberdata['time']=date('H:i:s');
				$memberdata['status']=0;
				
				$upload_path="./assets/uploads/members/";
				$allowed_types="jpg|jpeg|png";
				$file_name=$data['name'];
				$upload=upload_file('photo',$upload_path,$allowed_types,$file_name.'_photo');
				if($upload['status']===true){
                    $memberdata['photo']=$upload['path'];
                }
				$accountdata['bank']=$data['bank']??'';
				$accountdata['branch']=$data['branch']??'';
				$accountdata['city']=$data['city']??'';
				$accountdata['account_no']=$data['account_no']??'';
				$accountdata['account_name']=$data['account_name']??'';
				$accountdata['ifsc']=$data['ifsc']??'';
				
				if($this->tree=='position'){
					$treedata['parent_id']=$this->member->findleaf($data['refid'],$data['position']);
					$treedata['position']=$data['position'];
				}
				else{
					$treedata=$this->tree;
				}
                
                $nomineedata=array();
                $nomineedata['name']=$data['nom_name']??'';
                $nomineedata['relation']=$data['relation']??'';
                $data=array("userdata"=>$userdata,"memberdata"=>$memberdata,"accountdata"=>$accountdata,
                            "treedata"=>$treedata,"nomineedata"=>$nomineedata);
                //print_pre($data,true);
                //print_pre($data);return false;
				$result=$this->member->addmember($data);
                //print_pre($result,true);
				if($result['status']===true){
                    if($this->input->post('generate')!=1){
                        $message = "Welcome $memberdata[name]! Thank you for joining ".PROJECT_NAME."! Your Username is $result[username] and Password is $result[password]. ";
                        $message.= "Visit our site ".str_replace('members.','',base_url()).".";
                        $smsdata=array("mobile"=>$memberdata['mobile'],"message"=>$message);
                        //send_sms($smsdata);
                        $flash=array("mname"=>$memberdata['name'],"uname"=>$result['username'],"pass"=>$result['password']);
                        $this->session->set_flashdata($flash);
                        $this->session->set_flashdata("msg","Member Added successfully!");
                        redirect('registered/');
                    }
				}
				else{
					$this->session->set_flashdata("err_msg",$result['message']);
				}
			}
			else{
				$this->session->set_flashdata("err_msg","Invalid Sponsor ID!");
			}
		}
        if($this->input->post('generate')!=1){
            redirect('members/');
        }
	}
	
	public function updatemember(){
		if($this->input->post('updatemember')!==NULL){
			$data=$this->input->post();
			$regid=$data['regid'];
			$userdata=$memberdata=$accountdata=$treedata=array();
			
			if(isset($data['name'])){
				$userdata['mobile']=$data['mobile'];
				$userdata['name']=$data['name'];
				$userdata['email']=$data['email'];
				
				$memberdata['name']=$data['name'];
				$memberdata['dob']=$data['dob'];
				$memberdata['father']=$data['father'];
				$memberdata['mother']=$data['mother'];
				$memberdata['occupation']=$data['occupation'];
				$memberdata['qualification']=$data['qualification'];
				$memberdata['a_income']=$data['a_income'];
				$memberdata['gender']=$data['gender'];
				$memberdata['mstatus']=$data['mstatus'];
				$memberdata['mobile']=$data['mobile'];
				$memberdata['email']=$data['email'];
				$memberdata['aadhar']=$data['aadhar'];
				$memberdata['pan']=$data['pan'];
				$memberdata['address']=$data['address'];
				$memberdata['district']=$data['district'];
				$memberdata['state']=$data['state'];
				$memberdata['pincode']=$data['pincode'];
				$memberdata['pob']=$data['pob'];
				$memberdata['govt_service']=$data['govt_service'];
				$memberdata['height']=$data['height'];
				$memberdata['weight']=$data['weight'];
				$memberdata['i_mark']=$data['i_mark'];
				$memberdata['policy_no']=$data['policy_no'];
			}
			if(isset($data['bank'])){
				$accountdata['bank']=$data['bank'];
				$accountdata['branch']=$data['branch'];
				$accountdata['city']=$data['city']??'';
				$accountdata['account_no']=$data['account_no'];
				$accountdata['account_name']=$data['account_name'];
				$accountdata['ifsc']=$data['ifsc'];
			}
			$data=array("userdata"=>$userdata,"memberdata"=>$memberdata,"accountdata"=>$accountdata);
			
			
			$result=$this->member->updatemember($data,$regid);
			if($result===true){
				$this->session->set_flashdata("msg","Member Updated successfully!");
			}
			else{
				$this->session->set_flashdata("err_msg","Member Not Updated!");
			}
		}
		redirect('members/memberlist/');
	}
		
	public function updatedocs(){
		if($this->input->post('updatedocs')!==NULL){
			$where['regid']=$this->input->post('regid');
			$name=$this->input->post('name');
			$upload_path="./assets/uploads/documents/";
            $allowed_types="jpg|jpeg|png|webp";
			$file_name=$name;
			$upload=upload_file('pan',$upload_path,$allowed_types,$file_name.'_pan',10000);
			if($upload['status']===true){
				$data['pan']=$upload['path'];
			}
			$upload=upload_file('aadhar1',$upload_path,$allowed_types,$file_name.'_aadhar1',10000);
			if($upload['status']===true){
				$data['aadhar1']=$upload['path'];
			}
			$upload=upload_file('aadhar2',$upload_path,$allowed_types,$file_name.'_aadhar2',10000);
			if($upload['status']===true){
				$data['aadhar2']=$upload['path'];
			}
			$upload=upload_file('cheque',$upload_path,$allowed_types,$file_name.'_cheque',10000);
			if($upload['status']===true){
				$data['cheque']=$upload['path'];
			}
			foreach($data as $key=>$value){
				if(empty($value)){ unset($data[$key]); }
			}
			if(!empty($data)){
				$result=$this->member->updateaccdetails($data,$where);
				if($result===true){
					$this->session->set_flashdata("msg","Document successfully!");
				}
				else{
					$this->session->set_flashdata("err_msg",$result['message']);
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
    
	public function activatemember(){
		if($this->input->post('activatemember')!==NULL){
			$data=$this->input->post();
			unset($data['activatemember']);
			$result=$this->member->activatemember($data);
			if($result===true){
				$memberdata=$this->account->getuser(array("id"=>$data['regid']));
				$message="Hi $memberdata[name]! Your ID has been successfully activated! ";
				$message.= "Visit our site ".str_replace('members.','',base_url()).".";
				$smsdata=array("mobile"=>$memberdata['mobile'],"message"=>$message);
				send_sms($smsdata);
				$this->session->set_flashdata("msg","Member Activated successfully!");
			}
			else{
				$this->session->set_flashdata("err_msg",$result['message']);
			}
		}
		redirect('epins/unused/');
	}
	
	public function groupactivation(){
        $id=$this->input->get('id');
        $getuser=$this->account->getuser(["md5(concat('regid-',id))"=>$id]);
        //print_pre($getuser,true);
		if($getuser['status']===true){
            $user=$getuser['user'];
            $data=array('regid'=>$user['id'],'package_id'=>0);
			//unset($data['activatemember']);
			$result=$this->member->activatemember($data);
			if($result===true){
				$memberdata=$this->account->getuser(array("id"=>$data['regid']));
				$message="Hi $memberdata[name]! Your ID has been successfully activated! ";
				$message.= "Visit our site ".str_replace('members.','',base_url()).".";
				$smsdata=array("mobile"=>$memberdata['mobile'],"message"=>$message);
				//send_sms($smsdata);
				$this->session->set_flashdata("msg","Group Activated successfully!");
			}
			else{
				$this->session->set_flashdata("err_msg",$result['message']);
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function approvekyc(){
		if($this->input->post('kyc')!==NULL){
			$data['kyc']=$this->input->post('kyc');
			$where['regid']=$this->input->post('regid');
			$result=$this->member->approvekyc($data,$where);
			if($result===true){
				if($data['kyc']==3){ $status="Rejected"; }
				elseif($data['kyc']==1){ $status="Approved"; }
				$this->session->set_flashdata("msg","Member KYC $status!");
			}
			else{
				$this->session->set_flashdata("err_msg",$result['message']);
			}
		}
		redirect('members/kyc/');
	}
	
	public function getrefid(){
		$username=$this->input->post('username');
		$status=$this->input->post('status');
        $member=array('regid'=>0,'name'=>'');
        if($this->session->role=='admin' && $username=='admin'){
            $member=array('name'=>'Admin','regid'=>1);
        }
        elseif($username!='admin'){
            $member=$this->member->getmemberid($username,$status);
            if($member['regid']==0){
                $member['name']="Sponsor ID not Available!";
            }
        }
        elseif($username=='admin'){
            $member['name']="Sponsor ID not Available!";
        }
		echo json_encode($member);
	}
	
	public function getpopupdetails(){
		$regid=$this->input->post('regid');
		$array=$this->member->getpopupdetails($regid);
		echo json_encode($array);
	}
	
	public function gettree(){
		$regid=$this->input->post('regid');
		if((int)$regid==0){
			$where['username']=str_replace('a','',$regid);
			$getuser=$this->account->getuser($where);
            if($getuser['status']===true){
                $array=$getuser['user'];
                $regid=$array['id'];
                $data['user']=getuser();
                $user_id=$data['user']['id'];
                $members=$this->member->getallmembers($user_id,array(),"array");
                if(array_search($regid,$members)===false){
                    $regid='';
                }
            }
            else{
                $regid='';
            }
		}
		if($regid!=''){
            $this->load->helper('tree');
			$regids=generateTree($regid);
			$tree=createTree($regids);
			echo $tree;
		}
		else{
			echo "invalid";
		}
	}
	
	public function getmemberid(){
		$username=$this->input->post('username');
		$status=$this->input->post('status');
		$member=$this->member->getmemberid($username,$status);
		echo json_encode($member);
	}
	
    public function entertomember(){
        if($this->session->role!='admin'){ redirect('/'); }
        $data=['title'=>'Enter To Member'];
        $this->template->load('members','entertomember',$data);
    }
    
    public function memberdashboard(){
        if($this->session->role!='admin'){ redirect('/'); }
        $data=$this->input->post();
        $member=$this->member->getmemberid($data['member_id'],'all');
        if($member['regid']==0){
            $this->session->set_flashdata('err_msg',$member['name']);
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{
            $username=md5('username-'.$data['member_id']);
            redirect('login/userlogin/'.$username);
        }
    }
    
    public function adminactivate(){
        $data=$this->input->post();
        $encid=$data['id'];
        $policy_no=$data['policy_no'];
        $getuser=$this->account->getuser(["md5(concat('regid-',id))"=>$encid]);
        if($getuser['status']===true){
            $user=$getuser['user'];
            $member=$this->member->getmemberid($user['username'],'not activated');
            if($member['regid']==0){
                $this->session->set_flashdata('err_msg',$member['name']);
            }
            else{
                $data=array('regid'=>$user['id'],'policy_no'=>$policy_no);
                $result=$this->member->activatemember($data);
                if($result['status']===true){
                    $text="Activated";
                    $this->session->set_flashdata("msg","Member Id $text Successfully");
                }
                else{
                    $this->session->set_flashdata("err_msg",$result['message']);
                }
            }
        }
    }
    
	public function updatenominee(){
        $url='members/memberlist';
		if($this->input->post('updatenominee')!==NULL ){
			$data=$this->input->post();
			unset($data['updatenominee']);
			$regid=$data['regid'];
            //print_pre($data,true);
			$result=$this->member->updatenomineedetails($data,['regid'=>$regid]);
			if($result===true){
				$this->session->set_flashdata("msg","Nominee Details Updated successfully!");
			}
			else{
				$this->session->set_flashdata("err_msg","Member Not Updated!");
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
    
	public function updatefamily(){
        $url='members/memberlist';
		if($this->input->post('updatefamily')!==NULL ){
			$data=$this->input->post();
			$regid=$data['regid'];
			unset($data['updatefamily']);
            $familydata=array();
            foreach($data['relations'] as $key=>$relation){
                if(empty($data['status'][$key]) && empty($data['age'][$key])){
                    continue;
                }
                $death_date=empty($data['death_date'][$key])?NULL:$data['death_date'][$key];
                $type_of_death=empty($data['type_of_death'][$key])?NULL:$data['type_of_death'][$key];
                $familydata[]=array('regid'=>$regid,'relation'=>$relation,'status'=>$data['status'][$key],
                                    'age'=>$data['age'][$key],'health'=>$data['health'][$key],'death_date'=>$death_date,
                                    'type_of_death'=>$type_of_death);
            }

            if(empty($familydata)){
                $this->db->delete("family",['regid'=>$regid]);
            }
            else{
                $result=$this->member->updatefamilydetails($familydata);
                if($result===true){
                    $this->session->set_flashdata("msg","Family Details Updated successfully!");
                }
                else{
                    $this->session->set_flashdata("err_msg","Member Not Updated!");
                }
            }
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
		
    public function updatepassword(){
        if($this->input->post('updatepassword')!==NULL){
            $regid=$this->input->post('regid');
            $password=$this->input->post('password');
            $repassword=$this->input->post('retype');
			if($password==$repassword){
				$result=$this->account->updatepassword(array("password"=>$password),array("id"=>$regid));
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
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function generatemembers(){
        if($this->input->post('generatemembers')!==NULL){
            $data=$this->input->post();
            $getreferrer=$this->account->getuser("id='$data[refid]'");
			$userdata=$memberdata=array();
			if($getreferrer['status']===true){
                for($i=0;$i<$data['count'];$i++){
                    $memberdata=array('refid'=>$data['refid'],'position'=>$data['position'],'name'=>'Demo',
                                      'mobile'=>'0000000000','email'=>'demo@gmail.com','password'=>'12345','generate'=>'1');
                    $_POST=$memberdata;
                    $this->addmember();
                }
                $this->session->set_flashdata('msg',"Members Generated Successfully");
			}
			else{
				$this->session->set_flashdata("err_msg","Invalid Sponsor ID!");
			}
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
	/*public function upgrade(){
		checklogin();
		if($this->session->role=='admin'){
			redirect('members/downline/');
		}
		$data['title']="Upgrade";
		$data['user']=getuser();
		$regid=$data['user']['id'];
        $memberdetails=$this->member->getmemberdetails($regid);
        if($memberdetails['upgrade']==1){
			redirect('/');
            
        }
		$options=array(""=>"Select Bank");
		$banks=$this->member->getbanks();
		if(is_array($banks)){
			foreach($banks as $bank){
				$options[$bank['name']]=$bank['name'];
			}
		}
		$data['banks']=$options;
        $data['upgrade']=$this->member->getupgraderequests(array("regid"=>$regid),"single");
		$this->template->load('members','request',$data);
	}
	
	public function upgraderequests(){
		if($this->session->role!='admin'){ redirect('/'); }
		$data['title']="Upgrade Request List";
		$data['breadcrumb']=array("/"=>"Home");
		$members=$this->member->getupgraderequests(array("t1.status"=>"0"));
		$data['members']=$members;
		$data['datatable']=true;
		$this->template->load('members','requestlist',$data);
	}
	
    public function requestupgrade(){
		if($this->input->post('requestupgrade')!==NULL){
			$data=$this->input->post();
			unset($data['requestupgrade'],$data['paid_amount']);
			$result=$this->member->requestupgrade($data);
			if($result===true){
				$this->session->set_flashdata("msg","Upgrade Request Saved successfully!");
			}
			else{
				$this->session->set_flashdata("err_msg",$result['message']);
			}
		}
		redirect('members/upgrade/');
    }
    
	public function approveupgrade(){
        $request_id=$this->input->post('request_id');
        $result=$this->member->approveupgrade($request_id);
        if($result===true){
            $this->session->set_flashdata("msg","Member Upgraded successfully!");
        }
        else{
            $this->session->set_flashdata("err_msg",$result['message']);
        }
    }
    */
		
}
