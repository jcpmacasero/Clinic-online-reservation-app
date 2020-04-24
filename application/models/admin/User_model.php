<?php 

class User_model extends CI_Model {
	function user_info($user_id) {
		$query = $this->db->query('SELECT * FROM tbl_users,tbl_user_type where user_id = "'.$user_id['user_id'].'" AND tbl_users.user_type = tbl_user_type.user_type  ');
		return $query->row();
	}
	
	function countdiagnose($user,$datenow) {
		$query = $this->db->query('SELECT COUNT(tbl_check_up.check_up_id) FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
				INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id WHERE tbl_users.user_id="'.$user['user_id'].'" AND
				tbl_check_up.check_up_date="'.$datenow.'"');
		return $query->result();
	}

	function countdiagnoseSec($user) {
		$month = date('m');
		$year = date('Y');

		$query = $this->db->query('SELECT tbl_users.assign_id FROM tbl_users WHERE tbl_users.user_id = "'.$user['user_id'].'"');
		$assign_id = $query->row('assign_id');
		$query1 = $this->db->query('SELECT tbl_assignsec.user_id FROM tbl_assignsec WHERE tbl_assignsec.assign_id = "'.$assign_id.'" ');
		$qUser_id = $query1->row('user_id');
		$query2 = $this->db->query('SELECT COALESCE(COUNT(tbl_bill.bill_id),0) AS diagnose FROM tbl_clinics INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id
			INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id WHERE  tbl_clinics.user_id = "'.$qUser_id.'" AND Month(date_billed) = "'.$month.'" AND Year(date_billed) = "'.$year.'" ');
		return $query2->result();
	}

	function countqueueSec($user) {
		$query = $this->db->query('SELECT tbl_users.assign_id FROM tbl_users WHERE tbl_users.user_id = "'.$user['user_id'].'"');
		$assign_id = $query->row('assign_id');
		$query1 = $this->db->query('SELECT tbl_assignsec.user_id FROM tbl_assignsec WHERE tbl_assignsec.assign_id = "'.$assign_id.'" ');
		$qUser_id = $query1->row('user_id');
		$query2 = $this->db->query('SELECT COUNT(tbl_queue.queue_id) FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
					INNER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id WHERE tbl_users.user_id="'.$qUser_id.'" 
					AND tbl_queue.status = 0 ');
		return $query2->result();
	}

	function countqueue($user) {
		$query = $this->db->query('SELECT COUNT(tbl_queue.queue_id) FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
					INNER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id WHERE tbl_users.user_id="'.$user['user_id'].'" 
					AND tbl_queue.status = 0 ');
		return $query->result();
	}

	function totalEarnNow($user,$datenow){
		$query = $this->db->query(' SELECT SUM(tbl_bill.bill_amt) FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id
					INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id
					WHERE tbl_users.user_id="'.$user['user_id'].'" AND tbl_check_up.check_up_date="'.$datenow.'" ');
		return $query->result();
	}

	function myQueueSummary($user) {
		$query = $this->db->query(' SELECT tbl_clinics.clinic_name,COALESCE(COUNT(tbl_queue.queue_id),0) AS clinic_count FROM tbl_queue RIGHT OUTER JOIN tbl_clinics 
					ON tbl_clinics.clinic_id=tbl_queue.clinic_id  WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_queue.status = 0 GROUP BY tbl_clinics.clinic_name ');
		return $query->result();
	}

	function myFeeSummary($user) {
		$month = date('m');
		$year = date('Y');

		$query = $this->db->query(' SELECT c.clinic_name, COALESCE(SUM(b.bill_amt), 0) AS clinic_tot FROM tbl_clinics c LEFT OUTER JOIN tbl_check_up cu ON c.clinic_id = cu.clinic_id LEFT OUTER JOIN tbl_bill b ON cu.bill_id = b.bill_id AND MONTH(b.date_billed) = "'.$month.'" AND YEAR(b.date_billed) = "'.$year.'" WHERE c.user_id = "'.$user['user_id'].'" GROUP BY c.clinic_name ');
		return $query->result();
	}

	function myTotalEarn($user) {
		$month = date('m');
		$year = date('Y');

		$query = $this->db->query(' SELECT COALESCE(COUNT(tbl_bill.bill_id),0) AS total_earn FROM tbl_clinics INNER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id
			INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id WHERE  tbl_clinics.user_id = "'.$user['user_id'].'" AND Month(date_billed) = "'.$month.'" AND Year(date_billed) = "'.$year.'" ');
		return $query->result();
	}

}