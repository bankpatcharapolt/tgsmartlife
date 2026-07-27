<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resetpassword_by_email extends CI_Controller {

	private $data = array();

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

		// $this->load->library('session');
		// $this->load->library('email');
		// $this->load->library("pagination");
		
     	//เรียกใช้งาน Class helper     
        $this->load->helper('url'); 
      	$this->load->helper('form');
		$this->load->helper('file'); 
        // Load email library
        $this->load->library('email');
       
   


	
    }
	public function index(){
		$menu['mainmenu'] = 'home';
		$menu['submenu'] = 'home';
		$menu['seo'] = "";
		$access_token = isset($_GET['access_token']) ?$_GET['access_token'] : '' ;
		if(empty($access_token)){
			$this->load->view('desktop/header',$menu);
			$this->load->view('desktop/error_email');
			$this->load->view('desktop/footer');        
		}else{
			// AND `created` >= DATE_SUB(NOW(), INTERVAL 1 DAY)
			$Query = "SELECT *
			FROM `reset_pwd` 
			WHERE `access_token` = '{$access_token}' AND reset_flag = 0
			ORDER BY id DESC  LIMIT 1 ";
			$result = $this->db->query($Query)->result_array();
			if(empty($result)){
				$this->load->view('desktop/header',$menu);
				$this->load->view('desktop/error_email');
				$this->load->view('desktop/footer');   
			}else{
				$this->load->view('desktop/header',$menu);
				$this->load->view('desktop/resetpassword_by_email' ,['data'=>$result]);
				$this->load->view('desktop/footer');    
			}
		}                      
	}



	public function set_new_password(){
		if ($this->input->post()) {
			// ดึงข้อมูลจากฟอร์ม
			$password = $this->input->post('password');
			$user_id=$this->input->post('user_id');
			$user = $this->db->get_where('users', array('id' => $user_id))->row();
           
			// ถ้าพบผู้ใช้งาน
			if ($user) {
                 // ทำการอัพเดทรหัสผ่านใหม่ของผู้ใช้
				$this->db->set('updated', DATE("Y-m-d H:i:s")); // กำหนดรหัสผ่านใหม่
				$this->db->set('password', $password); // กำหนดรหัสผ่านใหม่
				$this->db->where('id', $user_id);
				$res = $this->db->update('users'); // อัพเดทข้อมูลในตาราง users

				// set reset flag
				$this->db->set('reset_flag', 1); // กำหนดรหัสผ่านใหม่
				$this->db->set('updated', DATE("Y-m-d H:i:s")); // กำหนดรหัสผ่านใหม่
				$this->db->where('user_id', $user_id);
				$this->db->update('reset_pwd'); // อัพเดทข้อมูลในตาราง users
			


                if($res){
				    echo json_encode(array('status'=> 'success'));exit();
                }else{
                    echo json_encode(array('status'=> 'fail', 'message'=> 'ไม่สามารถตั้งรหัสผ่านใหม่ได้'));exit();
			
                }
			} else {
				// หากไม่พบผู้ใช้งาน แสดงข้อความผิดพลาด
                echo json_encode(array('status'=> 'fail', 'message'=> 'ไม่สามารถตั้งรหัสผ่านใหม่ได้<br>เนื่องจากไม่พบผู้ใช้งาน'));exit();
			
            }
		}
	}


}