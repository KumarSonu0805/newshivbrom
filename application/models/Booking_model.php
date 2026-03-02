<?php
class Booking_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function savebooking($data){
        $bdata=$data['bdata'];
        $payment=$data['payment'];
        $bdata['added_on']=$bdata['updated_on']=date('Y-m-d H:i:s');
        $this->db->trans_start();
        if($this->db->insert('bookings',$bdata)){
            $booking_id=$this->db->insert_id();
            
            $payment['added_on']=$payment['updated_on']=date('Y-m-d H:i:s');
            
            $payment['booking_id']=$booking_id;
            $this->db->insert('booking_payment',$payment);
            $this->db->trans_complete();
            return array('status'=>true,'message'=>"Booking Save Successfully!");
        }
        else{
            $error=$this->db->error();
            return array('status'=>false,'message'=>$error['message']);
        }
    }
    
    public function getbookings($where=array(),$type='all',$order_by='t1.id desc'){
        $columns ="t1.*,t5.name as state,t6.name as district,t7.name as city,t5b.name as b_state,t6b.name as b_district,
                    t7b.name as b_city";
        $columns.=",t2.amount as paid_amount,t2.payment_type,t2.payment_mode";
        $columns.=",t4.username as member_id,t4.name as member_name,t3.status as a_status,t8.name as nominee_name";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('bookings t1');
        $this->db->join('booking_payment t2','t1.id=t2.booking_id');
        $this->db->join('members t3','t1.regid=t3.regid');
        $this->db->join('users t4','t1.regid=t4.id');
        $this->db->join('states t5','t1.state_id=t5.id');
        $this->db->join('districts t6','t1.district_id=t6.id');
        $this->db->join('cities t7','t1.city_id=t7.id');
        $this->db->join('states t5b','t1.b_state_id=t5b.id');
        $this->db->join('districts t6b','t1.b_district_id=t6b.id');
        $this->db->join('cities t7b','t1.b_city_id=t7b.id');
        $this->db->join('nominee t8','t1.id=t8.booking_id','left');
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
        $columns.=",t3.name as state,t4.name as district,t4.name as city,t3b.name as b_state,t4b.name as b_district,
                    t4b.name as b_city";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->from('bookings t1');
        $this->db->join('users t2','t1.regid=t2.id');
        $this->db->join('states t3','t1.state_id=t3.id');
        $this->db->join('districts t4','t1.district_id=t4.id');
        $this->db->join('cities t5','t1.city_id=t5.id');
        $this->db->join('states t3b','t1.b_state_id=t3b.id');
        $this->db->join('districts t4b','t1.b_district_id=t4b.id');
        $this->db->join('cities t5b','t1.b_city_id=t5b.id');
        $query=$this->db->get();
        $array=$query->unbuffered_row('array');
        if(!empty($array)){
            $array['details']=$this->db->get_where('booking_details',['booking_id'=>$array['id']])->unbuffered_row('array');
            $array['nominee']=$this->db->get_where('nominee',['booking_id'=>$array['id']])->unbuffered_row('array');
            $array['payment']=$this->db->get_where('booking_payment',['booking_id'=>$array['id']])->unbuffered_row('array');
        }
        return $array;
    }
    
	public function approvebooking($booking_id,$regid){
        $member=$this->db->get_where('members',['regid'=>$regid])->unbuffered_row('array');
        $datetime=date('Y-m-d H:i:s');
        $data=array('approved_date'=>$datetime,'approved_by'=>1,'status'=>1,'updated_on'=>$datetime);
        $parent_id=logupdateoperations('bookings',$data,['id'=>$booking_id]);
        if($this->db->update('bookings',$data,['id'=>$booking_id])){
            $parent_id=logupdateoperations('booking_payment',$data,['booking_id'=>$booking_id,'status'=>0],$parent_id);
            $this->db->update('booking_payment',$data,['booking_id'=>$booking_id,'status'=>0]);
            if($member['status']==0){
                $data=array('activation_date'=>$datetime,'status'=>1);
                $parent_id=logupdateoperations('members',$data,['regid'=>$regid],$parent_id);
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