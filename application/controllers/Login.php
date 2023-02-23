<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model("UserModel");
    }
    public function index()
    {
        if (!empty($this->session->auth)) {
            return redirect('home/dashboard', 'refresh');
        }
        $data = $this->session->flashdata('login_data');

        $this->load->view('layouts/front_h');
        $this->load->view('login/index',$data);
        $this->load->view('layouts/front_f');

    }
    public function test(){

        $result = hash("sha256", rand());
        echo $result;
    }

    public function register(){
        if (!empty($this->session->auth)) {
            return redirect('home', 'refresh');
        }
        if (!$this->input->post('mobile')){
            return redirect('login', 'refresh');
        }
        $mobile = $this->input->post('mobile');
        $res = $this->UserModel->valid_mobile($mobile);

        if(!$res['login_status']){
            $firstname = $this->input->post("firstname");
            $lastname = $this->input->post("lastname");
            $email = $this->input->post("email");
            $password = hash("sha256", rand());

            $this->UserModel->saveData($firstname, $lastname, $email, $password,$mobile);
            $this->index();
            $data['user_name'] = $mobile;
            $data['error_r'] = 'Register Success - Please login';
            $this->session->set_flashdata('login_data',$data);
            return redirect('login', 'refresh');

        }else{
            $data['status'] = 0;
            $data['error_r'] = 'Already registered Mobile..!';
            $this->load->view('layouts/front_h');
            $this->load->view('login/index',$data);
            $this->load->view('layouts/front_f');

        }

    }


    public function verify()
    {
        if (!empty($this->session->auth)) {
            return redirect('home/dashboard', 'refresh');
        }

        if (!$this->input->post('email')){
            return redirect('login', 'refresh');
        }
        $data['mobile'] = $this->input->post('email');

        $result = $this->sendOptEmail($data['mobile']);

        if ($result['status'] === 1){
            $data['user_id'] = $result['user_id'];
            $data['title'] = 'Login';
            $this->load->view('layouts/front_h');
            $this->load->view('login/code_index',$data);
            $this->load->view('layouts/front_f');

        }else{
            $data['error'] = $result['error'];
            $data['title'] = 'Login';
            $this->load->view('layouts/front_h');
            $this->load->view('login/index',$data);
            $this->load->view('layouts/front_f');

        }

    }
    public function verify_mobile()
    {
        if (!empty($this->session->auth)) {
            return redirect('home/dashboard', 'refresh');
        }

        if (!$this->input->post('mobile')){
            return redirect('login', 'refresh');
        }
        $data['mobile'] = $this->input->post('mobile');


        // Mobile/Email  - Numeric Filter
        if (is_numeric($data['mobile'])){
            $result = $this->sendOpt($data['mobile']);
            if ($result['status'] === 1){
                $data['user_id'] = $result['user_id'];
                $data['title'] = 'Login';
                $this->load->view('layouts/front_h');
                $this->load->view('login/code_index',$data);
                $this->load->view('layouts/front_f');

            }else{
                $data['error'] = $result['error'];
                $data['title'] = 'Login';
                $this->load->view('layouts/front_h');
                $this->load->view('login/index',$data);
                $this->load->view('layouts/front_f');

            }
        }else{
            return redirect('login', 'refresh');
        }
    }
    public function verify_nic()
    {
        if (!empty($this->session->auth)) {
            return redirect('home/dashboard', 'refresh');
        }

        if (!$this->input->post('mobile')){
            return redirect('login', 'refresh');
        }
        $data['mobile'] = $this->input->post('mobile');

        if (strlen($data['mobile']) < 8){
            $data['error'] = "Not a valid NIC";
            $data['title'] = 'Login';
            $this->load->view('layouts/front_h');
            $this->load->view('login/index',$data);
            $this->load->view('layouts/front_f');
        }
            $result = $this->sendOptNic($data['mobile']);
            if ($result['status'] === 1){
                $data['user_id'] = $result['user_id'];
                $data['title'] = 'Login';
                $this->load->view('layouts/front_h');
                $this->load->view('login/code_index',$data);
                $this->load->view('layouts/front_f');

            }else{
                $data['error'] = $result['error'];
                $data['title'] = 'Login';
                $this->load->view('layouts/front_h');
                $this->load->view('login/index',$data);
                $this->load->view('layouts/front_f');

            }
    }
    private function sendOpt($mobile) {

        $res = $this->UserModel->valid_mobile($mobile);

        if($res['login_status']){
            $data['status'] = 1;
            $data['user_id'] = $res["login_data"][0]->idusers;
            $code = $this->opt_code_generate($res["login_data"][0]->idusers);
            $this->otpSend($mobile,$code);
            return $data;
        }else{
            $data['status'] = 0;
            $data['error'] = 'Not a registered Mobile..!';
            return $data;
        }
 
    }
    private function sendOptEmail($email) {

        $res = $this->UserModel->valid_mobileByEmail($email);

        if($res['login_status']){
            $data['status'] = 1;
            $data['user_id'] = $res["login_data"][0]->idusers;
            $code = $this->opt_code_generate($res["login_data"][0]->idusers);
            $this->otpSend($res["login_data"][0]->mobilenumber,$code);
            return $data;
        }else{
            $data['status'] = 0;
            $data['error'] = 'Not a registered EMAIL..!';
            return $data;
        }

    }
    private function sendOptNic($email) {

        $res = $this->UserModel->valid_mobileByNic($email);

        if($res['login_status']){
            $data['status'] = 1;
            $data['user_id'] = $res["login_data"][0]->idusers;
            $code = $this->opt_code_generate($res["login_data"][0]->idusers);
            $this->otpSend($res["login_data"][0]->mobilenumber,$code);
            return $data;
        }else{
            $data['status'] = 0;
            $data['error'] = 'Not a registered NIC..!';
            return $data;
        }

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

    public function verify_otp($user_id){
        if (!empty($this->session->auth)) {
            return redirect('home', 'refresh');
        }

        if (!$this->input->post('otp')){
            return redirect('login', 'refresh');
        }
        $data['otp'] = $this->input->post('otp');

        if (is_numeric($data['otp'])){
            $result = $this->UserModel->login_code($user_id,$data['otp']);

            if ($result == "1"){
                $this->log_in($user_id);
                return redirect('home', 'refresh');
            }else{
                $data['user_id'] = $user_id;
                $data['error'] = 'OPT Not correct';

                $this->load->view('layouts/front_h');
                $this->load->view('login/code_index',$data);
                $this->load->view('layouts/front_f');

            }

        }
	
    }

    // Set login using user id - !!private!!!
    private function log_in($id)
    {
		
        $loginUser = $this->UserModel->getUserData($id);
        $addData = json_decode(json_encode($this->UserModel->getUserAdditionalDataByUserId($id)), true);
        $today = date("Y-m-d");
        $diff = date_diff(date_create($addData[0]['birthday']), date_create($today));
        $age =$diff->format('%y');

        $userData = array(
            'data'  => $loginUser[0],
            'auth'  => true,
            'id'     => $id,
            'nic'     => $addData[0]['nic'],
            'birthday' => $addData[0]['birthday'],
            'age' => $age,
            'name'     => $loginUser[0]->firstname,
            'super' => $loginUser[0]->superuser,
            'admin' => $loginUser[0]->admin,
        );

        $this->session->set_userdata($userData);
	
    }

    public function log_out(){
        $this->session->sess_destroy();
        return redirect('login', 'refresh');
    }

    // Send otp via request - !!private!!!
    private function otpSend($number,$otp){

        $curl = curl_init('https://pos.janitha.biz/pb/sms_send_otp/lkjs025s7kldjqd6wsd6fgdkjdfx798sdfuhsd257dfh/'.$number.'/'.$otp);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);
//        echo $result;
        return $result;
    }

}
