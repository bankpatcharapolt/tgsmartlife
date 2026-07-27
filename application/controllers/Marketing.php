<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

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

		$this->load->library('session');
		$this->load->library('email');
     	//เรียกใช้งาน Class helper     
        $this->load->helper('url'); 
      	$this->load->helper('form');
		$this->load->helper('file'); 
    }
	public function index()
	{
		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}

		$menu['main'] = (object)$this->getmainmenu();
        $menu['mainmenu'] = 'product';
		$menu['submenu'] = 'marketing';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$data['category'] = $this->getcategoryheader();
		$data['lang'] = $lang;

		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/marketing',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}

	public function get_category() {   
		
		$Query = " SELECT * FROM product_category WHERE displaystatus = '1' order by orders asc";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_category_once() {   
		$cate_id = $this->input->post('cate_id');
		$Query = " SELECT * FROM product_category WHERE displaystatus = '1' AND id ='".$cate_id."' order by orders asc";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function products($cate)
	{
		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}

		$menu['main'] = (object)$this->getmainmenu();
        $menu['mainmenu'] = 'product';
		$menu['submenu'] = 'marketing';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$category = $this->getcategory($cate);
		//$data['products'] = $this->getproduct(null, $cate, $category[0]['cate_folder']);
		$data['lang'] = $lang;
		$data['cate'] = $cate;
		
		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/product',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}
	
	public function get_product_by_cate() {  
		$cate_id = $this->input->post('cate_id');
        $Query = " SELECT p.*, pc.name_th cate_name 
		FROM products p 
		LEFT JOIN product_category pc ON p.category = pc.id
		where p.displaystatus = '1' and p.category = '".$cate_id."'
		order by p.orders asc
		";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function productdetail($cate, $product)
	{
		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}

		$menu['main'] = (object)$this->getmainmenu();
        $menu['mainmenu'] = 'product';
		$menu['submenu'] = 'marketing';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$category = $this->getcategory($cate);
		//$data['details'] = $this->getproductdetail($product, $category[0]['cate_folder']);
		//$data['productpdf'] = $this->getproductpdf($product, $category[0]['cate_folder']);
		$data['lang'] = $lang;
		//$data['cate_id'] = $cate;
		$data['product_id'] = $product;
		
		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/productdetail',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}
	
	public function get_product_once() {  
		$product_id = $this->input->post('product_id');
        $Query = "SELECT p.*, pc.name_th cate_th, pc.name_en cate_en
		FROM products p 
		LEFT JOIN product_category pc ON p.category = pc.id
		WHERE p.id = '".$product_id."' order by p.orders asc ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_image_once() { 
		
		$lang = 'th';
		if($this->session->userdata('Language') == 'en'){ 
			$lang = $this->session->userdata('Language');
		}
 
		$product_id = $this->input->post('product_id');
        $Query = " SELECT * FROM product_image pm where pm.product_id = '".$product_id."'  and [language] = '".$lang."' order by pm.orders asc ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function getcategoryheader()
	{
		$categories = [];
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/category.json", false, stream_context_create($arrContextOptions)), true);
		return $results;
	}
	public function getcategory($cate = null)
	{
		$categories = [];
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/category.json", false, stream_context_create($arrContextOptions)), true);
		foreach ($results[0]['cate_list'] as $key => $item) {
			if(empty($cate)){
				if($item['cate_show'] == true){array_push($categories, $item);}
			}else{
				if($item['cate_id'] == $cate && $item['cate_show'] == true){array_push($categories, $item);}
			}
		}
		return $categories;
	}
	public function getproduct($product = null, $cate, $folder)
	{
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/".$folder."/products.json", false, stream_context_create($arrContextOptions)), true);
		if($product == null){
			return $results;
		}else{
			$products = [];
			foreach ($results[0]['product_list'] as $key => $item) {
				if($item['product_id'] == (int)$product && $item['product_show'] == true  && $item['product_type'] == 'image'){array_push($products, $item);}
			}
			return $products;
		}
	}
	public function getproductdetail($product, $folder)
	{
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/".$folder."/products.json", false, stream_context_create($arrContextOptions)), true);
		if($product == null){
			return $results;
		}else{
			foreach ($results[0]['product_list'] as $key => $item) {
				if($item['product_id'] == (int)$product && $item['product_show'] == true){
					$productfiles = array();
					foreach($item['product_file'] as $k => $files){
						if($files['product_type'] != "pdf"){
							array_push($productfiles, $files);
						}
					}
					$item['product_file'] = $productfiles;
					$results[0]['product_list'] = $item;
				}
			}
			return $results[0];
		}
	}
	public function getproductpdf($product, $folder)
	{
		$productfiles = array();
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/".$folder."/products.json", false, stream_context_create($arrContextOptions)), true);
		if($product == null){
			return $results;
		}else{
			foreach ($results[0]['product_list'] as $key => $item) {
				if($item['product_id'] == (int)$product && $item['product_show'] == true){
					
					foreach($item['product_file'] as $k => $files){
						if($files['product_type'] == "pdf"){
							array_push($productfiles, $files);
						}
					}
					$item['product_file'] = $productfiles;
					$results[0]['product_list'] = $item;
				}
			}
		}
		return $productfiles[0];
	}
	public function getmainmenu()
	{
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/main.json", false, stream_context_create($arrContextOptions)), true);
		$obj = $this->ToObject($results);
		return $obj;
	}
	public function ToObject($Array) {
		$object = new stdClass();
		foreach ($Array as $key => $value) {
			if (is_array($value)) {
				$value = $this->ToObject($value);
			}
			$object->$key = $value;
		}
		return $object;
	}




	public function getRequestHeaders() {
		$headers = array();
		$headers['Ishidestatus'] = '0';
		$headers['Language'] = 'th';
		
		foreach($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') { continue; }
			
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			if($header == 'Ishidestatus'){
				$headers['Ishidestatus'] = $value;
			}else{
				$headers[$header] = $value;
			}
			
			// Language
			if($header == 'Language'){
				$headers['Language'] = $value;
			}else{
				$headers[$header] = $value;
			}
		}
		return $headers;
	}
	
	// public function getcategoryjson($cate = null)
	// {
	// 	$categories = [];
	// 	$results = json_decode(file_get_contents(base_url("assete/datafile/category.json")), true);
	// 	foreach ($results as $key => $item) {
	// 		if(empty($cate)){
	// 			if($item['cate_show'] == true){array_push($categories, $item);}
	// 		}else{
	// 			if($item['cate_id'] == $cate && $item['cate_show'] == true){array_push($categories, $item);}
	// 		}
	// 	}
	// 	echo json_encode($categories);
	// }
	// public function getproductjson($product = null, $cate, $folder)
	// {
	// 	$products = array();
	// 	$results = json_decode(file_get_contents(base_url("assete/datafile/".$folder."/products.json")), true);
	// 	foreach ($results as $key => $item) {
	// 		if($product == 'null'){
	// 			if($item['product_cate'] == $cate && $item['product_show'] == true){array_push($products, $item);}
	// 		}else{
	// 			if($item['product_id'] == (int)$product && $item['product_cate'] == $cate && $item['product_show'] == true){array_push($products, $item);}
	// 		}
	// 	}
	// 	echo json_encode($products);
	// }
	// public function getproductimagejson($product, $folder)
	// {
	// 	$details = [];
	// 	$results = json_decode(file_get_contents(base_url("assete/datafile/".$folder."/productfile.json")), true);
	// 	foreach ($results as $key => $item) {
	// 		if($item['product_id'] == $product && $item['product_show'] == true && $item['product_type'] == 'image'){
	// 			array_push($details, $item);
	// 		}
	// 	}
	// 	echo json_encode($details);
	// }
	// public function getproductpdfjson($product, $folder)
	// {
	// 	$productpdf = '';
	// 	$results = json_decode(file_get_contents(base_url("assete/datafile/".$folder."/productfile.json")), true);
	// 	foreach ($results as $key => $item) {
	// 		if($item['product_id'] == $product && $item['product_show'] == false && $item['product_type'] == 'pdf'){
	// 			$productpdf = $item['product_path'];
	// 		}
	// 	}
	// 	echo json_encode($productpdf);
	// }


}
