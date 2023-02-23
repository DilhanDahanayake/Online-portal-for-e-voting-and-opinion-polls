<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model("UserModel");
    }

    public function index()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){

            $data['users']= json_decode(json_encode($this->UserModel->getUserData($this->session->userdata('id'))), true);

            $this->load->view('layouts/header');
            $this->load->view('user/user_index',$data);
            $this->load->view('layouts/footer');
        }else{
            $data['users']= json_decode(json_encode($this->UserModel->getAllUserData()), true);


            $this->load->view('layouts/header');
            $this->load->view('user/index',$data);
            $this->load->view('layouts/footer');
        }


    }

    public function pic_upload(){

        $id_user = $this->session->userdata('id');
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $data['error'] = "File is not an image.";
                return $this->load->view('error_page', $data);
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            $data['error'] = "Sorry, file already exists.";
            return $this->load->view('error_page', $data);
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $data['error'] = "Sorry, your file is too large.";
            return $this->load->view('error_page', $data);
            $uploadOk = 0;
        }

// Allow certain file formats
        if($imageFileType != "png") {
            $data['error'] = "Sorry, PNG files are allowed.";
            return $this->load->view('error_page', $data);
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $data['error'] = "Sorry, your file was not uploaded.";
            return $this->load->view('error_page', $data);

// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                rename($target_file, "uploads/user_".$id_user.".".$imageFileType);
//                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                return redirect('user', 'refresh');
            } else {
                $data['error'] = "Sorry, there was an error uploading your file.";
                return $this->load->view('error_page', $data);
            }






        }

    }
    public function verify_email($id){

        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }

        $user_data = $this->UserModel->getUserData($id);
        $data['id'] = $id;
        $code = $this->opt_code_generate($id);
        $res_e = $this->otpSendEmail($user_data[0]->email,$code);
        $res = json_decode($res_e,true);
        if ($res['status'] == 1){
            $this->load->view('layouts/header');
            $this->load->view('user/verify_email',$data);
            $this->load->view('layouts/footer');
        }else{
            $data['error'] = "Email Sent - E1.";
            return $this->load->view('error_page', $data);
        }


    }
    public function verify_email_otp($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }

        if (!$this->input->post('otp')){
            $data['id'] = $id;
            $data['error'] = 'OPT Not correct';
            $this->load->view('layouts/header');
            $this->load->view('user/verify_email',$data);
            $this->load->view('layouts/footer');
            return;

        }
        $data['otp'] = $this->input->post('otp');

        if (is_numeric($data['otp'])){
            $result = $this->UserModel->login_code($id,$data['otp']);

            if ($result == "1"){
                $this->UserModel->updateEmailValidStatus($id);
                return redirect('user', 'refresh');
            }else{
                $data['id'] = $id;
                $data['error'] = 'OPT Not correct';

                $this->load->view('layouts/header');
                $this->load->view('user/verify_email',$data);
                $this->load->view('layouts/footer');
                return;
            }

        }else{
            $data['id'] = $id;
            $data['error'] = 'OPT Not correct';

            $this->load->view('layouts/header');
            $this->load->view('user/verify_email',$data);
            $this->load->view('layouts/footer');
            return;
        }

    }
    private function otpSendEmail($email,$otp){

        $curl = curl_init('https://pos.janitha.biz/pb/sms_send_otp_email/lkjs025s7kldjqd6wsd6fgdkjdfx798sdfuhsd257dfh/'.$email.'/'.$otp);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);
//        echo $result;
        return $result;
    }
    private function opt_code_generate($id){
        $rand_code =mt_rand(1000,9999);
        $data = array(
            'code' => $rand_code,
            'user_id' => $id
        );
        $this->UserModel->save_opt($data);

        return $rand_code;
    }
    public function set_admin($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $this->UserModel->updateAdminStatus($id);
        
        return redirect('user', 'refresh');
    }
    public function edit($id,$key){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }
        $this->UserModel->updateAdminStatus($id);

        return redirect('user', 'refresh');
    }

    public function delete($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $this->UserModel->updateStatusStatus($id);

        return redirect('user', 'refresh');
    }


    public function additional_data($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }
        $data['user']= json_decode(json_encode($this->UserModel->getUserData($id)), true);

        $data['user_add']= json_decode(json_encode($this->UserModel->getUserAdditionalDataByUserId($id)), true);
        if (empty($data['user_add'])){
            return redirect('user/additional_data_add/'.$id, 'refresh');
        }

        $this->load->view('layouts/header');
        $this->load->view('user/edit_additional_data',$data);
        $this->load->view('layouts/footer');

    }
    public function edit_user($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }
        $data['user']= json_decode(json_encode($this->UserModel->getUserData($id)), true);

