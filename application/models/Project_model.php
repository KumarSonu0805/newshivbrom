<?php
class Project_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function saveproject($data,$propertyimages){
        $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
        if($this->db->insert('projects',$data)){
            $project_id=$this->db->insert_id();
            if(!empty($propertyimages)){
                $images=array();
                foreach($propertyimages as $image){
                    $images[]=array('project_id'=>$project_id,'image'=>$image,'added_on'=>date('Y-m-d H:i:s'),
                                    'updated_on'=>date('Y-m-d H:i:s'));
                }
                $this->db->insert_batch('project_images',$images);
            }
            return array("status"=>true,"message"=>"Project Added Successfully!");
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }

    public function getprojects($where=array(),$type="all",$order_by="t1.id"){
        $this->db->select('t1.*,t2.name as state,t3.name as district,t4.name as city');
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('projects t1');
        $this->db->join('states t2','t1.state_id=t2.id');
        $this->db->join('districts t3','t1.district_id=t3.id');
        $this->db->join('cities t4','t1.city_id=t4.id');
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