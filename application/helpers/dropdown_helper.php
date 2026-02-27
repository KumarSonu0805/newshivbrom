<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
    if(!function_exists('state_dropdown')){
        function state_dropdown($where=array('status'=>1),$new=false){
            $CI = get_instance();
            $options=array(''=>'Select State');
            if($new){
                $options['new']='Add New';
            }
            $states=$CI->master->getstates($where);
            if(!empty($states)){
                foreach($states as $state){
                    $options[$state['id']]=$state['name'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('district_dropdown')){
        function district_dropdown($where=array('t1.status'=>1),$new=false){
            $CI = get_instance();
            $options=array(''=>'Select District');
            if($new){
                $options['new']='Add New';
            }
            $districts=$CI->master->getdistricts($where);
            if(!empty($districts)){
                foreach($districts as $district){
                    $options[$district['id']]=$district['name'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('city_dropdown')){
        function city_dropdown($where=array('t1.status'=>1),$new=false){
            $CI = get_instance();
            $options=array(''=>'Select City');
            if($new){
                $options['new']='Add New';
            }
            $cities=$CI->master->getcities($where);
            if(!empty($cities)){
                foreach($cities as $city){
                    $options[$city['id']]=$city['name'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('relation_dropdown')){
        function relation_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Relation','Father'=>'Father','Mother'=>'Mother','Husband/Wife'=>'Husband/Wife','Son'=>'Son','Daughter'=>'Daughter','Brother'=>'Brother',
                           'Sister'=>'Sister');
            return $options;
        }
    }
