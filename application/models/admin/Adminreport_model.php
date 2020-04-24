 <?php 

class Adminreport_model extends CI_Model {
	var $user = 'tbl_users';
	var $assign = 'tbl_assignsec';

	public function __construct() {
		parent::__construct();
	}

	public function getreportDataDaily($user,$date) {
		$query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname,
				DATE_FORMAT(tbl_check_up.check_up_date,"%d/%m/%Y %h:%i %p") AS check_up_date, tbl_check_up.check_up_id, tbl_clinics.clinic_name, COALESCE(tbl_bill.bill_amt,0) AS bill_amt FROM tbl_patients
				INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
				INNER JOIN tbl_clinics ON tbl_check_up.clinic_id = tbl_clinics.clinic_id LEFT OUTER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id
				WHERE tbl_queue.user_id = "'.$user['user_id'].'" AND tbl_check_up.check_up_date like "%'.$date.'%" ORDER BY check_up_date ASC ');
		return $query->result();
	}

	public function getallDoctors() {
		$query = $this->db->query(' SELECT tbl_users.user_id, tbl_users.user_fname, tbl_users.user_mname, tbl_users.user_lname FROM tbl_users INNER JOIN tbl_user_type 
			ON tbl_users.user_type = tbl_user_type.user_type WHERE tbl_user_type.user_type = "ut2" ');
		return $query->result();
	}

	public function getreportDataCustom($user,$dateStart,$dateEnd) {
		$query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname,
				DATE_FORMAT(tbl_check_up.check_up_date,"%d/%m/%Y %h:%i %p") AS check_up_date, tbl_check_up.check_up_id, tbl_clinics.clinic_name,
				DATE_FORMAT(tbl_check_up.check_up_date,"%d/%m/%Y") AS datefetch, tbl_bill.bill_amt FROM tbl_patients
				INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
				INNER JOIN tbl_clinics ON tbl_check_up.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id
				WHERE tbl_queue.user_id = "'.$user.'" AND (tbl_check_up.check_up_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'") ORDER BY check_up_date ASC ');
		return $query->result();
	}

	public function data_table_summary($user){
		$query = $this->db->query(' SELECT tbl_clinics.clinic_name, Count(tbl_check_up.check_up_id) AS totalpatient, COALESCE(SUM(tbl_bill.bill_amt),0) AS totalearn,
				tbl_clinics.clinic_id FROM tbl_clinics LEFT OUTER JOIN tbl_check_up ON tbl_clinics.clinic_id = tbl_check_up.clinic_id
				LEFT OUTER JOIN tbl_bill ON tbl_bill.bill_id = tbl_check_up.bill_id WHERE tbl_clinics.user_id = "'.$user['user_id'].'" GROUP BY tbl_clinics.clinic_name ');
		return $query->result();
	}

	public function fetchmyclinic($user,$clinic_id,$fromdate,$todate) {
		$query = $this->db->query(' SELECT COALESCE(tbl_bill.bill_amt,0) AS bill_amt, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_check_up.check_up_id,
					DATE_FORMAT(tbl_check_up.check_up_date,"%m-%d-%Y %h:%i %p") AS check_up_date, tbl_bill.receipt_no FROM tbl_clinics
					INNER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
					LEFT OUTER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
					WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_clinics.clinic_id = "'.$clinic_id.'" AND (tbl_check_up.check_up_date BETWEEN "'.$fromdate.'" AND "'.$todate.'") ORDER BY check_up_date ASC ');
		return $query->result();
	}

	public function fetchmyclinicdaily($user,$clinic_id,$datepicked) {
		$query = $this->db->query(' SELECT COALESCE(tbl_bill.bill_amt,0) AS bill_amt, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_check_up.check_up_id,
					DATE_FORMAT(tbl_check_up.check_up_date,"%m-%d-%Y %h:%i %p") AS check_up_date, tbl_bill.receipt_no FROM tbl_clinics
					INNER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
					LEFT OUTER JOIN tbl_bill ON tbl_check_up.bill_id = tbl_bill.bill_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
					WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_clinics.clinic_id = "'.$clinic_id.'" AND DATE(tbl_check_up.check_up_date) = "'.$datepicked.'" ORDER BY check_up_date ASC ');
		return $query->result();
	}

	public function getpiedata($user) {
		$query = $this->db->query(' SELECT tbl_clinics.clinic_name, COALESCE(COUNT(tbl_check_up.check_up_id),0) AS total_checked_up FROM tbl_clinics
					LEFT OUTER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id LEFT OUTER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
					WHERE tbl_clinics.user_id = "'.$user['user_id'].'" GROUP BY tbl_clinics.clinic_name ');
		return $query->result();
	}

	public function getmybardata($user,$month,$year) {
		$query = $this->db->query(' SELECT tbl_clinics.clinic_name, Count(tbl_check_up.check_up_id) AS total_check FROM tbl_clinics LEFT JOIN tbl_check_up
              		ON tbl_clinics.clinic_id = tbl_check_up.clinic_id WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND Month(tbl_check_up.check_up_date) = "'.$month.'"
					AND Year(tbl_check_up.check_up_date) = "'.$year.'" GROUP  BY tbl_clinics.clinic_name ');
		return $query->result();
	}

	public function getmybardata_date($user,$date) {
		$query = $this->db->query('SELECT DATE_FORMAT(tbl_check_up.check_up_date,"%M") AS datemonths FROM tbl_clinics INNER JOIN tbl_queue ON tbl_clinics.clinic_id = tbl_queue.clinic_id
					INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND YEAR(tbl_check_up.check_up_date) = "'.$date.'" 
					GROUP BY DATE_FORMAT(tbl_check_up.check_up_date,"%M") ORDER BY tbl_check_up.check_up_date ASC');
		return $query->result();
	}

	public function getSeriesClinics($user) {
		$query = $this->db->query('SELECT tbl_clinics.clinic_name, tbl_clinics.clinic_id FROM tbl_clinics WHERE tbl_clinics.user_id = "'.$user['user_id'].'" ');
		return $query->result();
	}

	public function getthisClinic($year,$month,$clinic_id,$user) {
		$query = $this->db->query('SELECT tbl_clinics.clinic_name, Count(tbl_check_up.check_up_id) AS total_check FROM tbl_clinics INNER JOIN tbl_check_up
              		ON tbl_clinics.clinic_id = tbl_check_up.clinic_id AND tbl_clinics.user_id = "'.$user['user_id'].'" AND Month(tbl_check_up.check_up_date) = "'.$month.'"
					AND Year(tbl_check_up.check_up_date) = "'.$year.'" AND tbl_clinics.clinic_id = "'.$clinic_id.'" ');
		return $query->result();
	}

	public function getDiagName($id) {
		$query = $this->db->query(' SELECT tbl_diagnosis.diagnosis, tbl_diagnosis.diagnosis_id FROM tbl_diagnosis WHERE tbl_diagnosis.diagnosis_id = "'.$id.'" ');
		return $query->result();
	}

	public function getDiagSeriesData($month,$diagnosis_id,$user) {
		$query = $this->db->query(' SELECT Count(tbl_diagnosis_patient.diagnosis_id) AS totdiag FROM tbl_diagnosis_patient INNER JOIN tbl_check_up ON tbl_check_up.check_up_id = tbl_diagnosis_patient.check_up_id
					INNER JOIN tbl_queue ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE 
					tbl_queue.user_id = "'.$user['user_id'].'" AND MONTH(tbl_check_up.check_up_date) = "'.$month.'" AND tbl_diagnosis_patient.diagnosis_id = "'.$diagnosis_id.'" ');
		return $query->result();
	}

}

