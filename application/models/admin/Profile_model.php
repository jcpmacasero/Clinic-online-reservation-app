<?php

class Profile_model extends CI_Model {
	var $table = 'tbl_clinics';
	var $check_up = 'tbl_check_up';
	var $diagnosis = 'tbl_diagnosis';

	public function __construct() {
		parent::__construct();
	}

	public function myprofile($user) {
		$query = $this->db->query('SELECT tbl_users.user_fname, tbl_users.user_mname, tbl_users.user_lname, tbl_users.user_address, tbl_users.user_contact_info
					FROM tbl_users WHERE user_id = "'.$user['user_id'].'" ');
		return $query->result();
	}

	public function editpersonalprofile($user,$data) {
		$this->db->where('user_id',$user['user_id']);
		$this->db->update('tbl_users',$data);
		return $this->db->affected_rows();
	}

	public function set_profilepic($user,$data) {
		$this->db->where('user_id',$user['user_id']);
		$this->db->update('tbl_users',$data);
		return $this->db->affected_rows();
	}

	function fetch_pwrod($userid){
    	$query = $this->db->query('SELECT user_password FROM  tbl_users where user_id = "'.$userid['user_id'].'" ');
    	return $query->row();
    }

    function update_pword($user_id,$newPword) {
        $updateData = array('user_password' => $newPword );
        $this->db->where("user_id",$user_id['user_id']);
        $this->db->update("tbl_users",$updateData);
    }

}


