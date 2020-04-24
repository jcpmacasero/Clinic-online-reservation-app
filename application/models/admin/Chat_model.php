<?php 

class Chat_model extends CI_Model {
	var $user = 'tbl_users';

	public function __construct() {
		parent::__construct();
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