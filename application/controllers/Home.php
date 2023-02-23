<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model("PollModel");
    }

    public function index()
    {
        $data['poll'] = json_decode(json_encode($this->PollModel->getElections()), true);

        $this->load->view('layouts/front_h');
        $this->load->view('layouts/banner_1');
        $this->load->view('home/index', $data);
        $this->load->view('layouts/front_f');
    }
    public function dashboard(){

        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }


        $data['poll'] = json_decode(json_encode($this->PollModel->getElections()), true);

        $this->load->view('layouts/header');
        $this->load->view('home/dashboard', $data);
        $this->load->view('layouts/footer');
    }
    public function admin()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }

        $this->load->view('home/admin');
    }
}
