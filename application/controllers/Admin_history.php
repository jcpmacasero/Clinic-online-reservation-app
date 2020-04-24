<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_history extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_model');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $data['user_type'] = $this->Admin_model->getUserType();  
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/history_form.php');
        $this->load->view('admin/footer.php');
    }

    public function viewall_visitors(){
        $viewall = $this->Admin_model->visitors();
        $data = array();
        foreach ($viewall as $visitor) {
            $row = array();  
            $row[] = $visitor->oauth_provider;
            $row[] = $visitor->first_name;
            $row[] = $visitor->last_name;
            $row[] = $visitor->email;
            $row[] = '<img src="'.$visitor->picture.'" class="img-rounded" width="35" height="auto">';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }
}