<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
public $user=null;
	function __construct() {
		parent::__construct();
		ob_start();
        $this->load->model('auth/User_model');
        $this->load->library('facebook/src/facebook', array('appId' => '1027885817316593', 'secret' => '6db175699897b514bf4881955b2944bb'));
	    $this->user = $this->facebook->getUser();
        $this->load->library('Googleplus');
    }

	public function index() {
        if ($this->user) {
            $data['user_profile'] = $this->facebook->api('/me?fields=id,first_name,last_name,email,link,gender,locale,picture');
            $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'Authentication/logout'));
            $this->session->set_userdata('logged_in', $data['user_profile']);
            //$data['user2'] = array('user_id' => $this->session->userdata['logged_in']['first_name']);
            
            $datame['user_profile'] = array(
                'oauth_provider' => 'Facebook',
                'oauth_uid'     => $this->session->userdata['logged_in']['id'],
                'first_name'    => $this->session->userdata['logged_in']['first_name'],
                'last_name'     => $this->session->userdata['logged_in']['last_name'],
                'email'         => $this->session->userdata['logged_in']['email'],
                'gender'        => $this->session->userdata['logged_in']['gender'],
                'locale'        => $this->session->userdata['logged_in']['locale'],
                'picture'       => $this->session->userdata['logged_in']['picture']['data']['url'],
                'link'          => $this->session->userdata['logged_in']['link']
            );

            $userData = $this->User_model->checkUser2($datame['user_profile']);

            $this->load->view('admin/profile.php', $data);
        } 
        else {
            $data['login_url'] = $this->facebook->getLoginUrl();
            $this->load->view('auth/login_form.php', $data);
       }
        
	}

	public function validate_credentials() {
		 $this->load->model('auth/Login_model');
		 $pp= $this->input->post('password');
         $pword = md5($pp);
		 $data = array(
            'username' => $this->input->post('username'),
            'password' => $pword
         );

         $res = $this->Login_model->validate($data);
         if(empty($res)) {
            $this->index(); 
         }
        else if($res[0]->user_type == 'ut1' && $res[0]->user_status == 'OK' ) {
        	 $session_data = array (
                'user_name' => $res[0]->user_name,
                'user_id' => $res[0]->user_id,
                'position' => $res[0]->position,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo
                );
            $this->session->set_userdata('logged_in', $session_data);
            $today = date("Y-m-d H:i:s");
            $logdata = array (
                'user_id' => $res[0]->user_id,
                'login_date' => $today,
                ); 
            $login_date = $this->Login_model->login_hist($logdata);
            redirect('Clinic_chat');
        }
         else if($res[0]->user_type == 'ut2' && $res[0]->user_status == 'OK' ) {
        	 $session_data = array (
                'user_name' => $res[0]->user_name,
                'user_id' => $res[0]->user_id,
                'position' => $res[0]->position,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo
                );
            $this->session->set_userdata('logged_in', $session_data); 
            $today = date("Y-m-d H:i:s");
            $logdata = array (
                'user_id' => $res[0]->user_id,
                'login_date' => $today,
                ); 
            $login_date = $this->Login_model->login_hist($logdata);
            redirect('Dashboard_admin');
        }
        else if($res[0]->user_type == 'ut3' && $res[0]->user_status == 'OK' ){
            $session_data = array (
                'user_name' => $res[0]->user_name,
                'user_id' => $res[0]->user_id,
                'position' => $res[0]->position,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo
                );
            $this->session->set_userdata('logged_in', $session_data); 
            $today = date("Y-m-d H:i:s");
            $logdata = array (
                'user_id' => $res[0]->user_id,
                'login_date' => $today,
                ); 
            $login_date = $this->Login_model->login_hist($logdata);
            redirect('Dashboard_sec');
        }
	}

    public function logout(){
            $this->load->model('auth/login_model');
            $today = date("Y-m-d H:i:s");
            $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
            $logdata = array (
                'logout_date' => $today,
                ); 
            $logout_date = $this->login_model->logout_hist(array('user_id' => $user['user_id']),$logdata);
            $this->load->driver('cache');
            $sess_array = array(
            'username' => '' );
            $this->session->unset_userdata('logged_in', $sess_array);
            $this->session->sess_destroy();
            $this->cache->clean();
            redirect('authentication', 'refresh');
            ob_clean();
    }
    
    // public function logout(){
    //         unset($_SESSION['logged_in']);
    //         //$facebook->destroySession();
    //         $this->load->model('auth/Login_model');
    //         $today = date("Y-m-d H:i:s");
    //         $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
    //         $logdata = array (
    //             'logout_date' => $today,
    //             ); 
    //         $logout_date = $this->Login_model->logout_hist(array('user_id' => $user['user_id']),$logdata);
    //         $this->load->driver('cache');
    //         $sess_array = array(
    //         'username' => '' );
    //         $this->session->unset_userdata('logged_in', $sess_array);
    //         $this->session->sess_destroy();
    //         $this->cache->clean();
    //         redirect(base_url(), 'refresh');
    //         ob_clean();
    // }

    // public function facebook_request(){
    //     $datame = null;
    //     $this->load->library('facebook/src/facebook', array('appId' => '1027885817316593', 'secret' => '6db175699897b514bf4881955b2944bb'));
    //     $this->user = $this->facebook->getUser();
    //     if ($this->user) {
    //         $datafb['user_profile']  = $this->facebook->api('/me?fields=id,first_name,last_name,email,link,gender,locale,picture');
    //         $this->load->view('admin/profile.php', $datafb);
    //     } 
    //     else {
    //         // Store users facebook login url
    //         $data['login_url'] = $this->facebook->getLoginUrl();
    //         $this->load->view('auth/login_form.php', $data);
    //     }
    // }

    // public function googleplus_request() {
    //     $CLIENT_ID = '499889319917-surco9a9k9osddjunbs6c8efaka6s7om.apps.googleusercontent.com';
    //     $CLIENT_SECRET = '7Ns2SIPhIrVzEQxHZ-2ZQwQi';
    //     $APPLICATION_NAME = 'Klinik App';

    //     $client = new Google_Client();
    //     $client->setApplicationName($APPLICATION_NAME);
    //     $client->setClientId($CLIENT_ID);
    //     $client->setClientSecret($CLIENT_SECRET);
    //     $client->setRedirectUri('http://localhost/clinic/');
    //     $client->setScopes('email');

    //     $plus = new Google_Service_Plus($client);

    //     // if(isset($_REQUEST['logout'])) {
    //     //     session_unset();
    //     // }
    //     if(isset($_GET['code'])) {
    //         $client->authenticate($_GET['code']);
    //         $_SESSION['access_token'] = $client->getAccessToken();
    //     }

    //     if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    //         $client->setAccessToken($_SESSION['access_token']);
    //         $me = $plus->people->get('me');
    //         echo '<pre>';
    //         print_r($me);
    //     }
    //     else {
    //         $authUrl = $client->createAuthUrl();
    //         echo '<a href="'.$authUrl.'"> Login with google </a>';
    //     }
    // }
}
