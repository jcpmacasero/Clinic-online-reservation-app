<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_billing extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('sec/Secbilling_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
		$myassignID = $this->getassignID($user);
		$data['doctors'] = $this->Secbilling_model->showdocs($myassignID); 
		$this->load->view('sec/header.php',$data);
		$this->load->view('sec/secbilling_form.php');
		$this->load->view('sec/footer.php');
 	}

 	private function getassignID($user) {
        $assignID = $this->Secbilling_model->getassigid($user);
        return $assignID;
    }

    public function getclinics($user) {
        $clinics = $this->Secbilling_model->getclinicsbyuser($user);
        echo json_encode($clinics);
    }

    public function bill_list($clinic_id,$user_id) {
    	$patients = $this->Secbilling_model->patient_bill($clinic_id,$user_id);
        $data = array();
        foreach ($patients as $npatients) {
            $row = array();  
            $row[] = $npatients->check_up_id;
            $row[] = $npatients->patient_fname;
            $row[] = $npatients->patient_lname;
            $row[] = $npatients->patient_mname;
            $row[] = $npatients->clinic_name;
            $row[] = '<button onclick="add_bill_patient('."'".$npatients->check_up_id."'".','."'".$npatients->patient_id."'".');" class="btn btn-primary btn-sm">Add bill</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

public function receipt_det($check_up_id,$bill_patient,$patient_id) {
        $today = date("Y-m-d H:i:s");
        $my_receipt_no = $this->create_receipt_no();
        $receipt = $this->Secbilling_model->getreceipt_det($check_up_id);
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $id = $this->create_bill_ID();
        $bill_id = $user['user_id'] ."-". $id;

        $data = array (
            'bill_id' => $bill_id,
            'patient_id' => $patient_id,
            'bill_amt' => $bill_patient,
            'date_billed' => $today,
            'receipt_no' => $my_receipt_no
            );

        $data1 = array(
         'bill_id'   => $bill_id,
        );

        $output1 = array(   
            "receipt_no" => $my_receipt_no,
            "receipt" => $receipt,
        );

        $insert = $this->Billing_model->save_tbl_bill($data);
        $insert1 = $this->Billing_model->save_bill_checkup($check_up_id,$data1);
        echo json_encode($output1);
    }

 	
    public function rec_details($clinic_id) {
        $receipt = $this->Secbilling_model->receipt($clinic_id);
        echo json_encode($receipt);
    }

    public function details_patient($check_up_id) {
        $patient = $this->Secbilling_model->checkup_patient($check_up_id);
        echo json_encode($patient);
    }

    private function create_bill_ID() {
        $mybill = $this->Secbilling_model->count_bill();
        return $mybill;
    }

    private function create_receipt_no() {
        $p_receipt_no = $this->Secbilling_model->receipt_no();
        return $p_receipt_no;
    }

}