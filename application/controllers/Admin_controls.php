<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controls extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $data['user_type'] = $this->Admin_model->getUserType();  
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/usercreate_form.php');
        $this->load->view('admin/footer.php');
    }

    public function getalldocs($assign_id) {
        $listdocs = $this->Admin_model->getdoctors();
        $data = array();
        foreach ($listdocs as $docs) {
            $row = array();  
            $row[] = $docs->user_fname;
            $row[] = $docs->user_mname;
            $row[] = $docs->user_lname; 
            $myuserID = $this->Admin_model->checkUser($assign_id,$docs->user_id);
                if($myuserID == $docs->user_id) {
                    $row[] = '<input name="user_id[]" value="'.$docs->user_id.'" checked="checked" type="checkbox">';    
                }
                else {
                    $row[] = '<input name="user_id[]" value="'.$docs->user_id.'" type="checkbox">';    
                }
            $data[] = $row;
            }
            
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getallusers() {
        $list = $this->Admin_model->getAdminUsers();
        $data = array();
        foreach ($list as $users) {
            $row = array();  
            $row[] = $users->user_fname;
            $row[] = $users->user_mname;
            $row[] = $users->user_lname;
            $row[] = $users->user_id;
            $row[] = $users->position;
            $row[] = '<button onclick="adminview_profile('."'".$users->user_id."'".');" class="btn btn-danger btn-sm">View Profile</button>';

            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function reg_user(){
         $this->form_validation->set_rules('userFName', 'userFName', 'trim|required',
            array('required' => 'First name is required')
            );

          $this->form_validation->set_rules('userMName', 'userMName', 'trim|required',
            array('required' => 'Middle name is required')
            );

          $this->form_validation->set_rules('userLName', 'userLName', 'trim|required',
            array('required' => 'Last name is required')
            );

          $this->form_validation->set_rules('user_name', 'user_name', 'trim|required|is_unique[tbl_users.user_name]|min_length[5]',
            array('required' => 'Username is required',
                  'is_unique' => 'Username already exist',
                  'min_length' => 'Username minimum length of 5 characters')
            );

          $this->form_validation->set_rules('user_password', 'user_password', 'trim|required|min_length[6]',
            array('required' => 'Password is required',
                  'min_length' => 'Password minimum length of 6 characters')
            );

          $this->form_validation->set_rules('userAddress', 'userAddress', 'trim|required',
            array('required' => 'Address is required')
            );

          $this->form_validation->set_rules('userContact', 'userContact', 'trim|required',
            array('required' => 'Contact # is required')
            );

          $this->form_validation->set_rules('user_bday', 'user_bday', 'trim|required',
            array('required' => 'Birthdate name is required')
            );

          $this->form_validation->set_rules('user_gender', 'user_gender', 'trim|required',
            array('required' => 'Gender is required')
            );

            if ($this->form_validation->run() == TRUE) {
                    $stat = "OK";
                    $user_photo = base_url().'asset/uploaded_images/default-img.png';
                    $newid = $this->generate_userid();
                    $myuser_type = $this->input->post('user_type');
                    $user_pword = md5($this->input->post('user_password'));
                    $today = date("Y-m-d H:i:s");
                    $bdate = $this->input->post('user_bday');
                    $userbday = date("Y-m-d", strtotime($bdate));
                    if($myuser_type == 'ut2') {
                        $mychatID = $this->generate_chatid();
                        $docAssignID = $this->countassignID();

                        $data1 = array (
                        'user_id'   => $newid,
                        'user_fname' => $this->input->post('userFName'),
                        'user_mname' => $this->input->post('userMName'),
                        'user_lname' => $this->input->post('userLName'),
                        'user_gender' => $this->input->post('user_gender'),
                        'user_bdate' => $userbday,
                        'user_address' => $this->input->post('userAddress'),
                        'user_contact_info' => $this->input->post('userContact'),
                        'user_name' => $this->input->post('user_name'),
                        'user_password' => $user_pword,
                        'user_type' => $this->input->post('user_type'),
                        'chat_id' => $mychatID,
                        'user_status' => $stat,
                        'user_photo'  => $user_photo
                         );

                         $data3 = array (
                            'user_id' => $newid,
                            'assign_id' => $docAssignID
                         );

                         $data4 = array (
                            'chat_id' => $mychatID,
                            'chat_topic' => 'wla',
                            'created_by'   => $newid,
                            'create_date' => $today
                         );

                         $insert_tbl_assign = $this->Admin_model->insert_assignID($data3);
                         $insertfrm_tbl_chat = $this->Admin_model->insert_tbl_chat($data4);  
                    }
                    else {
                        $data1 = array (
                        'user_id'   => $newid,
                        'user_fname' => $this->input->post('userFName'),
                        'user_mname' => $this->input->post('userMName'),
                        'user_lname' => $this->input->post('userLName'),
                        'user_gender' => $this->input->post('user_gender'),
                        'user_address' => $this->input->post('userAddress'),
                        'user_contact_info' => $this->input->post('userContact'),
                        'user_name' => $this->input->post('user_name'),
                        'user_password' => $user_pword,
                        'user_type' => $this->input->post('user_type'),
                        'user_status' => $stat,
                        'user_photo'  => $user_photo
                     );    
                    }
                    $result['status'] = true;                     
                    $insert = $this->Admin_model->insert_user($data1);

            }else {
                $result['status'] = false;
                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    private function generate_chatid() {
        $chat_id = $this->Admin_model->checkChatId();
        $new_chat_id = $chat_id + 1;
        return $new_chat_id;
    }
    private function generate_userid() {
        $id = $this->Admin_model->countusers();
        $theid = $id + 1;
        $user = $theid."-".date("Y");
        return $user;
    }

    public function getuser($user_id){
        $info = $this->Admin_model->userdet($user_id);
        echo json_encode($info);
    }

    public function getassign_id($user_id) {
        $myassignID = $this->Admin_model->fetchassignID($user_id);
        echo json_encode($myassignID);
    }
    
    public function assign_to($user_id) {
        $data = array (
            'assign_id' => $this->input->post('assign_id'),
            'user_id' => $user_id
         );
        $insertassign = $this->Admin_model->assignme($data);
    }

    public function removeassign($user_id) {
        $this->Admin_model->removemyassign($user_id);
        
    }

    private function countassignID() {
        $theassignID = $this->Admin_model->getAssignID();
        $finalassignID = $theassignID + 1;
        return $finalassignID;
    }
}