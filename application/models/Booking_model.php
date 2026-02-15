<?php
class Booking_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function savebooking($data){
        $bdata=$data['bdata'];
        $details=$data['details'];
        $nomineedata=$data['nomineedata'];
        $bdata['added_on']=$bdata['updated_on']=date('Y-m-d H:i:s');
        $this->db->trans_start();
        if($this->db->insert('bookings',$bdata)){
            $booking_id=$this->db->insert_id();
            
            $details['booking_id']=$booking_id;
            $details['added_on']=$details['updated_on']=date('Y-m-d H:i:s');
            
            $nomineedata['booking_id']=$booking_id;
            $this->db->insert('nominee',$nomineedata);
            $this->db->insert('booking_details',$details);
            $this->db->trans_complete();
            return array('status'=>true,'message'=>"Booking Save Successfully");
        }
        else{
            $error=$this->db->error();
            return array('status'=>false,'message'=>$error['message']);
        }
    }
    
    public function getbookings($where=array(),$type='all',$order_by='t1.id desc'){
        $columns ="t1.*,t1.type as b_type,t2.type,t2.city,t2.landmark,t2.price,t2.other_price,t2.total_amount";
        $columns.=",t2.token_amount,t2.payment_mode,t2.payment_type";
        $columns.=",t4.username as member_id,t4.name as member_name,t3.status as a_status";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('bookings t1');
        $this->db->join('booking_details t2','t1.id=t2.booking_id');
        $this->db->join('members t3','t1.regid=t3.regid');
        $this->db->join('users t4','t1.regid=t4.id');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function getbookingdetails($where=array()){
        $columns ="t1.*,t2.username as member_id,t2.name as member_name,t2.mobile as member_mobile";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->from('bookings t1');
        $this->db->join('users t2','t1.regid=t2.id');
        $query=$this->db->get();
        $array=$query->unbuffered_row('array');
        if(!empty($array)){
            $array['details']=$this->db->get_where('booking_details',['booking_id'=>$array['id']])->unbuffered_row('array');
            $array['nominee']=$this->db->get_where('nominee',['booking_id'=>$array['id']])->unbuffered_row('array');
        }
        return $array;
    }
    
	public function approvebooking($booking_id,$regid){
        $member=$this->db->get_where('members',['regid'=>$regid])->unbuffered_row('array');
        $datetime=date('Y-m-d H:i:s');
        $data=array('approved_date'=>$datetime,'approved_by'=>1,'status'=>1,'updated_on'=>$datetime);
        $parent_id=logupdateoperations('bookings',$data,['id'=>$booking_id]);
        if($this->db->update('bookings',$data,['id'=>$booking_id])){
            $parent_id=logupdateoperations('booking_details',['status'=>1,'updated_on'=>$datetime],
                                           ['booking_id'=>$booking_id]);
            $this->db->update('booking_details',['status'=>1,'updated_on'=>$datetime],
                              ['booking_id'=>$booking_id]);
            if($member['status']==0){
                $data=array('activation_date'=>$datetime,'status'=>1);
                $parent_id=logupdateoperations('members',$data,['regid'=>$regid]);
                $this->db->update('members',$data,['regid'=>$regid]);
            }
            return array('status'=>true,'message'=>"Booking Approved Successfully");
        }
        else{
            $error=$this->db->error();
            return array('status'=>false,'message'=>$error['message']);
        }
	}
	
}