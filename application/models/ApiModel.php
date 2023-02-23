<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApiModel extends CI_Model
{

    //user table related model
    public function __construct()
    {
        parent::__construct();
    }

    // get citizen by nic
    public function getCitizenByNic($nic){
        $this->db->where('nic', $nic);
        $query=$this->db->get("government_citizen_database");
        return $query->result();
    }

    // not using
    public function getCitizenByNicCity($nic,$city){
        $this->db->where('nic', $nic);
        $this->db->where('city', $city);
        $query=$this->db->get("government_citizen_database");
        return $query->result();
    }

    // get all citizens
    public function getCitizens(){
        $query=$this->db->get("government_citizen_database");
        return $query->result();
    }
}