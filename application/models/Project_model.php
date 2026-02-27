<?php
class Master_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function savestate($data){
        if($this->db->get_where('states',['LOWER(name)'=>strtolower($data['name'])])->num_rows()==0){
            $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
            if($this->db->insert('states',$data)){
                return array("status"=>true,"message"=>"State Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"State Already Added!");
        }
    }

    public function getstates($where=array(),$type="all",$order_by="id"){
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('states t1');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatestate($data){
        if($this->db->get_where('states',['LOWER(name)'=>strtolower($data['name']),'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            $data['updated_on']=date('Y-m-d H:i:s');
            logupdateoperations('states',$data,$where);
            if($this->db->update('states',$data,$where)){
                return array("status"=>true,"message"=>"State Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"State Already Added!");
        }
    }

}