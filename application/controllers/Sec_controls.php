<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_controls extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_model');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $data['user_type'] = $this->Admin_model->getUserType();  
        $this->load->view('sec/header.php',$data);
        $this->load->view('sec/secdashboard_form.php');
        $this->load->view('sec/footer.php');
    }
    
}