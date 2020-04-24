<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_diagnosis extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('admin/Search_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/doctor_diagnosis_form.php');
		$this->load->view('admin/footer.php');
 	}
 	

}