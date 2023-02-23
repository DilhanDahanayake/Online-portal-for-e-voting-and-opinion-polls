<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model
{

    //user table related model
    public function __construct()
    {
        parent::__construct();
    }


    //Login Begin

    // check mobile in the database
    public function valid_mobile($mobile)
    {
        $this->db->where("mobilenumber", $mobile);
        $this->db->where("status", 1);
        $query = $this->db->get('users');

        $data["login_status"] = false;
        if (!empty($query->result())) {
            $data["login_status"] = true;
            $data["login_data"] = $query->result();
            return $data;
        } else {
            $data["login_status"] = false;
            return $data;
        }
    }

    // check email  in the database
    public function checkEmailValid($email){
        $this->db->where("email", $email);
        $this->db->where("email_valid", 1);
        $query = $this->db->get('users');
        if (!empty($query->result())) {
            return true;
        } else {
            return false;
        }
    }

    // get user status  by email
    public function valid_mobileByEmail($email)
    {
        $this->db->where("email", $email);
        $this->db->where("status", 1);
        $query = $this->db->get('users');

        $data["login_status"] = false;
        if (!empty($query->result())) {
            $data["login_status"] = true;
            $data["login_data"] = $query->result();
            return $data;
        } else {
            $data["login_status"] = false;
            return $data;
        }
    }

    // get user status mobile  by nic
    public function valid_mobileByNic($nic)
    {
        $this->db->where("nic", $nic);
        $this->db->where("status", 1);
        $query = $this->db->get('users');

        $data["login_status"] = false;
        if (!empty($query->result())) {
            $data["login_status"] = true;
            $data["login_data"] = $query->result();
            return $data;
        } else {
            $data["login_status"] = false;
            return $data;
        }
    }

    // saave OPT code
    public function save_opt($data)
    {
        return $this->db->insert('otp_code', $data);
    }

    // OTP update when login
    public function login_code($id, $code){

        $this->db->set('status', 0);
        $this->db->where('code',$code);
        $this->db->where('user_id',$id);
        $this->db->where('status',1);
        $this->db->update('otp_code');
        return $this->db->affected_rows();
    }

    // get all users data and additional data
    public function getUserWithAdditionalData()
    {
        $query = $this->db->query("select * from users u INNER JOIN additionaldata ad ON u.idusers=ad.idusers");
        return $query->result();
    }

    //END ..**

    // get emails of active users
    public function getAllUserEmail()
    {
        $query = $this->db->query(" select email from users where status='1' ");
        return $query->result();
    }

    // get city of active users
    public function getUsersCity()
    {
        $query = $this->db->query(" select city from users where status='1' group by city ");
        return $query->result();
    }

    //get all user details
    public function getAllUserData()
    {
        $query=$this->db->get("users"); // select * from users
        return $query->result();
    }

    // get user details by city
    public function getUserDetailsByCity($city)
    {
        $query = $this->db->query("select * from users where status='1' and city= '".$city."';");
        return $query->result();
    }

    // get user details by income
    public function getUserWithAdditionalDataEmailByIncomeLevel($level)
    {
        $query = $this->db->query("select u.email from users u INNER JOIN additionaldata ad ON u.idusers=ad.idusers where u.status='1' and ad.monthly_income='".$level."';");
        return $query->result();
    }

    // get user details by education
    public function getUserWithAdditionalDataEmailByEducationLevel($level)
    {
        $query = $this->db->query("select u.email from users u INNER JOIN additionaldata ad ON u.idusers=ad.idusers where u.status='1' and ad.education_level='".$level."';");
        return $query->result();
    }

    //show all data related to a user id
    public function getUserData($id)
    {
        $this->db->where("idusers", $id);
        $query = $this->db->get('users'); // select * from users where iduser = $id
        return $query->result();
    }

    // get user  additional details by additional data id
    public function getUserAdditionalData($id)
    {
        $this->db->where("idadditionaldata", $id);
        $query = $this->db->get('additionaldata'); // select * from users where iduser = $id
        return $query->result();
    }

    // get user  additional details by user id
    public function getUserAdditionalDataByUserId($id)
    {
        $this->db->where("idusers", $id);
        $query = $this->db->get('additionaldata'); // select * from users where iduser = $id
        return $query->result();
    }


    //delete a perticular user (not using)
    public function deletebyId($id)
    {
        $query = $this->db->delete('additionaldata',"idusers = ".$id." ");
        $query = $this->db->delete('users',"idusers = ".$id." ");
        return $query;
    }

    //update data in user table - not using
    public function editData($id, $firstname, $lastname, $nic, $email, $mobilenumber)
    {
        $data = array(
            'iduser' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nic' => $nic,
            'email' => $email,
            'mobilenumber' => $mobilenumber
        );

        $query = $this->db->replace("users", $data);
        return $query->result();
    }

    //save user data when login
    public function saveData($firstname, $lastname, $email, $password,$mobile)
    {
        $data = array(
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => $password,
            "mobilenumber" => $mobile
        );

        $query = $this->db->insert('users', $data);
        return $query;
    }


    //load additional data via id
    public function additonaldata($id)
    {
        $query = $this->db->query(" select * from users u, additionaldata a where a.idusers = u.idusers and u.idusers =".$id);
        return $query->result();
    }

    // checking user have email added - not in use
    public function isCredentialOkay($email, $password)
    {
        $query = $this->db->query(" select email from users where email = '".$email."' and password = '".$password."' and status='1'");
        $result = $query->result();

        if(isset($result[0])==true)
        {
            return true;
        }else{
            return false;
        }
    }

    // get user data
    public function getUserDataByEmailPass($email, $password)
    {
        $query = $this->db->query(" select idusers,admin,superuser,firstname,lastname,nic,email,mobilenumber,address,profession from users where email = '".$email."' and password = '".$password."'");
        return $query->result();
    }

    // Update user data - correct function
    public function updateUserData($user_id, $firstname, $lastname, $nic ,$email,$mobilenumber,$address,$city)
    {
        $data = array(

            "firstname" => $firstname,
            "lastname" => $lastname,
            "nic" => $nic,
            "email" => $email,
            "mobilenumber" => $mobilenumber,
            "address" => $address,
            "city" => $city,
        );

        $this->db->set($data);
        $this->db->where("idusers",$user_id);
        $query = $this->db->update("users", $data);
        return $query;

    }

    // update user additional data
    public function updateAdditionalData($id, $office, $experience, $birthday ,$numchildren,$married,$hEducation,$income, $gender)
    {
        $data = array(
            "office" => $office,
            "experience" => $experience,
            "birthday" => $birthday,
            "numchildren" => $numchildren,
             "married" => $married,
            "education_level" => $hEducation,
            "monthly_income" => $income,
			"gender" => $gender,
        );

        $this->db->set($data);
        $this->db->where("idadditionaldata",$id);
        $query = $this->db->update("additionaldata", $data);
        return $query;

    }

    // save user additional data
    public function saveAdditionalData($user_id, $office, $experience, $birthday ,$numchildren,$married,$hEducation,$income, $gender)
    {
        $data = array(
            "office" => $office,
            "experience" => $experience,
            "birthday" => $birthday,
            "numchildren" => $numchildren,
            "idusers" => $user_id,
            "married" => $married,
            "education_level" => $hEducation,
            "monthly_income" => $income,
			"gender" => $gender,
        );
        $query = $this->db->insert('additionaldata', $data);
        return $query;
    }

    //set admin
    public function updateAdminStatus($id)
    {
        $data = array(
            "admin" => 1,
        );

        $this->db->set($data);
        $this->db->where("idusers",$id);
        $query = $this->db->update("users", $data);
        return $query;

    }

    //set email validation
    public function updateEmailValidStatus($id)
    {
        $data = array(
            "email_valid" => 1,
        );

        $this->db->set($data);
        $this->db->where("idusers",$id);
        $query = $this->db->update("users", $data);
        return $query;

    }

    // disable user
    public function updateStatusStatus($id)
    {
        $data = array(
            "status" => 0,
        );

        $this->db->set($data);
        $this->db->where("idusers",$id);
        $query = $this->db->update("users", $data);
        return $query;

    }

}