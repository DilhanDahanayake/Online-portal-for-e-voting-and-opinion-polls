<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model
{

    //Report related model
    public function __construct()
    {
        parent::__construct();
    }
	
	// user report function call
	public function getUserswithparam($location, $income, $edulevel, $numofchild, $gender)
    {
		$sqlquery = "SELECT * FROM `users`, `additionaldata` WHERE `users`.`idusers`= `additionaldata`.`idusers`";
		
		if($location == ""){
			$sqlquery = "SELECT * FROM `users`, `additionaldata` WHERE `users`.`idusers`= `additionaldata`.`idusers`";	
		}else{
			$sqlquery .= " AND `users`.`city` = '".$location."' ";
		}
		
		if($income != "any"){
			$sqlquery .= " AND `additionaldata`.`monthly_income` = '".$income."'";
		}
		
		if($edulevel != "any"){
			$sqlquery .= " AND `additionaldata`.`education_level`= '".$edulevel."'";
		}
		
		if($gender != "any"){
			$sqlquery .= " AND gender = '".$gender."'";	
		}
				
		$sqlquery .= " AND `additionaldata`.`numchildren` > '".$numofchild."'";
		
		
		
						
        $query = $this->db->query($sqlquery);
        return $query->result();
    }
	
	
	
	

}