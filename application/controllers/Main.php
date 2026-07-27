<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->library("pagination");
		
     	//เรียกใช้งาน Class helper     
        $this->load->helper('url'); 
      	$this->load->helper('form');
		$this->load->helper('file'); 
    }
	public function index(){
		$menu['mainmenu'] = 'home';
		$menu['submenu'] = 'home';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		
		//echo '<PRE>';print_r($menu);exit();
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/home');
		$this->load->view('desktop/footer');                          
	}
	public function home2(): void{
		$menu['mainmenu'] = 'home2';
		$menu['submenu'] = 'home2';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		
		//echo '<PRE>';print_r($menu);exit();
		//$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/home2');
		// $this->load->view('desktop/footer');                          
	}


	public function getSubcategoryList(){
		
		$Query = " SELECT * from product_subcategory ";
		$result = $this->db->query($Query)->result();

		return $result;
	}

		public function get_product_spec_details() {
    $product_id = $_POST['product_id'];
    $Query = " SELECT `product`.id,product.productcode,product.name,product.subtitle,product.is_show_specdetail,product.sub_category_id,product.thumnal, `product_category`.name as cate_name FROM `product` 
    LEFT JOIN `product_category` on `product`.category = `product_category`.id 
	where  product.active = '1'
	and product.id = '".$product_id."'
	 ORDER BY `product`.`sortting` asc ";
    $result = $this->db->query($Query)->result();

    $subCategoryList = $this->getSubcategoryList();
    
  
    foreach($result as $key => $value){
        $product_id = $value->id; 

       
        $sub_category_id = $value->sub_category_id;
        $index = false; 
        foreach ($subCategoryList as $subKey => $subValue) {
            if ($subValue->id == $sub_category_id) {
                $index = $subKey; 
                break; 
            }
        }
        if ($index !== false) {
            $result[$key]->sub_category_name = $subCategoryList[$index]->subcategory_name;
        }else{
            $result[$key]->sub_category_name = "";
        }
        
        
        
        $result[$key]->spec_details_html = $this->get_product_spec_summary($product_id);

    }
 

    $res = new stdClass();
    $res->status = true;
    $res->datas = $result;
    $res->massege = 'ดึงข้อมูล สำเร็จ';
    $res->status_code = '000';
    echo json_encode($res);
}
private function get_product_spec_summary($product_id) {
    // 1. ค้นหา Master Parent ID (Level 1)
    $this->db->select('id');
    $this->db->where('product_id', $product_id);
    // เปลี่ยนเงื่อนไขให้เข้ากับโครงสร้างข้อมูลในตารางที่คุณให้มา (ID 1 เป็น Master)
    $this->db->where('is_parent', 1)->where('name', 'MASTER'); 
    $master_parent = $this->db->get('product_spec_detail')->row();
    
    if (!$master_parent) {
        return '-';
    }
    $master_parent_id = $master_parent->id;

    // 2. ดึง Group (Level 2) และ Item (Level 3) ทั้งหมด
    // ดึงข้อมูลที่ไม่ใช่ Master Parent ออกมาทั้งหมด
    $this->db->select('id, name, value, is_parent, parent_id');
    $this->db->where('product_id', $product_id);
    $this->db->where('id !=', $master_parent_id);
    $this->db->order_by('id', 'ASC'); 
    $all_specs = $this->db->get('product_spec_detail')->result_array();

    // 3. จัดโครงสร้างข้อมูลเป็น Group-Item Hierarchy
    $groups_data = [];
    $current_group_id = 0;

    foreach ($all_specs as $spec) {
        // A. Group (Level 2): is_parent=1 และ parent_id ชี้ไปที่ Master ID
        if ($spec['is_parent'] == 1 && $spec['parent_id'] == $master_parent_id) {
            $current_group_id = $spec['id'];
            $groups_data[$current_group_id] = [
                'title' => $spec['name'],
                'items' => []
            ];
        } 
        // B. Item (Level 3): is_parent=0 และ parent_id ชี้ไปที่ Group ID 
        elseif ($spec['is_parent'] == 0 && isset($groups_data[$spec['parent_id']])) {
            $parent_group_id = $spec['parent_id'];
            
            // เพิ่ม Item เข้า Group ที่ถูกต้อง
            $groups_data[$parent_group_id]['items'][] = [
				"parent_id" => $spec["parent_id"],
                'title' => $spec['name'],
                'detail' => $spec['value']
            ];
        }
    }
   
	$returnData = [];
    foreach ($groups_data as $group) {
      
  

        if (!empty($group['items'])) {
         
            foreach ($group['items'] as $item) {
                $item_title = htmlspecialchars($item['title']);
                $item_detail = htmlspecialchars($item['detail']);
                
				$returnData[] = ["item_title"=>$item_title,"item_detail"=>$item_detail];
            }
          
        }
 
    }

   	//echo "<PRE>";print_r($groups_data);exit();
    return $groups_data;
}
	private function get_product_manual_summary($product_id) {
    // 1. ค้นหา Master Parent ID (ยังคงจำเป็นสำหรับการกรอง)
    $this->db->select('id');
    $this->db->where('product_id', $product_id);
    $this->db->where('is_parent', 1)->where('name', NULL);
    $master_parent = $this->db->get('product_manual_detail')->row();
    
    if (!$master_parent) {
        return '-';
    }
    $master_parent_id = $master_parent->id;

    // 2. ดึง Title และ Detail (name และ value) ที่ผูกกับ Master Parent
    // ใช้ SQL ที่ดึงข้อมูลจากตารางเดียว (t1) เพราะ Title และ Detail อยู่ในแถวเดียวกัน
    $Query = "
        SELECT 
            t1.name as title, 
            t1.value as detail_group  /* เปลี่ยนมาใช้ t1.value โดยตรง */
        FROM product_manual_detail t1
        /* ลบ LEFT JOIN ออก เพราะไม่จำเป็นต้อง Join ตัวเอง */
        WHERE t1.product_id = ? 
          AND t1.parent_id = ? /* ผูกกับ Master Parent ID */
          AND t1.name IS NOT NULL /* และต้องมี Title */
        ORDER BY t1.id ASC
    ";
    
    // ส่ง product_id และ master_parent_id เป็นพารามิเตอร์
    $specs = $this->db->query($Query, array($product_id, $master_parent_id))->result_array();

    $spec_display = [];
    foreach ($specs as $spec_row) {
        
        if ($spec_row['title']) {
            // ใช้ detail_group (ซึ่งตอนนี้คือ t1.value) โดยตรง
            $detail = $spec_row['detail_group'] ? $spec_row['detail_group'] : '-';
			$spec_display[] = ["title"=>$spec_row['title'] , "detail" =>$detail];
           // $spec_display[] = '<b>' . htmlspecialchars($spec_row['title']) . ':</b> ' . htmlspecialchars($detail);
        }
    }
    
    
    return $spec_display;
}
		public function get_document_list() {
    $product_id = $_POST["product_id"];
    $Query = " SELECT `product`.id,product.productcode,product.name,product.subtitle,product.is_show_specdetail,product.is_show_manualdetail,product.sub_category_id,product.thumnal, `product_category`.name as cate_name FROM `product` 
    LEFT JOIN `product_category` on `product`.category = `product_category`.id 
	
	 where  product.active = '1'
	 and  product.id = '".$product_id."'
	  ORDER BY `product`.`sortting` asc ";
    $result = $this->db->query($Query)->result();

    $subCategoryList = $this->getSubcategoryList();
    
  
    foreach($result as $key => $value){
        $product_id = $value->id; 

       
        $sub_category_id = $value->sub_category_id;
        $index = false; 
        foreach ($subCategoryList as $subKey => $subValue) {
            if ($subValue->id == $sub_category_id) {
                $index = $subKey; 
                break; 
            }
        }
        if ($index !== false) {
            $result[$key]->sub_category_name = $subCategoryList[$index]->subcategory_name;
        }else{
            $result[$key]->sub_category_name = "";
        }
        
        
        
        $result[$key]->manual_details_html = $this->get_product_manual_summary($product_id);

    }

	//echo "<PRE>";print_r($result);exit();
 

    $res = new stdClass();
    $res->status = true;
    $res->datas = $result;
    $res->massege = 'ดึงข้อมูล สำเร็จ';
    $res->status_code = '000';
    echo json_encode($res);
}
	public function get_home_products_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT  `product`.*, `product_category`.`name` as category_name
		,CASE
			WHEN `product`.`tag` IS NULL OR `product`.`tag` = '' THEN ''
			ELSE  (SELECT `name` FROM `product_tag` WHERE `product_tag`.`id` in(`product`.`tag`))
		END as tag_name
		FROM `product` 
		LEFT JOIN `product_category` ON `product`.`category` = `product_category`.`id` 
		WHERE `product_category`.`active` = 1  AND `product`.`active` = 1
		ORDER BY `product`.`sortting`  limit 6 ";
		
		$result = $this->db->query($Query)->result_array();
		

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_s(){
		echo '55';exit();
	}
	public function get_home_tg_slide_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `slide`.*
		FROM `slide` 
		WHERE `slide`.`active` = 1
		ORDER BY `slide`.`updated` DESC ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_home_knowledge_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `article`.*
		FROM `article` 
		WHERE `article`.`active` = 1
		ORDER BY `article`.`updated` DESC  LIMIT 3 ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_producttype_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `product_type`.*
		FROM `product_type` 
		WHERE `product_type`.`active` = 1
		ORDER BY `product_type`.`updated` DESC  LIMIT 3 ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_seo_id($id) {  
		//$id = $this->input->post('id');
        $Query = "SELECT *, '' as thumnal FROM page_seo WHERE id = $id ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		return $res;
	}

	public function about(){
		$menu['mainmenu'] = 'about';
		$menu['submenu'] = 'about';
		$menu['seo'] = $this->get_seo_id(5)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/about');
		$this->load->view('desktop/footer');                          
	}

	public function tg_help(){
		$menu['mainmenu'] = 'tg_help';
		$menu['submenu'] = 'tg_help';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/tg_help');
		$this->load->view('desktop/footer');                          
	}
	public function service_center(){
		$menu['mainmenu'] = 'service_center';
		$menu['submenu'] = 'service_center';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/service_center');
		$this->load->view('desktop/footer');                          
	}
	public function product_data_center(){
		$menu['mainmenu'] = 'product_data_center';
		$menu['submenu'] = 'product_data_center';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/product_data_center');
		$this->load->view('desktop/footer');                          
	}
	

	public function register_product(){
		$menu['mainmenu'] = 'register_product';
		$menu['submenu'] = 'register_product';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/register_product');
		$this->load->view('desktop/footer');                          
	}
	public function get_register_product_results() {  
		$register_code = $this->input->post('register_code');
		
        $Query = "SELECT `product_regis`.*, `product`.`name` FROM `product_regis` 
		LEFT JOIN `product` ON `product_regis`.`product_id` = `product`.`id`
		where `product_regis`.`bill_number` = '".$register_code."' OR `product_regis`.`tel_cus` = '".$register_code."' OR `product_regis`.`tel_idcart` = '".$register_code."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}


	public function create_suggestion(){
		$post_data = $_POST;
		if(!empty($post_data)){
			  // รับข้อมูลจากฟอร์ม
			  $data = array(
                'name' => $this->input->post('name'),
                'last_name' => $this->input->post('lastName'),
                'phone' => $this->input->post('phone'),
                'service_date' => $this->input->post('serviceDate'),
                'work_order_number' => $this->input->post('workOrderNumber'),
                'service_feedback' => $this->input->post('serviceFeedback')
            );
			// ทำการ Insert ข้อมูลลงฐานข้อมูล
			 $this->db->insert('service_feedback', $data);
			 $id = $this->db->insert_id();

			 $files = 'uploadFiles';
			$cpt = count($_FILES[$files]['name']);
			if($cpt > 0){
				for($i=0; $i < $cpt; $i++){  
					$upload_image = $this->do_upload_suggestion($files, $id, $i);
					if($upload_image->status){
						$obj_image = array( 
							'path' => $upload_image->data,
							'ref_id'=> $id,
							'created' => DATE('Y-m-d H:i:s'),
						
						);  
						$this->db->insert('suggesstion_images', $obj_image);
					}
				}  
			}

		}
		

		$res = new stdClass();
		$res->status = true;
		
		$res->massege = 'บันทึกข้อมูลสำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function create_maintain() {
		$post_data = $this->input->post();
		
		if (!empty($post_data)) {
			// รับข้อมูลจากฟอร์ม
			$data = array(
				'name' => $this->input->post('name'),
				'lastName' => $this->input->post('lastName'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'productType' => $this->input->post('productType'),
				'productModel' => $this->input->post('productModel'),
				'machineNumber' => $this->input->post('machineNumber'),
				'issueDescription' => $this->input->post('issueDescription')
			);
			
			// ทำการ Insert ข้อมูลลงฐานข้อมูล
			$this->db->insert('service_requests', $data);
			$id = $this->db->insert_id();
			
			// จัดการการอัพโหลดไฟล์หลักฐานการซื้อ
			if(isset($_FILES['purchaseProof'])){
				if (!empty($_FILES['purchaseProof']['name'])) {
					$upload_purchase_proof = $this->do_upload_ma_purchase('purchaseProof' ,$id);
					//$upload_image = $this->do_upload_ma_additional('purchaseProof' , $id , $i);
					if ($upload_purchase_proof->status) {
						$purchase_proof_data = array(
							'path' => $upload_purchase_proof->data,
							'group'=>"purchase_proof",
							'ref_id'=>$id,
							'created'=>DATE("Y-m-d H:i:s")
						);
						$this->db->insert('service_maintain_images', $purchase_proof_data);
					}
				}
			}
			
			// จัดการการอัพโหลดไฟล์ภาพและวิดีโอ
			$files = 'uploadFiles';
			if(isset($_FILES[$files])){
			$cpt = count($_FILES[$files]['name']);
			if ($cpt > 0) {
				for ($i = 0; $i < $cpt; $i++) {
					// $_FILES['file']['name'] = $_FILES[$files]['name'][$i];
					// $_FILES['file']['type'] = $_FILES[$files]['type'][$i];
					// $_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
					// $_FILES['file']['error'] = $_FILES[$files]['error'][$i];
					// $_FILES['file']['size'] = $_FILES[$files]['size'][$i];
					
					$upload_image = $this->do_upload_ma_additional($files , $id , $i);
					if ($upload_image->status) {
						$obj_image = array(
							'path' => $upload_image->data,
							'ref_id' => $id,
							'group'=>"addition",
							'created' => date('Y-m-d H:i:s')
						);
						$this->db->insert('service_maintain_images', $obj_image);
					}
				}
			}
		}
		}
		
		// ส่งผลลัพธ์กลับ
		$res = new stdClass();
		$res->status = true;
		$res->message = 'บันทึกข้อมูลสำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	private function do_upload($field_name) {
		$config['upload_path']   = './uploads/';  // ตั้งค่าตำแหน่งเก็บไฟล์
		$config['allowed_types'] = 'gif|jpg|png|pdf|docx|mp4';  // ประเภทไฟล์ที่อนุญาต
		$config['max_size']      = 20480;  // ขนาดไฟล์สูงสุด (20 MB)
		$config['overwrite']     = FALSE;  // ไม่เขียนทับไฟล์ที่มีชื่อเดียวกัน
	
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload($field_name)) {
			return (object) array('status' => false, 'error' => $this->upload->display_errors());
		} else {
			$data = $this->upload->data();
			return (object) array('status' => true, 'data' => $data['file_name']);
		}
	}
	
	public function do_upload_suggestion($files, $id, $i){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	false;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

		$_FILES['file']['name'] = $_FILES[$files]['name'][$i];
		$_FILES['file']['type'] = $_FILES[$files]['type'][$i];
		$_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
		$_FILES['file']['error'] = $_FILES[$files]['error'][$i];
		$_FILES['file']['size'] = $_FILES[$files]['size'][$i];

        ##### name img ####
        $_FILES['file']['name'] =  rand().".".pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);

        ##### create path ####
		$uploads_path = "./uploads/suggestion/".$id;
		if (!file_exists($uploads_path)) {
			if (!mkdir($uploads_path, 0777, true)) {//0777
				die($uploads_path.' Failed to create folders...');
			}
        }

        ##### create img to dir ####
        $fullPath = $uploads_path.'/'.$_FILES['file']['name'];
		$config['upload_path'] = $uploads_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		//$config['file_name'] = $_FILES['file']['name'];
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$path = $this->upload->data();
            $res->status = true;
			//$res->fileType = $_fileType;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }

	public function do_upload_ma_purchase($files, $id){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	false;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

		$_FILES['file']['name'] = $_FILES[$files]['name'];
		$_FILES['file']['type'] = $_FILES[$files]['type'];
		$_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'];
		$_FILES['file']['error'] = $_FILES[$files]['error'];
		$_FILES['file']['size'] = $_FILES[$files]['size'];

        ##### name img ####
        $_FILES['file']['name'] =  rand().".".pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);

        ##### create path ####
		$uploads_path = "./uploads/ma/".$id;
		if (!file_exists($uploads_path)) {
			if (!mkdir($uploads_path, 0777, true)) {//0777
				die($uploads_path.' Failed to create folders...');
			}
        }

        ##### create img to dir ####
        $fullPath = $uploads_path.'/'.$_FILES['file']['name'];
		$config['upload_path'] = $uploads_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		//$config['file_name'] = $_FILES['file']['name'];
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$path = $this->upload->data();
            $res->status = true;
			//$res->fileType = $_fileType;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function do_upload_ma_additional($files, $id, $i){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	false;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

		$_FILES['file']['name'] = $_FILES[$files]['name'][$i];
		$_FILES['file']['type'] = $_FILES[$files]['type'][$i];
		$_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
		$_FILES['file']['error'] = $_FILES[$files]['error'][$i];
		$_FILES['file']['size'] = $_FILES[$files]['size'][$i];

        ##### name img ####
        $_FILES['file']['name'] =  rand().".".pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);

        ##### create path ####
		$uploads_path = "./uploads/ma/".$id;
		if (!file_exists($uploads_path)) {
			if (!mkdir($uploads_path, 0777, true)) {//0777
				die($uploads_path.' Failed to create folders...');
			}
        }

        ##### create img to dir ####
        $fullPath = $uploads_path.'/'.$_FILES['file']['name'];
		$config['upload_path'] = $uploads_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		//$config['file_name'] = $_FILES['file']['name'];
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$path = $this->upload->data();
		
            $res->status = true;
			//$res->fileType = $_fileType;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function suggestion(){
		$menu['mainmenu'] = 'suggestion';
		$menu['submenu'] = 'suggestion'; 
		$menu['seo'] = "";
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/suggestion');
		$this->load->view('desktop/footer');                          
	}
	public function service_maintain(){
		$menu['mainmenu'] = 'service_maintain';
		$menu['submenu'] = 'service_maintain'; 
		$menu['seo'] = "";
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/service_maintain');
		$this->load->view('desktop/footer');                          
	}
    //####  Review ###//
	public function review(){
		$menu['mainmenu'] = 'review';
		$menu['submenu'] = 'review';
		$menu['seo'] = $this->get_seo_id(6)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/review');
		$this->load->view('desktop/footer');                          
	}
	public function review_detail($id){
		$menu['mainmenu'] = 'review';
		$menu['submenu'] = 'review';
		$menu['seo'] = $this->get_review_detail_seo_once($id)->datas;
		if(empty($menu['seo'][0]['seo_title'])){
			$menu['seo'] = $this->get_seo_id(6)->datas;
		}
		$data['id'] = $id;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/review_detail',$data);
		$this->load->view('desktop/footer');                          
	}
	
	public function get_review_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `review`.*, `product_category`.`name` as category_name 
		FROM `review` 
		LEFT JOIN `product_category` ON `review`.`product_cate` = `product_category`.`id` 
		WHERE `review`.`active` = 1
		ORDER BY `review`.`updated` DESC limit 10";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_review_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT `review`.* FROM `review` WHERE `review`.`active` = 1 AND `review`.`id` = $id  ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_review_images() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM `images` WHERE `ref_id` = $id AND `group` = 'review' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_review_detail_seo_once($id) {  
		//$id = $this->input->post('id');
        $Query = "SELECT `review`.`picture` as thumnal,`page_seo`.`seo_title`,`page_seo`.`seo_keyword`,`page_seo`.`seo_description`  
		FROM `review`
		LEFT JOIN `page_seo` ON `review`.`seo_id` = `page_seo`.`id`
		WHERE `review`.`id` = $id ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		return $res;
	}

	//####  Career ###//
	public function careers(){
		$menu['mainmenu'] = 'career';
		$menu['submenu'] = 'career';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/career');
		$this->load->view('desktop/footer');                          
	}

	
	public function faq(){
		$menu['mainmenu'] = 'faq';
		$menu['submenu'] = 'faq';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/faq');
		$this->load->view('desktop/footer');                          
	}

	
	public function get_faq() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT faq_main.topic as faq_main_topic , faq_sub.* FROM faq_main inner join faq_sub on faq_main.id = faq_sub.faq_main_id ";
		$result = $this->db->query($Query)->result_array();
		$returnData = [];
		foreach($result as $key => $value){
			if(!isset($returnData[$value['faq_main_id']])){
				$returnData[$value['faq_main_id']]['faq_main_id'] = $value['faq_main_id'];
				$returnData[$value['faq_main_id']]['faq_main_topic'] = $value['faq_main_topic'];
				$returnData[$value['faq_main_id']]['child'] = [];
			}
			$returnData[$value['faq_main_id']]['child'][] = $value;
		}
		$res = new stdClass();
		$res->status = true;
		$res->datas = array_values($returnData);
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function get_career_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT * FROM `career` WHERE `active` = 1";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	//####  tg service ###//
	public function tg_service(){
		$menu['mainmenu'] = 'tg_service';
		$menu['submenu'] = 'tg_service';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/tg_service');
		$this->load->view('desktop/footer');                          
	}
	public function get_tg_service_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT * FROM `others` WHERE `method` = 'tgsmartlifeservice'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	//#### tg project ###//
	public function tg_project(){
		$menu['mainmenu'] = 'tg_project';
		$menu['submenu'] = 'tg_project';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/tg_project');
		$this->load->view('desktop/footer');                          
	}
	public function get_tg_project_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT * FROM `others` WHERE `method` = 'tgsmartlifeproject'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	//#### Blog ###//
	public function get_product_detail_results() {  
		$id = $this->input->post('id');

		$Query = "SELECT  `product_spec`.`product_id`, `product_spec`.`detail` FROM `product_spec`
		
		WHERE `product_spec`.`product_id` = ".$id;
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function get_product_warranty_results() {  
		$id = $this->input->post('id');

		$Query = "SELECT  `product`.`name`, `product`.`warranty` FROM `product`
		
		WHERE `product`.`id` = ".$id;
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function knowledge(){
		$menu['mainmenu'] = 'blog';
		$menu['submenu'] = 'blog';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/knowledge');
		$this->load->view('desktop/footer');                          
	}
	public function term_of_condition(){
		$menu['mainmenu'] = 'contactus';
		$menu['submenu'] = 'term_of_condition';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/term_of_condition');
		$this->load->view('desktop/footer');                          
	}
	public function term_of_refund(){
		$menu['mainmenu'] = 'contactus';
		$menu['submenu'] = 'term_of_refund';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/term_of_refund');
		$this->load->view('desktop/footer');                          
	}
	public function pdpa(){
		$menu['mainmenu'] = 'contactus';
		$menu['submenu'] = 'pdpa';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/pdpa');
		$this->load->view('desktop/footer');                          
	}
	public function shipping_policy(){
		$menu['mainmenu'] = 'contactus';
		$menu['submenu'] = 'shipping_policy';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/shipping_policy');
		$this->load->view('desktop/footer');                          
	}
	
	public function warranty($id){
	
		$menu['mainmenu'] = 'warranty';
		$menu['submenu'] = 'warranty';
		$menu['seo'] = $this->get_seo_id(3)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/warranty' , ['id'=>$id]);
		$this->load->view('desktop/footer');                          
	}
	public function knowledge_detail($id){
		$menu['mainmenu'] = 'blog';
		$menu['submenu'] = 'blog';
		$menu['seo'] = $this->get_knowledge_detail_seo_once($id)->datas;
		if(empty($menu['seo'][0]['seo_title'])){
			$menu['seo'] = $this->get_seo_id(3)->datas;
		}
		$data['id'] = $id;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/knowledge_detail',$data);
		$this->load->view('desktop/footer');                          
	}
	public function get_knowledge_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `article`.*, `product_category`.`name` as category_name 
		FROM `article` 
		LEFT JOIN `product_category` ON `article`.`product_cate` = `product_category`.`id` 
		WHERE `article`.`active` = 1
		ORDER BY `article`.`updated` DESC ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_knowledge_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT `article`.* FROM `article` WHERE `article`.`active` = 1 AND `article`.`id` = $id  ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_knowledge_images() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM `images` WHERE `ref_id` = $id AND `group` = 'blog' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_knowledge_detail_seo_once($id) {  
		//$id = $this->input->post('id');
        $Query = "SELECT `article`.`picture` as thumnal,`page_seo`.`seo_title`,`page_seo`.`seo_keyword`,`page_seo`.`seo_description` 
		FROM `article` 
		LEFT JOIN `page_seo` ON `article`.`seo_id` = `page_seo`.`id`
		 WHERE `article`.`id` = $id ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		return $res;
	}

	//#### Product ###//
	public function products(){
		

		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$menu['seo'] = $this->get_seo_id(2)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/products');
		$this->load->view('desktop/footer');                          
	}
	public function products_test(){
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$menu['seo'] = $this->get_seo_id(2)->datas;
		$data['category'] = $this->get_product_category_use();
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/products_test',$data);
		$this->load->view('desktop/footer');                          
	}

	public function get_product_data_center_count_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT  `product`.*, `product_spec`.`link` as spec_link, `product_spec`.`file_path` as spec_path, `product_spec`.`detail` as spec_detail
		FROM `product` 
		LEFT JOIN `product_spec` ON `product`.`id` = `product_spec`.`product_id` 
		WHERE `product`.`active` = 1  
		ORDER BY `product`.`sortting`, `product`.`updated` DESC ";
		$result = $this->db->query($Query)->result_array();

		return count($result);
	}

	// product data center page 
	public function get_product_data_center_results($rowno = null) {  
		
		$rowno= $this->input->post('rowno') ? $this->input->post('rowno') : 0;
		$rowperpage =12;
		// row position
		  if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		  }
		  
        $Query = "SELECT  `product`.*, `product_spec`.`link` as spec_link, `product_spec`.`file_path` as spec_path
		, `product`.`warranty` as spec_warranty
		FROM `product` 
		LEFT JOIN `product_spec` ON `product`.`id` = `product_spec`.`product_id` 
		WHERE `product`.`active` = 1  
		ORDER BY `product`.`sortting`, `product`.`updated` DESC ";
		$Query .= " limit {$rowno},{$rowperpage}";	
	
		$result = $this->db->query($Query)->result_array();

		// pagniation setup 
		$config = $this->paginationConfig();
		$config['base_url'] = base_url().'product-data-center';
		$config['total_rows'] = $this->get_product_data_center_count_results();
		$config['per_page'] = 12;
		$config["uri_segment"] = 3;		
		 $this->pagination->initialize($config);

		// eof 
		$res = new stdClass();
		$res->status = true;
		$res->pagination = $this->pagination->create_links();
		$res->row = $rowno;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}


	public function get_review_results_count_paginate($cate_id = null) {
		$Query = "SELECT `review`.*, `product_category`.`name` as category_name 
		FROM `review` 
		LEFT JOIN `product_category` ON `review`.`product_cate` = `product_category`.`id` 
		WHERE `review`.`active` = 1";
		if(!empty($cate_id)){
			$Query .= " AND `product_category`.`id` = ".$cate_id ;
		}
		$Query .=  " ORDER BY `review`.`updated` ";
		$result = $this->db->query($Query)->result_array();
		return count($result);
	}
	public function get_review_results_paginate() {  
		//echo $row_number;exit();
		$category_id = $this->input->post('category_id');
		$rowno= $this->input->post('rowno') ? $this->input->post('rowno') : 0;
		$rowperpage =9;
		// row position
		  if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		  }
	
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `review`.*, `product_category`.`name` as category_name 
		FROM `review` 
		LEFT JOIN `product_category` ON `review`.`product_cate` = `product_category`.`id` 
		WHERE `review`.`active` = 1 ";
		if(!empty($category_id)){
			$Query .= " AND `product_category`.`id` = ".$category_id ;
		}
		$Query .= " ORDER BY `review`.`updated` DESC limit {$rowno},{$rowperpage}";	
		
		$result = $this->db->query($Query)->result_array();
		// pagniation setup 
		$config = $this->paginationConfig();
		$config['base_url'] = base_url().'review';
		$config['total_rows'] = $this->get_review_results_count_paginate($category_id);
		
		$config['per_page'] = 9;
		$config["uri_segment"] = 3;
	
        $this->pagination->initialize($config);

		// eof 


		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->pagination = $this->pagination->create_links();
		
		$res->row = $rowno;
		
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	 // Select total records
	 public function get_products_count($cate_id = null) {

		$Query = "SELECT  `product`.*, `product_subcategory`.`subcategory_name`, `product_tag`.`name` as `tag_name`, `product_tag`.`backgroundcolor`
		FROM `product` 
		LEFT JOIN `product_subcategory` ON `product`.`category` = `product_subcategory`.`id` 
		LEFT JOIN `product_tag` ON `product`.`tag` = `product_tag`.`id` 
		WHERE  `product`.`active` = 1 ";
		if(!empty($cate_id)){
		
			$Query .= " AND `product`.`sub_category_id` = ".$cate_id ;
		}
		$Query .= " ORDER BY `product`.`sortting`, `product`.`updated` DESC ";		
		$result = $this->db->query($Query)->result_array();

		return count($result);
	  }

	  public function get_product_subcategory() {   
		
		$Query = "  SELECT product_category.id as cate_id,product_subcategory.id,product_subcategory.subcategory_name,category_rel_subcategory.subcategory_id,product_category.name FROM category_rel_subcategory
		inner join product_subcategory on product_subcategory.id = category_rel_subcategory.subcategory_id 
		inner join product_category on product_category.id = category_rel_subcategory.category_id
		";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_products_results($row_number = null) {
		//echo $row_number;exit();
		$sub_category_id = $this->input->post('sub_category_id');
	
		$rowno= $this->input->post('rowno') ? $this->input->post('rowno') : 0;
		$rowperpage =9;
		// row position
		  if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		  }
	 
		// echo $rowno;exit();
		
	
        $Query = "SELECT  `product`.*, `product_category`.`name` as `category_name`, `product_tag`.`name` as `tag_name`, `product_tag`.`backgroundcolor`
		
		FROM `product` 
		LEFT JOIN `product_category` ON `product`.`category` = `product_category`.`id` 
		LEFT JOIN `product_tag` ON `product`.`tag` = `product_tag`.`id` 
		WHERE `product_category`.`active` = 1  AND `product`.`active` = 1 ";
		if(!empty($sub_category_id)){
			$Query .= " AND `product`.`sub_category_id` = ".$sub_category_id ;
		}
		$Query .= " ORDER BY `product`.`sortting`, `product`.`updated` DESC limit {$rowno},{$rowperpage}";		
		$result = $this->db->query($Query)->result_array();
		// echo $Query;exit();
		// pagniation setup 
		$config = $this->paginationConfig();
		$config['base_url'] = base_url().'products';
		$config['total_rows'] = $this->get_products_count($sub_category_id);
		$config['per_page'] = 9;
		$config["uri_segment"] = 3;
		
        $this->pagination->initialize($config);

		// eof 


		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->pagination = $this->pagination->create_links();
		
		$res->row = $rowno;
	
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function paginationConfig(){
		$config = [];
		
		// $config['use_page_numbers'] = TRUE;
	
		$config['per_page'] = 9;
		$config["use_page_numbers"] = TRUE;
	  
	    $config['full_tag_open'] = '<ul class="pagination" style="float:right !important;">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active" ><a class="" href="#" style="background-color:red;color:white;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		return $config;
		
	}
	public function get_products_tag() {  
		$tag = $this->input->post('tag');
        $Query = "SELECT * FROM `product_tag` WHERE `product_tag`.`id` in($tag)  AND `product_tag`.`active` = 1";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function product_detail($id){
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$menu['seo'] = $this->get_product_detail_seo_once($id)->datas;
		$data['id'] = $id;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/product_detail',$data);
		$this->load->view('desktop/footer');                          
	}
	public function get_product_detail_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT `product`.* FROM `product` WHERE `product`.`active` = 1 AND `product`.`id` = $id  ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_detail_seo_once($id) {  
		//$id = $this->input->post('id');
        $Query = "SELECT `product`.`thumnal`,`page_seo`.`seo_title`,`page_seo`.`seo_keyword`,`page_seo`.`seo_description`  FROM `product` 
		LEFT JOIN `page_seo` ON `product`.`seo_id` = `page_seo`.`id`
		WHERE `product`.`id` = $id ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		return $res;
	}
	public function get_product_images() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM `images` WHERE `ref_id` = $id AND `group` = 'product' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_related() {  
		$tag = $this->input->post('tag');
        $Query = "SELECT `product`.* FROM `product` WHERE `product`.`active` = 1 AND `product`.`tag` order by id desc limit 5;";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_category_used() {   
	
		$Query = " SELECT * FROM product_category WHERE active = '1'";
		$result = $this->db->query($Query)->result();
		
		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_category_use() {   
		$Query = " SELECT * FROM product_category WHERE active = '1'";
		$result = $this->db->query($Query)->result();
		return $result;
	}
	public function get_product_tags_used() {   
	
		$Query = " SELECT * FROM product_tag WHERE active = '1'";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function create_user() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`active` = 1 ORDER BY `general_setting`.`updated` DESC ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}



	//#### Generals ###//
	public function get_general_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`active` = 1 ORDER BY `general_setting`.`updated` DESC ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	//#### company profile ###//
	public function companyprofile() {  
		$menu['mainmenu'] = 'companyprofile';
		$menu['submenu'] = 'companyprofile';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/company_profile');
		$this->load->view('desktop/footer');      
	}

	//#### service center ###//
	public function servicecenter() {  
		$menu['mainmenu'] = 'servicecenter';
		$menu['submenu'] = 'servicecenter';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/service_center');
		$this->load->view('desktop/footer');      
	}

	//#### support ###//
	public function support() {  
		$menu['mainmenu'] = 'support';
		$menu['submenu'] = 'support';
		$menu['seo'] = $this->get_seo_id(4)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/support');
		$this->load->view('desktop/footer');      
	}

	//#### contact us ###//
	public function contactus() {  
		$menu['mainmenu'] = 'contactus';
		$menu['submenu'] = 'contactus';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/contactus');
		$this->load->view('desktop/footer');      
	}
	public function contactus_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$name = $this->input->post('name');
		$tel = $this->input->post('tel');
		$email = $this->input->post('email');
        $message = $this->input->post('message');
		//$active = $this->input->post('active');
		
        $obj = array( 
			'name' => $name,
			'tel' => $tel,
			'email' => $email,
			'message' => $message,
			'active' => 0,
			'created' => $curent_date,
			'updated' => $curent_date,
		);

		//###  INSERT ###//
		$this->db->insert('web_contact', $obj);
		$id = $this->db->insert_id();

		$res->status = true;
		$res->datas = base_url('contact-us');
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';
        
		echo json_encode($res);
	}


	//### installation agent ###//
	public function installation_agent() {  
		$menu['mainmenu'] = 'installation_agent';
		$menu['submenu'] = 'installation_agent';
		$menu['seo'] = $this->get_seo_id(1)->datas;
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/installation_agent');
		$this->load->view('desktop/footer');      
	}
	public function get_installation_agent_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT `register`.* FROM `register` WHERE active = 1";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}


	
























}