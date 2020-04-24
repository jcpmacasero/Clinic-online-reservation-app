<?php 

class Secbilling_model extends CI_Model {
	var $tbl_bill = 'tbl_bill';
	var $tbl_check_up = 'tbl_check_up';

	public function __construct() {
		parent::__construct();
	}

	public function showdocs($myassignID) {
        $query = $this->db->query('SELECT DISTINCT tbl_assignsec.user_id, tbl_users2.user_fname, tbl_users2.user_mname, tbl_users2.user_lname FROM
                tbl_assignsec INNER JOIN tbl_users ON tbl_users.assign_id = tbl_assignsec.assign_id INNER JOIN tbl_users AS tbl_users2 ON 
                tbl_assignsec.user_id = tbl_users2.user_id WHERE tbl_assignsec.assign_id = "'.$myassignID.'" ');
        return $query->result();
    }

    public function getassigid($user){
        $query = $this->db->query('SELECT tbl_users.assign_id FROM tbl_users WHERE tbl_users.user_id = "'.$user['user_id'].'" ');
        return $query->row('assign_id');
    }

    public function getclinicsbyuser($user) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_name, tbl_clinics.clinic_id FROM tbl_users INNER JOIN tbl_clinics 
                ON tbl_users.user_id = tbl_clinics.user_id WHERE tbl_clinics.user_id = "'.$user.'" ');
        return $query->result();
    }

    public function patient_bill($clinic_id,$user_id) {
        $query = $this->db->query(' SELECT tbl_queue.queue_id, tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,
                        tbl_check_up.check_up_id, tbl_clinics.clinic_name FROM tbl_queue INNER JOIN tbl_users ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON 
                        tbl_queue.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
                        INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id AND tbl_queue.clinic_id = tbl_check_up.clinic_id
                        WHERE tbl_queue.status="2" AND tbl_check_up.bill_id IS NULL AND tbl_users.user_id = "'.$user_id.'" AND tbl_queue.clinic_id = "'.$clinic_id.'" ORDER BY
                        tbl_queue.order_num ASC ');
        return $query->result();      
    }

    public function receipt($clinic_id) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_name, tbl_city.city_name, tbl_province.province_name, tbl_province.zip_code, tbl_clinics.clinic_address,
                tbl_clinics.clinic_logo FROM tbl_clinics INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id INNER JOIN tbl_province ON 
                tbl_city.province_id = tbl_province.province_id WHERE tbl_clinics.clinic_id = "'.$clinic_id.'" ');
        return $query->result();
    }

    public function checkup_patient($check_up_id) {
        $query = $this->db->query('SELECT tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname FROM tbl_check_up INNER JOIN tbl_queue 
            ON tbl_queue.queue_id = tbl_check_up.queue_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id WHERE tbl_check_up.check_up_id = "'.$check_up_id.'" ');
        return $query->result();
    }

    public function getreceipt_det($check_up_id) {
        $query = $this->db->query(' SELECT tbl_clinics.clinic_name, tbl_clinics.clinic_address, tbl_city.city_name, tbl_province.province_name, tbl_city.zip_code,
                    tbl_clinics.clinic_logo, tbl_patients.patient_fname, tbl_patients.patient_lname FROM tbl_check_up INNER JOIN tbl_queue ON tbl_check_up.queue_id = tbl_queue.queue_id
                    INNER JOIN tbl_clinics ON tbl_queue.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id
                    INNER JOIN tbl_province ON tbl_city.province_id = tbl_province.province_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id
                    WHERE tbl_check_up.check_up_id = "'.$check_up_id.'" ');
        return $query->result();
    }

    public function count_bill(){
        $query = $this->db->query('SELECT COUNT(bill_id) + 1 AS bill_id from tbl_bill');
        return $query->row('bill_id');
    }

    public function receipt_no() {
        $query = $this->db->query('SELECT COUNT(tbl_bill.bill_id) + 1 AS receipt_no FROM tbl_bill');
        return $query->row('receipt_no');
    }

}

