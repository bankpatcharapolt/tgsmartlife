<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct() { 
    
        parent::__construct(); 
    }
	public function login_page()
	{	
		$this->load->view('teamsale/login');
	}
    public function regis_page()
	{
		$this->load->view('teamsale/regis');
	}

    public function validate_login()
	{
        $res = array();
        $email = $this->input->post('user');
		$pass = $this->input->post('pass');
        $checkLogin = $this->get_user($email, $pass);
        if($checkLogin){ 
            $this->session->set_userdata('teamsale_login', TRUE); 
            $this->session->set_userdata('teamsale_id', $checkLogin[0]['ref_id']); 
            $this->session->set_userdata('teamsale_email', $checkLogin[0]['email']); 
            $this->session->set_userdata('teamsale_username', $checkLogin[0]['firstname']); 
            
            $res['status'] = true;
            $res['message'] = 'เข้าสู่ระบบ สำเร็จ!';
            $res['data'] = base_url('teamsale/product');
            $res['status_code'] = '000';
        }else{ 
            $res['status'] = false;
            $res['message'] = 'Email หรือ Password ไม่ถูกต้อง';
            $res['data'] = '';
            $res['status_code'] = '001';
        } 

        echo json_encode($res);
	}
    public function get_user($email, $password) {   
        $this->db->select('*');
        $this->db->where('firstname',$email);
        $this->db->where('password',md5($password));
        $this->db->where('type','teamsale');
        $this->db->from('administrator'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
        return $result;
	}

    public function get_email($email) {   
        $this->db->select('*');
        $this->db->where('email',$email);
        //$this->db->where('method','admin');
        $this->db->from('administrator'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
        return $result;
	}
    public function validate_regis()
	{
        $res = array();
        $username = $this->input->post('username');
        $email = $this->input->post('email');
		$pass = $this->input->post('pass');

        $get_email = $this->get_email($email); 
        if($get_email){
            $res['status'] = true;
            $res['message'] = 'Email นี้ถูกใช้งานแล้ว กรุณาลองใหม่อีกครั้ง';
            $res['data'] = '';
            $res['status_code'] = '000';
        }else{
            $data = array( 
                'firstname' => $username, 
                'email' => $email, 
                'password' => md5($pass), 
                // 'method' => 'admin', 
                'type' => 'teamsale', 
                'created' => date("Y-m-d H:m:s"),
                'updated' => date("Y-m-d H:m:s"),
                'active' => 1
            );
            if ($this->db->insert("administrator", $data)) {
                $res['status'] = true;
                $res['message'] = 'บันทึกสำเร็จ';
                $res['data'] = '';
                $res['status_code'] = '000';
                //redirect(base_url('admin')); 
            }else{
                $res['status'] = false;
                $res['message'] = 'บันทึกไม่สำเร็จ กรุณาลองใหม่อีกครั้ง';
                $res['data'] = '';
                $res['status_code'] = '001';
                //redirect(base_url('admin')); 
            }
        }
        echo json_encode($res);
	}
    public function logout()
	{
        $this->session->unset_userdata('teamsale_login'); 
        $this->session->unset_userdata('teamsale_id'); 
        $this->session->unset_userdata('teamsale_email'); 
        $this->session->unset_userdata('teamsale_username');
        $this->session->sess_destroy(); 
        redirect(base_url('teamsale')); 
	}
}
