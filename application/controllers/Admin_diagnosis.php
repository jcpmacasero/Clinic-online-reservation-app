<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_diagnosis extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Admin_diagnosis_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/admin_diagnosis_form.php');
        $this->load->view('admin/footer.php');
    }

    public function viewall_diagnosis() {
        $viewall = $this->Admin_diagnosis_model->showall_diagnosis();
        $data = array();
        foreach ($viewall as $diag) {
            $row = array();  
            $row[] = $diag->diagnosis_id;
            $row[] = $diag->diagnosis;
            $row[] = $diag->description;
                if($diag->status == "ACCEPTED") {
                    $row[] = '<p style="color:green;">'.$diag->status.'</p>';
                } else {
                    $row[] = '<p style="color:red;">'.$diag->status.'</p>';  
                }
                
            $row[] = '<button onclick="edit_diagnosis('."'".$diag->diagnosis_id."'".');" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="Edit details" id="btnR2"><i class="fa fa-pencil"></i> &nbsp;&nbsp;<i class="fa fa-user"></i></button>';
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_diagnosis() {
        $this->form_validation->set_rules('diagnosis_in', 'diagnosis_in', 'trim|required',
            array('required' => 'Diagnosis name is required')
            );

        $this->form_validation->set_rules('description_in', 'description_in', 'trim|required',
            array('required' => 'Description is required')
            );

        $this->form_validation->set_rules('status_in', 'status_in', 'trim|required',
            array('required' => 'Status is required')
            );

            if ($this->form_validation->run() == TRUE) {

                    $result['status'] = true;
                    $data = array (
                            'diagnosis' => $this->input->post('diagnosis_in'),
                            'description' => $this->input->post('description_in'),
                            'status' => $this->input->post('status_in')
                    );
                    $insert = $this->Admin_diagnosis_model->insert_diagnosis($data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }

    public function getdiagnosisdetails($diagnosis_id) {
        $diagnosis_details = $this->Admin_diagnosis_model->fetch_diagnosis($diagnosis_id);
        echo json_encode($diagnosis_details);
    }

    public function diagnosis_edit($diagnosis_id) {
        $this->form_validation->set_rules('editdiagnosis', 'editdiagnosis', 'trim|required',
            array('required' => 'Diagnosis is required')
            );

          $this->form_validation->set_rules('editdescription', 'editdescription', 'trim|required',
            array('required' => 'Description is required')
            );

          $this->form_validation->set_rules('editstatus', 'editstatus', 'trim|required',
            array('required' => 'Status is required')
            );

            if ($this->form_validation->run() == TRUE) {

                    $result['status'] = true;
                    $data = array (
                    'diagnosis' => $this->input->post('editdiagnosis'),
                    'description' => $this->input->post('editdescription'),
                    'status' => $this->input->post('editstatus'),
                 );

                $thediagnosis_data = $this->Admin_diagnosis_model->updateDiagnosis(array('diagnosis_id' => $diagnosis_id),$data);

            }else {
                $result['status'] = false;

                $result['message'] = $this->form_validation->error_array();
            }
            echo json_encode($result);
    }
}