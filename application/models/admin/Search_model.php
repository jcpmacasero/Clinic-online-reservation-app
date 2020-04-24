<?php

class Search_model extends CI_Model {
	var $table = 'tbl_clinics';
	var $check_up = 'tbl_check_up';
	var $diagnosis = 'tbl_diagnosis';

	public function __construct() {
		parent::__construct();
	}

    public function searchby_all($user) {
        $query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname, tbl_check_up.check_up_date, tbl_check_up.check_up_id FROM tbl_patients INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE tbl_queue.user_id = "'.$user['user_id'].'"  ORDER BY patient_id ASC ');
        return $query->result();
    }

    
    public function searchby_fname($user,$fname) {
        $query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname, tbl_check_up.check_up_date, tbl_check_up.check_up_id FROM tbl_patients INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE tbl_queue.user_id = "'.$user['user_id'].'" AND  tbl_patients.patient_fname = "'.$fname.'" ORDER BY patient_id ASC ');
        return $query->result();
    }

    public function searchby_check_up_id($user,$check_up_id) {
        $query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname, tbl_check_up.check_up_date, tbl_check_up.check_up_id FROM tbl_patients INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE tbl_queue.user_id = "'.$user['user_id'].'" AND  tbl_check_up.check_up_id = "'.$check_up_id.'" ORDER BY patient_id ASC ');
        return $query->result();
    }

    public function searchby_show_all($user) {
        $query = $this->db->query('SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_lname, tbl_patients.patient_mname, tbl_check_up.check_up_date, tbl_check_up.check_up_id FROM tbl_patients INNER JOIN tbl_queue ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id WHERE tbl_queue.user_id = "'.$user['user_id'].'" ORDER BY patient_id ASC');
        return $query->result();
    }

    public function view_profile_btn($user,$check_up_id,$check_up_date) {
        $query = $this->db->query(' SELECT tbl_patients.patient_blood,tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
                tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday, tbl_patients.patient_photo,
                tbl_check_up.note, tbl_check_up.patient_weight, tbl_check_up.patient_height, tbl_check_up.check_up_id, tbl_check_up.complaint,
                tbl_check_up.check_up_date, tbl_check_up.finding FROM tbl_check_up INNER JOIN tbl_queue ON tbl_queue.queue_id = tbl_check_up.queue_id
                INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id WHERE tbl_queue.user_id = "'.$user['user_id'].'" 
                AND tbl_check_up.check_up_id = "'.$check_up_id.'" AND tbl_check_up.check_up_date = "'.$check_up_date.'" LIMIT 1 ');
        return $query->result();
    }

    public function view_diagnosis($check_up_id) {
        $query = $this->db->query(' SELECT tbl_diagnosis.diagnosis FROM tbl_diagnosis INNER JOIN tbl_diagnosis_patient ON tbl_diagnosis_patient.diagnosis_id = tbl_diagnosis.diagnosis_id
                WHERE tbl_diagnosis_patient.check_up_id = "'.$check_up_id.'" ');
        return $query->result();

    }

    public function getall_clinic_details($user,$check_up_id) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_address, tbl_clinics.clinic_name, tbl_users.user_fname, tbl_users.user_mname, tbl_users.user_lname,
                tbl_clinics.clinic_logo, tbl_city.city_name, tbl_province.province_name, tbl_city.zip_code FROM tbl_clinics INNER JOIN tbl_users ON tbl_users.user_id = tbl_clinics.user_id
                INNER JOIN tbl_check_up ON tbl_check_up.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id
                INNER JOIN tbl_province ON tbl_city.province_id = tbl_province.province_id WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_check_up.check_up_id = "'.$check_up_id.'" ');
        return $query->result();
    }
}

    /*SELECT
tbl_clinics.clinic_address,
tbl_clinics.clinic_name,
tbl_users.user_fname,
tbl_users.user_mname,
tbl_users.user_lname,
tbl_clinics.clinic_logo,
tbl_city.city_name,
tbl_province.province_name
FROM tbl_clinics INNER JOIN tbl_users ON tbl_users.user_id = tbl_clinics.user_id
                INNER JOIN tbl_check_up ON tbl_check_up.clinic_id = tbl_clinics.clinic_id INNER JOIN tbl_city ON tbl_clinics.city_id = tbl_city.city_id
                INNER JOIN tbl_province ON tbl_city.province_id = tbl_province.province_id
WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_check_up.check_up_id = "'.$check_up_id.'"


}

/*
0 - not selected
1 - selected
2 - finished
*/