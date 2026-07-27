
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function success(){
        $menu['mainmenu'] = 'payment';
		$menu['submenu'] = 'payment';
		$menu['seo'] = "";
        
        
        $this->load->view('desktop/header',$menu);
		$this->load->view('desktop/payment_success' , []);
		$this->load->view('desktop/footer');      
    }

    function convertData($data) {
        // เตรียมตัวแปรเก็บข้อมูลที่จะ return
        $result = array();
    
        // วนลูปใน $data เพื่อแปลงข้อมูลแต่ละตัวเป็น associative array
        foreach ($data as $obj) {
            $name = $obj->name;
            $map = array(
                "fullnameComp" => "name",
                "phoneComp" => "phone",
                "addrComp" => "addr",
                "provinceComp" => "province",
                "districtComp" => "district",
                "subdistrictComp" => "subdistrict",
                "zipcodeComp" => "zipcode",
                "road" => "road",
            );
          
            // ตรวจสอบและแทนที่ $name ตาม map ที่กำหนด
            if (isset($map[$name])) {
                $name = $map[$name];
            }

            $result[$name] = $obj->value;
        }
    
        return $result;
    }
    public function transformData($data , $user_id , $addr_type , $tax_invoice) {
      
        $result = array(
            'tax_invoice'=>$tax_invoice,
            'user_id' => $user_id,
            'home_no' => $data['home_no'],
            'building' => isset($data['building']) ? $data['building']: "",
            'road' => isset($data['road']) ? $data['road']: "",
            'addr_type' => $addr_type,
            'province_id' => $data['province'],
            'amphur_id' => isset($data['district']) ? $data['district'] : "",
            'district_id' =>isset($data['subdistrict']) ? $data['subdistrict'] : "",
            'zipcode' =>isset($data['zipcode']) ? $data['zipcode'] : "",
            'name' => isset($data['name']) ? $data['name'] : "",
            'tax_type' => isset($data['tax_type']) ? $data['tax_type'] : "",
            'passport_number' => isset($data['passport_number']) ? $data['passport_number'] : "",
            'phone' => $data['phone'],
            'addr' => $data['addr'],
            'created' => isset($data['created']) ? $data['created'] : "",
            'updated' => isset($data['updated']) ? $data['updated'] : "",
        );
    
        // คืนค่า array ในรูปแบบที่มี index เป็นตัวเลข
        return array($result);
    }
    public function index(){
        //echo '<PRE>';print_r($this->session);exit();
        // $this->load->controller('Profile');
    // โหลด Model Profile แทนการโหลด Controller Profile
    $this->load->model('Profile_model');

    $user_id = $this->session->userdata('user_id');
    if(empty($user_id)){
        redirect(base_url('login')); 
    }
    $address = [];
    $tax_invoice = 0;
    if(isset($_GET['order_id'])){
        $getAddrByOrder = $this->Profile_model->getAddrByOrderId($user_id , $_GET['order_id']);
        
        if(!empty($getAddrByOrder)){
            $addrCurrent = json_decode($getAddrByOrder[0]['addrCurrent']);
            $tax_invoice = $getAddrByOrder[0]['tax_invoice'];
        
            if(!empty($addrCurrent)){
              $convertData = $this->convertData($addrCurrent);
              $transformData = $this->transformData($convertData , $user_id , '1' ,$tax_invoice);
              $address[] = $transformData[0];
            }

            $addrComp = json_decode($getAddrByOrder[0]['addrComp']);
   
            if(!empty($addrComp)){
                $convertData = $this->convertData($addrComp);
                $tax_invoice = $getAddrByOrder[0]['tax_invoice'];
                $transformData = $this->transformData($convertData , $user_id , '2' , $tax_invoice);
                $address[] = $transformData[0];
            }
              
        }
      
    }else{
        $address = $this->Profile_model->getAddr($user_id);
     
    }

   // echo "<PRE>";print_r($address);exit();
   
        // เรียกใช้เมธอด getAddr จาก Model Profile_model
        $profile = $this->Profile_model->getProfile($user_id);
        $province =$this->Profile_model->get_province();
        $amphur  =$this->Profile_model->get_amphur();
    
        $districts=$this->Profile_model->get_districts();
   
        // echo '=======';
        // echo '<PRE>';print_r($address);exit();
        $menu['mainmenu'] = 'payment';
		$menu['submenu'] = 'payment';
		$menu['seo'] = "";
        
        $data = [
            'address' => $address,
            "profile"=>$profile,
            "province"=>$province,
            "amphur"=>$amphur,
            "districts"=>$districts,
            "tax_invoice"=>$tax_invoice,
        ];
        
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/payment' , $data);
		$this->load->view('desktop/footer');      

    }

    public function getDataByOrder($input){
		$param = $input;
		
		$this->db->select("orders.*,order_detail.*,product.name,product.thumnal")->from('orders')
        ->join('order_detail' , 'orders.order_id = order_detail.order_id')
        ->join('product' , 'order_detail.product_id = product.id')
        ->where("orders.user_id",$input['user_id'])
		->where("orders.order_id",$input['order_id']);


		// รับข้อมูลจากฐานข้อมูล
		$query = $this->db->get();
$data = [];
		// เตรียม array สำหรับเก็บข้อมูลที่ได้
		$return_data = array();
        $product_name = [];
		// ตรวจสอบว่ามีข้อมูลหรือไม่ก่อนที่จะดำเนินการ
		if ($query->num_rows() > 0) {
			// วนลูปผลลัพธ์ที่ได้จากฐานข้อมูล
			foreach ($query->result() as $row) {
				$product_id = $row->id;
			
				$amount = $row->amount; // จำนวนสินค้าจาก array ที่กำหนด
				$price = $row->price; // ราคาสินค้าจากฐานข้อมูล

				// คำนวณค่าเงินทั้งหมด
				$total_price = $amount * $price;
                $product_name[] = $row->name;
				// เตรียมข้อมูลที่จะเก็บลงใน return_data
				$item_data = array(
					'product_id' => $product_id,
					'thumnal'=>$row->thumnal,
					'name'=>$row->name,
					'amount' => $amount,
					'price' => $price,
					'total_price' => $total_price
				);

				// เก็บข้อมูลใน return_data
				$return_data[] = $item_data;
				
			}
		} 
		
		return ["return_data"=>$return_data , "product_name"=>$product_name];
	}
    public function update(){
        $result = $this->getDataByOrder($_POST);
        $input = $_POST;
        if(isset($input['addrCurrent'])){
            $input['addrCurrent'] = json_encode($input['addrCurrent']);
        }
        if(isset($input['addrComp'])){
            $input['addrComp'] = json_encode($input['addrComp']);
        }

 
       
        if(!empty($input)){
            // ===================================================================  
            $update_array = $input;
            $update_array['updated'] = DATE("Y-m-d H:i:s");             
            unset($update_array['user_id']);
            unset($update_array['order_id']);
            // ==================================================================== 
            $product_name = implode(",", $result['product_name']); // ตัวอย่างของ array ของ product_name

            // ตรวจสอบว่าข้อความยาวเกิน 255 หรือไม่
            if (strlen($product_name) > 255) {
            $product_name = substr($product_name, 0, 200) . '...';
            }

            $this->db->where('order_id', $input['order_id']);
            $this->db->update('orders', $update_array);
            echo json_encode(array('status' => true , 'order_id'=>$input['order_id']  , "product_name" =>$product_name));
        }else{
            echo json_encode(['status'=>false]);exit();
        }
    }
    public function del_order(){
        $input = $_POST;
      
        if(isset($input['order_id'])){
            // delete order
            $this->db->where('orders.order_id', $input['order_id']);
    		$this->db->delete('orders');

            //  delete order detail
            $this->db->where('order_detail.order_id', $input['order_id']);
    		$this->db->delete('order_detail');


            echo json_encode(['status'=>true]);exit();
        }
        echo json_encode(['status'=>false]);exit();
    }
    public function insert(){
        
        $cartData = $this->db->select('cart.*,product.name,product.price')->from('cart')
        ->join('product' , 'cart.product_id = product.id')
        ->where('user_id' , $_POST['user_id'])->get();
        $result = $cartData->result();
        $input = $_POST;
        if(isset($input['addrCurrent'])){
            $input['addrCurrent'] = json_encode($input['addrCurrent']);
        }
        if(isset($input['addrComp'])){
            $input['addrComp'] = json_encode($input['addrComp']);
        }
        $input['created'] = DATE("Y-m-d H:i:s");
        $this->db->insert("orders" , $input);
        $insert_id = $this->db->insert_id();
    
        if($insert_id){
         
            $order_id = sprintf("%012d", $insert_id);
            // update new order id
            $this->db->where('id', $insert_id);
            $this->db->update('orders', ['order_id' => $order_id]);

            $product_name = [];
            // insert order detail 
            foreach($result as $key => $value){
                $product_name[] = $value->name;
                $this->db->insert('order_detail', [
                    'order_id'=>$order_id,
                    'product_id' => $value->product_id,
                    'price'=>$value->price,
                    'amount' => $value->amount,
                    'created' => DATE("Y-m-d H:i:s"),
                ]);
            }

            // delete old data 
            $this->db->where('user_id', $_POST['user_id']);
            $this->db->delete('cart');
            if($this->db->affected_rows() > 0){
                $product_name = implode(",", $product_name); // ตัวอย่างของ array ของ product_name

                                // ตรวจสอบว่าข้อความยาวเกิน 255 หรือไม่
                if (strlen($product_name) > 255) {
                    $product_name = substr($product_name, 0, 200) . '...';
                }
                echo json_encode(array('status' => true , 'order_id'=>$order_id  , 'product_name' => $product_name));
                exit();
            }

        }
        echo json_encode(array('status'=>false));
        
    }
}

?>
