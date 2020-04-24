<?php 

class Admin_delete_history_model extends CI_Model {
	var $user = 'tbl_users';
	var $assign = 'tbl_assignsec';

	public function __construct() {
		parent::__construct();
	}

	public function get_deleted_patients() {
		$query = $this->db->query(' SELECT tbl_removequeue.user_id, tbl_removequeue.patient_id, tbl_removequeue.time_deleted, tbl_patients.patient_fname,
					tbl_patients.patient_lname, tbl_clinics.clinic_name FROM tbl_removequeue INNER JOIN tbl_patients ON tbl_removequeue.patient_id = tbl_patients.patient_id
					INNER JOIN tbl_clinics ON tbl_removequeue.clinic_id = tbl_clinics.clinic_id ');
		return $query->result();
	}


}

