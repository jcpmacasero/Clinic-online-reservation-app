<?php

class Sec_chatmodel extends CI_Model {
    var $tbl_patients = 'tbl_patients';
    var $tbl_queue = 'tbl_queue';
    var $user = 'tbl_users';

	public function __construct() {
		parent::__construct();
	}

    public function getassigid($user){
        $query = $this->db->query('SELECT tbl_users.assign_id FROM tbl_users WHERE tbl_users.user_id = "'.$user['user_id'].'" ');
        return $query->row('assign_id');
    }

    public function showdocs($myassignID) {
        $query = $this->db->query('SELECT tbl_assignsec.user_id, tbl_users2.user_fname, tbl_users2.user_mname, tbl_users2.user_lname FROM
                tbl_assignsec INNER JOIN tbl_users ON tbl_users.assign_id = tbl_assignsec.assign_id INNER JOIN tbl_users AS tbl_users2 ON 
                tbl_assignsec.user_id = tbl_users2.user_id WHERE tbl_assignsec.assign_id = "'.$myassignID.'" ');
        return $query->result();
    }

    public function getchatID($user) {
        $query = $this->db->query('SELECT tbl_users.chat_id FROM tbl_users WHERE tbl_users.user_id = "'.$user.'" ');
        return $query->result();
    }

    public function add_chat_message($chat_id, $user_id, $chat_message_content) {
        $query = "INSERT INTO tbl_chatmessages (chat_id, user_id, chat_message_content) VALUES (?, ?, ?)";
        $this->db->query($query, array($chat_id, $user_id, $chat_message_content));
    }

    public function get_chat_messages($chat_id, $last_chat_id = 0) {
        $query = "SELECT tbl_chatmessages.chat_message_id, tbl_chatmessages.user_id, tbl_chatmessages.chat_message_content, DATE_FORMAT(tbl_chatmessages.create_date, '%D of %M %Y at %H:%i:%s') AS create_date,
            tbl_users.user_name, tbl_users.user_photo FROM tbl_users INNER JOIN tbl_chatmessages ON tbl_users.user_id = tbl_chatmessages.user_id
            WHERE tbl_chatmessages.chat_id = ? AND tbl_chatmessages.chat_message_id > ? ORDER BY tbl_chatmessages.chat_message_id ASC ";
        $result = $this->db->query($query, array($chat_id, $last_chat_id));

        return $result;
    }   
}

