<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_myclinic extends CI_Controller {

	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('sec/Clinicsec_model');
        $this->load->library('form_validation');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
        $myassignID = $this->getassignID($user);
        // $doctors = $this->clinicsec_model->showdocs($myassignID);
        // var_dump($doctors);
        $data['doctors'] = $this->Clinicsec_model->showdocs($myassignID);
        $data['defaultphoto'] = base_url().'asset/uploaded_images/default-img.png';
		$this->load->view('sec/header.php',$data);
		$this->load->view('sec/secmyclinic_form.php');
		$this->load->view('sec/footer.php');
 	}

    private function getassignID($user) {
        $assignID = $this->Clinicsec_model->getassigid($user);
        return $assignID;
    }

    public function getclinics($user) {
        $clinics = $this->Clinicsec_model->getclinicsbyuser($user);
        echo json_encode($clinics);
    }

    public function get_patients($getClinicID,$lastQueueID,$user) {
        $list = $this->Clinicsec_model->get_allpatients($user,$getClinicID,$lastQueueID);
        echo json_encode($list);
    }

    public function get_patients_refresh($getClinicID,$user) {
        $list = $this->Clinicsec_model->get_allpatients_refresh($user,$getClinicID);
        echo json_encode($list);
    }

    public function myclinic_stat($getClinicID,$user) {
        $selectStatus = $this->Clinicsec_model->selectedClinicStatus($user,$getClinicID);
        echo json_encode($selectStatus);
    }

    public function updateClinicStat($getClinicID,$user){
        $data = array (
            'clinic_status' => $this->input->post('clinic_status'),
            );
        if($data['clinic_status'] == "0"){

        }
        else if($data['clinic_status'] == "OPEN" OR $data['clinic_status'] == "CLOSE") {
            $updatedClinicStat = $this->Clinicsec_model->updateClinicStatus(array('clinic_id' => $getClinicID, 'user_id' => $user),$data);
            echo json_encode($updatedClinicStat);
        }
    }

    public function addpatient($cuser_id) {

            $this->form_validation->set_rules('pafname', 'pafname', 'trim|required|callback_check_patient['.$cuser_id.']',
            array('required' => 'First name is required')
            );

          $this->form_validation->set_rules('pamname', 'pamname', 'trim|required',
            array('required' => 'Middle name is required')
            );

          $this->form_validation->set_rules('palname', 'palname', 'trim|required',
            array('required' => 'Last name is required')
            );

          $this->form_validation->set_rules('paaddress', 'paaddress', 'trim|required',
            array('required' => 'Address is required')
            );

          $this->form_validation->set_rules('pacontact', 'pacontact', 'trim|required',
            array('required' => 'Contact # is required')
            );

          $this->form_validation->set_rules('pabdate', 'pabdate', 'trim|required',
            array('required' => 'Birthdate is required')
            );

          $this->form_validation->set_rules('psex', 'psex', 'trim|required',
            array('required' => 'Gender is required')
            );

          $this->form_validation->set_rules('pmartialstat', 'pmartialstat', 'trim|required',
            array('required' => 'Martial status is required')
            );

            if ($this->form_validation->run() == TRUE) {
                    $config['upload_path'] = './asset/uploaded_images/patients/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 1024 * 12;
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload("file")) {
                        $upload_data = $this->upload->data();
                        $file_name =   base_url().'asset/uploaded_images/patients/'.$upload_data['file_name'];
                        $mypatiendid = $this->genpatient_id();
                        $patient_bday = $this->input->post('pabdate');
                        $DB_date = date('Y-m-d', strtotime($patient_bday));
                        $curryear = date("Y");
                        $patient_age = $curryear - date('Y', strtotime($patient_bday));
                        $result['status'] = true;

                        $data = array (
                            'patient_id' => $mypatiendid,
                            'patient_fname' => $this->input->post('pafname'),
                            'patient_mname' => $this->input->post('pamname'),
                            'patient_lname' => $this->input->post('palname'),
                            'patient_address' => $this->input->post('paaddress'),
                            'patient_contact_info' => $this->input->post('pacontact'),
                            'patient_bday' => $DB_date,
                            'patient_blood' => $this->input->post('bloodtype'),
                            'patient_age' => $patient_age,
                            'patient_sex' => $this->input->post('psex'),
                            'patient_civil_status' => $this->input->post('pmartialstat'),
                            'patient_photo' => $file_name,
                            'creator_id' => $cuser_id,
                        );
                        $insert = $this->Clinicsec_model->insert_patient($data);
                    } else {
                        $user_photo = base_url().'asset/uploaded_images/default-img.png';
                        $mypatiendid = $this->genpatient_id();
                        $patient_bday = $this->input->post('pabdate');
                        $DB_date = date('Y-m-d', strtotime($patient_bday));
                        $curryear = date("Y");
                        $patient_age = $curryear - date('Y', strtotime($patient_bday));
                        $result['status'] = true;                        

                        $data = array (
                            'patient_id' => $mypatiendid,
                            'patient_fname' => $this->input->post('pafname'),
                            'patient_mname' => $this->input->post('pamname'),
                            'patient_lname' => $this->input->post('palname'),
                            'patient_address' => $this->input->post('paaddress'),
                            'patient_contact_info' => $this->input->post('pacontact'),
                            'patient_bday' => $DB_date,
                            'patient_blood' => $this->input->post('bloodtype'),
                            'patient_age' => $patient_age,
                            'patient_sex' => $this->input->post('psex'),
                            'patient_civil_status' => $this->input->post('pmartialstat'),
                            'patient_photo' => $user_photo,
                            'creator_id' => $cuser_id,
                        );
                        $insert = $this->Clinicsec_model->insert_patient($data);
                    }                                                        
            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    public function editmypatient($patient_id,$user_id) {
         $this->form_validation->set_rules('paeditfname', 'paeditfname', 'trim|required|callback_check_patient['.$user_id.']',
            array('required' => 'First name is required')
            );

          $this->form_validation->set_rules('paeditmname', 'paeditmname', 'trim|required',
            array('required' => 'Middle name is required')
            );

          $this->form_validation->set_rules('paeditlname', 'paeditlname', 'trim|required',
            array('required' => 'Last name is required')
            );

          $this->form_validation->set_rules('paeditaddress', 'paeditaddress', 'trim|required',
            array('required' => 'Address is required')
            );

          $this->form_validation->set_rules('paeditcontact', 'paeditcontact', 'trim|required',
            array('required' => 'Contact # is required')
            );

          $this->form_validation->set_rules('paeditbdate', 'paeditbdate', 'trim|required',
            array('required' => 'Birthdate is required')
            );

          $this->form_validation->set_rules('paeditage', 'paeditage', 'trim|required',
            array('required' => 'Age is required')
            );

          $this->form_validation->set_rules('peditsex', 'peditsex', 'trim|required',
            array('required' => 'Gender is required')
            );

          $this->form_validation->set_rules('paeditmartialstat', 'paeditmartialstat', 'trim|required',
            array('required' => 'Martial status is required')
            );

            if ($this->form_validation->run() == TRUE) {
                    $patient_edit_bday = $this->input->post('paeditbdate');
                    $DB_date = date('Y-m-d', strtotime($patient_edit_bday));
                    $curryear = date("Y");
                    $patient_age = $curryear - date('Y', strtotime($patient_edit_bday));
                    $result['status'] = true;
                    $data = array (
                    'patient_fname' => $this->input->post('paeditfname'),
                    'patient_mname' => $this->input->post('paeditmname'),
                    'patient_lname' => $this->input->post('paeditlname'),
                    'patient_address' => $this->input->post('paeditaddress'),
                    'patient_contact_info' => $this->input->post('paeditcontact'),
                    'patient_sex' => $this->input->post('peditsex'),
                    'patient_civil_status' => $this->input->post('paeditmartialstat'),
                    'patient_age' => $patient_age,
                    'patient_blood' => $this->input->post('paeditblood'),
                    'patient_bday' => $DB_date,
                 );

                $thepatient_data = $this->Clinicsec_model->updatepatientinfo(array('patient_id' => $patient_id),$data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    public function check_patient($user_id){
       $patient_fname = $this->input->post('pafname');
       $patient_mname = $this->input->post('pamname');
       $patient_lname = $this->input->post('palname');
       $bdatepost = $this->input->post('pabdate');
       $patient_gender = $this->input->post('psex');
       $patient_bdate = date('Y-m-d', strtotime($bdatepost));

       $checking_patient = $this->Clinicsec_model->fetch_patient($patient_fname,$patient_mname,$patient_lname,$patient_bdate,$user_id,$patient_gender);
       if ($checking_patient > 0) {
          $this->form_validation->set_message('check_patient', 'Patient already exist');
          return FALSE;
       }
       else {
          return TRUE;
       }    
    }

    private function genpatient_id() {
        $patientID = $this->Clinicsec_model->getpatientid();
        $generatePatientID = $patientID + 1;
        return $generatePatientID;
    }

    public function viewall_patients($userID) {
        $viewall = $this->Clinicsec_model->showall_patients($userID);
        $data = array();
        foreach ($viewall as $patient) {
            $row = array();              
            $row[] = $patient->patient_fname;
            $row[] = $patient->patient_lname;
            $row[] = $patient->patient_mname;
            $row[] = '<button onclick="addtoqueue('."'".$patient->patient_id."'".');" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Add to queue" id="btnR"><i class="fa fa-plus"></i> &nbsp;<i class="fa fa-users"></i></button>
                      <button onclick="editpatient('."'".$patient->patient_id."'".');" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="Edit details" id="btnR2"><i class="fa fa-pencil"></i> &nbsp;&nbsp;<i class="fa fa-user"></i></button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function check_uphistory($patient_id) {
        $viewall = $this->Clinicsec_model->showall_checkups($patient_id);
        $data = array();
        foreach ($viewall as $patient) {
            $row = array();  
            $row[] = $patient->check_up_id;
            $row[] = $patient->check_up_date;
            $row[] = '<button onclick="checkupdetails('."'".$patient->check_up_id."'".');" class="btn btn-success btn-xs"> Show details </button>';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function patientaddqueue() {
    $clinic_id = $this->input->post('clinic_id');
    if($this->session->userdata('reset') !== FALSE) {
        $myorderNUM = 1;
        $this->session->set_userdata('reset', FALSE);
    } else {
        $myorderNUM = $this->get_ordernum($clinic_id);    
    }        
    $firstStat = "0";

     $data = array (
        'order_num' => $myorderNUM,
        'clinic_id' => $clinic_id,
        'patient_id' => $this->input->post('patient_id'),
        'user_id' => $this->input->post('user_id'),
        'status' => $firstStat,
        );
     $insert = $this->Clinicsec_model->insert_toqueue($data);
     echo json_encode(array("status" => TRUE));
    }

    private function get_ordernum($clinic_id){
        $ordernum = $this->Clinicsec_model->getordernum($clinic_id);
        $generateordernum = $ordernum + 1;
        return $generateordernum;
    }

    public function getmydetails($patient_id) {
        $mydet = $this->Clinicsec_model->getmydetails($patient_id);
        echo json_encode($mydet);
    }

    public function patient_picture($patient_id) {
        $config['upload_path'] = './asset/uploaded_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024 * 12;
        $this->load->library('upload', $config);
        if($this->upload->do_upload("file")) {
            $upload_data = $this->upload->data(); 
            $file_name =   base_url().'asset/uploaded_images/'.$upload_data['file_name'];
            $data = array (
                    'patient_photo' => $file_name,
                );
            $update_photo = $this->Clinicsec_model->set_pic($patient_id,$data);
        }
        else {
            echo "File cannot be uploaded";
            $error = array('error' => $this->upload->display_errors()); var_dump($error);
        }
    }

    public function getpic($patient_id) {
        $updatepic = $this->Clinicsec_model->getupdatepic($patient_id);
        echo json_encode($updatepic);
    }

    public function removetoqueue($queue_id) {
        $this->move_data($queue_id);
        $deletequeue = $this->Clinicsec_model->removemetoqueue($queue_id);
        echo json_encode($deletequeue);
    }

    public function myhistdet($check_up_id) {
        $selecthist = $this->Clinicsec_model->hist_patient($check_up_id);
        $selecthist_diagnosis = $this->Clinicsec_model->hist_patient_diagnosis($check_up_id);
        
        $checkup_details = array (
                'selecthist' => $selecthist,
                'selecthist_diagnosis' => $selecthist_diagnosis
        );
        echo json_encode($checkup_details);
    }

    public function checkingUpdates($clinicID, $userID) {
        $myupdate = $this->Clinicsec_model->alwaysCheck($clinicID, $userID);
        echo json_encode($myupdate);
    }

    private function move_data($queue_id) {
        $deltime = date("Y-m-d H:i:s");
        $removeID = $this->genRemoveID();
        $data = array();
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $getqueuedata = $this->Clinicsec_model->queue_data($queue_id,$user);

       $data = array (
       'remove_id' => $removeID,
       'queue_id' => $getqueuedata[0]->queue_id,
       'user_id' => $user['user_id'],
       'clinic_id' => $getqueuedata[0]->clinic_id,
       'order_num' => $getqueuedata[0]->order_num,
       'patient_id' => $getqueuedata[0]->patient_id,
       'time_deleted' => $deltime
       );
       
       $insert_to_tbl_remove = $this->Clinicsec_model->del_history($data);
    }

    private function genRemoveID() {
        $rid = $this->Clinicsec_model->getRemoveCount();
        $genrId = $rid + 1;
        return $genrId;
    }

    public function queue_reset() {
        $this->session->set_userdata('reset', TRUE);
        $result['msg'] = true;
       echo json_encode($result);
    }
}