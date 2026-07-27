<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword extends CI_Controller {

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
	
		$data = [
			
		];
		// $this->data['province'] = $this->m_travel->getProvince();
		// $this->data['province'] = $this->m_travel->getProvince();
		// $this->data['province'] = $this->m_travel->getProvince();
		// echo '<PRE>';print_r($this->data);exit();

		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/resetpassword' ,$data);
		$this->load->view('desktop/footer');                          
	}


    public function reset_by_email() {
		// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
		if ($this->input->post()) {
			// ดึงข้อมูลจากฟอร์ม
			$email = $this->input->post('email');
			$user = $this->db->get_where('users', array('email' => $email))->row();
           
			// ถ้าพบผู้ใช้งาน
			if ($user) {
                $token = bin2hex(random_bytes(16));
                $data =  array('user_id' => $user->id,
				    'access_token'=>$token,
				);
				$this->db->insert('reset_pwd', $data);


                $res = $this->generate_email($email , $token  , $user->fullname);
                if($res){
				    echo json_encode(array('status'=> 'success'));exit();
                }else{
                    echo json_encode(array('status'=> 'fail', 'message'=> 'ไม่สามารถส่งอีเมล์ได้'));exit();
			
                }
			} else {
				// หากไม่พบผู้ใช้งาน แสดงข้อความผิดพลาด
                echo json_encode(array('status'=> 'fail', 'message'=> 'กรุณาตรวจสอบอีเมล์ของท่านอีกครั้ง<br>เนื่องจากไม่พบอีเมล์ดังกล่าวในระบบ'));exit();
			
            }
		}
	
	}


    public function generate_email($email = null , $access_token = null , $fullname){
         $config =  $this->config->item('email');
         $mail_body = $this->load->view('desktop/reset_email', array('email'=>$email ,'access_token'=>$access_token , 'fullname'=>$fullname), TRUE);
         $config['mailtype'] = 'html';
         $this->email->initialize($config);
         
         
          // Email parameters
          $this->email->from('smtp_tgsmartlife@tgsmartlife.com', 'tgsmartlife.com');
          $this->email->reply_to('no-reply@tgsmartlife.com', 'No-Reply');
          $this->email->to($email); // อีเมล์ผู้รับ
          $this->email->subject('คำร้องขอเปลี่ยนรหัสผ่านใหม่ (tgsmartlife.com)');
          $this->email->message($mail_body);

		  // Add embedded image
		//   $image_cid = 'header_image';
		//   $image_path = 'http://uat.tgsmartlife.com/assete/icons/header_mail.png';
		//   $this->email->attach($image_path, 'inline', null, null, $image_cid);
      
          // Send email
          if($this->email->send()) {
              return true;
          } else {
              return false;
          }

    }
	
	

}