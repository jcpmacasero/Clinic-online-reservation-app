<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('admin/Billing_model');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user); 
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/billing_form.php');
		$this->load->view('admin/footer.php');
 	}
 	
 	// public function bill_id() {
 	// 	$id = $this->create_bill_ID();
 	// 	$checkid = $this->checkBill_id();
 	// 	$bill_id = $id ."-". $checkid;
 	// 	$check_up_id = $this->input->post('check_up_id');

 	// 	$data = array (
 	// 		'bill_id'	=> $bill_id,
		//  	'bill_amt' => $this->input->post('bill_amt'),
		//  	'patient_id'	=> $this->input->post('patient_id'),
		//  	'date_billed'	=> $this->input->post('date_save'),
		//  );
 	// 	$data1 = array(
 	// 		'bill_id'	=> $bill_id,
 	// 	 );
 	// 	$insert = $this->Billing_model->save_tbl_bill($data);
 	// 	$insert1 = $this->Billing_model->save_bill_checkup($check_up_id,$data1);
 	// 	echo json_encode($insert1);	
 	// }

 	public function receipt_det($check_up_id,$bill_patient,$patient_id) {
 		$today = date("Y-m-d H:i:s");
 		$my_receipt_no = $this->create_receipt_no();
 		$receipt = $this->Billing_model->getreceipt_det($check_up_id);
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

 	public function bill_list() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $patients_no_bill = $this->Billing_model->getall_finished_check_up_w_o_bill($user);
        $data = array();

        foreach ($patients_no_bill as $npatients) {
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

    public function or_printed() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $patients_or = $this->Billing_model->reprinting_or($user);
        $data = array();

        foreach ($patients_or as $patients_bill) {
            $row = array();  
            $row[] = $patients_bill->receipt_no;
            $row[] = $patients_bill->bill_amt;
            $row[] = $patients_bill->check_up_id;
            $row[] = $patients_bill->patient_fname;
            $row[] = $patients_bill->patient_lname;
            $row[] = $patients_bill->patient_mname;
            $row[] = '<button onclick="reprint_bill('."'".$patients_bill->check_up_id."'".','."'".$patients_bill->patient_id."'".');" class="btn btn-primary btn-sm">Re-print</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function reprint_details($patient_id,$check_up_id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $details_or = $this->Billing_model->getmyOR_details($patient_id,$check_up_id,$user);
        echo json_encode($details_or);
    }

 	private function create_bill_ID() {
 		$mybill = $this->Billing_model->count_bill();
 		return $mybill;
 	}
    
 	private function create_receipt_no() {
 		$p_receipt_no = $this->Billing_model->receipt_no();
 		return $p_receipt_no;
 	}

}