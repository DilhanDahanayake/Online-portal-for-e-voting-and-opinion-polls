<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ApiModel");
    }

    public function index(){

    }

    public function get_valid_nic($key,$nic){
        $verify_key = "12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n";

        if ($key == $verify_key){
            $citizenDB= json_decode(json_encode($this->ApiModel->getCitizenByNic($nic)), true);
            if(empty($citizenDB)){
                echo '{"valid": "0","error": "Not Valid NIC"}';
            }else{
                if ($citizenDB[0]['death'] == 1){
                    echo '{"valid": "0","error": "Deceased Person"}';
                }else{
                    echo '{"valid": "1"}';
                }

            }

        }else{
            echo '{"valid": "0","error": "Key Not Correct"}';
        }
    }

    public function get_valid_nic_with_city($key,$nic,$city){
        $verify_key = "12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n";

        if ($key == $verify_key){
            $citizenDB= json_decode(json_encode($this->ApiModel->getCitizenByNicCity($nic,$city)), true);
            if(empty($citizenDB)){
                echo '{"valid": "0","error": "Not Valid City"}';
            }else{
                    echo '{"valid": "1"}';
            }

        }else{
            echo '{"valid": "0","error": "Key Not Correct"}';
        }
    }

    public function get_death_status_by_nic($key,$nic){
        $verify_key = "12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n";

        if ($key == $verify_key){
            $citizenDB= json_decode(json_encode($this->ApiModel->getCitizenByNic($nic)), true);
            if(empty($citizenDB)){
                echo '{"valid": "0","error": "Not Valid NIC"}';
            }else{
                if ($citizenDB[0]['death'] == 1){
                    echo '{"valid": "1","death": "1"}';
                }else{
                    echo '{"valid": "1","death": "0"}';
                }

            }

        }else{
            echo '{"valid": "0","error": "Key Not Correct"}';
        }
    }

    // not using
    public function checkApi($key,$nic){

        $curl = curl_init('https://evoting2732.techyfish.com/api/get_valid_nic/'.$key.'/'.$nic);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);
        echo $result;
//        return $result;
    }

    public function mock_db(){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $data['db'] = json_decode(json_encode($this->ApiModel->getCitizens()), true);

        $this->load->view('layouts/header');
        $this->load->view('api/mock_db', $data);
        $this->load->view('layouts/footer');
    }
}