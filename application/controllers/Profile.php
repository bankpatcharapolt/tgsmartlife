
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        //echo '<PRE>';print_r($this->session);exit();
        $this->load->model('Profile_model');
        $user_id = $this->session->userdata('user_id');
        if(empty($user_id)){
            redirect(base_url('login')); 
        }
        $profile = $this->getProfile($user_id);
        $address = $this->Profile_model->getAddr($user_id);
        $province =$this->Profile_model->get_province();
        $amphur  =$this->Profile_model->get_amphur();
        $districts=$this->Profile_model->get_districts();
       
        // echo '=======';
        // echo '<PRE>';print_r($address);exit();
        $menu['mainmenu'] = 'profile';
		$menu['submenu'] = 'profile';
		$menu['seo'] = "";
	
        
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/profile' ,[
            'profile' => empty($profile) ? [] : $profile,
            'address' => empty($address) ? [] : $address,
            'province'=>$province,
            "amphur"=>$amphur,
            "districts"=>$districts
        ]);
		$this->load->view('desktop/footer');      

    }

    public function edit_user(){
		//echo '5';exit();
		 // รับค่าจากการ POST
         $user_id = $this->session->userdata('user_id');
		 $username = $this->input->post('username');
		 $email = $this->input->post('email');
		 $phone = $this->input->post('phone');

		 // เช็ค email ซ้ำ
       
		 $this->db->where('email', $email);
         $this->db->where('id !=', $user_id);
		 $queryEmail = $this->db->get('users');
		 if ($queryEmail->num_rows() > 0) {
			// ถ้า username ซ้ำในระบบ
			echo json_encode(array('status'=> 'fail','message'=> 'มีผู้ใช้อีเมลนี้สมัครสมาชิกในระบบแล้ว กรุณาเปลี่ยนอีเมลของท่านอีกครั้ง'));exit();
		 }

		 // เช็คว่า username ซ้ำหรือไม่
		 $this->db->where('username', $username);
         $this->db->where('id !=', $user_id);
		 $query = $this->db->get('users');
 
		 if ($query->num_rows() > 0) {
			 // ถ้า username ซ้ำในระบบ
			 echo json_encode(array('status'=> 'fail','message'=> 'ชื่อผู้ใช้ซ้ำกับในระบบ'));exit();
		 } else {
			
            $data = array(
                'username' => $username,
                'email' => $email,
                'phone' => $phone,		
                'updated' => date("Y-m-d H:i:s")
            );
            
            $this->db->where('id', $user_id); // เงื่อนไข: user id เท่ากับ 3
            $this->db->update('users', $data); // ทำการอัปเดตข้อมูลในตาราง users
            
			 

			 echo json_encode(array('status'=> 'success'));exit();
		 }
	}


    public function edit_address(){
		//echo '5';exit();
		 // รับค่าจากการ POST
         $user_id = $this->session->userdata('user_id');

         $name = isset($_POST['name']) ? $_POST['name'] : "";
         $home_no = $this->input->post('home_no'); 
         $building = $this->input->post('building'); 
         $road = $this->input->post('road'); 
		 $addr = $this->input->post('addr'); 
		 $province = $this->input->post('province');
		 $district = $this->input->post('district');
         $subdistrict = $this->input->post('subdistrict');
         $zipcode = $this->input->post('zipcode');
         $phone = $this->input->post('phone');
        // ตัวแปรข้อมูลที่ต้องการ insert หรือ update
        $data = array(
            "name"=>$name,
            "home_no"=>$home_no,
            "building"=>$building,
            "road"=>$road,
            'addr' => $addr,
            'province_id' => $province,
            'amphur_id' => $district,
            'district_id' => $subdistrict,
            'zipcode' => $zipcode,
            "phone"=>$phone,
            'updated' => date("Y-m-d H:i:s")
        );

        // เงื่อนไขสำหรับค้นหาข้อมูลในตาราง address
        $this->db->where('user_id', $user_id); // เงื่อนไข: user id เท่ากับ $user_id
        $this->db->where('addr_type', '1'); // เงื่อนไข: addr_type เท่ากับ '1'

        // ทำการ query ข้อมูลจากตาราง address โดยใช้เงื่อนไขที่กำหนด
        $query = $this->db->get('address');

        // ตรวจสอบว่ามีข้อมูลที่ตรงกับเงื่อนไขหรือไม่
        if ($query->num_rows() == 0) {
            // ถ้าไม่มีข้อมูลที่ตรงกับเงื่อนไข ให้ทำการ insert ข้อมูลใหม่
            $data['user_id'] = $user_id; // เพิ่ม user_id เข้าไปใน array $data สำหรับการ insert
            $data['addr_type'] = '1'; // เพิ่ม addr_type เข้าไปใน array $data สำหรับการ insert
            
            $this->db->insert('address', $data); // ทำการ insert ข้อมูลใหม่ลงในตาราง address
        } else {
            // ถ้ามีข้อมูลที่ตรงกับเงื่อนไข ให้ทำการ update ข้อมูลที่มีอยู่
            $this->db->where('user_id', $user_id); // เงื่อนไข: user id เท่ากับ $user_id
            $this->db->where('addr_type', '1'); // เงื่อนไข: addr_type เท่ากับ '1'
            $this->db->update('address', $data); // ทำการอัปเดตข้อมูลในตาราง address
        }
     
    
        echo json_encode(array('status'=> 'success'));exit();
       
	}

    public function edit_address_tax(){
		//echo '5';exit();
		 // รับค่าจากการ POST
         $tax_type = isset($_POST['tax_type'])  ? $_POST['tax_type'] : "";
         $passport_number = isset($_POST['passport_number']) && $tax_type != '2' ? $_POST['passport_number'] : "";
         $home_no = $this->input->post('home_no'); 
         $building = $this->input->post('building'); 
         $road = $this->input->post('road'); 
         $fullnameComp = $this->input->post('fullnameComp');
         $tax_id = $this->input->post('tax_id');
         $phoneComp = $this->input->post('phoneComp');
         $user_id = $this->session->userdata('user_id');
		 $addr = $this->input->post('addrComp');
		 $province = $this->input->post('provinceComp');
		 $district = $this->input->post('districtComp');
         $subdistrict = $this->input->post('subdistrictComp');
         $zipcode = $this->input->post('zipcodeComp');

         $data = array(
            'name'=>$fullnameComp,
            'passport_number'=>$passport_number,
            "tax_type"=>$tax_type,
            'home_no'=>$home_no,
            'building'=>$building,
            'road'=>$road,
            'phone'=>$phoneComp,
            'addr' => $addr,
            'province_id' => $province,
            'amphur_id' => $district,
            'district_id' => $subdistrict,	
            'zipcode' => $zipcode,		
            'updated' => date("Y-m-d H:i:s")
        );
        
        // $this->db->where('user_id', $user_id); // เงื่อนไข: user id เท่ากับ 3
        // $this->db->where('addr_type', '2'); // เงื่อนไข: user id เท่ากับ 3
        // $this->db->update('address', $data); // ทำการอัปเดตข้อมูลในตาราง address
        // เงื่อนไขสำหรับค้นหาข้อมูลในตาราง address
        $this->db->where('user_id', $user_id); // เงื่อนไข: user id เท่ากับ $user_id
        $this->db->where('addr_type', '2'); // เงื่อนไข: addr_type เท่ากับ '1'

        // ทำการ query ข้อมูลจากตาราง address โดยใช้เงื่อนไขที่กำหนด
        $query = $this->db->get('address');

        // ตรวจสอบว่ามีข้อมูลที่ตรงกับเงื่อนไขหรือไม่
        if ($query->num_rows() == 0) {
            // ถ้าไม่มีข้อมูลที่ตรงกับเงื่อนไข ให้ทำการ insert ข้อมูลใหม่
            $data['user_id'] = $user_id; // เพิ่ม user_id เข้าไปใน array $data สำหรับการ insert
            $data['addr_type'] = '2'; // เพิ่ม addr_type เข้าไปใน array $data สำหรับการ insert
            
            $this->db->insert('address', $data); // ทำการ insert ข้อมูลใหม่ลงในตาราง address
        } else {
            // ถ้ามีข้อมูลที่ตรงกับเงื่อนไข ให้ทำการ update ข้อมูลที่มีอยู่
            $this->db->where('user_id', $user_id); // เงื่อนไข: user id เท่ากับ $user_id
            $this->db->where('addr_type', '2'); // เงื่อนไข: addr_type เท่ากับ '1'
            $this->db->update('address', $data); // ทำการอัปเดตข้อมูลในตาราง address
        }
     
    


        $this->db->where('id', $user_id); // เงื่อนไข: user id เท่ากับ 3
        $this->db->update('users', ['tax_id'=>$tax_id]); // ทำการอัปเดตข้อมูลในตาราง users
        echo json_encode(array('status'=> 'success'));exit();
       
	}

    public function getProfile($user_id = null){
        $query = "select users.*  
        from users ";
        if(!empty($user_id)){
            $query .= " WHERE users.id={$user_id}";
        }
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            $row = $result->result_array();
            return $row;
        }else{
            return false;
        }
    }

 
}


?>
