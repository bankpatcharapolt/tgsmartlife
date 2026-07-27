<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

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
	function __construct()
	{

		parent::__construct();


		$this->load->library('session');
		$this->load->library('email');
		$this->load->library("pagination");

		//เรียกใช้งาน Class helper     
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('file');
	}
	public function index()
	{
		$menu['mainmenu'] = 'home';
		$menu['submenu'] = 'home';
		$menu['seo'] = "";

		//echo '<PRE>';print_r($menu);exit();
		$this->load->view('desktop/header', $menu);
		$this->load->view('desktop/cart');
		$this->load->view('desktop/footer');
	}

	public function get_data_member_by_orderId(){
		$param = $_POST;
		
		$this->db->select("orders.*,order_detail.*,product.name,product.thumnal")->from('orders')
        ->join('order_detail' , 'orders.order_id = order_detail.order_id')
        ->join('product' , 'order_detail.product_id = product.id')
        ->where("orders.user_id",$_POST['user_id'])
		->where("orders.order_id",$_POST['order_id']);


		// รับข้อมูลจากฐานข้อมูล
		$query = $this->db->get();
$data = [];
		// เตรียม array สำหรับเก็บข้อมูลที่ได้
		$return_data = array();

		// ตรวจสอบว่ามีข้อมูลหรือไม่ก่อนที่จะดำเนินการ
		if ($query->num_rows() > 0) {
			// วนลูปผลลัพธ์ที่ได้จากฐานข้อมูล
			foreach ($query->result() as $row) {
				$product_id = $row->id;
			
				$amount = $row->amount; // จำนวนสินค้าจาก array ที่กำหนด
				$price = $row->price; // ราคาสินค้าจากฐานข้อมูล

				// คำนวณค่าเงินทั้งหมด
				$total_price = $amount * $price;

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
		
		echo json_encode(array("data"=>$return_data));exit();
	}
	public function get_data_member(){

		$param = $_POST;
		$this->db->select('cart.product_id,cart.amount,cart.product_id,cart.user_id,product.id as id,product.name,product.thumnal,product.price');
		$this->db->from('cart');
		$this->db->join('product', 'product.id = cart.product_id'); // ทำการ join กับตาราง product โดยเชื่อมโยงด้วย product.id กับ cart.product_id
		$this->db->where('user_id', $param['user_id']);
		// รับข้อมูลจากฐานข้อมูล
		$query = $this->db->get();
$data = [];
		// เตรียม array สำหรับเก็บข้อมูลที่ได้
		$return_data = array();

		// ตรวจสอบว่ามีข้อมูลหรือไม่ก่อนที่จะดำเนินการ
		if ($query->num_rows() > 0) {
			// วนลูปผลลัพธ์ที่ได้จากฐานข้อมูล
			foreach ($query->result() as $row) {
				$product_id = $row->id;
			
				$amount = $row->amount; // จำนวนสินค้าจาก array ที่กำหนด
				$price = $row->price; // ราคาสินค้าจากฐานข้อมูล

				// คำนวณค่าเงินทั้งหมด
				$total_price = $amount * $price;

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

		echo json_encode(array("data"=>$return_data));exit();
	}

	public function add_to_cart_member(){
		
		$post_data = [];
		
		$post_data[$_POST['product_id']] = ['amount'=>$_POST['amount']];
		$this->update_data($post_data , $_POST['is_replace']);
	}
	public function delete_data_member(){
		$data = $_POST;
		// สร้างเงื่อนไขสำหรับลบ
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('product_id', $data['product_id']);

		// ทำการลบข้อมูลจากตาราง 'cart'
		$this->db->delete('cart');

		// ตรวจสอบว่ามีการลบเรียบร้อยหรือไม่
		if ($this->db->affected_rows() > 0) {
			$response = array('status' => true);
		} else {
			$response = array('status' => false);
		}

		// ส่งผลลัพธ์เป็น JSON
		echo json_encode($response);exit();
	}
	public function get_data()
	{
		
		// ตัวอย่างข้อมูล Array ที่กำหนด
		$data = $_POST;

		// เตรียม product_id จาก key ของ array
		$product_ids = array_keys($data);

		// สร้าง query ในรูปแบบของ CodeIgniter
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('id', $product_ids);

		// รับข้อมูลจากฐานข้อมูล
		$query = $this->db->get();

		// เตรียม array สำหรับเก็บข้อมูลที่ได้
		$return_data = array();

		// ตรวจสอบว่ามีข้อมูลหรือไม่ก่อนที่จะดำเนินการ
		if ($query->num_rows() > 0) {
			// วนลูปผลลัพธ์ที่ได้จากฐานข้อมูล
			foreach ($query->result() as $row) {
				$product_id = $row->id;
				$amount = $data[$product_id]['amount']; // จำนวนสินค้าจาก array ที่กำหนด
				$price = $row->price; // ราคาสินค้าจากฐานข้อมูล

				// คำนวณค่าเงินทั้งหมด
				$total_price = $amount * $price;

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

		echo json_encode(array("data"=>$return_data));exit();

	}

	public function update_data($post_data = [] ,$is_replace = false){
			if(!empty($post_data)){
				$data = $post_data;
			}else{
				$data = $_POST;
			}
			$user_id = $this->session->userdata('user_id'); // Get user_id from session

			foreach ($data as $product_id => $values) {
				$amount = $values['amount'];

				// Check if the product_id exists in the cart for the current user
				$existing_product = $this->db->get_where('cart', ['product_id' => $product_id, 'user_id' => $user_id])->row();

				// Prepare data array for insert or update
				$product_data = [
					'user_id' => $user_id,
					'product_id' => $product_id,
					'amount' => $amount,
					'updated' => date("Y-m-d H:i:s") // Default updated timestamp
				];

				if ($existing_product) {
					// If product exists in cart, update the amount
					if(!$is_replace){
						$new_amount = $existing_product->amount + $amount;
					}else{
						$new_amount = $amount;
					}
					
					$product_data['amount'] = $new_amount;

					$this->db->where('id', $existing_product->id);
					$this->db->update('cart', $product_data);
				} else {
					// If product does not exist in cart, insert new record
					$product_data['created'] = date("Y-m-d H:i:s");

					$this->db->insert('cart', $product_data);
				}
			}


			$this->getAmount();
	}

	public function getAmount() {
		$user_id = $this->session->userdata('user_id'); 
		
		$result = $this->db->select_sum('amount')
						   ->from('cart')
						   ->where('user_id', $user_id)
						   ->get()
						   ->row();
	
		// Check if result exists
		if ($result) {
			
			$response = array(
				'sum_amt' => $result->amount  > 0 ? $result->amount : 0
			);
			echo json_encode($response);  
		} else {
			
			echo json_encode(array('sum_amt' => 0));  
		}
	
		exit();  
	}
	
}