<?php 

class Adminreportearnings_model extends CI_Model {
	var $user = 'tbl_users';
	var $assign = 'tbl_assignsec';

	public function __construct() {
		parent::__construct();
	}

	public function getreportDataDaily($user,$date) {
	$query = $this->db->query(' SELECT tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_check_up.check_up_id,
				tbl_bill.bill_amt, tbl_bill.receipt_no FROM tbl_patients INNER JOIN tbl_queue ON tbl_queue.patient_id = tbl_patients.patient_id
				INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id ');
	return $query->result();
	}
}

