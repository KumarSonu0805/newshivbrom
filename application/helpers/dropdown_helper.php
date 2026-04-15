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

    if(!function_exists('bookingtype_dropdown')){
        function bookingtype_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Type','land'=>'Land Booking','flat'=>'Flat Booking');
            return $options;
        }
    }

    if(!function_exists('projecttype_dropdown')){
        function projecttype_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Type','land'=>'Land','flat'=>'Flat','mixed'=>'Mixed');
            return $options;
        }
    }

    if(!function_exists('project_dropdown')){
        function project_dropdown($where=array()){
            $CI = get_instance();
            $options=array(''=>'Select Project');
            $projects=$CI->project->getprojects($where);
            if(!empty($projects)){
                foreach($projects as $project){
                    $options[$project['id']]=$project['name'].'-'.$project['city'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('paymenttype_dropdown')){
        function paymenttype_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Payment Type','full_payment'=>'Full Payment','partial'=>'Partial Payment',
                           'token'=>'Token Payment');
            return $options;
        }
    }

    if(!function_exists('paymentmode_dropdown')){
        function paymentmode_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Payment Mode','cash'=>'Cash','online'=>'Online','cheque'=>'Cheque');
            return $options;
        }
    }

    if(!function_exists('projectstatus_dropdown')){
        function projectstatus_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Status','sale'=>'Sale','soldout'=>'Sold Out','upcoming'=>'Upcoming');
            return $options;
        }
    }

    if(!function_exists('propertytype_dropdown')){
        function propertytype_dropdown(){
            $CI = get_instance();
            $options=array(''=>'Select Property Type','residential'=>'Residential','commercial'=>'Commercial');
            return $options;
        }
    }

    if(!function_exists('amenities_dropdown')){
        function amenities_dropdown(){
            $CI = get_instance();
            $options=array('park'=>'Park','temple'=>'Temple');
            $options['swimming_pool']='Swimming Pool';
            $options['community_hall']='Community Hall';
            $options['playground']='Playground';
            $options['stadium']='Stadium';
            $options['gym']='Gym';
            $options['school']='School';
            $options['market']='Market';
            return $options;
        }
    }
