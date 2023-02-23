<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PollModel extends CI_Model
{

    //user table related model
    public function __construct()
    {
        parent::__construct();
    }

   // add question
    public function savePoll($name, $user_id,$f_name,$verify_key,$e_id)
    {
        $data = array(
            "name" => $name,
            "user_id" => $user_id,
            "first_name" => $f_name,
            "verify_key" => $verify_key,
            "election_id" => $e_id,
        );
        $this->db->insert('poll', $data);
        return  $this->db->insert_id();
    }

    // create poll
    public function saveElection($name, $user_id,$f_name,$verify_key,$expire_date,$description,$approve)
    {
        $data = array(
            "name" => $name,
            "user_id" => $user_id,
            "first_name" => $f_name,
            "expire_date" => $expire_date,
            "description" => $description,
            "verify_key" => $verify_key,
            "approve" => $approve,
        );
        $this->db->insert('election', $data);
        return  $this->db->insert_id();
    }

    //get question by id
    public function getPollById($id)
    {
        $this->db->where('id', $id);
        $query=$this->db->get("poll");
        return $query->result();
    }
    
    //poll report graph - how many polls created by a admin
    public function getElectionCountByUser()
    {
        $query = $this->db->query("select sum(status) as election_count,first_name from election  group by user_id");
        return $query->result();
    }

    // get poll result from question and answer tables
    public function getElectionVoteCount($eid)
    {
        $query = $this->db->query("select * from poll p INNER JOIN poll_answers pa ON p.id=pa.poll_id where p.election_id='.$eid.'");
        return $query->result();
    }
	
    // get answers for one question
	public function getPollVoteAndResult($pollid)
	{
		$query = $this->db->query("SELECT answer, point_count FROM `poll_answers` WHERE poll_id = ".$pollid."");
        return $query->result();	
	}
	
    // get answers for multiple questions
	public function getPollVoteAndResults($pollids)
	{
		$sqldata = "SELECT `poll_answers`.`answer`, `poll_answers`.`point_count`, `poll`.`name` FROM `poll_answers`, `poll` WHERE `poll`.`id` = `poll_answers`.`poll_id` AND `poll`.`id` in ( ";
		$size = sizeof($pollids);
		$i = 0;
		foreach($pollids as $id){
			if($i == $size-1){
				$sqldata .= " '".$id["id"]."' );";	
			}else{
				$sqldata .= " '".$id["id"]."', ";
			}	
			$i = $i + 1;				
		}
		
		$query = $this->db->query($sqldata);
        return $query->result();	
	}
	
    //get question id
	public function getPollIdsFromElectionId($electionid)
	{
		$sqldata = "SELECT id FROM `poll` WHERE `election_id` = '".$electionid."';";	
		$query = $this->db->query($sqldata);
        return $query->result();	
	}

    // get question data
    public function getPollByIdKeyUser($id,$key,$user_id)
    {
        $this->db->where('id', $id);
        $this->db->where('verify_key', $key);
        if ($user_id != 0){
            $this->db->where('user_id', $user_id);
        }
        $query=$this->db->get("poll");
        return $query->result();
    }

    // get poll details
    public function getElectionByIdKeyUser($id,$key,$user_id)
    {
        $this->db->where('id', $id);
        $this->db->where('verify_key', $key);
        if ($user_id != 0){
            $this->db->where('user_id', $user_id);
        }
        $query=$this->db->get("election");
        return $query->result();
    }
//    public function getElectionResultSumByIdKey($id,$key)
//    {
//        $query = $this->db->query("select * from election where  poll_id in(".$id.") order by poll_id");
//        return $query->result();
//    }

    // get poll details 
    public function getElectionByUser($user_id)
    {
        $this->db->where('status', 1);
        $this->db->where('user_id', $user_id);
        $query=$this->db->get("election");
        return $query->result();
    }

    // get poll details
    public function getElectionById($id)
    {
        $this->db->where('status', 1);
        $this->db->where('id', $id);
        $query=$this->db->get("election");
        return $query->result();
    }

    // get poll details
    public function getElections()
    {
        $this->db->where('status', 1);
        $this->db->where('approve', 0);
        $query=$this->db->get("election");
        return $query->result();
    }

    public function getElectionsapprove()
    {
        $this->db->where('status', 1);
        
        $query=$this->db->get("election");
        return $query->result();
    }

    // get poll answers
    public function getPollAnswersByPollId($id)
    {
        $this->db->where('status', 1);
        $this->db->where('poll_id', $id);
        $query=$this->db->get("poll_answers");
        return $query->result();
    }

    // get poll question
    public function getPollsByElectionId($id)
    {
        $this->db->where('status', 1);
        $this->db->where('election_id', $id);
        $query=$this->db->get("poll");
        return $query->result();
    }

    // get poll answers
    public function getPollAnswerByIdKey($id, $key)
    {
        $this->db->where('status', 1);
        $this->db->where('id', $id);
        $this->db->where('verify_key', $key);
        $query=$this->db->get("poll_answers");
        return $query->result();
    }

    // get vote result only for one question
    public function getVoteLogByPollId($id)
    {
        $this->db->where('poll_id', $id);
        $query=$this->db->get("vote_log");
        return $query->result();
    }

    // get vote result only for multiple question (input array)
    public function getVoteLogByPollIdList($id)
    {
        $query = $this->db->query("select * from vote_log where  poll_id in(".$id.") order by poll_id");
        return $query->result();
    }

    // get vote result only for multiple question (input array)
    public function getVoteLogByPollIdListSum($id)
    {
        $query = $this->db->query("select answer_id, sum(vote) as vote from vote_log where  poll_id in(".$id.") group by answer_id");
        return $query->result();
    }

    // get vote result only for one question
    public function getVoteLogByPollIdUserId($id,$user_id)
    {
        $this->db->where('poll_id', $id);
        $this->db->where('user_id', $user_id);
        $query=$this->db->get("vote_log");
        return $query->result();
    }

    // insert poll answers
    public function savePollQuestion($id, $answer,$user_id,$f_name,$verify_key)
    {
        $data = array(
            "poll_id" => $id,
            "answer" => $answer,
            "user_id" => $user_id,
            "first_name" => $f_name,
            "verify_key" => $verify_key,
        );
        $this->db->insert('poll_answers', $data);
        return  $this->db->insert_id();
    }

    //save votes in database
    public function saveVote($poll_id,$id,$user_id,$f_name)
    {
        $data = array(
            "poll_id" => $poll_id,
            "answer_id" => $id,
            "vote" => 1,
            "user_id" => $user_id,
            "first_name" => $f_name,
        );
        $this->db->insert('vote_log', $data);
        return  $this->db->insert_id();
    }

    // update poll disable status
    public function updateElectionStatus($id,$verify_key)
    {
        $data = array(
            "status" => 0,
        );

        $this->db->set($data);
        $this->db->where("id",$id);
        $this->db->where("verify_key",$verify_key);
        $query = $this->db->update("election", $data);
        return $query;

    }

    // update poll end status
    public function updateElectionEndStatus($id,$verify_key)
    {
        $data = array(
            "end_status" => 1,
        );

        $this->db->set($data);
        $this->db->where("id",$id);
        $this->db->where("verify_key",$verify_key);
        $query = $this->db->update("election", $data);
        return $query;

    }

    public function updateApproveStatus($id,$verify_key)
    {
        $data = array(
            "approve" => 0,
        );

        $this->db->set($data);
        $this->db->where("id",$id);
        $this->db->where("verify_key",$verify_key);
        $query = $this->db->update("election", $data);
        return $query;

    }

    // insert comments
    public function updatePollComment($pollid,$userid,$comment)
    {
        $data = array(
         	"pollid" => $pollid,
			"userid" => $userid,
			"comment" => $comment
        );

        $this->db->set($data);
        $this->db->insert("comments", $data);
    }
	
    // get comments
	public function getlastpollcomment($userid, $pollid)
	{
		$this->db->where('pollid', $pollid);
        $this->db->where('userid', $userid);
        $query=$this->db->get("comments");
        return $query->result();
	}

    // update poll end date 
    public function updateElectionEndDate()
    {
        $data = array(
            "end_status" => 1,
        );
        date_default_timezone_set("Asia/Colombo");
        $todayDate = date("Y-m-d");

        $this->db->set($data);
        $this->db->where("expire_date <",$todayDate);
        $query = $this->db->update("election", $data);
        return $query;

    }



}