<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PollModel");
        $this->load->model("UserModel");
		$this->load->model("ReportModel");
    }

    public function index()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['poll'] = json_decode(json_encode($this->PollModel->getElections()), true);
        $data['users']= json_decode(json_encode($this->UserModel->getAllUserData()), true);
        $this->load->view('layouts/header');
        $this->load->view('report/index' , $data);
        $this->load->view('layouts/footer');
    }
    public function poll_report()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['poll'] = json_decode(json_encode($this->PollModel->getElections()), true);
        $data['poll_count'] = json_decode(json_encode($this->PollModel->getElectionCountByUser()), true);


        $this->load->view('layouts/header');
        $this->load->view('report/poll_report' , $data);
        $this->load->view('layouts/footer');
    }

    public function user_report($location="Colombo", $incomelevel=1, $edulevel=1, $numchild=0, $gender=1)
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }

		
        $data['users']= json_decode(json_encode($this->ReportModel->getUserswithparam($location, $incomelevel, $edulevel, $numchild, $gender)), true);

        $this->load->view('layouts/header');
        $this->load->view('report/user_report' , $data);
        $this->load->view('layouts/footer');
    }
	
	public function user_report_search()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }

			$location = $this->input->post('location');
			$incomelevel = $this->input->post('incomelevel');
			$edulevel = $this->input->post('educationlevel');
			$numchild = $this->input->post('numofchild');
			$gender = $this->input->post('gender');
		
		
		if(isset($location) == false){	
			$location = "";
			$incomelevel = 1;
			$edulevel = 1;
			$numchild = 1;
			$gender = 0;
		}
		
        $data['users']= json_decode(json_encode($this->ReportModel->getUserswithparam($location, $incomelevel, $edulevel, $numchild, $gender)), true);

        $this->load->view('layouts/header');
        $this->load->view('report/user_report' , $data);
        $this->load->view('layouts/footer');
    }

}