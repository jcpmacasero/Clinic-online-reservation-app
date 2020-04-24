<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic_chat extends CI_Controller {
    function __construct(){
        parent::__construct ();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Chat_model');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['profile'] = $this->User_model->user_info($user);
        $data['chat_id'] = 1;
        $this->session->set_userdata('last_chat_message_id_' . $data['chat_id'], 0);
        $this->load->view('admin/header.php',$data);
        $this->load->view('admin/chat_form.php');
        $this->load->view('admin/footer.php');
    }

    public function ajax_add_chat_message() {

        $chat_id = $this->input->post('chat_id');
        $user_id = $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $chat_message_content = $this->input->post('chat_message_content', TRUE);

        $this->Chat_model->add_chat_message($chat_id, $user_id['user_id'], $chat_message_content);

        echo $this->get_chat_messages($chat_id);
    }

    public function ajax_get_chat_messages() {
        $chat_id = $this->input->post('chat_id');
        echo $this->get_chat_messages($chat_id);
    }

    private function get_chat_messages($chat_id) {

        $last_chat_message_id = (int)$this->session->userdata('last_chat_message_id_' . $chat_id);
        $chat_messages = $this->Chat_model->get_chat_messages($chat_id, $last_chat_message_id);

        if($chat_messages->num_rows() > 0) {
            //store last message ID
            $last_chat_message_id = $chat_messages->row($chat_messages->num_rows() - 1)->chat_message_id;
            $this->session->set_userdata('last_chat_message_id_' . $chat_id, $last_chat_message_id);

            $chat_messages_html = '<ul class="chat">';
                foreach($chat_messages->result() as $chat_message) {
                    $chat_messages_html .= '<li class="left clearfix">' . '<span class="chat-img pull-left">' . '<img src="'.$chat_message->user_photo.'" alt="User Avatar" class="imgchat-picture" />' . ' </span>'
                        .'<div class="chat-body clearfix">'
                            .'<div class="header">'.'<strong class="primary-font">'.$chat_message->user_name.'</strong>'.'<small class="timechat text-muted">'.'<span class="glyphicon glyphicon-time">'.'</span>'.$chat_message->create_date.'</small>'.'</div>'
                            .'<p>'
                            .$chat_message->chat_message_content.
                            '</p>'.
                        '</div>'. 
                        '</li>';
                }    

            $chat_messages_html .= '</ul>';
            $result = array('status' => 'ok', 'content' => $chat_messages_html);
            return json_encode($result);
            exit();
        }
        else {
            $result = array('status' => 'ok', 'content' => '');
            return json_encode($result);
            exit();
        }

    }



}