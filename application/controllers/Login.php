<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
			'province' => $this->get_province(),
			'amphur' => $this->get_amphur()
		];
		// $this->data['province'] = $this->m_travel->getProvince();
		// $this->data['province'] = $this->m_travel->getProvince();
		// $this->data['province'] = $this->m_travel->getProvince();
		// echo '<PRE>';print_r($this->data);exit();

		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/login' ,$data);
		$this->load->view('desktop/footer');                          
	}
	
	public function user_login() {
		// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
		if ($this->input->post()) {
			// ดึงข้อมูลจากฟอร์ม
			$username = $this->input->post('username');
			$password = $this->input->post('password');
	
			// ตรวจสอบในฐานข้อมูลว่ามีผู้ใช้งานที่ตรงกับ username และ password ที่ระบุหรือไม่
			$user = $this->db->get_where('users', array('username' => $username, 'password' => $password ))->row();
	
			// ถ้าพบผู้ใช้งาน
			if ($user) {
				if($user->is_email_verify == 0){
					echo json_encode(array('status'=> 'fail' , 'err_msg' => "กรุณาดำเนินการยืนยันอีเมล({$user->email}) ของท่านเพื่อเข้าใช้งานระบบ หากไม่พบเจออีเมลดังกล่าว กรุณาตรวจสอบที่ junk mail"));exit();
				}

				// สร้าง session สำหรับผู้ใช้งาน
				$this->session->set_userdata('user_id', $user->id);
				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('email', $user->email);
	
				// ส่งกลับไปยังหน้าหลักหรือหน้าที่ต้องการ
				echo json_encode(array('status'=> 'success'));exit();
			} else {
				// หากไม่พบผู้ใช้งาน แสดงข้อความผิดพลาด
				echo json_encode(array('status'=> 'fail' , 'err_msg' => "กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่านของท่านอีกครั้ง"));exit();
			}
		}
	
	}
	
	public function create_user(){
		//echo '5';exit();
		 // รับค่าจากการ POST
		 $name = isset($_POST['name']) ? $_POST['name'] : ""; 
		 $home_no = isset($_POST['home_no']) ? $_POST['home_no'] : ""; 
         $building = isset($_POST['building']) ? $_POST['building'] : ""; 
         $road = isset($_POST['road']) ? $_POST['road'] : ""; 
		 $fullname = $this->input->post('fullname');
		 $username = $this->input->post('username');
		 $password = $this->input->post('password');
		 $email = $this->input->post('email');
		 $phone = $this->input->post('phone');
		 $addr = $this->input->post('addr');
		 $province = $this->input->post('province');
		 $district = $this->input->post('district');
		 $subdistrict = $this->input->post('subdistrict');
		 $zipcode = $this->input->post('zipcode');
 
		 // เช็ค email ซ้ำ
		 $this->db->where('email', $email);
		 $queryEmail = $this->db->get('users');
		 if ($queryEmail->num_rows() > 0) {
			// ถ้า username ซ้ำในระบบ
			echo json_encode(array('status'=> 'fail','message'=> 'มีผู้ใช้อีเมลนี้สมัครสมาชิกในระบบแล้ว กรุณาเปลี่ยนอีเมลของท่านอีกครั้ง'));exit();
		 }

		 // เช็คว่า username ซ้ำหรือไม่
		 $this->db->where('username', $username);
		 $query = $this->db->get('users');
 
		 if ($query->num_rows() > 0) {
			 // ถ้า username ซ้ำในระบบ
			 echo json_encode(array('status'=> 'fail','message'=> 'ชื่อผู้ใช้ซ้ำกับในระบบ'));exit();
		 } else {
			 // ถ้า username ไม่ซ้ำในระบบ
			 // เพิ่มข้อมูลลงในฐานข้อมูล
			 $tax_id = $this->input->post('tax_id');
			 if(!empty($tax_id)){
				$is_tax_invoice = 1;
			 }else{
				$is_tax_invoice =0;
			 }
			 $data = array(
			
				 'fullname' => $fullname,
				 'username' => $username,
				 'password' => $password,
				 'email' => $email,
				 'phone' => $phone,
				 "tax_id" => !empty($tax_id) ? $tax_id : "",
				 "is_tax_invoice"=>$is_tax_invoice
				
		
			 );
 
			 $this->db->insert('users', $data);

			 // รับค่า ID ที่เพิ่มล่าสุด
			 $user_id = $this->db->insert_id();
			 $this->generate_verify_email($email   , $username , $user_id); // ยืนยัน email สมาชิก
		
		
			 $fullnameComp = $this->input->post('fullnameComp');
			 // address 
			 if(!empty($province)
			 )  {
				$addrCurrent =  array('addr' => $addr,
					'addr_type'=>'1',
					'name'=>$name,
					'home_no'=>$home_no,
					"building"=>$building,
					'road'=>$road,
					'province_id' => $province,
					'amphur_id' => $district,
					'district_id' => $subdistrict,
					'zipcode' => $zipcode,
					'phone'=> $phone,
					"user_id"=>$user_id,
			
				);
				$this->db->insert('address', $addrCurrent);
			 }

			
			
			$phoneComp = $_POST['phoneComp'];
			$addrComp = $_POST['addrComp'];
			$provinceComp = $_POST['provinceComp'];
			$districtComp = $_POST['districtComp'];
			$subdistrictComp = $_POST['subdistrictComp'];
			$zipcodeComp = $_POST['zipcodeComp'];
			$tax_type = isset($_POST['tax_type']) ? $_POST['tax_type'] : ""; 
			$home_no = isset($_POST['home_no_comp']) ? $_POST['home_no_comp'] : ""; 
			$building = isset($_POST['building_comp']) ? $_POST['building_comp'] : ""; 
			$road = isset($_POST['road_comp']) ? $_POST['road_comp'] : ""; 
			$passport_number = isset($_POST['passport_number']) ? $_POST['passport_number'] : ""; 

			if($is_tax_invoice == 1)  {
				$addrComp =  array('addr' => $addrComp,
					'addr_type'=>'2',
					'tax_type'=>$tax_type,
					'home_no'=>$home_no,
					"building"=>$building,
					'road'=>$road,
					"passport_number"=>$passport_number,
					'province_id' => $provinceComp,
					'amphur_id' => $districtComp,
					'district_id' => $subdistrictComp,
					'zipcode' => $zipcodeComp,
					'phone'=> $phoneComp,
					"user_id"=>$user_id,
					'name'=>$fullnameComp
				);
				$this->db->insert('address', $addrComp);
			 }
			 

			 echo json_encode(array('status'=> 'success'));exit();
		 }
	}
	public function generate_verify_email($email = null , $fullname , $user_id){
		$config =  $this->config->item('email');
		$mail_body = $this->load->view('desktop/verify_email', array('email'=>$email  , 'fullname'=>$fullname , "user_id"=>$user_id), TRUE);
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		
		 // Email parameters
		 $this->email->from('smtp_tgsmartlife@tgsmartlife.com', 'tgsmartlife.com');
		 $this->email->reply_to('no-reply@tgsmartlife.com', 'No-Reply');
		 $this->email->to($email); // อีเมล์ผู้รับ
		 $this->email->subject('ยืนยันการสมัครสมาชิก (tgsmartlife.com)');
		 $this->email->message($mail_body);

		
		 // Send email
		 if($this->email->send()) {
			 return true;
		 } else {
			 return false;
		 }

   }
	public function get_province() {  
		$Query = "SELECT *
		FROM `provinces` 
		 ";
		$result = $this->db->query($Query)->result_array();
		return $result;
	}

	public function get_districts($district_id = null) {  
		$Query = "SELECT *
		FROM `districts` 
		
		 ";
 $subWhere = "";
		 if(!empty($district_id)){
			$subWhere .= " district_id='".$district_id."'";
		}

		$result = $this->db->query($Query)->result_array();
		echo json_encode($result);exit();
	}


	public function get_amphur($provice_id = null , $code = null) {  
		$Query = "SELECT *
		FROM `amphures` 
		 ";
		 $subWhere = "";
		if(!empty($provice_id)){
			$subWhere .= " provice_id='".$provice_id."'";
		}
		if(!empty($code)){
			if(!empty($subWhere)){
				$subWhere .= " and ";
			}
			$subWhere .= " code='".$code."'";
		}



		$result = $this->db->query($Query)->result_array();
		return $result;
	}




}