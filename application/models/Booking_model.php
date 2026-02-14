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
        $bdata['added_on']=$bdata['added_on']=date('Y-m-d H:i:s');
        $this->db->trans_start();
        if($this->db->insert('bookings',$bdata)){
            $booking_id=$this->db->insert_id();
            
            $details['booking_id']=$booking_id;
            $details['added_on']=$details['added_on']=date('Y-m-d H:i:s');
            
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
}