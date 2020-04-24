<?php 

class Billing_model extends CI_Model {
	var $tbl_bill = 'tbl_bill';
	var $tbl_check_up = 'tbl_check_up';

	public function __construct() {
		parent::__construct();
	}

	public function get_check_up_ID($user) {
		$query = $this->db->query('SELECT tbl_check_up.check_up_id FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
				INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id WHERE tbl_users.user_id = "'.$user['user_id'].'" ORDER BY 
				tbl_check_up.check_up_id DESC LIMIT 1');
		return $query->row('check_up_id');
	}
	public function count_bill(){
		$query = $this->db->query('SELECT COUNT(bill_id) + 1 AS bill_id from tbl_bill');
		return $query->row('bill_id');
	}

	public function getall_finished_check_up_w_o_bill($user) {
		$query = $this->db->query(' SELECT tbl_queue.queue_id, tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,
						tbl_check_up.check_up_id, tbl_clinics.clinic_name FROM tbl_queue INNER JOIN tbl_users ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON 
						tbl_queue.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
						INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id AND tbl_queue.clinic_id = tbl_check_up.clinic_id
						WHERE tbl_queue.status="2" AND tbl_check_up.bill_id IS NULL AND tbl_users.user_id = "'.$user['user_id'].'" ORDER BY
						tbl_queue.order_num ASC ');
		return $query->result();
	}

	public function reprinting_or($user) {
		$query = $this->db->query(' SELECT tbl_queue.queue_id, tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,
					tbl_check_up.check_up_id, tbl_clinics.clinic_name, tbl_clinics.clinic_id, tbl_bill.receipt_no, tbl_bill.bill_amt FROM tbl_queue
					INNER JOIN tbl_users ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_queue.clinic_id = tbl_clinics.clinic_id
					INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id AND tbl_queue.clinic_id = tbl_check_up.clinic_id
					INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id WHERE tbl_queue.status="2" AND tbl_check_up.bill_id IS NOT NULL AND tbl_users.user_id = "'.$user['user_id'].'" 
					ORDER BY tbl_queue.order_num ASC ');
		return $query->result();
	}

	public function save_tbl_bill($data) {
		$this->db->insert($this->tbl_bill, $data);
		return $this->db->insert_id();
	}

	public function save_bill_checkup($check_up_id,$data) {
		$this->db->where('check_up_id', $check_up_id);
		$this->db->update('tbl_check_up',$data);
	}

	public function getreceipt_det($check_up_id) {
		$query = $this->db->query(' SELECT tbl_clinics.clinic_name, tbl_clinics.clinic_address, tbl_city.city_name, tbl_province.province_name, tbl_city.zip_code,
					tbl_clinics.clinic_logo, tbl_patients.patient_fname, tbl_patients.patient_lname FROM tbl_check_up INNER JOIN tbl_queue ON tbl_check_up.queue_id = tbl_queue.queue_id
					INNER JOIN tbl_clinics ON tbl_queue.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id
					INNER JOIN tbl_province ON tbl_city.province_id = tbl_province.province_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
					WHERE tbl_check_up.check_up_id = "'.$check_up_id.'" ');
		return $query->result();
	}

	public function receipt_no() {
		$query = $this->db->query('SELECT COUNT(tbl_bill.bill_id) + 1 AS receipt_no FROM tbl_bill');
		return $query->row('receipt_no');
	}

	public function getmyOR_details($patient_id,$check_up_id,$user) {
		$query = $this->db->query(' SELECT tbl_bill.receipt_no, tbl_clinics.clinic_name, tbl_clinics.clinic_logo, tbl_clinics.clinic_address, tbl_city.city_name, tbl_city.zip_code,
					tbl_province.province_name, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_bill.bill_amt FROM
					tbl_queue INNER JOIN tbl_users ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_queue.clinic_id = tbl_clinics.clinic_id
					INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id AND tbl_queue.clinic_id = tbl_check_up.clinic_id
					INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id
					INNER JOIN tbl_province ON tbl_province.province_id = tbl_city.province_id WHERE tbl_queue.status="2" AND tbl_check_up.bill_id IS NOT NULL AND tbl_users.user_id = "'.$user['user_id'].'" AND tbl_check_up.check_up_id = "'.$check_up_id.'" AND tbl_patients.patient_id = "'.$patient_id.'"
					ORDER BY tbl_queue.order_num ASC ');
		return $query->result();
	}

}

