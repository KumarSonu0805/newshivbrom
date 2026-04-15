<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MY_Controller {
    
	function __construct(){
		parent::__construct();
		checklogin();
	}
    
    public function index(){
        $data['title']="Projects";
        $data['projects']=$this->project->getprojects();
        $data['datatable']=true;
        $this->template->load('projects','projectlist',$data); 
    }
    
    public function addproject(){
        $data['title']="Add Project";
        $this->template->load('projects','projectform',$data); 
    }
    
    public function saveproject(){
        if($this->input->post('saveproject')!==NULL){
            $data=$this->input->post();
            unset($data['saveproject']);
            $data['amenities_facing']=!empty($data['amenities_facing'])?json_encode($data['amenities_facing']):NULL;
            //print_pre($_FILES,true);
            $upload_path="./assets/uploads/projects/".url_title($data['name']).'/';
            $allowed_types='gif|jpg|jpeg|png|svg|webp';
            $upload=upload_file('thumbnail_image',$upload_path,$allowed_types,'thumbnail_image');
            if($upload['status']===true){
                $data['thumbnail_image']=$upload['path'];
            }
            $upload=upload_file('village_map',$upload_path,$allowed_types,'village_map');
            if($upload['status']===true){
                $data['village_map']=$upload['path'];
            }
            $upload=upload_file('plot_paper',$upload_path,$allowed_types,'plot_paper');
            if($upload['status']===true){
                $data['plot_paper']=$upload['path'];
            }
            $property_images=array();
            if(is_array($_FILES['property_images']['name'])){
                $count=count($_FILES['property_images']['name']);
                for($i=0; $i<$count; $i++) {
                    if(is_uploaded_file($_FILES['property_images']['tmp_name'][$i])){
                        $_FILES['multi']['name']     = $_FILES['property_images']['name'][$i];
                        $_FILES['multi']['type']     = $_FILES['property_images']['type'][$i];
                        $_FILES['multi']['tmp_name'] = $_FILES['property_images']['tmp_name'][$i];
                        $_FILES['multi']['error']     = $_FILES['property_images']['error'][$i];
                        $_FILES['multi']['size']     = $_FILES['property_images']['size'][$i];
                        $upload_path="./assets/uploads/projects/".url_title($data['name']).'/';
                        $upload=upload_file('multi',$upload_path,$allowed_types,'property_images');
                        if($upload['status']===true){
                            $property_images[]=$upload['path'];
                        }
                    }
                }
            }
            
            $allowed_types="pdf";
            $upload=upload_file('brochure',$upload_path,$allowed_types,'brochure');
            if($upload['status']===true){
                $data['brochure']=$upload['path'];
            }
            //print_pre($property_images,true);
            $result=$this->project->saveproject($data,$property_images);
            //print_pre($result,true);
            if($result['status']===true){
                $this->session->set_flashdata('msg',$result['message']);
            }
            else{
                $this->session->set_flashdata('err_msg',$result['message']);
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function getproject(){
        $id=$this->input->post('project_id');
        $project=$this->project->getprojects(['t1.id'=>$id],'single');
        if(!empty($project)){
            $price=$project['price'];
            
            $corner_percent=$project['corner_extra_percentage'];
            $corner_cost=$corner_percent*$price/100;

            $amenities_percent=$project['amenities_percent'];
            $amenities_cost=$amenities_percent*$price/100;
            $other_price=$corner_cost+$amenities_cost;

            $discount=$project['discount'];

            $final_price=$price+$other_price;
            $final_price-=($final_price*$discount)/100;
            
            $project['other_price']=$other_price;
            $project['final_price']=$final_price;
        }
        
        echo json_encode($project);
    }
    
	
}