<?php 

class Admin_model extends CI_Model {
	var $user = 'tbl_users';
	var $assign = 'tbl_assignsec';

	public function __construct() {
		parent::__construct();
	}

	public function get_check_up_ID($user) {
		$query = $this->db->query('SELECT tbl_check_up.check_up_id FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
				INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id WHERE tbl_users.user_id = "'.$user['user_id'].'" ORDER BY 
				tbl_check_up.check_up_id DESC LIMIT 1');
		return $query->result();
	}

	public function getAdminUsers(){
		$query = $this->db->query('SELECT tbl_user_type.position, tbl_users.user_id, tbl_users.user_fname, tbl_users.user_lname,
					tbl_users.user_mname FROM tbl_users INNER JOIN tbl_user_type ON tbl_users.user_type = tbl_user_type.user_type WHERE tbl_users.user_type <> "ut1" ');
		return $query->result();
	}

	public function getUserType() {
		$query = $this->db->query('SELECT tbl_user_type.user_type, tbl_user_type.position FROM tbl_user_type WHERE tbl_user_type.user_type <> "ut1" AND tbl_user_type.user_type <> "ut3" ');
		return $query->result();
	}

	public function countusers() {
		$query = $this->db->query('SELECT SUBSTRING(tbl_users.user_id,1,1) AS user_id FROM tbl_users ORDER BY user_id desc LIMIT 1');
		return $query->row('user_id');
	}

	public function insert_user($data) {
    	$this->db->insert($this->user, $data);
    	return $this->db->insert_id();
    }
    public function userdet($user){
    	$query = $this->db->query('SELECT *from tbl_users where user_id = "'.$user.'" ');
    	return $query->result();
    }
    public function visitors(){
    	$query = $this->db->query('SELECT tbl_oauth.oauth_provider, tbl_oauth.first_name, tbl_oauth.last_name, tbl_oauth.email,
						tbl_oauth.picture FROM tbl_oauth ');
    	return $query->result();
    }

    public function getdoctors(){
    	$query = $this->db->query('SELECT tbl_users.user_id, tbl_users.user_fname, tbl_users.user_mname, tbl_users.user_lname FROM tbl_users WHERE tbl_users.user_type = "ut2" ');
    	return $query->result();
    }

    public function fetchassignID($user_id) {
    	$query = $this->db->query('SELECT tbl_users.assign_id FROM tbl_users WHERE tbl_users.user_id = "'.$user_id.'" ');
    	return $query->result();
    }

    public function assignme($data) {
		$this->db->insert($this->assign, $data);
		return $this->db->insert_id();
	}

	public function removemyassign($id){
		$this->db->where('user_id', $id);
		$this->db->delete('tbl_assignsec');
		return $this->db->affected_rows();
	}

	public function checkUser($assign_id,$user_id) {
		$query = $this->db->query('SELECT tbl_assignsec.user_id FROM tbl_assignsec WHERE tbl_assignsec.assign_id = "'.$assign_id.'" AND tbl_assignsec.user_id = "'.$user_id.'" ');
		return $query->row('user_id');
	}

	public function checkChatId() {
		$query = $this->db->query(' SELECT COUNT(tbl_chat.chat_id) AS chat_id FROM tbl_chat ');
		return $query->row('chat_id');
	}

	public function getAssignID() {
		$query = $this->db->query(' SELECT COUNT(tbl_assignsec.assign_id) AS assign_id FROM tbl_assignsec ');
		return $query->row('assign_id');
	}

	public function insert_assignID($data) {
		$this->db->insert('tbl_assignsec', $data);
		return $this->db->insert_id();
	}

	public function insert_tbl_chat($data) {
		$this->db->insert('tbl_chat', $data);
		return $this->db->insert_id();
	}

}

