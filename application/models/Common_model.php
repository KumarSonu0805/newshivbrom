<?php
class Common_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function getbanks(){
        $array=$this->db->get('banks')->result_array();
        return $array;
    }
    
    public function savebannerimage($data){
        if($this->db->insert("banner_images",$data)){
            return array("status"=>true,"message"=>"Banner Image Added Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function getbannerimages($where=array(),$type="all"){
        $default=file_url('assets/images/default.jpg');
        $columns="t1.*,  case when t1.image='' then '$default' else concat('".file_url()."',t1.image) end as image";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->from("banner_images t1");
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatebannerimage($data,$where){
        if($this->db->update("banner_images",$data,$where)){
            return array("status"=>true,"message"=>"Banner Image Updated Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
      
    public function deletebannerimage($where){
        if($this->db->delete("banner_images",$where)){
            return array("status"=>true,"message"=>"Banner Image Deleted Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function saveyoutubelink($data){
        if($this->db->insert("youtube_links",$data)){
            return array("status"=>true,"message"=>"Banner Image Added Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function getyoutubelinks($where=array(),$type="all"){
        $columns="t1.*";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->from("youtube_links t1");
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updateyoutubelink($data,$where){
        if($this->db->update("youtube_links",$data,$where)){
            return array("status"=>true,"message"=>"Banner Image Updated Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
      
    public function homedata($regid){
        /*
        -Left Team
        -RIght Team
        -My Bookings
        -Income
        -Payout
        */
        $result=array();
        $left=$right=$leftbv=$rightbv=0;
        $leftright=$this->member->getleftrightmembers($regid,NULL,"regids");
        $left=!empty($leftright['left'])?count($leftright['left']):0;
        $right=!empty($leftright['right'])?count($leftright['right']):0;
        
        $bookings=$this->db->get_where('bookings',['regid'=>$regid])->num_rows();
        
        $this->db->select_sum('amount');
        $myincome=$this->db->get_where('wallet',['regid'=>$regid])->unbuffered_row()->amount;
        $myincome=$myincome===NULL?0:$myincome;
        
        $this->db->select_sum('amount');
        $this->db->where("closing is NOT NULL");
        $mypayout=$this->db->get_where('wallet',['regid'=>$regid])->unbuffered_row()->amount;
        $mypayout=$mypayout===NULL?0:$mypayout;
        
        $result['left']=$left;
        $result['right']=$right;
        $result['leftbv']=$leftbv;
        $result['rightbv']=$rightbv;
        $result['bookings']=$bookings;
        $result['myincome']=$myincome;
        $result['mypayout']=$mypayout;
        return $result;
    }
    
    public function adminhomedata(){
        /*
        -Total Users
        -Total Land Bookings
        -Total Flat Bookings
        -Pending Bookings
        -Approved Bookings
        */
        
        $total_users=$this->db->get("members")->num_rows();
        $active_users=$this->db->get_where("members",array("status"=>1))->num_rows();
        $inactive_users=$total_users-$active_users;
        
        $this->db->select('t2.username,t2.name,t2.email,t2.mobile,t3.name as sponsor,t1.status,t1.date');
        $this->db->from('members t1');
        $this->db->join('users t2','t1.regid=t2.id');
        $this->db->join('users t3','t1.refid=t3.id');
        $this->db->order_by('t1.id desc');
        $this->db->limit(15);
        $query=$this->db->get();
        $newusers=$query->result_array();
        
        $landbookings=$this->db->get_where('bookings',['booking_type'=>'land'])->num_rows();
        $flatbookings=$this->db->get_where('bookings',['booking_type'=>'flat'])->num_rows();
        $pendingbookings=$this->db->get_where('bookings',['status'=>0])->num_rows();
        $approvedbookings=$this->db->get_where('bookings',['status'=>1])->num_rows();
        
        $result['total_users']=$total_users;
        $result['active_users']=$active_users;
        $result['inactive_users']=$inactive_users;
        $result['newusers']=$newusers;
        $result['landbookings']=$landbookings;
        $result['flatbookings']=$flatbookings;
        $result['pendingbookings']=$pendingbookings;
        $result['approvedbookings']=$approvedbookings;
        
        return $result;
    }
    
    public function addnotification($data){
        $data['added_on']=date('Y-m-d H:i:s');
        if($this->db->insert("notifications",$data)){
            return array("status"=>true,"message"=>"Notification Added Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function getnotification($where=array(),$type="all"){
        $this->db->where($where);
        $query=$this->db->get("notifications");
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function addfranchisebonus($data){
        if($this->db->get_where('franchise',array('min_quantity'=>$data['min_quantity']))->num_rows()==0){
            if($this->db->insert("franchise",$data)){
                return array("status"=>true,"message"=>"Franchise Bonus Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Franchise Bonus Already Added!");
        }
    }
    
    public function getfranchisebonus($where=array(),$type="all"){
        $this->db->where($where);
        $query=$this->db->get("franchise");
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatefranchisebonus($data){
        $id=$data['id'];
        unset($data['id']);
        $where=array("id"=>$id);
        if($this->db->get_where('franchise',array('min_quantity'=>$data['min_quantity'],"id!="=>$id))->num_rows()==0){
            if($this->db->update("franchise",$data,$where)){
                return array("status"=>true,"message"=>"Franchise Bonus Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Franchise Bonus Already Added!");
        }
    }
    
    public function savenews($data){
        if($this->db->insert("news",$data)){
            return array("status"=>true,"message"=>"News Added Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function getnews($where=array(),$type="all",$order_by="id"){
        $columns="t1.*";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from("news t1");
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatenews($data,$where){
        if($this->db->update("news",$data,$where)){
            return array("status"=>true,"message"=>"News Updated Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
      
    public function saveticket($data){
        $data['date']=date('Y-m-d');
        $data['ticket_no']=empty($data['parent_id'])?time():$data['ticket_no'];
        $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
        if($this->db->insert("helpdesk",$data)){
            return array("status"=>true,"message"=>"Ticket Created Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function gethelpdeskmessages($where=array(),$type="all",$order_by="t1.id"){
        $columns="t1.*,t2.username,t2.name";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from("helpdesk t1");
        $this->db->join("users t2","t1.regid=t2.id");
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updateticket($data,$where){
        if($this->db->update("news",$data,$where)){
            return array("status"=>true,"message"=>"Ticket Updated Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
      
}
