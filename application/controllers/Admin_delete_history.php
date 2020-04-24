<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_delete_history extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_delete_history_model');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/delete_history_form.php');
        $this->load->view('admin/footer.php');
    }

    public function data_table_deleted() {
        $deleted_patient = $this->Admin_delete_history_model->get_deleted_patients();

        $data = array();
        foreach ($deleted_patient as $patient) {
            $row = array();  
            $row[] = $patient->patient_id;
            $row[] = $patient->patient_fname;
            $row[] = $patient->patient_lname;
            $row[] = $patient->clinic_name;
            $row[] = $patient->user_id;
            $row[] = $patient->time_deleted;

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

}