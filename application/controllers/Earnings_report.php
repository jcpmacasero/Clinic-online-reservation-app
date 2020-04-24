<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Earnings_report extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	//$this->load->model('admin/clinic_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/earnings_report_form.php');
		$this->load->view('admin/footer.php');
 	}

 	public function getSpecificDate() {
 		$check_up_date = $this->input->post('check_up_date');
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$reportlist = $this->Adminreport_model->getreportDataDaily($user['user_id'],$check_up_date);
        echo json_encode($reportlist);
 	}

}