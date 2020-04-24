<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends CI_Controller {
	 function __construct(){
	 	parent::__construct ();
   		$this->load->database(); // load database
   		$this->load->model('admin/User_model');
 	}
	
	public function index() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('admin/header.php', $data);
		$this->load->view('admin/content.php');
		$this->load->view('admin/footer.php');
	}

	public function count_diagnose() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$datenow = date('Y-m-d');
		$diagnose = $this->User_model->countdiagnose($user,$datenow);
		echo json_encode($diagnose);
	}

	public function count_queue() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$queue = $this->User_model->countqueue($user);
		echo json_encode($queue);
	}

	public function count_earnings() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$datenow = date('Y-m-d');
		$totalearn = $this->User_model->totalEarnNow($user,$datenow);
		echo json_encode($totalearn);
	}
	
	public function getSummaryQueue(){
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$myclinicsq = $this->User_model->myQueueSummary($user);
		echo json_encode($myclinicsq);
	}

	public function getSummaryFees(){		
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$myclinicf = $this->User_model->myFeeSummary($user);
		echo json_encode($myclinicf);
	}

	public function getTotalFees() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$mytotalfee = $this->User_model->myTotalEarn($user);
		echo json_encode($mytotalfee);
	}

}
