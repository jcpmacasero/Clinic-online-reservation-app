<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Myclinic extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('admin/Clinic_model');
        $this->load->library('form_validation');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
        $data['clinic_id'] = $this->Clinic_model->showmy_clinics($user);
        $data['diagnosis_id'] = $this->Clinic_model->showall_diagnosis(); 
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/myclinic_form.php');
		$this->load->view('admin/footer.php');
 	}

 	public function get_patients($getClinicID,$lastQueueID) {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$list = $this->Clinic_model->get_allpatients($user,$getClinicID,$lastQueueID);
 		echo json_encode($list);
 	}

 	public function get_checkup($patient_id,$queue_id) {
 		 $stat = "1";
			$data = array (
				'status' => $stat
			);
 		$patient_data = $this->Clinic_model->updateStat(array('patient_id' => $patient_id, 'queue_id' => $queue_id),$data);
 		echo json_encode($patient_data);
 	}

 	public function checkupinfo($getClinicID) {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$checkup = $this->Clinic_model->checkupinfo($user,$getClinicID);
 		echo json_encode($checkup);	
 	}

 	public function getcheckID() {
 		$checkID = $this->Clinic_model->checkupID();
 		echo json_encode($checkID);	
 	}

 	public function checkstatus() {
 		$statuscheck = $this->Clinic_model->queue_stat();
 		echo json_encode($statuscheck);
 	}

 	public function update_old($patient_id,$queue_id) {
 		$stat = "0";
 			$data = array (
 				'status' => $stat
 			);
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
 		$patient_old_data = $this->Clinic_model->updateoldStat(array('patient_id' => $patient_id, 'user_id' => $user['user_id'], 'queue_id' => $queue_id),$data);
 		echo json_encode($patient_old_data);
 	}

 	public function finish_checkup($patient_id,$queue_id,$checkup_id,$clinic_id) {
        $today = date("Y-m-d H:i:s");
 		$stat = "2";
        $patient_height = $this->input->post('thepatientheight');
        $DB_height = $patient_height . " cm";
        $patient_weight = $this->input->post('thepatientweight');
        $DB_weight = $patient_weight . " kg";

 		$data = array (
		 	'check_up_id' => $checkup_id,
            'queue_id' => $queue_id,
            'clinic_id' => $clinic_id,
            'check_up_date' => $today,
            'note' => $this->input->post('tnote'),
            'complaint' => $this->input->post('tcomplaint'),
            'finding' => $this->input->post('tfindings'),
            'patient_weight' => $DB_weight,
            'patient_height' => $DB_height
		 );
 		
 		$data1 = array( 
 			'status' => $stat
 		 );
        
        $diagnosis = $this->input->post('tdiagnosis');
        for($i = 0;$i < count($diagnosis); $i++) {
            $data3 = array (
                'diagnosis_id' => $diagnosis[$i],
                'check_up_id' => $checkup_id
            );
        $insert1 = $this->Clinic_model->finished_diagnosis($data3);
        }

 		$insert = $this->Clinic_model->finished_check_up($data);
 		$updatefinish = $this->Clinic_model->finished_status(array('patient_id' => $patient_id),$data1);
 		echo json_encode($updatefinish);
 	}

 	private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('clinic_address') == '') {
            $data['inputerror'][] = 'clinic_address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('clinic_status') == '') {
            $data['inputerror'][] = 'clinic_status';
            $data['error_string'][] = 'Clinic Status is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function genpatient_id() {
        $patient_id = $this->Clinic_model->patient_id();
        $generatepatient_id = $patient_id + 1;
        return $generatepatient_id; 
    }

    public function myclinic_stat($getClinicID) {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $selectStatus = $this->Clinic_model->selectedClinicStatus($user,$getClinicID);
        echo json_encode($selectStatus);
    }

    public function updateClinicStat($getClinicID){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data = array (
            'clinic_status' => $this->input->post('clinic_status'),
            );
        $updatedClinicStat = $this->Clinic_model->updateClinicStatus(array('clinic_id' => $getClinicID, 'user_id' =>$user['user_id']),$data);
        echo json_encode($updatedClinicStat);
    }

    public function check_uphistory($patient_id) {
        $viewall = $this->Clinic_model->showall_checkups($patient_id);
        $data = array();
        foreach ($viewall as $patient) {
            $row = array();  
            $row[] = $patient->check_up_id;
            $row[] = date("m-d-Y H:i:s", strtotime($patient->check_up_date));
            $row[] = '<button onclick="checkupdetails('."'".$patient->check_up_id."'".');" class="btn btn-success btn-xs"> Show details </button>';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function myhistdet($check_up_id) {
        $selecthist = $this->Clinic_model->hist_patient($check_up_id);
        $selecthist_diagnosis = $this->Clinic_model->hist_patient_diagnosis($check_up_id);

        $checkup_details = array (
                'selecthist' => $selecthist,
                'selecthist_diagnosis' => $selecthist_diagnosis
            );
        echo json_encode($checkup_details);
    }

    public function viewall_patients() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $viewall = $this->Clinic_model->showall_patients($user);
        $data = array();
        foreach ($viewall as $patient) {
            $row = array();  
            $row[] = $patient->patient_id;
            $row[] = $patient->patient_fname;
            $row[] = $patient->patient_lname;
            $row[] = $patient->patient_mname;
            $row[] = $patient->patient_sex;
            $row[] = '<button onclick="addtoqueue('."'".$patient->patient_id."'".');" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Add to queue" id="btnR"><i class="fa fa-plus"></i> &nbsp;<i class="fa fa-users"></i></button>
                      <button onclick="checkstatus1('."'".$patient->patient_id."'".');" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Check history" id="btnR1"><i class="fa fa-history"></i> &nbsp;<i class="fa fa-user"></i> </button>
                      <button onclick="editpatient('."'".$patient->patient_id."'".');" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="Edit details" id="btnR2"><i class="fa fa-pencil"></i> &nbsp;&nbsp;<i class="fa fa-user"></i></button>';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function addpatient() {

         $this->form_validation->set_rules('pafname', 'pafname', 'trim|required|callback_check_patient',
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
                    $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
                    $curryear = date("Y");
                    $patient_age = $curryear - date('Y', strtotime($patient_bday));

                    $data = array (
                        'patient_id' => $mypatiendid,
                        'patient_fname' => $this->input->post('pafname'),
                        'patient_mname' => $this->input->post('pamname'),
                        'patient_lname' => $this->input->post('palname'),
                        'patient_address' => $this->input->post('paaddress'),
                        'patient_contact_info' => $this->input->post('pacontact'),
                        'patient_bday' => $DB_date,
                        'patient_age' => $patient_age,
                        'patient_blood' => $this->input->post('bloodtype'),
                        'patient_sex' => $this->input->post('psex'),
                        'patient_civil_status' => $this->input->post('pmartialstat'),
                        'patient_photo' => $file_name,
                        'creator_id' => $user['user_id'],
                    );
                    $insert = $this->Clinic_model->insert_patient($data);
                    $result['status'] = TRUE;
                }
                else {
                    $file_name = base_url().'asset/uploaded_images/default-img.png';                     
                    $mypatiendid = $this->genpatient_id();
                    $patient_bday = $this->input->post('pabdate');
                    $DB_date = date('Y-m-d', strtotime($patient_bday));
                    $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
                    $curryear = date("Y");
                    $patient_age = $curryear - date('Y', strtotime($patient_bday));                    

                    $data = array (
                        'patient_id' => $mypatiendid,
                        'patient_fname' => $this->input->post('pafname'),
                        'patient_mname' => $this->input->post('pamname'),
                        'patient_lname' => $this->input->post('palname'),
                        'patient_address' => $this->input->post('paaddress'),
                        'patient_contact_info' => $this->input->post('pacontact'),
                        'patient_bday' => $DB_date,
                        'patient_age' => $patient_age,
                        'patient_blood' => $this->input->post('bloodtype'),
                        'patient_sex' => $this->input->post('psex'),
                        'patient_civil_status' => $this->input->post('pmartialstat'),
                        'patient_photo' => $file_name,
                        'creator_id' => $user['user_id'],
                    );
                    $insert = $this->Clinic_model->insert_patient($data);
                    $result['status'] = TRUE;
                }
                
        }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
        }
        echo json_encode($result);
    }

    public function check_patient($patient_fname){
       $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       $patient_mname = $this->input->post('pamname');
       $patient_lname = $this->input->post('palname');
       $bdatepost = $this->input->post('pabdate');
       $patient_gender = $this->input->post('psex');
       $patient_bdate = date('Y-m-d', strtotime($bdatepost));

       $checking_patient = $this->Clinic_model->fetch_patient($patient_fname,$patient_mname,$patient_lname,$patient_bdate,$user,$patient_gender);
       if ($checking_patient > 0) {
          $this->form_validation->set_message('check_patient', 'Patient already exist');
          return FALSE;
       }
       else {
          return TRUE;
       }    
    }

    public function editmypatient($patient_id) {
         $this->form_validation->set_rules('paeditfname', 'paeditfname', 'trim|required|callback_check_patient',
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

                $thepatient_data = $this->Clinic_model->updatepatientinfo(array('patient_id' => $patient_id),$data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

     public function profile_picture() {
        $patient_id = $this->input->post('patient_id_hide');
        $config['upload_path'] = './asset/uploaded_images/patients/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024 * 12;
        $this->load->library('upload', $config);
        if($this->upload->do_upload("file")) {
            $upload_data = $this->upload->data(); 
            $file_name =   base_url().'asset/uploaded_images/patients/'.$upload_data['file_name'];
            $data = array (
                    'patient_photo' => $file_name,
                );
            $update_photo = $this->Clinic_model->set_patientpic($patient_id,$data);
            echo json_encode($update_photo);
        }
        else {
            echo "File cannot be uploaded";
            $error = array('error' => $this->upload->display_errors()); var_dump($error);
        }
    }

    public function getmydetails($patient_id) {
        $mydet = $this->Clinic_model->getmydetailspat($patient_id);
        echo json_encode($mydet);
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
    $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);

     $data = array (
        'order_num' => $myorderNUM,
        'clinic_id' => $clinic_id,
        'patient_id' => $this->input->post('patient_id'),
        'user_id' => $user['user_id'],
        'status' => $firstStat,
        );

     $insert = $this->Clinic_model->insert_toqueue($data);
     echo json_encode(array("status" => TRUE));
    }

    private function get_ordernum($clinic_id){
        $ordernum = $this->Clinic_model->getordernum($clinic_id);
        $generateordernum = $ordernum + 1;
        return $generateordernum;
    }

    public function get_patients_refresh($getClinicID) {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Clinic_model->get_allpatients_refresh($user['user_id'],$getClinicID);
        echo json_encode($list);
    }

    public function removetoqueue($queue_id) {
        $this->move_data($queue_id);
        $deletequeue = $this->Clinic_model->removemetoqueue($queue_id);
        echo json_encode($deletequeue);
    }

    private function move_data($queue_id) {
        $deltime = date("Y-m-d H:i:s");
        $removeID = $this->genRemoveID();
        $data = array();
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $getqueuedata = $this->Clinic_model->queue_data($queue_id,$user);

       $data = array (
       'remove_id' => $removeID,
       'queue_id' => $getqueuedata[0]->queue_id,
       'user_id' => $user['user_id'],
       'clinic_id' => $getqueuedata[0]->clinic_id,
       'order_num' => $getqueuedata[0]->order_num,
       'patient_id' => $getqueuedata[0]->patient_id,
       'time_deleted' => $deltime
       );
       
       $insert_to_tbl_remove = $this->Clinic_model->del_history($data);
    }

    public function checkingUpdates($clinicID) {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $myupdate = $this->Clinic_model->alwaysCheck($clinicID, $user);
        echo json_encode($myupdate);
    }

    private function genRemoveID() {
        $rid = $this->Clinic_model->getRemoveCount();
        $genrId = $rid + 1;
        return $genrId;
    }

    public function add_doc_diagnosis() {
        $dbsavestat = "PENDING";

        $this->form_validation->set_rules('docdiag', 'docdiag', 'trim|required',
            array('required' => 'Diagnosis is required')
            );

        $this->form_validation->set_rules('doc_desc', 'doc_desc', 'trim|required',
            array('required' => 'Description is required')
            );

        if ($this->form_validation->run() == TRUE) {
                    $result['status'] = true;
                    $data = array (
                    'diagnosis' => $this->input->post('docdiag'),
                    'description' => $this->input->post('doc_desc'),
                    'status' => $dbsavestat
                    );

            $pending_diag = $this->Clinic_model->pend_diagnose($data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    public function queue_reset() {
        $this->session->set_userdata('reset', TRUE);
        $result['msg'] = true;
       echo json_encode($result);
    }
}