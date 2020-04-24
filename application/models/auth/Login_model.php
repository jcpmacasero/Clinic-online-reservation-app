<?php

class Login_model extends CI_Model {
	var $table = 'tbl_login_details';

	public function __construct() {
		parent::__construct();
	}
	
	function validate($data) {
		$condition = "tbl_users.user_type = tbl_user_type.user_type AND " . "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'" ;
		$this->db->select('*');
		$this->db->from('tbl_users,tbl_user_type');
		$this->db->where($condition);
		$query = $this->db->get();
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return NULL;
		}
	}

	function login_hist($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	function logout_hist($where,$data) {
		$this->db->update('tbl_login_details', $data, $where);
    	return $this->db->affected_rows();
	}

}
?>
