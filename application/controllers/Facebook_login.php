<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once FCPATH . "vendor/autoload.php";
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Facebook_login extends CI_Controller {

    protected $ci;
    protected $facebook;
    public $facebook_app_id = null;
    function __construct() { 
    
        parent::__construct(); 
        $this->load->config('facebook');
        
        $config = [ 
            'app_id'                => $this->config->item('facebook_app_id'), 
            'app_secret'            => $this->config->item('facebook_app_secret'), 
            'default_graph_version' => $this->config->item('facebook_graph_version') 
        ]; 
        $this->facebook = new Facebook($config);
    
    }
    
    function Update_user_data($data, $id)
    {
        $this->db->where('login_oauth_uid_facebook', $id);
        $this->db->update('users', $data);
    }

    function Insert_user_data($data)
    {
        $this->db->insert('users', $data);
    }
    public function index() {

        $helper = $this->facebook->getRedirectLoginHelper();
   
        // session_destroy();
        // print_r($_SESSION);exit();
        // Check if state is already generated, otherwise generate new state
        $state = isset($_SESSION['facebook_state']) ? $_SESSION['facebook_state'] : bin2hex(random_bytes(16));
        
        // Save the state to session
       $_SESSION['facebook_state'] = $state;

      
        if(isset($_GET['code'])){
            try {   
               
                $accessToken = $helper->getAccessToken();
               
                $user = $this->callback($accessToken);
               
                $result = $this->Is_already_register($user['id']);
                $this->onaction_update_or_insert($result , $state ,$user);
            } catch(FacebookResponseException $e) {
                // When Facebook returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }        
        }
     
        try {
            
            $loginUrl = $helper->getLoginUrl(base_url('facebook_login/callback'), ['email']  );
            redirect($loginUrl);
            
        } catch(FacebookResponseException $e) {
            // When Facebook returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
    
    public function onaction_update_or_insert($result , $state , $user){
        if($result) {
            $user_data = array(
                'fullname'  => $user['name'],
                'email'  => $user['email'],
                'updated' => DATE("Y-m-d H:i:s")
            );

            $this->Update_user_data($user_data, $user['id']);           
            $this->session->set_userdata('user_id', $result[0]->id);
            $this->session->set_userdata('username', $result[0]->username);
            $this->session->set_userdata('email', $result[0]->email);
            $this->session->set_userdata('facebook_state', $state);
            redirect(base_url('')); 
        } else {
            $user_data = array(
                'login_oauth_uid_facebook' => $user['id'],
                'username'=>$user['email'],
                'fullname'  => $user['name'],
                'email'  => $user['email'],
                'password'=>md5($user['email']),
                'created'  => DATE("Y-m-d H:i:s")
            );

            $this->Insert_user_data($user_data);
            $this->session->set_userdata('user_id', $this->db->insert_id());
            $this->session->set_userdata('username', $user['email']);
            $this->session->set_userdata('email', $user['email']);
            $this->session->set_userdata('facebook_state', $state);
            redirect(base_url('')); 
        }
    }
    public function callbackWhenLoginSuccess($accessToken){
        $response = $this->facebook->get('/me?fields=id,name,email', $accessToken);
        $state = isset($_SESSION['facebook_state']) ? $_SESSION['facebook_state'] : bin2hex(random_bytes(16));
        
        $user = $response->getGraphUser();
        $result = $this->Is_already_register($user['id']);
        $this->onaction_update_or_insert($result , $state , $user);
    }
    public function callback($accessToken = null){
        if($_GET['code']){
            $helper = $this->facebook->getRedirectLoginHelper();
            $accessToken = $helper->getAccessToken();
            $this->callbackWhenLoginSuccess($accessToken);
        }
        if(!empty($accessToken)){
           
            $response = $this->facebook->get('/me?fields=id,name,email', $accessToken);
            
            $user = $response->getGraphUser();
          
            return $user;
        }else{
            redirect(base_url('login'));
        }
    }
    public function   Is_already_register($id)
    {
        $this->db->where('login_oauth_uid_facebook', $id); 
        $query = $this->db->get('users');
        $result = ($query->num_rows() > 0)?$query->result():FALSE; 
      
        if ($query->num_rows() > 0) {
           
            return $result;
        } else {
            return false;
        }
    }
}
