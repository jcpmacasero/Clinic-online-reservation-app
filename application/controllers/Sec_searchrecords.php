<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_searchrecords extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
        $this->load->model('sec/Sec_searchmodel');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
        $myassignID = $this->getassignID($user);
        $data['doctors'] = $this->Sec_searchmodel->showdocs($myassignID); 
		$this->load->view('sec/header.php',$data);
		$this->load->view('sec/secsearch_form.php');
		$this->load->view('sec/footer.php');
 	}

    private function getassignID($user) {
        $assignID = $this->Sec_searchmodel->getassigid($user);
        return $assignID;
    }
    
    //good
 	public function viewall($user_id) {
 		$searchall = $this->Sec_searchmodel->searchby_all($user_id);

 		$data = array();
        foreach ($searchall as $patient) {
            $row = array();  
            $row[] = $patient->check_up_id;
            $row[] = $patient->patient_fname;
            $row[] = $patient->patient_lname;
            $row[] = $patient->patient_mname;
            $row[] = date("m-d-Y H:i:s", strtotime($patient->check_up_date));
            $row[] = '<button onclick="view_profilebutton('."'".$patient->check_up_date."'".','."'".$patient->check_up_id."'".');" class="btn btn-primary btn-sm">View Profile</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
 	}

    public function view_profbtn() {
        $check_up_id = $this->input->post('check_up_id');
        $check_up_date = $this->input->post('check_up_date');
        $user_id = $this->input->post('user_id');
        $getprofile = $this->Sec_searchmodel->view_profile_btn($user_id,$check_up_id,$check_up_date);
        $getdiagnosis = $this->Sec_searchmodel->view_diagnosis($check_up_id);

        $checkup_details = array (
            'checkup_profile' => $getprofile,
            'checkup_diagnosis' => $getdiagnosis
        );
        
        echo json_encode($checkup_details);
    }

    public function get_clinicID($check_up_id,$user) {
        $clinicID = $this->Sec_searchmodel->getall_clinic_details($user,$check_up_id);
        echo json_encode($clinicID);
    }

 	// public function view_profbtn() {
 	// 	$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 	// 	$check_up_id = $this->input->post('check_up_id');
 	// 	$check_up_date = $this->input->post('check_up_date');
 	// 	$getprofile = $this->search_model->view_profile_btn($user,$check_up_id,$check_up_date);
 	// 	echo json_encode($getprofile);
 	// }

}