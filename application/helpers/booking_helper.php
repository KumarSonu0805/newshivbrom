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
