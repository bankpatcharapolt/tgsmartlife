<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Order extends Main {

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

	
	public function view($order_id = null){  
		if (isset($_POST['status'])) {
			// ทำสิ่งที่ต้องการเมื่อตัวแปรทั้งหมดถูกตั้งค่า
			$status = $_POST['status'];
			$order_id = $_POST['order_id'];
            $update_array = ['status'=>$status , "updated"=>DATE("Y-m-d H:i:s")];
            if(isset($_POST['parcel_number']) && $status != 1 && $status != 0){
                $update_array['parcel_number'] = $_POST['parcel_number'];
            }
            if(isset($_POST['send_by']) && $status != 1 && $status != 0){
                $update_array['send_by'] = $_POST['send_by'];
            }
          

			$this->db->where('order_id', $order_id);
            $this->db->update('orders',  $update_array);
		
		}
		$result = $this->db->select("orders.*,order_detail.*,product.name,product.thumnal,users.fullname,users.email")->from('orders')
        ->join('order_detail' , 'orders.order_id = order_detail.order_id')
        ->join('product' , 'order_detail.product_id = product.id')
		->join('users','orders.user_id = users.id')
		->where('orders.order_id',$order_id)
		->get();
		$user_id = "";
		if($result->num_rows() > 0){
            foreach($result->result() as $key => $value){
                if(!isset($return_data[$value->order_id])){
                    $order_detail = [];

                    if($value->product_id != "" && $value->product_id != null){
                        $order_detail= [
                            'product_id'=>$value->product_id,
                            'price'=>$value->price,
                            'amount'=>$value->amount,
                            'name'=>$value->name,
                            'thumnal'=>$value->thumnal,
                        ];
                    }
                    $return_data[$value->order_id] = [
                        'order_id'=>$value->order_id,
						'fullname'=>$value->fullname,
						'email'=>$value->email,
                        'addrCurrent'=>$value->addrCurrent,
                        'addrComp'=>$value->addrComp,
                        'total_amount'=>$value->total_amount,
                        'total_amount_with_shipping_cost'=>$value->total_amount_with_shipping_cost,
                        'status'=>$value->status,
						'send_by'=>$value->send_by,
						'parcel_number'=>$value->parcel_number,
                        'payment_status'=>$value->payment_status,
                        'shipping'=>$value->shipping,
                        'tax_invoice'=>$value->tax_invoice,
                        'created'=>$value->created,
                        'order_detail'=> []
                    ];

					
                    if(!empty($order_detail)){
                        $return_data[$value->order_id]['order_detail'][] = $order_detail;
                       
                    }
					$user_id = $value->user_id;
                }
            }
        }
		$this->load->model('Profile_model');

		$address = [];
		$getAddrByOrder = $this->Profile_model->getAddrByOrderId($user_id , $order_id);
		$addrCurrent = json_decode($getAddrByOrder[0]['addrCurrent']);
		if(!empty($addrCurrent)){
			$convertData = $this->convertData($addrCurrent);
			$transformData = $this->transformData($convertData , $user_id , '1' ,"0");
			$address[] = $transformData[0];
		  }

		  $addrComp = json_decode($getAddrByOrder[0]['addrComp']);
 
		  if(!empty($addrComp)){
			  $convertData = $this->convertData($addrComp);
			  $tax_invoice = $getAddrByOrder[0]['tax_invoice'];
			  $transformData = $this->transformData($convertData , $user_id , '2' , $tax_invoice);
			  $address[] = $transformData[0];
		  }
	
		$province =$this->Profile_model->get_province();
		$amphur  =$this->Profile_model->get_amphur();
	
		$districts=$this->Profile_model->get_districts();
		$menu['mainmenu'] = 'order';
		$menu['submenu'] = 'order';

		$this->load->view('admin/header',$menu);
		$this->load->view('admin/view_order' , ["data"=>array_values($return_data) 
		, "address"=>$address 
		, "province"=>$province
		, "amphur" => $amphur
		, "districts"=>$districts
		]);
		$this->load->view('admin/footer');
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

    public function index($page = null , $order_id = null){

        $menu['mainmenu'] = 'order';
		$menu['submenu'] = 'order';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/order');
		$this->load->view('admin/footer');
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
	public function get_order(){
		$result =		$this->db->select("orders.*,order_detail.*,product.name,product.thumnal")->from('orders')
        ->join('order_detail' , 'orders.order_id = order_detail.order_id')
        ->join('product' , 'order_detail.product_id = product.id')->get();

		$return_data = [];
		if($result->num_rows() > 0){
            foreach($result->result() as $key => $value){
                if(!isset($return_data[$value->order_id])){
                    $order_detail = [];
					$productList = "";
                    if($value->product_id != "" && $value->product_id != null){
                        $order_detail= [
                            'product_id'=>$value->product_id,
                            'price'=>$value->price,
                            'amount'=>$value->amount,
                            'name'=>$value->name,
                            'thumnal'=>$value->thumnal,
                        ];
						
                    }
                    $return_data[$value->order_id] = [
                        'order_id'=>$value->order_id,
                        'addrCurrent'=>$value->addrCurrent,
                        'addrComp'=>$value->addrComp,
                        'total_amount'=>$value->total_amount,
                        'total_amount_with_shipping_cost'=>$value->total_amount_with_shipping_cost,
                        'status'=>$value->status,
                        'payment_status'=>$value->payment_status,
                        'shipping'=>$value->shipping,
                        'tax_invoice'=>$value->tax_invoice,
                        'created'=>$value->created,
                        'order_detail'=> [],
						"productList"=> "",
						"thumnal"=> "",
                    ];
                    if(!empty($order_detail)){
                        $return_data[$value->order_id]['order_detail'][] = $order_detail;
						$productList = "";
						if(!empty($return_data[$value->order_id]['productList'])){
							$productList .= ",";
						}
						$productList .= $order_detail['name'];

						$return_data[$value->order_id]['productList'] .= $productList;
						$return_data[$value->order_id]['thumnal'] = $order_detail['thumnal'];
                    }
                }
            }
        }
		
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'สำเร็จ';
		$res->datas = array_values($return_data);
		$res->status_code = '000';
		echo json_encode($res);


	}

}
