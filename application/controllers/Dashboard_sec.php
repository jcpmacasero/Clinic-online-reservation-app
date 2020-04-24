<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_sec extends CI_Controller {
	 function __construct(){
	 	parent::__construct ();
   		$this->load->database(); // load database
   		$this->load->model('admin/User_model');
 	}
	
	public function index() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('sec/header.php', $data);
		$this->load->view('sec/content_sec.php');
		$this->load->view('sec/footer.php');
	}

	public function count_diagnose() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$datenow = date('Y-m-d');
		$diagnose = $this->User_model->countdiagnoseSec($user,$datenow);
		echo json_encode($diagnose);
	}

	public function count_queue() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$queue = $this->User_model->countqueueSec($user);
		echo json_encode($queue);
	}

	public function count_earnings() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$datenow = date('Y-m-d');
		$totalearn = $this->User_model->totalEarnNow($user,$datenow);
		echo json_encode($totalearn);
	}
	

}
