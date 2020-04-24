<?php

class Clinic_model extends CI_Model {
	var $table = 'tbl_clinics';
	var $check_up = 'tbl_check_up';
	var $diagnosis = 'tbl_diagnosis';
    var $tbl_queue = 'tbl_queue';
    var $tbl_users = 'tbl_users';
    var $tbl_sec = 'tbl_sec';

	public function __construct() {
		parent::__construct();
	}

	public function savedb($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_allpatients($user,$getClinicID,$lastQueueID) {
		 $query = $this->db->query('SELECT tbl_queue.order_num, tbl_queue.clinic_id,  tbl_patients.patient_id, tbl_patients.patient_fname,
									tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
									tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday,
									tbl_patients.patient_photo, tbl_queue.user_id, tbl_queue.queue_id FROM
									tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id
									INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id where tbl_queue.status = "0" AND tbl_users.user_id ="'.$user['user_id'].'"
                                    AND tbl_queue.clinic_id = "'.$getClinicID.'" AND tbl_queue.order_num > "'.$lastQueueID.'" ORDER BY tbl_queue.queue_id ASC ');
		 return $query->result();
	}

	public function updateStat($where, $data){
        $this->db->update('tbl_queue', $data, $where);
        return $this->db->affected_rows();
    }

    public function updateoldStat($where, $data) {
    	$this->db->update('tbl_queue', $data, $where);
    	return $this->db->affected_rows();
    }

    public function checkupinfo($user,$getClinicID) {
    	$query = $this->db->query('SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,tbl_patients.patient_blood, tbl_patients.patient_address, tbl_patients.patient_contact_info, tbl_patients.patient_sex, tbl_patients.patient_civil_status,
					tbl_patients.patient_age, tbl_patients.patient_bday,
					tbl_patients.patient_photo, tbl_queue.queue_id, tbl_queue.user_id FROM tbl_queue INNER JOIN tbl_patients ON 
					tbl_queue.patient_id = tbl_patients.patient_id	INNER JOIN tbl_users ON tbl_users.user_id = tbl_queue.user_id 
					WHERE tbl_queue.status = 1 AND tbl_queue.user_id="'.$user['user_id'].'" AND tbl_queue.clinic_id = "'.$getClinicID.'" ORDER BY tbl_queue.queue_id LIMIT 1 ');
		return $query->result();
    }
    
    
    public function checkupID() { 
        $query = $this->db->query('SELECT COUNT(tbl_check_up.check_up_id) AS check_up_id FROM tbl_check_up'); 
        return $query->row(); 
    }

    public function queue_stat() {
    	$query = $this->db->query('SELECT tbl_queue.queue_id, tbl_queue.status, tbl_queue.patient_id FROM tbl_queue WHERE tbl_queue.status = 1 ');
    	return $query->result();
    }

    public function finished_check_up($data) {
    	$this->db->insert($this->check_up, $data);
    	return $this->db->affected_rows();
    }

    public function finished_diagnosis($data) {
    	$this->db->insert("tbl_diagnosis_patient", $data);
    	return $this->db->affected_rows();
    }

    public function finished_status($where, $data) {
    	$this->db->update('tbl_queue', $data, $where);
    	return $this->db->affected_rows();
    }

    public function checkingclinic() {
    	$query = $this->db->query(' SELECT clinic_id FROM tbl_clinics ORDER BY clinic_id DESC LIMIT 1');
        return $query->result();
    }

    public function showmy_clinics($user) {
        $query = $this->db->query(' SELECT tbl_clinics.clinic_id, tbl_clinics.clinic_name FROM tbl_clinics INNER JOIN tbl_users ON tbl_users.user_id = tbl_clinics.user_id
                    WHERE tbl_clinics.user_id = "'.$user['user_id'].'" ');
        return $query->result();
    }

    public function selectedClinicStatus($user,$getClinicID) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_status FROM tbl_clinics INNER JOIN tbl_users ON tbl_users.user_id = tbl_clinics.user_id
                    WHERE tbl_clinics.user_id = "'.$user['user_id'].'" AND tbl_clinics.clinic_id = "'.$getClinicID.'" ');
        return $query->result();
    }

    public function updateClinicStatus($where, $data) {
        $this->db->update('tbl_clinics', $data, $where);
        return $this->db->affected_rows();
    }

    public function getallProvince() {
        $query = $this->db->query('SELECT tbl_province.province_id, tbl_province.province_name FROM tbl_province ORDER BY tbl_province.province_name ASC');
        return $query->result();
    }

    public function getcitybyID($province_id) {
        $query = $this->db->query('SELECT tbl_city.city_id,tbl_city.city_name, tbl_city.city_name,tbl_city.province_id FROM tbl_city WHERE province_id = "'.$province_id.'" ');
        return $query->result();
    }

    public function getallmyclinics($user) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_id, tbl_clinics.clinic_logo, tbl_clinics.clinic_address, tbl_clinics.clinic_status, tbl_clinics.clinic_name FROM
                    tbl_clinics INNER JOIN tbl_users ON tbl_clinics.user_id = tbl_users.user_id WHERE tbl_clinics.user_id = "'.$user.'" ');
        return $query->result();
    }

    public function getupdatepic($clinic_id) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_logo FROM tbl_clinics WHERE tbl_clinics.clinic_id = "'.$clinic_id.'" ');
        return $query->result();
    }

    public function getmydetails($clinic_id) {
        $query = $this->db->query('SELECT tbl_clinics.clinic_name, tbl_clinics.clinic_status, tbl_clinics.user_id, tbl_clinics.clinic_address,
                tbl_clinics.city_id FROM tbl_clinics WHERE tbl_clinics.clinic_id = "'.$clinic_id.'" ');
        return $query->result();
    }

    public function set_logo($clinic_id,$data) {
        $this->db->where('clinic_id',$clinic_id);
        $this->db->update('tbl_clinics',$data);
        return $this->db->affected_rows();
    }

    public function province_clinic($city_id) {
        $query = $this->db->query('SELECT tbl_city.city_name, tbl_province.province_name, tbl_province.province_id FROM tbl_city INNER JOIN tbl_province 
            ON tbl_city.province_id = tbl_province.province_id WHERE tbl_city.city_id = "'.$city_id.'" ');
        return $query->result();
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

     public function showall_patients($user) {
        $query = $this->db->query('SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,
                    tbl_patients.patient_address, tbl_patients.patient_contact_info, tbl_patients.patient_sex, tbl_patients.patient_civil_status,
                    tbl_patients.patient_age, tbl_patients.patient_bday, tbl_patients.patient_photo FROM tbl_patients WHERE tbl_patients.creator_id = "'.$user['user_id'].'" ');
        return $query->result();   
    }

    public function insert_patient($data) {
        $this->db->insert('tbl_patients', $data);
        return $this->db->insert_id();
    }

     public function updatepatientinfo($where, $data) {
        $this->db->update('tbl_patients', $data, $where);
        return $this->db->affected_rows();
    }

     public function getmydetailspat($patient_id) {
        $query = $this->db->query('SELECT tbl_patients.patient_id, tbl_patients.patient_fname, tbl_patients.patient_mname, tbl_patients.patient_lname,tbl_patients.patient_blood, tbl_patients.patient_address, tbl_patients.patient_contact_info, tbl_patients.patient_sex, tbl_patients.patient_civil_status,
                    tbl_patients.patient_age, tbl_patients.patient_bday, tbl_patients.patient_photo
                    FROM tbl_patients WHERE patient_id = "'.$patient_id.'" ');
        return $query->result();
    }

    public function patient_id(){
        $query = $this->db->query('SELECT COUNT(tbl_patients.patient_id) FROM tbl_patients');
        return $query->row('COUNT(tbl_patients.patient_id)');
    }

    public function getordernum($clinic_id){
        $query = $this->db->query('SELECT order_num FROM tbl_queue WHERE clinic_id="'.$clinic_id.'" ORDER BY tbl_queue.queue_id DESC LIMIT 1');
        return $query->row('order_num');      
    }

    public function insert_toqueue($data) {
        $this->db->insert($this->tbl_queue, $data);
        return $this->db->insert_id();
    }

    public function get_allpatients_refresh($user,$getClinicID) {
         $query = $this->db->query('SELECT tbl_queue.queue_id, tbl_queue.order_num, tbl_queue.clinic_id,  tbl_patients.patient_id, tbl_patients.patient_fname,
                                    tbl_patients.patient_mname, tbl_patients.patient_lname, tbl_patients.patient_address, tbl_patients.patient_contact_info,
                                    tbl_patients.patient_sex, tbl_patients.patient_civil_status, tbl_patients.patient_age, tbl_patients.patient_bday,
                                    tbl_patients.patient_photo, tbl_queue.user_id FROM
                                    tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id
                                    INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id where tbl_queue.status = "0" AND tbl_users.user_id ="'.$user.'"
                                    AND tbl_queue.clinic_id = "'.$getClinicID.'" ORDER BY tbl_queue.queue_id ASC ');
         return $query->result();
    }

     public function updateClinic($where, $data) {
        $this->db->update('tbl_clinics', $data, $where);
        return $this->db->affected_rows();
    }

    public function gensec_id() {
        $query = $this->db->query('SELECT count(tbl_sec.Sec_id) AS sec_id FROM tbl_sec');
        return $query->row('sec_id');
    }

    public function genuser_id() {
        $query = $this->db->query('SELECT SUBSTRING(tbl_users.user_id,1,1) AS user_id FROM tbl_users ORDER BY user_id desc LIMIT 1');
        return $query->row('user_id');
    }

    public function getAssign_ID($user) {
        $query = $this->db->query('SELECT tbl_assignsec.assign_id FROM tbl_assignsec WHERE user_id = "'.$user['user_id'].'"');
        return $query->row('assign_id');
    }

    public function getChat_ID($user) {
        $query = $this->db->query('SELECT tbl_chat.chat_id FROM tbl_chat WHERE created_by = "'.$user['user_id'].'" ');
        return $query->row('chat_id');
    }

    public function addSecUser($data) {
        $this->db->insert($this->tbl_users, $data);
        return $this->db->insert_id();
    }

    public function addSec($data) {
        $this->db->insert($this->tbl_sec, $data);
        return $this->db->insert_id();
    }

    public function getallmySecretary($user) {
        $query = $this->db->query('SELECT tbl_assignsec.assign_id AS assign_id FROM tbl_assignsec WHERE tbl_assignsec.user_id = "'.$user.'" ');

        $assign_id = $query->row('assign_id');
        $query1 = $this->db->query('SELECT tbl_users.user_id, tbl_users.user_type, tbl_users.user_name, tbl_users.user_password, tbl_users.user_fname, tbl_users.user_mname, tbl_users.user_lname, tbl_users.user_address, tbl_users.user_contact_info, tbl_users.user_photo, tbl_users.user_status, tbl_users.user_gender, tbl_users.user_bdate, tbl_users.assign_id, tbl_users.chat_id FROM tbl_users WHERE tbl_users.user_type = "ut3" AND tbl_users.assign_id = "'.$assign_id.'" ');
        return $query1->result();
    }

    public function getsecprofile($user){
        $query = $this->db->query('SELECT *FROM tbl_users WHERE user_id = "'.$user.'" ');
        return $query->result();
    }

    public function updateSecInfo($where, $data) {
        $this->db->update('tbl_users', $data, $where);
        return $this->db->affected_rows();
    }

    public function removemetoqueue($queue_id) {
        $this->db->where('queue_id', $queue_id);
        $this->db->delete('tbl_queue');
        return $this->db->affected_rows();
    }

    public function alwaysCheck($getClinicID, $user) {
        $query = $this->db->query(' SELECT tbl_queue.queue_id FROM tbl_users INNER JOIN tbl_queue ON tbl_users.user_id = tbl_queue.user_id INNER JOIN tbl_clinics ON tbl_clinics.clinic_id = tbl_queue.clinic_id INNER JOIN tbl_patients ON tbl_queue.patient_id = tbl_patients.patient_id 
                                WHERE tbl_queue.status = "0" AND tbl_users.user_id ="'.$user['user_id'].'" AND tbl_queue.clinic_id = "'.$getClinicID.'" ');
        return $query->result();
    }

    public function check_patient_duplicate($fname,$mname,$lname,$bdate) {
        $query = $this->db->query(' SELECT COUNT(tbl_patients.patient_fname) AS dup FROM tbl_patients WHERE tbl_patients.patient_fname = "' .$fname. '" AND tbl_patients.patient_mname = "' .$mname. '" AND tbl_patients.patient_lname = "'.$lname.'" AND tbl_patients.patient_bday = "'.$bdate.'" ');
         return $query->row('dup');
    }

    public function check_clinic_duplicate($clinic_address,$clinic_name,$user) {
        $query = $this->db->query(' SELECT COUNT(tbl_clinics.clinic_id) as dup FROM tbl_clinics WHERE tbl_clinics.user_id = "'.$user['user_id'].'" 
                AND tbl_clinics.clinic_name = "'.$clinic_name.'" OR tbl_clinics.clinic_address = "'.$clinic_address.'" ');
        return $query->row('dup');
    }

    public function check_sec_duplicate($sec_username,$sec_pword){
        $query = $this->db->query(' SELECT COUNT(tbl_users.user_id) AS dup FROM tbl_users WHERE tbl_users.user_name = "'.$sec_username.'" OR tbl_users.user_password = "'.$sec_pword.'" ');
        return $query->row('dup');
    }

    public function queue_data($queue_id,$user) {
        $query = $this->db->query(' SELECT tbl_queue.user_id, tbl_queue.clinic_id, tbl_queue.order_num, tbl_queue.patient_id, tbl_queue.`status`, tbl_queue.time_sched,
                    tbl_queue.queue_id FROM tbl_queue WHERE tbl_queue.queue_id = "'.$queue_id.'" AND tbl_queue.user_id = "'.$user['user_id'].'" ');
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

    public function set_patientpic($patient_id,$data) {
        $this->db->where('patient_id',$patient_id);
        $this->db->update('tbl_patients',$data);
        return $this->db->affected_rows();
    }

    public function fetch_clinicname($user,$clinic_name) {
        $query = $this->db->query(' SELECT COUNT(tbl_clinics.clinic_id) AS clinic_id FROM tbl_users INNER JOIN tbl_clinics ON tbl_users.user_id = tbl_clinics.user_id 
                WHERE tbl_users.user_id = "'.$user['user_id'].'" AND tbl_clinics.clinic_name = "'.$clinic_name.'" ');
        return $query->row('clinic_id');
    }

    public function fetch_patient($patient_fname,$patient_mname,$patient_lname,$patient_bdate,$user,$patient_gender) {
        $query = $this->db->query(' SELECT COUNT(tbl_patients.patient_id) AS patient_id FROM tbl_patients WHERE tbl_patients.patient_fname = "'.$patient_fname.'" 
                AND tbl_patients.patient_mname = "'.$patient_mname.'" AND tbl_patients.patient_lname = "'.$patient_lname.'" AND tbl_patients.patient_bday = "'.$patient_bdate.'" 
                AND tbl_patients.creator_id = "'.$user['user_id'].'" AND tbl_patients.patient_sex = "'.$patient_gender.'" ');
        return $query->row('patient_id');
    }

    public function showall_diagnosis() {
        $query = $this->db->query(' SELECT tbl_diagnosis.diagnosis_id, tbl_diagnosis.diagnosis, tbl_diagnosis.description FROM tbl_diagnosis WHERE
                tbl_diagnosis.`status` = "ACCEPTED" ');
        return $query->result();
    }

    public function pend_diagnose($data) {
        $this->db->insert('tbl_diagnosis', $data);
        return $this->db->insert_id();   
    }

}

/*
0 - not selected
1 - selected
2 - finished
*/