//        $data['user_add']= json_decode(json_encode($this->UserModel->getUserAdditionalDataByUserId($id)), true);
//        if (empty($data['user_add'])){
//            return redirect('user/additional_data_add/'.$id, 'refresh');
//        }

        $this->load->view('layouts/header');
        $this->load->view('user/edit',$data);
        $this->load->view('layouts/footer');

    }
    public function additional_data_add($id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }
        $data['user']= json_decode(json_encode($this->UserModel->getUserData($id)), true);

        $data['user_add']= json_decode(json_encode($this->UserModel->getUserAdditionalDataByUserId($id)), true);
        if (!empty($data['user_add'])){
            return redirect('user/additional_data/'.$id, 'refresh');
        }

        $this->load->view('layouts/header');
        $this->load->view('user/add_additional',$data);
        $this->load->view('layouts/footer');

    }

    public function update_user_additional(){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }

        $id = $this->input->post('user_add_id');
        $user_id = $this->input->post('user_id');
        $office = $this->input->post('office');
        $experience = $this->input->post('experience');
        $birthday = $this->input->post('birthday');
        $married = $this->input->post('married');
        $numchildren = $this->input->post('numchildren');
        $hEducation = $this->input->post('education');
        $income = $this->input->post('monthly_income');
		$gender = $this->input->post('gender');
		

        if ($this->session->userdata('id') != $user_id){
            $data['error'] = "Only User can edit User Data!";
            return $this->load->view('error_page', $data);
        }

        $insert_id = $this->UserModel->updateAdditionalData($id, $office, $experience, $birthday ,$numchildren,$married,$hEducation,$income, $gender);
        return redirect('user/additional_data/'.$user_id, 'refresh');


    }

    public function update_user(){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }

        $user_id = $this->input->post('user_id');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $nic = $this->input->post('nic');
        $email = $this->input->post('email');
        $mobilenumber = $this->input->post('mobilenumber');
        $address = $this->input->post('address');
        $city = $this->input->post('city');

        if ($this->session->userdata('id') != $user_id){
            $data['error'] = "Only User can edit User Data!";
            return $this->load->view('error_page', $data);
        }

        // NIC Validation
        $curl = curl_init('https://evoting.techyfish.com/api/get_valid_nic/12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n/'.$nic);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($result,true);
        if ($res['valid'] == 0){
            $data['error'] = "Not Valid Nic .!";
            return $this->load->view('error_page', $data);
        }

        /// END NIC validation

        // City Validation
        $curl = curl_init('https://evoting.techyfish.com/api/get_valid_nic_with_city/12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n/'.$nic.'/'.$city);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($result,true);
        if ($res['valid'] == 0){
            $data['error'] = "Not Valid City .!";
            return $this->load->view('error_page', $data);
        }

        /// END City Validation

        $insert_id = $this->UserModel->updateUserData($user_id, $firstname, $lastname, $nic ,$email,$mobilenumber,$address,$city);

        return redirect('user/edit_user/'.$user_id, 'refresh');


    }


    public function save_user_add(){

        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
//        if ($this->session->userdata('admin') == 0){
//            $data['error'] = "Only Admin Can Access This .!";
//            return $this->load->view('error_page', $data);
//        }
        $user_id = $this->input->post('user_id');
        $office = $this->input->post('office');
        $experience = $this->input->post('experience');
        $birthday = $this->input->post('birthday');
        $married = $this->input->post('married');
        $numchildren = $this->input->post('numchildren');
        $hEducation = $this->input->post('education');
        $income = $this->input->post('monthly_income');
		$gender = $this->input->post('gender');
		

        if ($this->session->userdata('id') != $user_id){
            $data['error'] = "Only User can edit User Data!";
            return $this->load->view('error_page', $data);
        }

        $insert_id = $this->UserModel->saveAdditionalData($user_id, $office, $experience, $birthday ,$numchildren,$married,$hEducation,$income,$gender);


        return redirect('user/edit_user/'.$user_id, 'refresh');
        
    }
}
