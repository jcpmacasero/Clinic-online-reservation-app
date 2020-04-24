<?php 

class Admin_diagnosis_model extends CI_Model {
	var $user = 'tbl_users';
	var $assign = 'tbl_assignsec';

	public function __construct() {
		parent::__construct();
	}

	public function showall_diagnosis() {
		$query = $this->db->query(' SELECT tbl_diagnosis.diagnosis_id, tbl_diagnosis.diagnosis, tbl_diagnosis.description, tbl_diagnosis.`status` FROM
					tbl_diagnosis ORDER BY tbl_diagnosis.`status` ASC');
		return $query->result();
	}

	public function insert_diagnosis($data) {
		$this->db->insert('tbl_diagnosis', $data);
		return $this->db->insert_id();
	}

	public function fetch_diagnosis($diagnosis_id) {
		$query = $this->db->query(' SELECT tbl_diagnosis.diagnosis_id, tbl_diagnosis.diagnosis, tbl_diagnosis.description, tbl_diagnosis.`status`
				FROM tbl_diagnosis WHERE tbl_diagnosis.diagnosis_id = "'.$diagnosis_id.'" ');
		return $query->result();
	}

	public function updateDiagnosis($where, $data) {
		$this->db->update('tbl_diagnosis', $data, $where);
        return $this->db->affected_rows();
	}

}

