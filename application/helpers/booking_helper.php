<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('calculatepercent')) {
  		function calculatepercent($total_amount,$paid) {
            $CI = get_instance();
            if($total_amount<=0 || $paid==0){ return 0; }
            $percent=$paid*100/$total_amount;
            return $percent;
		}  
	}

	if(!function_exists('calculateincome')) {
  		function calculateincome($percent,$type,$prevpaid=0,$bv=NULL) {
            $CI = get_instance();
            $bv = $bv??$CI->bv;
            $total_income=($bv*$CI->$type)/100;
            if($percent==0){ return 0; }
            $income=($percent*$total_income)/100;
            $income-=$prevpaid;
            return $income;
		}  
	}

	if(!function_exists('getdownlinebv')) {
  		function getdownlinebv($regids,$activation_date) {
            $CI = get_instance();
            $CI->db->group_start();
            $regid_chunks = array_chunk($regids,25);
            foreach($regid_chunks as $regid_chunk){
                $CI->db->or_where_in('t1.regid', $regid_chunk);
            }
            $CI->db->group_end();
            $CI->db->select("*");
            $where="t1.status='1' and t1.approved_date>'".$activation_date."'";
            $CI->db->where($where);
            $CI->db->from('bookings t1');
            $CI->db->join('booking_details t2','t1.id=t2.booking_id');
            $CI->db->order_by("t1.approved_date");
            
            $bookings=$CI->db->get()->result_array();
            return $bookings;
		}  
	}
