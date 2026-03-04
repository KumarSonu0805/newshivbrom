<?php
class Wallet_model extends CI_Model{
	
    var $status=false;
    var $activation_date=NULL;
    
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
	
	public function checkstatus($regid,$date=NULL){
		$where=array("regid"=>$regid,"status"=>'1');
        $this->activation_date=NULL;
		$getmember=$this->db->get_where("members",$where);
		if($getmember->num_rows()==0){ $this->status=false; }
		else{ 
            $member=$getmember->unbuffered_row('array');
            if(date('Y-m-d',strtotime($member['activation_date']))>$date){
                $this->status=false;
            }
            else{
                $this->status=true; 
                $this->activation_date = $member['activation_date'];
            }
        }
	}
	
    public function directincome($regid,$date=NULL){
        if($date===NULL){
            $date=date('Y-m-d');
        }
        //echo '<br>------------------------<br>';
        //echo $regid;
        if($this->status){
            $newdirects=$this->member->getdirectmembers($regid,1);
            //print_pre($newdirects);
            if(!empty($newdirects)){
                foreach($newdirects as $member){
                    if($member['status']==1 && $member['activation_date']>$this->activation_date){
                        $member_id=$member['regid'];
                        $this->db->order_by('t1.approved_date asc');
                        $booking=$this->booking->getbookings(['t1.regid'=>$member_id,'t1.status'=>1],'single');
                        if(!empty($booking)){
                            $where="booking_id='$booking[id]' and status='1' and id not in (SELECT payment_id from ".TP."wallet where regid='$regid' and remarks='Direct Income')";
                            $payments=$this->db->get_where('booking_payment',$where)->result_array();
                            $booking_id=$booking['id'];
                            $this->db->select_sum('amount');
                            $deposited_amount=$this->db->get_where('booking_payment',"booking_id='$booking[id]' and status='1'")->unbuffered_row()->amount;
                            $deposited_amount=empty($deposited_amount)?0:$deposited_amount;
                            $newdeposits=!empty($payments)?array_column($payments,'amount'):array();
                            $new_amount=array_sum($newdeposits);
                            $current_deposit=$deposited_amount-$new_amount;
                            foreach($payments as $payment){
                                if($deposited_amount>=$this->min_deposit){
                                    $payment_id=$payment['id'];
                                    $where=array("type"=>"ewallet","regid"=>$regid,"member_id"=>$member_id,
                                                 "booking_id"=>$booking_id,"payment_id"=>$payment_id,
                                                 "remarks"=>"Direct Income");
                                    if($this->db->get_where("wallet",$where)->num_rows()==0){
                                        unset($where['payment_id']);
                                        $this->db->select_sum('amount');
                                        $added=$this->db->get_where('wallet',$where)->unbuffered_row()->amount;
                                        $added=empty($added)?0:$added;
                                        $current_deposit+=$payment['amount'];
                                        $percent = calculatepercent($booking['price'],$current_deposit);
                                        $amount = calculateincome($percent,'direct',$added);
                                        $amount=round($amount,2);
                                        //echo $regid.':: '.$payment_id.':: '.$added.':: '.$percent.':: '.$amount.'<br>';
                                        if($amount>0){
                                            $amount=round($amount,2);
                                            $data=array("date"=>$date,"type"=>"ewallet","regid"=>$regid,"member_id"=>$member_id,
                                                        "booking_id"=>$booking_id,"payment_id"=>$payment_id,"percent"=>$percent,
                                                        "amount"=>$amount,"remarks"=>"Direct Income",
                                                        "added_on"=>date('Y-m-d H:i:s'),"updated_on"=>date('Y-m-d H:i:s'));
                                            
                                            $this->db->insert("wallet",$data);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
        }
    }
	
    public function matchingincome($regid,$date=NULL){
        if($date===NULL){
            $date=date('Y-m-d');
        }
        if($this->status){
            $leftright=$this->member->getleftrightmembers($regid,NULL,"regids");
            $leftmembers=$leftright['left'];
            $rightmembers=$leftright['right'];
            
            if(empty($leftmembers) || empty($rightmembers)){
                return false;
            }
            else{
                $this->db->group_start();
                $left_chunks = array_chunk($leftmembers,25);
                foreach($left_chunks as $left_chunk){
                    $this->db->or_where_in('regid', $left_chunk);
                }
                $this->db->group_end();
                $this->db->select("regid");
                $where="status='1' and activation_date>'".$this->activation_date."' and date(activation_date)<='$date' 
                        and refid='$regid'";
				$this->db->order_by("activation_date");
                $leftdirect=$this->db->get_where("members",$where)->result_array();
                
                $this->db->group_start();
                $right_chunks = array_chunk($rightmembers,25);
                foreach($right_chunks as $right_chunk){
                    $this->db->or_where_in('regid', $right_chunk);
                }
                $this->db->group_end();
                $this->db->select("regid");
                $where="status='1' and activation_date>'".$this->activation_date."' and date(activation_date)<='$date' 
                        and refid='$regid'";
				$this->db->order_by("activation_date");
                $rightdirect=$this->db->get_where("members",$where)->result_array();
            }
            if(empty($leftdirect) || empty($rightdirect)){
                return false;
            }
            
            $leftbookings=getdownlinebv($leftmembers,$this->activation_date);
            $rightbookings=getdownlinebv($rightmembers,$this->activation_date);
            
            if(empty($leftbookings) || empty($rightbookings)){
                return false;
            }
            //echo 'Left';
            //print_pre($leftbookings);
            //echo 'Right';
            //print_pre($rightbookings);
            $leftbvs=array_column($leftbookings,'bv');
            $rightbvs=array_column($rightbookings,'bv');
            
            $leftbv=array_sum($leftbvs);
            $rightbv=array_sum($rightbvs);
            
            $this->db->select('sum(leftbv) as leftbv, sum(rightbv) as rightbv');
            $prevmatchings=$this->db->get_where('wallet',['regid'=>$regid,'date<'=>$date,
                                                          'remarks'=>'Matching Income'])->unbuffered_row('array');
            //print_pre($prevmatchings);
            $prevleftbv=$prevmatchings['leftbv']??0;
            $prevrightbv=$prevmatchings['rightbv']??0;
            
            $leftbv-=$prevleftbv;
            $rightbv-=$prevrightbv;
            
            if($leftbv<$rightbv){
                $matching=$leftbv;
            }else{
                $matching=$rightbv;
            }
            if($matching>0){
                $amount = ($matching*$this->matching)/100;
                $amount=round($amount,2);
                //echo $regid.':: '.$payment_id.':: '.$added.':: '.$percent.':: '.$amount.'<br>';
                if($amount>0){
                    $amount=round($amount,2);
                    $data=array("date"=>$date,"type"=>"ewallet","regid"=>$regid,"leftbv"=>$matching,"rightbv"=>$matching,
                                "amount"=>$amount,"remarks"=>"Matching Income",
                                "added_on"=>date('Y-m-d H:i:s'),"updated_on"=>date('Y-m-d H:i:s'));
                    $where=array("date"=>$date,"type"=>"ewallet","regid"=>$regid,"remarks"=>"Matching Income");
                    if($this->db->get_where('wallet',$where)->num_rows()==0){
                        $this->db->insert("wallet",$data);
                    }
                    else{
                        unset($data['added_on']);
                        $this->db->update("wallet",$data,$where);
                    }
                    
                }
            }
        }
    }
	
	public function addcommission($regid,$date=NULL){
		$this->checkstatus($regid,$date);
        if($this->status){
            //echo '<br>---------------------<br>';
            //echo $regid.':'.$this->activation_date.':';
            //var_dump($this->status);
            //echo '<br>';
        }
		$this->directincome($regid,$date);
		$this->matchingincome($regid,$date);
		//$this->addreward($regid,$date);
	}
	
	public function addallcommission($date=NULL){
		if($date===NULL){
			$date=date('Y-m-d');
		}
		$this->db->select('id');
		$where="id>1";
        $this->db->order_by('id desc');
		$query=$this->db->get_where("users",$where);
		$array=$query->result_array();
		if(is_array($array)){
			foreach($array as $user){
				$this->addcommission($user['id'],$date);
			}
		}
	}
	
	public function getwallet($regid,$type="ewallet"){
		$result=array();
		$where=array("regid"=>$regid);
		$this->db->select_sum('amount');
		$query=$this->db->get_where("wallet",$where);
		$wallet=$query->row()->amount;
		if($wallet==NULL){ $wallet=0; }
		$result['wallet']=$wallet;
		
		$bankwithdrawal=$wallettransfers=$walletreceived=$epingeneration=$cancelled=0;
		if($type=="ewallet"){
			$where2=array("regid"=>$regid,"status!="=>2);
			$this->db->select_sum('amount','amount');
			$query2=$this->db->get_where("withdrawals",$where2);
			$bankwithdrawal=$query2->row()->amount;
			if($bankwithdrawal==NULL){ $bankwithdrawal=0; }
			
			$where3=array("reg_from"=>$regid);
			$this->db->select_sum('amount');
			$query3=$this->db->get_where("wallet_transfers",$where3);
			$wallettransfers=$query3->row()->amount;
			if($wallettransfers==NULL){ $wallettransfers=0; }
			
			$where4=array("reg_to"=>$regid);
			$this->db->select_sum('amount');
			$query4=$this->db->get_where("wallet_transfers",$where4);
			$walletreceived=$query4->row()->amount;
			if($walletreceived==NULL){ $walletreceived=0; }
			
			
		}
		$result['bankwithdrawal']=$bankwithdrawal;
		
		$result['cancelled']=$cancelled;
		
		$result['wallettransfers']=$wallettransfers;
		
		$result['walletreceived']=$walletreceived;
		
		$result['actualwallet']=$wallet-$bankwithdrawal-$wallettransfers+$walletreceived+$cancelled;
		$result['wallet']=$result['actualwallet']-(10*$result['actualwallet'])/100;
		return $result;
	}
	
	public function memberincome($regid){
		$this->db->order_by("id");
		$array=$this->db->get_where("wallet",array("regid"=>$regid,"amount>"=>"0"))->result_array();
		return $array;
	}
	
	public function transferamount($data){
		if($this->db->insert("wallet_transfers",$data)){
			return true;
		}
		else{
			return $this->db->error();
		}
	}
	
	public function gethistory($regid,$type="register",$wallet="ewallet"){
		if($type=="register"){
			$where=array("reg_from"=>$regid,"type_from"=>$wallet);
		}
		else{
			$where=array("reg_to"=>$regid,"type_to"=>$wallet);
		}
		$array=$this->db->get_where("wallet_transfers",$where)->result_array();
		if(is_array($array)){
			foreach($array as $key=>$value){
				$to=$this->db->get_where("users",array("id"=>$value['reg_to']))->row_array();
				$from=$this->db->get_where("users",array("id"=>$value['reg_from']))->row_array();
				$array[$key]['to_id']=$to["username"];
				$array[$key]['to_name']=$to["name"];
				$array[$key]['from_id']=$from["username"];
				$array[$key]['from_name']=$from["name"];
			}
		}
		return $array;
	}
	
	public function requestpayout($data){
		$regid=$data['regid'];
		$check=$this->db->get_where("withdrawals",array("regid"=>$regid,"status"=>"0"))->num_rows();
		if($check==0){
			if($this->db->insert("withdrawals",$data)){
				return true;
			}
			else{
				return $this->db->error();
			}
		}
		else{
			return array("message"=>"Previous Payout Request is Pending!");
		}
	}
	
	public function getmemberrequests($where){
		$this->db->where($where);
		$query=$this->db->get("withdrawals");
		$array=$query->result_array();
		return $array;
	}
	
	public function getwitdrawalrequest($where=array(),$type='all'){
		if(empty($where)){ $where['t1.status']=0; }
		$this->db->select("t1.*, t2.username,t2.name,t3.bank,t3.account_no,t3.account_name,t3.ifsc,t3.cheque");
		$this->db->from('withdrawals t1');
		$this->db->join('users t2','t1.regid=t2.id','Left');
		$this->db->join('acc_details t3','t1.regid=t3.regid','Left');
		$this->db->where($where);
		$query=$this->db->get();
		if($type=='all'){ $array=$query->result_array(); }
		else{ $array=$query->row_array(); }
		return $array;
	}
	
	public function approvepayout($id){
		$date=date('Y-m-d');
		$updated_on=date('Y-m-d H:i:s');
		if($this->db->update("withdrawals",array("status"=>1,"approve_date"=>$date,"updated_on"=>$updated_on),array("id"=>$id))){
			return true;
		}
		else{
			return $this->db->error();
		}
	}
	
	public function rejectpayout($id,$reason){
		$updated_on=date('Y-m-d H:i:s');
		$data=array("status"=>2,'reason'=>$reason,"updated_on"=>$updated_on);
		if($this->session->role=='admin'){
			$data['approve_date']=date('Y-m-d');
		}
		if($this->db->update("withdrawals",$data,array("id"=>$id))){
			return true;
		}
		else{
			return $this->db->error();
		}
	}
	
	public function paymentreport($where=array(),$type='all'){
		$where['t1.status']=1;
		$columns="t1.approve_date,t2.username, t2.name,t3.account_no,t3.ifsc,amount,tds,admin_charge,t1.payable as paidamount";
		$this->db->select($columns);
		$this->db->from('withdrawals t1');
		$this->db->join('users t2','t1.regid=t2.id','Left');
		$this->db->join('acc_details t3','t1.regid=t3.regid','Left');
		$this->db->order_by("t1.approve_date");
		$this->db->where($where);
		$query=$this->db->get();
		if($type=='all'){ $array=$query->result_array(); }
		else{ $array=$query->row_array(); }
		return $array;
	}
	
	public function approveallpayout($endtime){
		$where=array("t1.status"=>0,"t1.added_on<"=>$endtime);
		$members=$this->Wallet_model->getwitdrawalrequest($where);
		foreach($members as $member){
			$this->approvepayout($member['id']);
		}
	}
	
	public function dailypaymentreport(){
		$this->db->select("approve_date,sum(payable) as total_amount");
		$this->db->group_by("approve_date");
		$query=$this->db->get_where("withdrawals",array("status"=>1));
		$array=$query->result_array();
		return $array;
	}
	
	public function getmemberrewards(){
		$this->db->select("t2.username,t2.name,t1.*,t3.category");
		$this->db->from("member_rewards t1");
		$this->db->join("users t2","t1.regid=t2.id");
		$this->db->join("rewards t3","t1.reward_id=t3.id");
		$this->db->order_by("t1.status,t1.id");
		//$this->db->where(array("t1.status"=>"0"));
		$query=$this->db->get();
		$array=$query->result_array();
		return $array;
	}
	
	public function approvereward($id){
		if($this->db->update("member_rewards",array("status"=>1,"approve_date"=>date('Y-m-d')),array("id"=>$id))){
			return true;
		}
		else{
			return $this->db->error();
		}
	}
	
	public function getmembercommission(){
		$this->db->select("t1.regid,t2.username,t2.name,sum(t1.amount) as total");
		$this->db->from("wallet t1");
		$this->db->join("users t2","t1.regid=t2.id");
		$this->db->group_by("t1.regid");
		$array=$this->db->get()->result_array();
		if(is_array($array)){
			foreach($array as $key=>$member){
				$where2=array("regid"=>$member['regid'],"status!="=>2);
				$this->db->select_sum('amount','amount');
				$query2=$this->db->get_where("withdrawals",$where2);
				$bankwithdrawal=$query2->row()->amount;
				if($bankwithdrawal==NULL){ $bankwithdrawal=0; }
				$array[$key]['available']=$member['total']-$bankwithdrawal;
			}
		}
		return $array;
	}
}
