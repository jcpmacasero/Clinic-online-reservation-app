<?php

class Clinicsec_model extends CI_Model {
    var $tbl_patients = 'tbl_patients';
    var $tbl_queue = 'tbl_queue';

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

    public function get_allpatients($user,$getClinicID,$lastQueueID) {
         $query = $this->db->query('SELECT tbl_queue.queue_id, tbl_queue.order_num, tbl_queue.clinic_id,  tbl_patients.patient_id, tbl_patients.patient_fname,
                                    tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
                                    tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday,
                                    tbl_patients.patient_photo, tbl_queue.user_id FROM
                                    tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id
                                    INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id where tbl_queue.status = "0" AND tbl_users.user_id ="'.$user.'"
                                    AND tbl_queue.clinic_id = "'.$getClinicID.'" AND tbl_queue.order_num > "'.$lastQueueID.'" ORDER BY tbl_queue.queue_id ASC');
         return $query->result();
    }

    public function get_allpatients_refresh($user,$getClinicID) {
         $query = $this->db->query('SELECT tbl_queue.queue_id, tbl_queue.order_num, tbl_queue.clinic_id,  tbl_patients.patient_id, tbl_patients.patient_fname,
                                    tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
                                    tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday,
                                    tbl_patients.patient_photo, tbl_queue.user_id FROM
                                    tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id
                                    INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id where tbl_queue.status = "0" AND tbl_users.user_id ="'.$user.'"
                                    AND tbl_queue.clinic_id = "'.$getClinicID.'" ORDER BY tbl_queue.queue_id ASC');
         return $query->result();
    }

    public function selectedClinicStatus($user,$getClinicID) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_status FROM tbl_clinics INNER JOIN tbl_users ON tbl_users.user_id = tbl_clinics.user_id
                    WHERE tbl_clinics.user_id = "'.$user.'" AND tbl_clinics.clinic_id = "'.$getClinicID.'" ');
        return $query->result();
    }

    public function updateClinicStatus($where, $data) {
        $this->db->update('tbl_clinics', $data, $where);
        return $this->db->affected_rows();
    }

    public function getpatientid() {
        $query = $this->db->query('SELECT COUNT(tbl_patients.patient_id) FROM tbl_patients');
        return $query->row('COUNT(tbl_patients.patient_id)');
    }

    public function insert_patient($data) {
        $this->db->insert($this->tbl_patients, $data);
        return $this->db->insert_id();
    }

    public function showall_patients($user_id) {
        $query = $this->db->query('SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,
                    tbl_patients.patient_address, tbl_patients.patient_contact_info, tbl_patients.patient_sex, tbl_patients.patient_civil_status,
                    tbl_patients.patient_age, tbl_patients.patient_bday, tbl_patients.patient_photo
                    FROM tbl_patients WHERE tbl_patients.creator_id = "'.$user_id.'" ');
        return $query->result();   
    }

    public function queue_id(){
        $query = $this->db->query('SELECT MAX(tbl_queue.queue_id) AS queue_id FROM tbl_queue');
        return $query->row('queue_id');   
    }

    public function getordernum($clinic_id){
        $query = $this->db->query('SELECT order_num FROM tbl_queue WHERE clinic_id="'.$clinic_id.'" ORDER BY tbl_queue.queue_id DESC LIMIT 1');
        return $query->row('order_num');   
    }

    public function insert_toqueue($data) {
        $this->db->insert($this->tbl_queue, $data);
        return $this->db->insert_id();
    }

    public function getmydetails($patient_id) {
        $query = $this->db->query(' SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,tbl_patients.patient_blood,
                    tbl_patients.patient_address, tbl_patients.patient_contact_info, tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age,
                    tbl_patients.patient_bday, tbl_patients.patient_photo FROM tbl_patients WHERE patient_id = "'.$patient_id.'" ');
        return $query->result();
    }

    public function set_pic($patient_id,$data) {
        $this->db->where('patient_id',$patient_id);
        $this->db->update('tbl_patients',$data);
        return $this->db->affected_rows();
    }

    public function getupdatepic($patient_id) {
        $query = $this->db->query('SELECT tbl_patients.patient_photo FROM tbl_patients WHERE tbl_patients.patient_id = "'.$patient_id.'" ');
        return $query->result();
    }

    public function removemetoqueue($queue_id) {
        $this->db->where('queue_id', $queue_id);
        $this->db->delete('tbl_queue');
        return $this->db->affected_rows();
    }

    public function showall_checkups($patient_id) {
        $query = $this->db->query('SELECT tbl_check_up.check_up_id, tbl_check_up.check_up_date FROM tbl_patients INNER JOIN tbl_queue 
            ON tbl_patients.patient_id = tbl_queue.patient_id INNER JOIN tbl_check_up ON tbl_queue.queue_id = tbl_check_up.queue_id
            WHERE tbl_queue.patient_id = "'.$patient_id.'" ');
        return $query->result();
    }

    public function hist_patient($check_up_id) {
        $query = $this->db->query(' SELECT tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
                tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday, tbl_patients.patient_photo,
                tbl_check_up.note, tbl_check_up.patient_weight, tbl_check_up.patient_height, tbl_check_up.check_up_id, tbl_check_up.complaint,tbl_patients.patient_blood,
                tbl_check_up.check_up_date, tbl_check_up.finding FROM tbl_check_up INNER JOIN tbl_queue ON tbl_queue.queue_id = tbl_check_up.queue_id
                INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id WHERE tbl_check_up.check_up_id = "'.$check_up_id.'" ');
        return $query->result();
    }

    public function hist_patient_diagnosis($check_up_id) {
        $query = $this->db->query(' SELECT tbl_diagnosis.diagnosis FROM tbl_diagnosis INNER JOIN tbl_diagnosis_patient ON tbl_diagnosis_patient.diagnosis_id = tbl_diagnosis.diagnosis_id
                WHERE tbl_diagnosis_patient.check_up_id = "'.$check_up_id.'" ');
        return $query->result();
    }

    public function alwaysCheck($getClinicID, $user) {
        $query = $this->db->query(' SELECT tbl_queue.queue_id FROM tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id 
                                WHERE tbl_queue.status = "0" AND tbl_users.user_id ="'.$user.'" AND tbl_queue.clinic_id = "'.$getClinicID.'" ORDER BY tbl_queue.order_num ASC ');
        return $query->result();
    }

    public function check_patient_duplicate($fname,$mname,$lname,$bdate) {
        $query = $this->db->query(' SELECT COUNT(tbl_patients.patient_fname) AS dup FROM tbl_patients WHERE tbl_patients.patient_fname = "' .$fname. '" AND tbl_patients.patient_mname = "' .$mname. '" AND tbl_patients.patient_lname = "'.$lname.'" AND tbl_patients.patient_bday = "'.$bdate.'" ');
         return $query->row('dup');
    }

    public function queue_data($queue_id) {
        $query = $this->db->query(' SELECT tbl_queue.user_id, tbl_queue.clinic_id, tbl_queue.order_num, tbl_queue.patient_id, tbl_queue.`status`, tbl_queue.time_sched,
                    tbl_queue.queue_id FROM tbl_queue WHERE tbl_queue.queue_id = "'.$queue_id.'" ');
        return $query->result();
    }

    public function getRemoveCount() {
        $query = $this->db->query(' SELECT COUNT(tbl_removequeue.remove_id) AS remove_id FROM tbl_removequeue ');
        return $query->row('remove_id');
    }

    public function del_history($data) {
        $this->db->insert('tbl_removequeue', $data);
        return $this->db->insert_id();
    }

    public function fetch_patient($patient_fname,$patient_mname,$patient_lname,$patient_bdate,$user,$patient_gender) {
        $query = $this->db->query(' SELECT COUNT(tbl_patients.patient_id) AS patient_id FROM tbl_patients WHERE tbl_patients.patient_fname = "'.$patient_fname.'" 
                AND tbl_patients.patient_mname = "'.$patient_mname.'" AND tbl_patients.patient_lname = "'.$patient_lname.'" AND tbl_patients.patient_bday = "'.$patient_bdate.'" 
                AND tbl_patients.creator_id = "'.$user.'" AND tbl_patients.patient_sex = "'.$patient_gender.'" ');
        return $query->row('patient_id');
    }

    public function updatepatientinfo($where, $data) {
        $this->db->update('tbl_patients', $data, $where);
        return $this->db->affected_rows();
    }

}


/*
0 - not selected
1 - selected
2 - finished
*/
