<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_records extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('admin/Search_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/search_form.php');
		$this->load->view('admin/footer.php');
 	}

 	public function viewall() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$searchall = $this->Search_model->searchby_all($user);

 		$data = array();
        foreach ($searchall as $patient) {
            $row = array();  
            $row[] = $patient->check_up_id;
            $row[] = $patient->patient_fname;
            $row[] = $patient->patient_lname;
            $row[] = $patient->patient_mname;
            $row[] = date("m-d-Y H:i:s", strtotime($patient->check_up_date));
            $row[] = '<button onclick="view_profile('."'".$patient->check_up_date."'".','."'".$patient->check_up_id."'".');" class="btn btn-primary btn-sm">View Profile</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
 	}

 	public function view_profbtn() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$check_up_id = $this->input->post('check_up_id');
 		$check_up_date = $this->input->post('check_up_date');
 		$getprofile = $this->Search_model->view_profile_btn($user,$check_up_id,$check_up_date);
        $getdiagnosis = $this->Search_model->view_diagnosis($check_up_id);

        $checkup_details = array (
            'checkup_profile' => $getprofile,
            'checkup_diagnosis' => $getdiagnosis
        );
 		echo json_encode($checkup_details);
 	}

 	public function get_clinicID($check_up_id) {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$clinicID = $this->Search_model->getall_clinic_details($user,$check_up_id);
 		echo json_encode($clinicID);
 	}

}