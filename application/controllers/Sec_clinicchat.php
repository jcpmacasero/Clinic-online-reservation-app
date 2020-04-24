<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sec_clinicchat extends CI_Controller {
	function __construct(){
	 	parent::__construct ();
	 	$this->load->model('admin/User_model');
	 	$this->load->model('sec/Sec_chatmodel');
 	}

 	public function index() {
 		$user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
		$data['profile'] = $this->User_model->user_info($user);
		$myassignID = $this->getassignID($user);
		$data['doctors'] = $this->Sec_chatmodel->showdocs($myassignID); 
		$this->load->view('sec/header.php',$data);
		$this->load->view('sec/secchat_form.php');
		$this->load->view('sec/footer.php');
 	}

    private function getassignID($user) {
        $assignID = $this->Sec_chatmodel->getassigid($user);
        return $assignID;
    }

    public function getChatID($user) {
        $mychatID = $this->Sec_chatmodel->getchatID($user);
        echo json_encode($mychatID);
    }

    public function ajax_add_chat_message() {

        $chat_id = $this->input->post('chat_id');
        $user_id = $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $chat_message_content = $this->input->post('chat_message_content', TRUE);

        $this->Sec_chatmodel->add_chat_message($chat_id, $user_id['user_id'], $chat_message_content);

        echo $this->get_chat_messages($chat_id);
    }

    public function ajax_get_chat_messages() {
        $chat_id = $this->input->post('chat_id');
        echo $this->get_chat_messages($chat_id);
    }

    private function get_chat_messages($chat_id) {

        $last_chat_message_id = (int)$this->session->userdata('last_chat_message_id_' . $chat_id);
        $chat_messages = $this->Sec_chatmodel->get_chat_messages($chat_id, $last_chat_message_id);

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