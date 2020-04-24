<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_report extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Adminreport_model');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        //$data['user_type'] = $this->Admin_model->getUserType();  
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/adminreport_form.php');
        $this->load->view('admin/footer.php');
    }

    public function view_mydocs() {
        $listdoc = $this->Adminreport_model->getallDoctors();
        $data = array();
        foreach ($listdoc as $doctor) {
            $row = array();  
            $row[] = $doctor->user_fname;
            $row[] = $doctor->user_mname;
            $row[] = $doctor->user_lname;
            $row[] = '<button onclick="viewrep('."'".$doctor->user_id."'".');" class="btn btn-success btn-xs">View Report</button>';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getCustomDate($user_id){
        $StartDate = $this->input->post('startdate');
        $EndDate = $this->input->post('enddate');
        $reportlist = $this->Adminreport_model->getreportDataCustom($user_id,$StartDate,$EndDate);
        echo json_encode($reportlist);
    }

    public function getSpecificDate($user) {
        $check_up_date = $this->input->post('reportdate');
        $reportlist = $this->Adminreport_model->getreportDataDaily($user,$check_up_date);
        echo json_encode($reportlist);
    }

}