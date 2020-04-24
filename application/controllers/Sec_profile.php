<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_profile extends CI_Controller {
	 function __construct(){
	 	parent::__construct ();
   		$this->load->model('admin/User_model');
   		$this->load->model('admin/Profile_model');
   		$this->load->helper('file');
   		$this->load->library('form_validation');
 	}

	public function index() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('sec/header.php',$data);
		$this->load->view('sec/secprofile_form.php');
		$this->load->view('sec/footer.php');
	}
	
	public function get_profile() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$get_myprofile = $this->Profile_model->myprofile($user);
		echo json_encode($get_myprofile);
	}

	public function edit_myprofile() {
		$this->_validate();
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data = array (
				'user_fname' => $this->input->post('editfname'),
				'user_mname' => $this->input->post('editmname'),
				'user_lname' => $this->input->post('editlname'),
				'user_address' => $this->input->post('editaddess'),
				'user_contact_info' => $this->input->post('editcontact'),
			);
		$editprof = $this->Profile_model->editpersonalprofile($user,$data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('editfname') == '') {
            $data['inputerror'][] = 'editfname';
            $data['error_string'][] = 'First Name is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('editmname') == '') {
            $data['inputerror'][] = 'editmname';
            $data['error_string'][] = 'Middle name is required';
            $data['status'] = FALSE;
        }
         if($this->input->post('editlname') == '') {
            $data['inputerror'][] = 'editlname';
            $data['error_string'][] = 'Last Name is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('editaddess') == '') {
            $data['inputerror'][] = 'editaddess';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('editcontact') == '') {
            $data['inputerror'][] = 'editcontact';
            $data['error_string'][] = 'Contact Number is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function profile_picture() {
    	$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);

    	$config['upload_path'] = './asset/uploaded_images/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['overwrite'] = TRUE;
      $config['max_size'] = 1024 * 12;
      $this->load->library('upload', $config);
      if($this->upload->do_upload("file")) {
        $upload_data = $this->upload->data();
        $raw_filename = $upload_data['file_name'];
        $file_name =   base_url().'asset/uploaded_images/'.$upload_data['file_name'];
        $data = array (
            'user_photo' => $file_name,
          );
        $update_photo = $this->Profile_model->set_profilepic($user,$data);      
        $result['status'] = TRUE;        
      }
      else {
        $result['status'] = FALSE;       
        $result['error'] = $this->upload->display_errors('', '');
      }
      echo json_encode($result);
    }

    public function update_password() {
    	$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $config = array(
            array(
                'field'   => 'curPword',
                'label'   => 'curPword',
                'rules'   => 'trim|required|callback_oldpassword_check' // Note: Notice added callback verifier.
            ),
            array(
                'field'   => 'confPword',
                'label'   => 'confPword',
                'rules'   => 'trim|required|matches[newPword]'
            ),
            array(
                'field'   => 'newPword',
                'label'   => 'newPword',
                'rules'   => 'trim|required'
            ));
        $pword = md5($this->input->post('newPword'));
        
        
        $this->form_validation->set_rules($config);

         if ($this->form_validation->run() == FALSE) {
               echo 'Error in password fields !';  
               echo validation_errors();
         }
         else {
              unset($_POST);
              $this->prof_model->update_pword($user,$pword);
              $message = "Password successfully  updated! ";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }
  }

  public function oldpassword_check($old_password){
       $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       $old_password_hash = md5($old_password);
       $old_password_db_hash = $this->prof_model->fetch_pwrod($user);
       
       if ($old_password_hash != $old_password_db_hash->user_password) {
          $this->form_validation->set_message('oldpassword_check', 'Old password not match');
          return FALSE;
       }
       else {
          return TRUE;
       }    
  }

}