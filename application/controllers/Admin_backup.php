<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_backup extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_backup_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/admin_backup_form.php');
        $this->load->view('admin/footer.php');
    }

    public function backup_db() {
        $this->load->dbutil();

        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );
        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'pathtobkfolder/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 
        
        $this->load->helper('download');
        force_download($db_name, $backup); 
    }
}