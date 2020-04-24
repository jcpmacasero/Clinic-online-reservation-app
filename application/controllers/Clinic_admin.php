<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic_admin extends CI_Controller {
    

	function __construct(){
	 	parent::__construct ();
   		$this->load->model('admin/User_model');
        $this->load->model('admin/Clinic_model');
        $this->load->library('form_validation');
 	}

	public function index() {
		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
        $data['province_id'] = $this->Clinic_model->getallProvince();
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/clinic_form.php');
		$this->load->view('admin/footer.php');
	}

    public function getpic($clinic_id) {
        $updatepic = $this->Clinic_model->getupdatepic($clinic_id);
        echo json_encode($updatepic);
    }

    public function myclinics() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $allclinics = $this->Clinic_model->getallmyclinics($user['user_id']);

        $data = array();
        foreach ($allclinics as $clinic) {
            $row = array();  
            $row[] = $clinic->clinic_name;
            $row[] = $clinic->clinic_address;
            $row[] = '<img src="'.$clinic->clinic_logo.'" class="img-rounded" width="35" height="auto">';
            if ($clinic->clinic_status == "CLOSE") {

                $row[] = '<p class="closered" >'.$clinic->clinic_status.'</p>';    
            } else {
                $row[] = '<p class="openblue" >'.$clinic->clinic_status.'</p>';
            }
            
            $row[] = '<button onclick="clinic_view('."'".$clinic->clinic_id."'".');" class="btn btn-primary btn-xs">&nbsp;&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function mysecs() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $allsecs = $this->Clinic_model->getallmySecretary($user['user_id']);

        $data = array();
        foreach ($allsecs as $sec) {
            $row = array();  
            $row[] = $sec->user_fname;
            $row[] = $sec->user_mname;
            $row[] = $sec->user_lname;
            $row[] = $sec->user_address;
            $row[] = $sec->user_contact_info;
            $row[] = '<img src="'.$sec->user_photo.'" class="img-rounded" width="35" height="auto">';
            if($sec->user_status == "OK") {
                $row[] = '<p class="openblue">'.$sec->user_status.'</p>';    
            } else {
                $row[] = '<p class="closered">'.$sec->user_status.'</p>';    
            }
            
            $row[] = '<button onclick="sec_details('."'".$sec->user_id."'".');" class="btn btn-primary btn-xs">More Details/Edit</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function create_clinic() {

        $this->form_validation->set_rules('clinic_name', 'clinic_name', 'trim|required|callback_check_duplicate',
            array('required' => 'Clinic name is required')
            );

        $this->form_validation->set_rules('clinic_address', 'clinic_address', 'trim|required',
            array('required' => 'Clinic address is required')
            );

        $this->form_validation->set_rules('clinic_province', 'clinic_province', 'trim|required',
            array('required' => 'Clinic province is required')
            );

        $this->form_validation->set_rules('clinic_city', 'clinic_city', 'trim|required',
            array('required' => 'Clinic city is required')
            );


            if ($this->form_validation->run() == TRUE) {

                $result['status'] = true;
                $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
                $clinic_photo = base_url().'asset/uploaded_images/clinicdefault.jpg';
                $initial = "CLOSE";
                

                 $data = array (
                    'clinic_name' => $this->input->post('clinic_name'),
                    'clinic_address' => $this->input->post('clinic_address'),
                    'city_id' => $this->input->post('clinic_city'),
                    'clinic_status' => $initial,
                    'user_id' => $user['user_id'],
                    'clinic_logo' => $clinic_photo,
                 );
                
                 $insert = $this->Clinic_model->savedb($data);
                 

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
        echo json_encode($result);
        
	}

    public function check_duplicate($clinic_name){
    $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       $theclinic_name = $this->Clinic_model->fetch_clinicname($user,$clinic_name);
       if ($theclinic_name > 0) {
          $this->form_validation->set_message('check_duplicate', 'Clinic name already used');
          return FALSE;
       }
       else {
          return TRUE;
       }    
    }

    public function disp_clinic_ID() {
        $clinic = $this->Clinic_model->checkingclinic();
        echo json_encode($clinic);
    }

    public function getcity($province_id){
        $cityselect = $this->Clinic_model->getcitybyID($province_id);
        echo json_encode($cityselect);
    }

    public function getClinicDetails($clinic_id) {
        $clinicme = $this->Clinic_model->getmydetails($clinic_id);
        echo json_encode($clinicme);
    }

    public function upclinic_logo($clinic_id) {
        $config['upload_path'] = './asset/uploaded_images/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024 * 8;
        $this->load->library('upload', $config);
        if($this->upload->do_upload("file")) {
            $upload_data = $this->upload->data(); 
            $file_name =   base_url().'asset/uploaded_images/'.$upload_data['file_name'];
            $data = array (
                    'clinic_logo' => $file_name,
                );
            $update_photo = $this->Clinic_model->set_logo($clinic_id,$data);
        }
        else {
            echo "File cannot be uploaded";
            $error = array('error' => $this->upload->display_errors()); var_dump($error);
        }
    }

    public function getmyprovince($city_id){
        $myprovince = $this->Clinic_model->province_clinic($city_id);
        echo json_encode($myprovince);
    }

    public function edit_myclinic($clinic_id) {
        $this->form_validation->set_rules('editclinic_name', 'editclinic_name', 'trim|required|callback_check_duplicate',
            array('required' => 'Clinic name is required')
            );

          $this->form_validation->set_rules('editclinic_address', 'editclinic_address', 'trim|required',
            array('required' => 'Clinic address is required')
            );

          $this->form_validation->set_rules('clinic_province', 'clinic_province', 'trim|required',
            array('required' => 'Clinic province is required')
            );

          $this->form_validation->set_rules('clinic_city', 'clinic_city', 'trim|required',
            array('required' => 'Clinic city is required')
            );

            if ($this->form_validation->run() == TRUE) {

                    $result['status'] = true;
                     
                    $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
                    $data = array (
                        'clinic_name' => $this->input->post('editclinic_name'),
                        'clinic_address' => $this->input->post('editclinic_address'),
                        'city_id' => $this->input->post('clinic_city'),
                        'user_id' => $user['user_id'],
                     );
                    $clinic_data = $this->Clinic_model->updateClinic(array('clinic_id' => $clinic_id),$data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
        
    }

    public function addusersec() {
          $this->form_validation->set_rules('addsec_fname', 'addsec_fname', 'trim|required',
            array('required' => 'First name is required')
            );

          $this->form_validation->set_rules('addsec_mname', 'addsec_mname', 'trim|required',
            array('required' => 'Middle name is required')
            );

          $this->form_validation->set_rules('addsec_lname', 'addsec_lname', 'trim|required',
            array('required' => 'Last name is required')
            );

          $this->form_validation->set_rules('addsec_username', 'addsec_username', 'trim|required|is_unique[tbl_users.user_name]|min_length[5]',
            array('required' => 'Username is required',
                  'is_unique' => 'Username already exist',
                  'min_length' => 'Username minimum length of 5 characters')
            );

          $this->form_validation->set_rules('addsec_pword', 'addsec_pword', 'trim|required|min_length[6]',
            array('required' => 'Password is required',
                  'min_length' => 'Password minimum length of 6 characters')
            );

          $this->form_validation->set_rules('addsec_address', 'addsec_address', 'trim|required',
            array('required' => 'Address is required')
            );

          $this->form_validation->set_rules('addsec_contact', 'addsec_contact', 'trim|required',
            array('required' => 'Contact # is required')
            );

          $this->form_validation->set_rules('addsec_bday', 'addsec_bday', 'trim|required',
            array('required' => 'Birthdate name is required')
            );

          $this->form_validation->set_rules('addsec_gender', 'addsec_gender', 'trim|required',
            array('required' => 'Gender is required')
            );

            if ($this->form_validation->run() == TRUE) {

                    $result['status'] = true;
                    $temp_user_id = $this->user_id();
                    $curYear = date('Y');
                    $final_user_id = $temp_user_id . "-" . $curYear;
                    $this->addsec($final_user_id);
                    $myAssignID = $this->assign_id();
                    $myChatID = $this->chat_id();
                    $sec_photo = base_url().'asset/uploaded_images/default-img.png';
                    $sec_pword = md5($this->input->post('addsec_pword'));
                    $sec_bdate = $this->input->post('addsec_bday');
                    $format_bdate = date("Y-m-d", strtotime($sec_bdate));

                    $data = array (
                        'user_id' => $final_user_id,
                        'user_type' => "ut3",
                        'user_name' => $this->input->post('addsec_username'),
                        'user_password' => $sec_pword,
                        'user_fname' => $this->input->post('addsec_fname'),
                        'user_mname' => $this->input->post('addsec_mname'),
                        'user_lname' => $this->input->post('addsec_lname'),
                        'user_address' => $this->input->post('addsec_address'),
                        'user_contact_info' => $this->input->post('addsec_contact'),
                        'user_bdate' => $format_bdate,
                        'user_photo' => $sec_photo,
                        'user_status' => "OK",
                        'user_gender' => $this->input->post('addsec_gender'),
                        'assign_id' => $myAssignID,
                        'chat_id' => $myChatID,
                     );
                     
                     $insert = $this->Clinic_model->addSecUser($data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    public function addsec($user_id) {
        $usec_id = $this->sec_id();
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data = array (
            'sec_id' => $usec_id,
            'creator_id' => $user['user_id'],
            'user_id' => $user_id,
         );
         $insert1 = $this->Clinic_model->addSec($data);

    }

    private function user_id() {
        $user_id = $this->Clinic_model->genuser_id();
        $myuser_id = $user_id + 1;
        return $myuser_id;
    }

    private function sec_id() {
        $sec_id = $this->Clinic_model->gensec_id();
        $mysec_id = $sec_id + 1;
        return $mysec_id;
    }

    private function assign_id() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $ass_id = $this->Clinic_model->getAssign_ID($user);
        return $ass_id;
    }

    private function chat_id() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $chat_id = $this->Clinic_model->getChat_ID($user);
        return $chat_id;
    }

    public function getsecprofile($user_id) {
        $secdata = $this->Clinic_model->getsecprofile($user_id);
        echo json_encode($secdata);   
    }

    public function updateSecProfile($user_id){
        $this->form_validation->set_rules('secedit_fname', 'secedit_fname', 'trim|required',
            array('required' => 'First name is required')
            );

          $this->form_validation->set_rules('secedit_mname', 'secedit_mname', 'trim|required',
            array('required' => 'Middle name is required')
            );

          $this->form_validation->set_rules('secedit_lname', 'secedit_lname', 'trim|required',
            array('required' => 'Last name is required')
            );

          $this->form_validation->set_rules('secedit_uname', 'secedit_uname', 'trim|required|is_unique[tbl_users.user_name]|min_length[5]',
            array('required' => 'Username is required',
                  'is_unique' => 'Username already exist',
                  'min_length' => 'Username minimum length of 5 characters')
            );

          $this->form_validation->set_rules('secedit_pword', 'secedit_pword', 'trim|required|min_length[6]',
            array('required' => 'Password is required',
                  'min_length' => 'Password minimum length of 6 characters')
            );

          $this->form_validation->set_rules('secedit_address', 'secedit_address', 'trim|required',
            array('required' => 'Address is required')
            );

          $this->form_validation->set_rules('secedit_contact', 'secedit_contact', 'trim|required',
            array('required' => 'Contact # is required')
            );

          $this->form_validation->set_rules('secedit_stat', 'secedit_stat', 'trim|required',
            array('required' => 'Martial status is required')
            );

          $this->form_validation->set_rules('secedit_gender', 'secedit_gender', 'trim|required',
            array('required' => 'Gender is required')
            );

            if ($this->form_validation->run() == TRUE) {

                    $result['status'] = true;
                    $secedit_pword = md5($this->input->post('secedit_pword'));
                    $data = array (
                            'user_fname' => $this->input->post('secedit_fname'),
                            'user_mname' => $this->input->post('secedit_mname'),
                            'user_lname' => $this->input->post('secedit_lname'),
                            'user_name' => $this->input->post('secedit_uname'),
                            'user_password' => $secedit_pword,
                            'user_address' => $this->input->post('secedit_address'),
                            'user_contact_info' => $this->input->post('secedit_contact'),
                            'user_gender' => $this->input->post('secedit_gender'),
                            'user_status' => $this->input->post('secedit_stat'),
                    ); 
                    $clinic_data = $this->Clinic_model->updateSecInfo(array('user_id' => $user_id),$data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

}
