<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Election extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PollModel");
        $this->load->model("UserModel");
    }

    public function index()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        //Update Election End Date
        $this->PollModel->updateElectionEndDate();

        $admin = $this->session->userdata('admin');

        if ($admin == 0){
            $data['poll'] = json_decode(json_encode($this->PollModel->getElectionByUser($this->session->id)), true);
        }else{
            $data['poll'] = json_decode(json_encode($this->PollModel->getElectionsapprove()), true);
        }

        $this->load->view('layouts/header');
        $this->load->view('election/index', $data);
        $this->load->view('layouts/footer');

    }


    public function invite_email($id,$key){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $admin = $this->session->userdata('admin');

        if ($admin == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,0)), true);
        $data['city'] = json_decode(json_encode($this->UserModel->getUsersCity()), true);

        $this->load->view('layouts/header');
        $this->load->view('election/invite_email', $data);
        $this->load->view('layouts/footer');

    }

    public function send_invite($type,$id){
        $email_list = "janithae@gmail.com";
        $election = json_decode(json_encode($this->PollModel->getElectionById($id)), true);

        if ($type == "all"){
            $email= json_decode(json_encode($this->UserModel->getAllUserEmail()), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "city"){
            $city = $this->input->post('city');
            $email= json_decode(json_encode($this->UserModel->getUserDetailsByCity($city)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];				
            }
        }
        if ($type == "il1"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByIncomeLevel(1)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "il2"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByIncomeLevel(2)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "il3"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByIncomeLevel(3)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "il4"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByIncomeLevel(4)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }

        if ($type == "ed1"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByEducationLevel(1)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "ed2"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByEducationLevel(2)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "ed3"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByEducationLevel(3)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }
        if ($type == "ed4"){
            $email= json_decode(json_encode($this->UserModel->getUserWithAdditionalDataEmailByEducationLevel(4)), true);
            foreach($email as $i){
                $email_list = $email_list.",".$i['email'];
            }
        }


        $curl = curl_init('https://pos.janitha.biz/pb/send_email/lkjs025s7kldjqd6wsd6fgdkjdfx798sfsdfsdf453fsdsdfsdfuhsd257dfh/'.$email_list."/".$election[0]['name']."/".$election[0]['id']."/".$election[0]['expire_date']."/".$election[0]['verify_key']);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        $res = json_decode($result,true);
//        var_dump($res);
        if ($res['status'] == 1){
            $data['error'] = "Email Sent .";
            return $this->load->view('error_page', $data);
        }else{
            $data['error'] = "Email Sent..";
            return $this->load->view('error_page', $data);
        }


    }



    public function view($id,$key){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $admin = $this->session->userdata('admin');

        if ($admin == 0){
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,$this->session->id)), true);
        }else{
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,0)), true);
        }

        $data['e_id'] = $id;
        $data['e_key'] = $key;
        $data['poll_count'] = 0;
        $data['vote_count'] = 0;
        $data['polls'] = json_decode(json_encode($this->PollModel->getPollsByElectionId($id)), true);
        $data['poll_id_list'] = "";
        foreach ($data['polls'] as $value) {
            $data['poll_count'] = $data['poll_count'] + 1;
            if ($data['poll_id_list'] == ""){
                $data['poll_id_list'] = $value['id'];
            }else{
                $data['poll_id_list'] = $data['poll_id_list'].",".$value['id'];
            }
        }

        $data['vote_log_chart'] = json_decode(json_encode($this->PollModel->getVoteLogByPollIdListSum($data['poll_id_list'])), true);
        $data['vote_log'] = json_decode(json_encode($this->PollModel->getVoteLogByPollIdList($data['poll_id_list'])), true);

        foreach ($data['vote_log'] as $value) {
            $data['vote_count'] = $data['vote_count'] + 1;
        }

        $this->load->view('layouts/header');
        $this->load->view('election/view', $data);
        $this->load->view('layouts/footer');

    }
	
	
	public function showPollVoteAndResult($id)
	{
		$data['pollresult'] = json_decode(json_encode($this->PollModel->getPollVoteAndResult($id)), true);
		$this->load->view('layouts/header');
        $this->load->view('election/showresult', $data);
        $this->load->view('layouts/footer');
		  	
	}
	
	public function showPollVoteAndResultFromElection($electionid)
	{
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
		$pollids = json_decode(json_encode($this->PollModel->getPollIdsFromElectionId($electionid)), true);
        $election = json_decode(json_encode($this->PollModel->getElectionById($electionid)), true);

		$data['pollresult'] = json_decode(json_encode($this->PollModel->getPollVoteAndResults($pollids)), true);
		$data['electiontitle'] = urldecode($election[0]['name']);
		
		$this->load->view('layouts/header');
        $this->load->view('election/showresult', $data);
        $this->load->view('layouts/footer');
		  	
	}

    public function remove($id,$key){
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['election'] = json_decode(json_encode($this->PollModel->updateElectionStatus($id, $key)), true);
        return redirect('election', 'refresh');

    }
    public function end_election($id,$key){
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['election'] = json_decode(json_encode($this->PollModel->updateElectionEndStatus($id, $key)), true);
        return redirect('election', 'refresh');

    }

    public function approve_election($id,$key){
        if ($this->session->userdata('admin') == 0){
            $data['error'] = "Only Admin Can Access This .!";
            return $this->load->view('error_page', $data);
        }
        $data['election'] = json_decode(json_encode($this->PollModel->updateApproveStatus($id, $key)), true);
        return redirect('election', 'refresh');

    }

    // not in use
    public function user_death_status(){
        $user_data = $this->session->userdata('data');
        $curl = curl_init('https://evoting.techyfish.com/api/get_death_status_by_nic/12ddk3ok3kklfddlkfkjewqpamdfnjvnrke4neem2n/'.$user_data->nic);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        $res = json_decode($result,true);
        if ($res['valid'] == 0){
            return -1;
        }else{
            if ($res['valid'] == 1){
                return $res['death'];
            }
        }



    }

    public function vote($id,$key,$poll_id = 0){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
		
		$useridsession = $this->session->id;
		
		$loginUser = $this->UserModel->getUserData($useridsession);
        $addData = json_decode(json_encode($this->UserModel->getUserAdditionalDataByUserId($useridsession)), true);
        $today = date("Y-m-d");
        $diff = date_diff(date_create($addData[0]['birthday']), date_create($today));
        $age =$diff->format('%y');

        $userData = array(
            'data'  => $loginUser[0],
            'auth'  => true,
            'id'     => $useridsession,
            'nic'     => $addData[0]['nic'],
            'birthday' => $addData[0]['birthday'],
            'age' => $age,
            'name'     => $loginUser[0]->firstname,
            'super' => $loginUser[0]->superuser,
            'admin' => $loginUser[0]->admin,
        );

        $this->session->set_userdata($userData);
		
		
        //Update End Date
        $this->PollModel->updateElectionEndDate();

//        $admin = $this->session->userdata('admin');

//        if ($admin == 0){
//            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,$this->session->id)), true);
//        }else{
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,0)), true);
//        }

        $death_status = $this->user_death_status();
        if ($death_status == -1){
            $data['error'] = "Please update your NIC. Your NIC not found in government database !";
            return $this->load->view('error_page', $data);
        }else{
            if ($death_status == 1){
                $data['error'] = "Deceased Person cannot vote .!";
                return $this->load->view('error_page', $data);
            }
        }

        if ($data['election'][0]['end_status'] == 1){
            $data['error'] = "Election Has Ended .!";
            return $this->load->view('error_page', $data);
        }

        if ($loginUser[0]->email_valid == 0){
            $data['error'] = "You Must validate email before vote .!";
            return $this->load->view('error_page', $data);
        }



        $data['e_id'] = $id;
        $data['e_key'] = $key;
        $data['poll_id'] = $poll_id;
        $data['poll_data'] = [];
        $data['poll_empty'] = false;
        $data['poll_answers'] = [];
        $data['poll_key'] = 0;
        $data['polls'] = [];
        $data['polls'] = json_decode(json_encode($this->PollModel->getPollsByElectionId($id)), true);
        $data['answer_id'] = 0;
        $user_id = $this->session->id;
        $data['age_18'] = 0;

        if ($this->session->age > 18){
            $data['age_18'] = 1;
        }else{
            $data['error'] = "Age Restriction: Cannot vote below 18 years old";
            return $this->load->view('error_page', $data);
        }
        if (empty($data['polls'])){
            $data['poll_empty'] = true;
        }else{
            if ($poll_id == 0){
                $data['poll_id'] = $data['polls'][0]['id'];
            }else{
                $data['poll_id'] = $poll_id;
            }
            $data['poll_data'] = json_decode(json_encode($this->PollModel->getPollById($data['poll_id'])), true);
            $data['poll_answers'] = json_decode(json_encode($this->PollModel->getPollAnswersByPollId($data['poll_id'])), true);
            $data['poll_key'] = $data['poll_data'][0]['verify_key'];

        $check_vote_log = json_decode(json_encode($this->PollModel->getVoteLogByPollIdUserId($data['poll_id'],$user_id)), true);

        if (!empty($check_vote_log)){
            $data['answer_id'] = $check_vote_log[0]['answer_id'];
        }

        }
		
		$data["userid"] = $this->session->id;
		$usrid = $this->session->id;
		
		$data["comments"] = $this->PollModel->getlastpollcomment($usrid, $poll_id);

        $this->load->view('layouts/header');
        $this->load->view('election/vote', $data);
        $this->load->view('layouts/footer');


    }

    public function vote_submit($id,$key,$e_id,$e_key,$poll_id){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $userid= $this->session->id;
        $loginUser = $this->UserModel->getUserData($userid);

        $answer = json_decode(json_encode($this->PollModel->getPollAnswerByIdKey($id, $key)), true);

        if (!empty($answer)){

            $user_id = $this->session->id;
            $f_name = $this->session->name;

            $insert_id = $this->PollModel->saveVote($answer[0]['poll_id'],$id,$user_id,$f_name);

        }else{
            return redirect('election', 'refresh');
        }

        $election = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($e_id, $e_key,0)), true);
        $curl = curl_init('https://pos.janitha.biz/pb/send_poll_result_email/lkjs025s7kldjqd6wsd6fgdkjdfx798sfsdfsdf453fsdsdfsdfuhsd257dfhw/'.$election[0]['id']."/".$loginUser[0]->email."/".$election[0]['name']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        $res = json_decode($result,true);
   
        return redirect('election/vote/'.$e_id."/".$e_key."/".$poll_id, 'refresh');
    }

    public function comment_submit(){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if (!$this->input->post('election_id')){
            return redirect('poll', 'refresh');
        }
        if (!$this->input->post('poll_id')){
            return redirect('poll', 'refresh');
        }
        if (!$this->input->post('comment')){
            return redirect('poll', 'refresh');
        }
		$user_id = $this->session->id;
        $insert_id = $this->PollModel->updatePollComment($this->input->post('poll_id'),$user_id,$this->input->post('comment'));

        return redirect('election/vote/'.$this->input->post('election_id')."/".$this->input->post('election_key')."/".$this->input->post('poll_id'), 'refresh');
    }

    public function test_json(){

    }

    public function create_poll($id,$key)
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $admin = $this->session->userdata('admin');

        if ($admin == 0){
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,$this->session->id)), true);
        }else{
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,0)), true);
        }

        if (empty($data['election'])){
            return redirect('election', 'refresh');
        }




        $this->load->view('layouts/header');
        $this->load->view('election/create_poll', $data);
        $this->load->view('layouts/footer');

    }
    public function create_election()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }

        $this->load->view('layouts/header');
        $this->load->view('election/election_create');
        $this->load->view('layouts/footer');

    }
    public function save_create_poll()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if (!$this->input->post('name')){
            return redirect('poll', 'refresh');
        }
        $name = $this->input->post('name');
        $e_id = $this->input->post('election_id');
        $user_id = $this->session->id;
        $f_name = $this->session->name;
        $verify_key =  hash("sha256", rand());


        $insert_id = $this->PollModel->savePoll($name, $user_id,$f_name,$verify_key,$e_id);

        return redirect('election/edit_election/'.$this->input->post('election_id')."/".$this->input->post('election_key')."/".$insert_id, 'refresh');
    }
    public function save_create_election()
    {
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if (!$this->input->post('name')){
            return redirect('poll', 'refresh');
            
            //return redirect('create_election', 'refresh');
        }
        $name = $this->input->post('name');
        $user_id = $this->session->id;
        $f_name = $this->session->name;
        $expire_date = $this->input->post('expire_date');
        $description = $this->input->post('description');
        $verify_key =  hash("sha256", rand());
        $approve = 1;


        $insert_id = $this->PollModel->saveElection($name, $user_id,$f_name,$verify_key,$expire_date,$description,$approve);

        return redirect('election/edit_election/'.$insert_id."/".$verify_key, 'refresh');
    }
    public function edit_election($id,$key,$poll_id = 0){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        $admin = $this->session->userdata('admin');

        if ($admin == 0){
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,$this->session->id)), true);
        }else{
            $data['election'] = json_decode(json_encode($this->PollModel->getElectionByIdKeyUser($id, $key,0)), true);
        }

        $data['e_id'] = $id;
        $data['e_key'] = $key;
        $data['poll_id'] = $poll_id;
        $data['poll_data'] = [];
        $data['poll_empty'] = false;
        $data['poll_answers'] = [];
        $data['poll_key'] = 0;
        $data['polls'] = [];
        $data['polls'] = json_decode(json_encode($this->PollModel->getPollsByElectionId($id)), true);


        if (empty($data['polls'])){
                $data['poll_empty'] = true;
        }else{
            if ($poll_id == 0){
                $data['poll_id'] = $data['polls'][0]['id'];
            }else{
                $data['poll_id'] = $poll_id;
            }
            $data['poll_data'] = json_decode(json_encode($this->PollModel->getPollById($data['poll_id'])), true);
            $data['poll_answers'] = json_decode(json_encode($this->PollModel->getPollAnswersByPollId($data['poll_id'])), true);
            $data['poll_key'] = $data['poll_data'][0]['verify_key'];

        }

        $this->load->view('layouts/header');
        $this->load->view('election/edit_election', $data);
        $this->load->view('layouts/footer');


    }

    public function add_question(){
        if (!$this->session->has_userdata('auth')) {
            return redirect('login', 'refresh');
        }
        if (!$this->input->post('key')){
            return redirect('election?e=0', 'refresh');
        }
        if (!$this->input->post('id')){
            return redirect('election?e=1', 'refresh');
        }

        $admin = $this->session->userdata('admin');

        $id = $this->input->post('id');
        $key = $this->input->post('key');

        // only edit - Admin or created user
        if ($admin == 0){
            $data['poll'] = json_decode(json_encode($this->PollModel->getPollByIdKeyUser($id, $key,$this->session->id)), true);
        }else{
            $data['poll'] = json_decode(json_encode($this->PollModel->getPollByIdKeyUser($id, $key,0)), true);
        }

        // No POLL data found to add
        if (empty($data['poll'])){
            return redirect('election?e=2', 'refresh');
        }
        $answer = $this->input->post('answer');
        $user_id = $this->session->id;
        $f_name = $this->session->name;
        $verify_key =  hash("sha256", rand());

        $this->PollModel->savePollQuestion($id, $answer,$user_id,$f_name,$verify_key);

        return redirect('election/edit_election/'.$this->input->post('election_id')."/".$this->input->post('election_key')."/".$this->input->post('id'), 'refresh');




    }


}
