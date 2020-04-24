<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients_report extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('admin/Adminreport_model');
        $this->load->model('admin/Clinic_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
        $data['diagnosis_id'] = $this->Clinic_model->showall_diagnosis();
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/patients_report_form.php');
		$this->load->view('admin/footer.php');
 	}

 	public function data_report_summary(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $myreport = $this->Adminreport_model->data_table_summary($user);
        $count = 0;
        $patients = 0;
        $earn = 0;
        $data = array();

        foreach ($myreport as $summary) {
            $row = array();  
            $row[] = $summary->clinic_name;
            $row[] = $summary->totalpatient;
            $row[] = $summary->totalearn;
            $row[] = '<button class="btn btn-primary btn-xs" onclick="viewOnDetails('."'".$summary->clinic_id."'".')">View Transaction</button>';
            $count = $count + 1;
            $patients = $patients + $summary->totalpatient;
            $earn = $earn + $summary->totalearn;

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
            "oclinics" => $count,
            "opatients" => $patients,
            "oearn" => $earn
        );
        echo json_encode($output);
    }

    public function fetchclinicsummary($clinic_id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $firstdate = $this->input->post('from');
        $secondate = $this->input->post('to');
        $mysummary = $this->Adminreport_model->fetchmyclinic($user,$clinic_id,$firstdate,$secondate);
        echo json_encode($mysummary);
    }

    public function fetchclinicdaily($clinic_id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $datepicked = $this->input->post('pickrepdate');
        $mysummary = $this->Adminreport_model->fetchmyclinicdaily($user,$clinic_id,$datepicked);
        echo json_encode($mysummary);
    }

    public function piedataclinic() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $piedata = $this->Adminreport_model->getpiedata($user);
        echo json_encode($piedata);
    }

    public function bardataclinic($month) {
        $date = date_parse($month);
        $today = date("Y");
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $bardata = $this->Adminreport_model->getmybardata($user,$date['month'],$today);
        echo json_encode($bardata);
    }

    public function bardata_date(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $today = date("Y");
        $dates = $this->Adminreport_model->getmybardata_date($user,$today);
        echo json_encode($dates);
    }

    public function seriesclinics() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $clinics = $this->Adminreport_model->getSeriesClinics($user);
        echo json_encode($clinics);
    }

    public function get_checkup($month,$clinic_id) {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $date = date_parse($month);
        $today = date("Y");
        $seriesdata = $this->Adminreport_model->getthisClinic($today,$date['month'],$clinic_id,$user);
        echo json_encode($seriesdata);
    }

    public function graph_diagnose() {
       $diagnosis = $this->input->post('selectdiagnosis');
       $diagnames = [];
       for ($i = 0; $i < count($diagnosis); $i++) {
            $result = $this->Adminreport_model->getDiagName($diagnosis[$i]);
            $diagnames = array_merge($diagnames, $result);
       }
       echo json_encode($diagnames);
    }

    public function dataforSeries($month, $diagnosis_id) {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $date = date_parse($month);
        $diagcount = $this->Adminreport_model->getDiagSeriesData($date['month'],$diagnosis_id,$user);
        echo json_encode($diagcount);
    }
}