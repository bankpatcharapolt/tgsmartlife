<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Product extends Main {

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
	//###  PRODUCT   ###/
	public function product_page(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product');
		$this->load->view('admin/footer');
	}
	public function product_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_add');
		$this->load->view('admin/footer');
	}
	public function product_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_product_onc() {   
		$id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('product'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product() {   
		
		$Query = " SELECT `product`.*, `product_category`.name as cate_name FROM `product` 
		LEFT JOIN `product_category` on `product`.category = `product_category`.id  ORDER BY `product`.`sortting` asc  ";
		$result = $this->db->query($Query)->result();


		$subCategoryList = $this->getSubcategoryList();
		//echo '<PRE>';print_r($subCategoryList);exit();
		foreach($result as $key => $value){
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
		}

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	
	public function get_product_manual_detail() {
    
    $Query = " SELECT `product`.id,product.productcode,product.name,product.subtitle,product.is_show_specdetail,product.is_show_manualdetail,product.sub_category_id,product.thumnal, `product_category`.name as cate_name FROM `product` 
    LEFT JOIN `product_category` on `product`.category = `product_category`.id  where  product.active = '1' ORDER BY `product`.`sortting` asc ";
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
 

    $res = new stdClass();
    $res->status = true;
    $res->datas = $result;
    $res->massege = 'ดึงข้อมูล สำเร็จ';
    $res->status_code = '000';
    echo json_encode($res);
}

	public function get_product_spec_detail() {
    
    $Query = " SELECT `product`.id,product.productcode,product.name,product.subtitle,product.is_show_specdetail,product.sub_category_id,product.thumnal, `product_category`.name as cate_name FROM `product` 
    LEFT JOIN `product_category` on `product`.category = `product_category`.id where  product.active = '1' ORDER BY `product`.`sortting` asc ";
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
            $spec_display[] = '<b>' . htmlspecialchars($spec_row['title']) . ':</b> ' . htmlspecialchars($detail);
        }
    }
    
    
    return implode('<br>', $spec_display);
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
                'title' => $spec['name'],
                'detail' => $spec['value']
            ];
        }
    }
    
    // 4. แปลงโครงสร้าง Hierarchy เป็น HTML List (Tree View)
    $html = '<ul style="padding-left: 15px; margin-bottom: 0px; list-style-type: none;">';

    foreach ($groups_data as $group) {
        // แสดง Group Title (Level 2)
        $html .= '<li>';
        $html .= '<b>' . htmlspecialchars($group['title']) . '</b>';

        if (!empty($group['items'])) {
            // เริ่มรายการย่อย (Level 3)
            $html .= '<ul style="padding-left: 20px; list-style-type: disc; margin-bottom: 0px;">';
            foreach ($group['items'] as $item) {
                $item_title = htmlspecialchars($item['title']);
                $item_detail = htmlspecialchars($item['detail']);
                
                // แสดง Item: Title: Detail
                $html .= '<li>' . $item_title . ': ' . ($item_detail ? $item_detail : '-') . '</li>';
            }
            $html .= '</ul>';
        }
        $html .= '</li>';
    }

    $html .= '</ul>';
    
    return $html;
}
	public function getSubcategoryList(){
		
		$Query = " SELECT * from product_subcategory ";
		$result = $this->db->query($Query)->result();

		return $result;
	}
	public function getSubcategory(){

		$category_id = $this->input->post('category');
		$Query = " SELECT product_subcategory.subcategory_name,category_rel_subcategory.subcategory_id FROM category_rel_subcategory
		 inner join product_subcategory on product_subcategory.id = category_rel_subcategory.subcategory_id ";
		
		$Query .= "WHERE category_id = '{$category_id}'";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);

	}
	public function product_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		//$productcode = Date('YmdHis');
        $productcode = $this->input->post('productcode');
        $name = $this->input->post('name');
        $regis_name = $this->input->post('regis_name');
        $subtitle = $this->input->post('subtitle');
        $counts = $this->input->post('counts');
        $price = $this->input->post('price');
        $saleprice = $this->input->post('saleprice');
		$category = $this->input->post('category');
		$sub_category_id = $this->input->post('sub_category_id');
		
		$tag = '';
		if(!empty($this->input->post('tag'))){ $tag = implode(",",$this->input->post('tag'));}

		//$tag = implode(",",(!empty($this->input->post('tag')))?$this->input->post('tag'):null);
		$detail = $this->input->post('detail');
		$warranty = $this->input->post('warranty');
		$salerphone = $this->input->post('salerphone');
		$seo = $this->input->post('seo');
		$active = $this->input->post('active');

        $obj = array(
			'productcode'=>$productcode,
			// 'thumnal' => '',
			'name' => $name, 
			'regis_name' => $regis_name,
			'subtitle' => $subtitle, 
			'counts' => $counts, 
			'price' => $price, 
			'saleprice' => $saleprice, 
			'category' => $category,
			'sub_category_id' => $sub_category_id,
			'tag' => $tag,
			'detail' => $detail,
			'warranty' => $warranty,
			'salerphone' => $salerphone,
			'seo_id' => $seo,
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_product');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_product');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		
		//###  thumnal ###///
		if (!empty($_FILES['thumnal']['name'])) {
			$upload = $this->do_upload_thumnel('thumnal', $id);
			if($upload->status){
				$img['thumnal'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('product', $img);
			}
		}

		//###  Files Image  ###//
		$files = 'images';
		$cpt = count($_FILES[$files]['name']);
		if($cpt > 0){
			for($i=0; $i < $cpt; $i++){  
				$upload_image = $this->do_upload_image($files, $id, $i);
				if($upload_image->status){
					$obj_image = array( 
						'path' => $upload_image->data,
						'ref_id'=> $id,
						'group' => 'product',
						'created' => $curent_date,
						'updated' => $curent_date
					);  
					$this->db->insert('images', $obj_image);
				}
			}  
		}

		//###  Files Image  ###//
		$files = 'pdf_files';
		// Check if $_FILES[$files] is set and is an array
	
		if (isset($_FILES[$files]) && isset($_FILES[$files]['name'])) {
				$cpt = isset($_FILES[$files]['name']);
				
				if($cpt){
					
					$upload_image = $this->do_upload_manual_files("pdf_files", $id);
						if($upload_image->status){
							$manualFiles = [];
							
							$manualFiles['manual_path'] = trim($upload_image->data);
							$this->db->where('id', $id);
							$this->db->update('product', $manualFiles);
						}
				}
			}
		

		$res->status = true;
		$res->datas = base_url('admin_product');
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';


		echo json_encode($res);
	}
	public function del_product(){
		$id = $this->input->post('id');
		$this->deleted_product($id);
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_tag_used() {   
	
		$Query = " SELECT * FROM product_tag WHERE active = '1'";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_type_used() {   
	
		$Query = " SELECT * FROM product_type WHERE active = '1'";
		$result = $this->db->query($Query)->result();

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
	public function get_images() {
		$id = $this->input->post('id');
		$Query = " SELECT * FROM images WHERE ref_id = '".$id."' and `group` = 'product' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function do_upload_thumnel($files, $id){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png|pdf'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		$_FILES[$files]['name'] = 'thumnal.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/images/product/".$id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }
		
        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		@unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function do_upload_image($files, $id, $i){
		
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
		$uploads_path = "./uploads/images/product/".$id;
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

	public function do_upload_manual_files($files, $product_id){
        $res = new stdClass();
		$config= [];
        $config['allowed_types'] = '*'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
		$config['assets'] = 'jpg|jpeg|jpe|png|gif|mov|mpeg|mp3|wav|aiff|pdf|css|zip|svg';
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		// $_FILES[$files]['name'] = 'product.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/images/product/".$product_id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		 @unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }

	
	
	public function del_image() { 
		$id = $this->input->post('id');
		$ref_id = $this->input->post('ref_id');

		$Query = " SELECT * FROM images WHERE id = '".$id."' AND ref_id = '".$ref_id."' AND `group` = 'product'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);
			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('ref_id', $item->ref_id);
			$this->db->where('group', 'product');
    		$this->db->delete('images');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}
	public function update_product_sorting(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		
		$id = $this->input->post('id');
        $sortable = $this->input->post('sortable');
		
        $obj = array( 
			'sortting' => $sortable,
		); 

		$obj['updated'] = date(date_format(date_create(),"Y-m-d H:i:s"));
        $this->db->where("id", $id);
        $this->db->update("product", $obj); 

		$res->status = true;
		//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
		$res->datas = base_url('admin_product');
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';

		echo json_encode($res);
	}
	public function get_product_seo_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM page_seo WHERE category = 'product'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}



	//###   CATEGORY   ###/
	public function category_page(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'category';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_cate');
		$this->load->view('admin/footer');
	}
	
	public function category_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'category';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_cate_add');
		$this->load->view('admin/footer');
	}
	public function category_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'category';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_cate_edit',$data);
		$this->load->view('admin/footer');
	}
	//###   SUB CATEGORY   ###/
	public function sub_category_page(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'sub_category';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_subcate');
		$this->load->view('admin/footer');
	}
	public function sub_category_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'sub_category';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_subcate_add');
		$this->load->view('admin/footer');
	}
	public function sub_category_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'sub_category';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_subcate_edit',$data);
		$this->load->view('admin/footer');
	}

	public function get_product_subcategory_onc() {   
		$id = $this->input->post('id');
        $q = " SELECT product_subcategory.id,product_subcategory.subcategory_name,category_rel_subcategory.category_id FROM product_subcategory 
			inner join category_rel_subcategory on category_rel_subcategory.subcategory_id = product_subcategory.id 
			where product_subcategory.id = {$id}
		";
     	$query = $this->db->query($q);
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function check_product_rel(){
		$id = $this->input->post('id');
	
        $this->db->select('product.name');
        $this->db->where('sub_category_id', $id);
        $this->db->from('product'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);

	}


	public function del_subcategory() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_subcategory');

		//### delete category ###///
		$this->db->where('subcategory_id', $id);
		$this->db->delete('category_rel_subcategory');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function get_product_category_onc() {   
		$id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('product_category'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_category() {   
		
		$Query = " SELECT * FROM product_category ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
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


	public function category_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $name = $this->input->post('name');
		$active = $this->input->post('active');
		
        $obj = array( 
			'name' => $name,
			//'detail' => $detail,
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_category', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_product_category');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product_category", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_category');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}

	public function sub_category_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$category_id = $this->input->post('category_id');
        $subcategory_name = $this->input->post('subcategory_name');
		// $active = $this->input->post('active');
		
        $obj = array( 
			'subcategory_name' => $subcategory_name,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_subcategory', $obj);
   			$id = $this->db->insert_id();

			// table เก็บความสัมพันธ์ระหว่าง category กับ subcategory
			$cate_rel_sub = [
				'category_id' => $category_id,
				'subcategory_id' => $id,
				'created'=>$curent_date
			];
			$this->db->insert('category_rel_subcategory', $cate_rel_sub);
			

			$res->status = true;
			$res->datas = base_url('admin_product_subcategory');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product_subcategory", $obj); 

			// table เก็บความสัมพันธ์ระหว่าง category กับ subcategory
			$cate_rel_sub = [
				'category_id' => $category_id,
				'created'=>$curent_date
			];

			$this->db->where("subcategory_id", $id); 
			$this->db->update("category_rel_subcategory", $cate_rel_sub); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_subcategory');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function del_category() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_category');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}


	//###   TAG   ###/
	public function tag_page(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'tag';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_tag');
		$this->load->view('admin/footer');
	}
	public function tag_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'tag';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_tag_add');
		$this->load->view('admin/footer');
	}
	public function tag_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'tag';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_tag_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_product_tag_onc() {   
		$id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('product_tag'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_tag() {   
		
		$Query = " SELECT * FROM product_tag ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function tag_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $backgroundcolor = $this->input->post('backgroundcolor');
		$active = $this->input->post('active');
		
        $obj = array( 
			'name' => $name,
			'backgroundcolor' => $backgroundcolor,
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_tag', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_product_tag');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product_tag", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_tag');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function del_tag() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_tag');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	//###   TYPE   ###/
	public function type_page(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'type';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_type');
		$this->load->view('admin/footer');
	}
	public function type_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'type';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_type_add');
		$this->load->view('admin/footer');
	}
	public function type_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'type';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_type_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_product_type_onc() {   
		$id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('product_type'); 
        $query = $this->db->get(); 
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_type() {   
		
		$Query = " SELECT * FROM product_type ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function type_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $link = $this->input->post('link');
		$active = $this->input->post('active');
		
        $obj = array( 
			'name' => $name,
			'link' => $link,
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_type', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_product_type');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product_type", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_type');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  thumnal ###///
		if (!empty($_FILES['thumnal']['name'])) {
			$upload = $this->type_do_upload_thumnel('thumnal', $id);
			if($upload->status){
				$img['thumnal'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('product_type', $img);
			}
		}

		echo json_encode($res);
	}
	public function type_do_upload_thumnel($files, $id){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		$_FILES[$files]['name'] = 'thumnal.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/images/product_type/".$id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		@unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function del_type() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_type');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	//###   SPEC   ###/
	public function spec_page(){	
		$menu['mainmenu'] = 'spec';
		$menu['submenu'] = 'spec';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_spec');
		$this->load->view('admin/footer');
	}
	public function spec_detail(){	
		$menu['mainmenu'] = 'spec_detail';
		$menu['submenu'] = 'spec_detail';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_specdetail');
		$this->load->view('admin/footer');
	}


	public function manual_detail(){	
		$menu['mainmenu'] = 'manual_detail';
		$menu['submenu'] = 'manual_detail';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_manualdetail');
		$this->load->view('admin/footer');
	}
	
	
	
public function getProductSpecs() {
    $product_id = $this->input->post('product_id');

    // 1. ดึงสถานะ is_show_specdetail
    $this->db->select('is_show_specdetail');
    $this->db->where('id', $product_id);
    $product_info = $this->db->get('product')->row();
    $is_checked = $product_info ? $product_info->is_show_specdetail : 0;

    // 2. ค้นหา Master Parent ID (Level 1)
    // เงื่อนไข: product_id, is_parent=1, name=NULL
    $this->db->select('id');
    $this->db->where('product_id', $product_id);
    $this->db->where('is_parent', 1);
    $this->db->where('name', "MASTER"); 
    $master_parent = $this->db->get('product_spec_detail')->row();

    if (!$master_parent) {
        // หากไม่พบ Master Parent (ยังไม่มีข้อมูล) ให้ส่ง Array ว่างกลับ
        echo json_encode(['groups_data' => [], 'is_checked' => $is_checked]);
        return;
    }
	
    $master_parent_id = $master_parent->id;

    // 3. ดึงข้อมูล Group (Level 2) และ Item (Level 3) ทั้งหมด
    $this->db->select('id, product_id, is_parent, name, value, parent_id');
    $this->db->where('product_id', $product_id);
    $this->db->where('id !=', $master_parent_id); // ไม่เอา Master Parent ออกมา
    $this->db->order_by('id', 'ASC'); // เรียงตามลำดับการสร้าง
    $all_specs = $this->db->get('product_spec_detail')->result_array();

    // 4. จัดโครงสร้างข้อมูลเป็น Group-Item Hierarchy
    $groups_data = [];
    $groups_map = []; // ใช้สำหรับอ้างอิง Group ID อย่างรวดเร็ว

    foreach ($all_specs as $spec) {
        // A. Group (Level 2): is_parent=1 และ parent_id ชี้ไปที่ Master Parent ID
        if ($spec['is_parent'] == 1 && $spec['parent_id'] == $master_parent_id) {
            $group_id = $spec['id'];
            $groups_map[$group_id] = [
                'group_id' => $group_id,
                'group_title' => $spec['name'],
                'items' => [] // เตรียม array สำหรับ Spec Item (Level 3)
            ];
            // เพิ่ม Group เข้าไปใน groups_data เพื่อรักษาลำดับ (ใช้ Reference & เพื่อให้ Spec Item สามารถใส่ข้อมูลเข้าไปได้)
            $groups_data[] =& $groups_map[$group_id]; 
		

        // B. Spec Item (Level 3): is_parent=0 และ parent_id ชี้ไปที่ Group ID
        } elseif ($spec['is_parent'] == 0 && isset($groups_map[$spec['parent_id']])) {
            $parent_group_id = $spec['parent_id'];
            
            // เพิ่ม Spec Item เข้าไปใน Group ที่เกี่ยวข้อง
            // ตรวจสอบว่ามีข้อมูล title หรือ detail หรือไม่ ก่อนเพิ่ม
            if (!empty(trim($spec['name'])) || !empty(trim($spec['value']))) {
                $groups_map[$parent_group_id]['items'][] = [
                    'id' => $spec['id'],
                    'title' => $spec['name'],
                    'detail' => $spec['value']
                ];
            }
        }
    }
    
    // ลบการอ้างอิงหลังจากใช้งานเสร็จ
    unset($groups_map);

    // 5. ส่งข้อมูลกลับไปให้ JavaScript
    echo json_encode([
        'groups_data' => $groups_data, // ข้อมูล Group-Item 3 ชั้น
        'is_checked' => $is_checked     // ค่าสถานะ Checkbox 1 หรือ 0
    ]);
}
// public function getProductSpecs() {
//     $product_id = $this->input->post('product_id');

//     // 1. ตรวจสอบ Master Parent ID
//     // ค้นหา Master Parent เพื่อใช้ ID ในการกรอง Children
//     $this->db->select('id');
//     $this->db->where('product_id', $product_id);
//     $this->db->where('is_parent', 1);
//     $this->db->where('name', NULL); // เงื่อนไข Master Parent
//     $master_parent = $this->db->get('product_spec_detail')->row();

//     if (!$master_parent) {
//         // หากไม่พบ Master Parent (ยังไม่มีข้อมูล) ให้ส่ง Array ว่างกลับ
//         echo json_encode([]);
//         return;
//     }
    

//     $this->db->select('is_show_specdetail');
//     $this->db->where('id', $product_id);
//     $product_info = $this->db->get('product')->row();
//     $is_checked = $product_info ? $product_info->is_show_specdetail : 0;


//     $master_parent_id = $master_parent->id;

//     // 2. ดึงข้อมูล Children (Titles และ Details) ทั้งหมด
//     // ดึงเฉพาะแถวที่ไม่ได้เป็น Master Parent
//     $this->db->select('id, name AS title, value, parent_id');
//     $this->db->where('product_id', $product_id);
//     $this->db->where('id !=', $master_parent_id); // ไม่เอา Master Parent ออกมา
//     $this->db->order_by('id', 'ASC'); // เรียงตามลำดับการสร้าง
//     $all_children = $this->db->get('product_spec_detail')->result_array();

//     // 3. จัดกลุ่ม Titles และ Details ให้อยู่ในรูปแบบคู่ที่ JS คาดหวัง
//     $result_array = [];
//     $current_title = null;
//     $current_title_id = null;

//     foreach ($all_children as $row) {
//         // แถวที่เก็บ Title (Level 2)
//         if ($row['title'] !== NULL && $row['parent_id'] == $master_parent_id) {
//               $current_value = $row['value'];
// 			  $current_title = $row["title"];
// 			  $current_title_id = $row["id"];
//            $result_array[] = [
//                     'id'    => $current_title_id,
//                     'title' => $current_title,
//                     'detail' =>$current_value
//                 ];
			
          

//         // แถวที่เก็บ Detail (Level 3)
//         } elseif ($row['value'] !== NULL && $row['parent_id'] == $current_title_id) {
          
//         }
//     }
    
  
    
//     // 4. ส่งข้อมูลกลับไปให้ JavaScript
//     echo json_encode([
//         'specs_data' => $result_array, // ข้อมูล Title-Detail
//         'is_checked' => $is_checked     // ค่าสถานะ Checkbox 1 หรือ 0
//     ]);
// }
public function getProductManual() {
    $product_id = $this->input->post('product_id');

    $this->db->select('id');
    $this->db->where('product_id', $product_id);
    $this->db->where('is_parent', 1);
    $this->db->where('name', NULL); // เงื่อนไข Master Parent
    $master_parent = $this->db->get('product_manual_detail')->row();

    if (!$master_parent) {
     
        echo json_encode([]);
        return;
    }
    

    $this->db->select('is_show_manualdetail');
    $this->db->where('id', $product_id);
    $product_info = $this->db->get('product')->row();
    $is_checked = $product_info ? $product_info->is_show_manualdetail : 0;


    $master_parent_id = $master_parent->id;


    $this->db->select('id, name AS title, value, parent_id');
    $this->db->where('product_id', $product_id);
    $this->db->where('id !=', $master_parent_id); 
    $this->db->order_by('id', 'ASC');
    $all_children = $this->db->get('product_manual_detail')->result_array();


    $result_array = [];
    $current_title = null;
    $current_title_id = null;

    foreach ($all_children as $row) {
        // แถวที่เก็บ Title (Level 2)
        if ($row['title'] !== NULL && $row['parent_id'] == $master_parent_id) {
              $current_value = $row['value'];
			  $current_title = $row["title"];
			  $current_title_id = $row["id"];
           $result_array[] = [
                    'id'    => $current_title_id,
                    'title' => $current_title,
                    'detail' =>$current_value
                ];
			
          

        // แถวที่เก็บ Detail (Level 3)
        } elseif ($row['value'] !== NULL && $row['parent_id'] == $current_title_id) {
          
        }
    }
    
  
    echo json_encode([
        'specs_data' => $result_array,
        'is_checked' => $is_checked 
    ]);
}

public function save_dynamic_manual() {
		
		if (!$this->input->post('product_id') ) {
			echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่สมบูรณ์']);
			return;
		}

		$product_id = $this->input->post('product_id');
		$specifications = $this->input->post('specifications') ? $this->input->post('specifications') : [];
		$is_show_status = $this->input->post('is_show_manualdetail_status');
		$product_update_data = [
			'is_show_manualdetail' => $is_show_status 
		];
		$this->db->where('id', $product_id);
		$this->db->update('product', $product_update_data); 
		if (!empty($specifications)) {
			
			$this->db->select('id');
			$this->db->where('product_id', $product_id);
			$this->db->where('is_parent', 1);
			$this->db->where('name', NULL); 
			$master_parent = $this->db->get('product_manual_detail')->row();

			if ($master_parent) {
				$master_parent_id = $master_parent->id;
				
				$this->db->where('parent_id', $master_parent_id);
				$this->db->delete('product_manual_detail'); 
			} else {
				
				$parent_data = [
					'product_id' => $product_id,
					'is_parent'  => 1, 
					'name'       => NULL, 
					'value'      => NULL,
					'parent_id'  => NULL,
				];
				$this->db->insert('product_manual_detail', $parent_data);
				$master_parent_id = $this->db->insert_id(); 
			}


			foreach ($specifications as $spec) {
				$title = trim($spec['title']);
				$detail = trim($spec['detail']);
				
				$child_title_data = [
						'product_id' => $product_id,
						'is_parent'  => 0, // เป็น Child
						'name'       => $title, 
						'value'      => $detail,
						'parent_id'  => $master_parent_id, // ชี้ไปที่ Master Parent
					];
					$this->db->insert('product_manual_detail', $child_title_data);
			}
		}else{

			$this->db->where('product_id', $product_id);
   			 $this->db->delete('product_manual_detail');
		}

		echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลเรียบร้อย']);
	}

	public function save_dynamic_specs() {
    // 1. ตรวจสอบข้อมูลพื้นฐาน
    if (!$this->input->post('product_id')) {
        echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่สมบูรณ์: ไม่พบรหัสสินค้า']);
        return;
    }

    $product_id = $this->input->post('product_id');
    // เปลี่ยนจาก 'specifications' เป็น 'groups' ตามที่ตั้งค่าใน JS
    $groups = $this->input->post('groups') ? $this->input->post('groups') : [];
    $is_show_status = $this->input->post('is_show_specdetail_status');

    // 2. อัปเดตสถานะการแสดงผลในตาราง product
    $product_update_data = [
        'is_show_specdetail' => $is_show_status 
    ];
    $this->db->where('id', $product_id);
    $this->db->update('product', $product_update_data); 

    // 3. จัดการข้อมูลจำเพาะในตาราง product_spec_detail
    
    // 3.1 ลบข้อมูลเก่าทั้งหมดของสินค้านี้เพื่อเริ่มใหม่
    // เนื่องจากเราเปลี่ยนโครงสร้างการบันทึก เราจะลบข้อมูลที่เกี่ยวข้องกับ product_id นี้ออกทั้งหมด
    $this->db->where('product_id', $product_id);
    $this->db->delete('product_spec_detail'); 

    if (!empty($groups)) {
        
        // 3.2 สร้าง Master Parent (ชั้นที่ 1) เสมอ เพื่อเป็น Root
        $master_parent_data = [
            'product_id' => $product_id,
            'is_parent'  => 1, // กำหนดให้เป็น Parent
            'name'       => 'MASTER', // ตั้งชื่อเฉพาะเพื่อระบุว่าเป็น Root
            'value'      => NULL,
            'parent_id'  => NULL,
        ];
        $this->db->insert('product_spec_detail', $master_parent_data);
        $master_parent_id = $this->db->insert_id(); // เก็บ ID ของ Master Parent

        // 3.3 วนลูป Group (ชั้นที่ 2)
        foreach ($groups as $group) {
            $group_title = trim($group['group_title']);
            $items = $group['items'];

            // ถ้าไม่มีชื่อ Group และไม่มีรายละเอียด ก็ไม่ต้องบันทึก
            if ($group_title === '' && empty($items)) {
                continue; 
            }

            // สร้าง Group/หมวดหมู่หลัก (ชั้นที่ 2)
            $group_data = [
                'product_id' => $product_id,
                'is_parent'  => 1, // Group เป็น Parent ของ Spec Item
                'name'       => $group_title, // หัวข้อ Group
                'value'      => NULL,
                'parent_id'  => $master_parent_id, // ชี้ไปที่ Master Parent (ชั้นที่ 1)
            ];
            $this->db->insert('product_spec_detail', $group_data);
            $group_id = $this->db->insert_id(); // เก็บ ID ของ Group

            // 3.4 วนลูป Spec Item (ชั้นที่ 3) ภายใต้ Group นั้นๆ
            if (!empty($items)) {
                foreach ($items as $item) {
                    $item_title = trim($item['title']);
                    $item_detail = trim($item['detail']);
                    
                    // บันทึกเฉพาะแถวที่มีข้อมูล
                    if ($item_title !== '' || $item_detail !== '') {
                        $item_data = [
                            'product_id' => $product_id,
                            'is_parent'  => 0, // Spec Item เป็น Child
                            'name'       => $item_title, // หัวข้อย่อย (เช่น สี)
                            'value'      => $item_detail, // รายละเอียด (เช่น แดง)
                            'parent_id'  => $group_id, // ชี้ไปที่ Group (ชั้นที่ 2)
                        ];
                        $this->db->insert('product_spec_detail', $item_data);
                    }
                }
            }
        }
    }
    
    // 4. แสดงผลสำเร็จ
    echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลเรียบร้อย']);
}


	// public function save_dynamic_specs() {
		
	// 	if (!$this->input->post('product_id') ) {
	// 		echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่สมบูรณ์']);
	// 		return;
	// 	}

	// 	$product_id = $this->input->post('product_id');
	// 	$specifications = $this->input->post('specifications') ? $this->input->post('specifications') : [];
	// 	$is_show_status = $this->input->post('is_show_specdetail_status');
	// 	$product_update_data = [
	// 		'is_show_specdetail' => $is_show_status 
	// 	];
	// 	$this->db->where('id', $product_id);
	// 	$this->db->update('product', $product_update_data); 
	// 	if (!empty($specifications)) {
			
	// 		$this->db->select('id');
	// 		$this->db->where('product_id', $product_id);
	// 		$this->db->where('is_parent', 1);
	// 		$this->db->where('name', NULL); 
	// 		$master_parent = $this->db->get('product_spec_detail')->row();

	// 		if ($master_parent) {
	// 			$master_parent_id = $master_parent->id;
				
	// 			$this->db->where('parent_id', $master_parent_id);
	// 			$this->db->delete('product_spec_detail'); 
	// 		} else {
				
	// 			$parent_data = [
	// 				'product_id' => $product_id,
	// 				'is_parent'  => 1, 
	// 				'name'       => NULL, 
	// 				'value'      => NULL,
	// 				'parent_id'  => NULL,
	// 			];
	// 			$this->db->insert('product_spec_detail', $parent_data);
	// 			$master_parent_id = $this->db->insert_id(); 
	// 		}


	// 		foreach ($specifications as $spec) {
	// 			$title = trim($spec['title']);
	// 			$detail = trim($spec['detail']);
				
	// 			$child_title_data = [
	// 					'product_id' => $product_id,
	// 					'is_parent'  => 0, // เป็น Child
	// 					'name'       => $title, 
	// 					'value'      => $detail,
	// 					'parent_id'  => $master_parent_id, // ชี้ไปที่ Master Parent
	// 				];
	// 				$this->db->insert('product_spec_detail', $child_title_data);
	// 		}
	// 	}else{

	// 		$this->db->where('product_id', $product_id);
   	// 		 $this->db->delete('product_spec_detail');
	// 	}

	// 	echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลเรียบร้อย']);
	// }
	public function spec_detail_action($product_id){	
		$menu['mainmenu'] = 'spec_detail';
		$menu['submenu'] = 'spec_detail';
		$data['product_id'] = $product_id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_specdetail_action',$data);
		$this->load->view('admin/footer');
	}
	public function spec_action($product_id){	
		$menu['mainmenu'] = 'spec';
		$menu['submenu'] = 'spec';
		$data['product_id'] = $product_id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_spec_action',$data);
		$this->load->view('admin/footer');
	}
	public function get_product_spec_onc() {   
		$product_id = $this->input->post('product_id');

		$Query = "SELECT `product_spec`.*, `product`.`name` FROM `product_spec`
		LEFT JOIN `product` ON `product_spec`.`product_id` = `product`.`id`
		WHERE `product_spec`.`product_id` = ".$product_id;
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_spec() {   
		
		$Query = "SELECT `product`.*, `product_category`.name as cate_name 
		, `product_spec`.`link` as link 
		, `product_spec`.`file_path` as file_path 
		, `product_spec`.`detail` as product_spec_detail 
		, `product`.`warranty`
		FROM `product` 
		LEFT JOIN `product_category` on `product`.category = `product_category`.id
		LEFT JOIN `product_spec` on `product`.`id` = `product_spec`.`product_id`";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function upload() {
        if ($_FILES['upload']['error'] == UPLOAD_ERR_OK) {
            $tempFile = $_FILES['upload']['tmp_name'];

            // Your image processing logic here (e.g., resizing)

            // Save the resized image
            $uploadDir = 'uploads/tmp';  // Set your upload directory
            $uploadFile = $uploadDir . basename($_FILES['upload']['name']);
            move_uploaded_file($tempFile, $uploadFile);

            // Return the URL of the uploaded image
            echo json_encode(['url' => base_url($uploadFile)]);
        } else {
            // Handle upload error
            echo json_encode(['error' => 'Upload failed']);
        }
    }

	public function spec_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$product_id = $this->input->post('product');
        $link = $this->input->post('link');
        $detail = $this->input->post('detail');
		
        $obj = array( 
			'product_id' => $product_id,
			'link' => $link,
			'detail' => $detail,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_spec', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_product_spec');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->where("product_id", $product_id);
            $this->db->update("product_spec", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_spec');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		//###  thumnal ###///
		if (!empty($_FILES['pdfFile']['name'])) {
			$upload = $this->do_upload_pdffile('pdfFile', $product_id);
			if($upload->status){
				$pdf['file_path'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('product_spec', $pdf);
			}
		}

		echo json_encode($res);
	}
	public function do_upload_pdffile($files, $product_id){
        $res = new stdClass();
        $config['allowed_types'] = 'pdf'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		$_FILES[$files]['name'] = 'product.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/product_spec/pdf/product/".$product_id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		@unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function del_spec() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_spec');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	
	public function del_product_manual() {   

		$id = $this->input->post('id');
		
		$curent_date = Date('Y-m-d H:i:s');

		$Query = " SELECT * FROM product WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result();

		//### del PDF ###///
		foreach($result as $item){
			
			//### del files ###///
			$this->load->helper('file');
			delete_files( $item->manual_path, true); // Delete files into the folder
		
			//### update files ###///
			$obj['manual_path'] = '';
			$obj['updated'] = $curent_date;
			$this->db->where("id", $item->id);
			
			$this->db->update("product", $obj); 
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}
	public function del_spec_PDF() {   

		$id = $this->input->post('id');
		$product_id = $this->input->post('product_id');
		$curent_date = Date('Y-m-d H:i:s');

		$Query = " SELECT * FROM product_spec WHERE id = '".$id."' AND product_id = '".$product_id."' ";
		$result = $this->db->query($Query)->result();

		//### del PDF ###///
		foreach($result as $item){
			
			//### del files ###///
			$this->load->helper('file');
			delete_files('./uploads/product_spec/pdf/product/'.$item->product_id.'/', true); // Delete files into the folder
			@rmdir('./uploads/product_spec/pdf/product/'.$item->product_id.'/'); // Delete the folder

			//### update files ###///
			$obj['file_path'] = '';
			$obj['updated'] = $curent_date;
			$this->db->where("id", $item->id);
			$this->db->where("product_id", $item->product_id);
			$this->db->update("product_spec", $obj); 
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}

	//###   REGIS PRODUCT   ###/
	// API: รายชื่อสินค้าสำหรับ dropdown ในหน้าแก้ไข/เพิ่มข้อมูลลงทะเบียนสินค้า
	// แสดงเฉพาะสินค้าที่ตั้งค่า "ชื่อสินค้า (สำหรับอ้างอิง)" ไว้แล้วเท่านั้น ตามที่ระบุ
	public function regis_product_options() {
		$rows = $this->db
			->select('id, regis_name')
			->where('regis_name IS NOT NULL', null, false)
			->where('regis_name !=', '')
			->order_by('regis_name', 'ASC')
			->get('product')
			->result_array();
		$res = new stdClass();
		$res->status = true;
		$res->datas = $rows;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}
	public function regis_page(){	
		$menu['mainmenu'] = 'regis';
		$menu['submenu'] = 'regis';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_regis');
		$this->load->view('admin/footer');
	}
	public function regis_add(){	
		$menu['mainmenu'] = 'regis';
		$menu['submenu'] = 'regis';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_regis_add');
		$this->load->view('admin/footer');
	}
	public function regis_edit($id){	
		$menu['mainmenu'] = 'regis';
		$menu['submenu'] = 'regis';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/product_regis_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_product_regis_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `product_regis`.*, `product`.`name` FROM `product_regis`
		LEFT JOIN `product` ON `product_regis`.`product_id` = `product`.`id`
		WHERE `product_regis`.`id` = ".$id;
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_regis() {   
		
		$Query = " SELECT `product_regis`.*,`product`.`productcode`,`product`.`name`,`product`.`regis_name`,`product`.`thumnal` FROM `product_regis` LEFT JOIN `product` on `product_regis`.`product_id` = `product`.id ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	// Import ข้อมูลจากไฟล์ Excel (รายงานใบเสร็จรับเงิน) เข้า product_regis
	// รหัสสินค้า (product_id) ได้จากจับคู่ "ชื่อสินค้า/บริการ" ในไฟล์ กับ product.regis_name ก่อน
	// ถ้าไม่เจอ ลองจับคู่กับ product.name แทน ถ้ายังไม่เจอใส่ null (ตามที่ระบุ)
	public function regis_import() {
		$res = new stdClass();
		$res->status = false;

		if (empty($_FILES['excel_file']['tmp_name']) || !is_uploaded_file($_FILES['excel_file']['tmp_name'])) {
			$res->massege = 'กรุณาเลือกไฟล์ Excel (.xlsx)';
			echo json_encode($res, JSON_UNESCAPED_UNICODE); return;
		}
		$ext = strtolower(pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION));
		if ($ext !== 'xlsx') {
			$res->massege = 'รองรับเฉพาะไฟล์ .xlsx เท่านั้น';
			echo json_encode($res, JSON_UNESCAPED_UNICODE); return;
		}

		$this->load->library('Xlsx_reader');
		try {
			$rows = $this->xlsx_reader->read($_FILES['excel_file']['tmp_name']);
		} catch (Exception $e) {
			$res->massege = 'อ่านไฟล์ไม่สำเร็จ: ' . $e->getMessage();
			echo json_encode($res, JSON_UNESCAPED_UNICODE); return;
		}

		// หาแถวหัวตารางแบบไดนามิก (ไม่ fix เลขแถวตายตัว เผื่อรายงานคนละช่วงวันที่มีความยาว
		// ส่วนหัว/ข้อมูลบริษัทไม่เท่ากัน) — ต้องเจอทั้ง "เลขที่เอกสาร" และ "ชื่อสินค้า/บริการ" ในแถวเดียวกัน
		$headerRowIdx = null;
		$col = [];
		foreach ($rows as $i => $row) {
			if (in_array('เลขที่เอกสาร', $row, true) && in_array('ชื่อสินค้า/บริการ', $row, true)) {
				$headerRowIdx = $i;
				foreach ($row as $ci => $label) { $col[trim((string) $label)] = $ci; }
				break;
			}
		}
		if ($headerRowIdx === null) {
			$res->massege = 'ไม่พบแถวหัวตารางในไฟล์ (ต้องมีคอลัมน์ "เลขที่เอกสาร" และ "ชื่อสินค้า/บริการ")';
			echo json_encode($res, JSON_UNESCAPED_UNICODE); return;
		}

		// preload สินค้าทั้งหมดไว้จับคู่ในหน่วยความจำ (ไม่ query ทีละแถว)
		$products = $this->db->select('id, name, regis_name')->get('product')->result_array();
		$byRegisName = [];
		$byName = [];
		foreach ($products as $p) {
			if (!empty($p['regis_name'])) { $byRegisName[trim($p['regis_name'])] = $p['id']; }
			if (!empty($p['name']))       { $byName[trim($p['name'])] = $p['id']; }
		}

		// preload เลขที่เอกสารที่มีอยู่แล้ว -> id (เพื่ออัปเดตแถวเดิมถ้าเจอซ้ำ แทนที่จะข้าม ตามที่ระบุ)
		$existingBills = [];
		foreach ($this->db->select('id, bill_number')->get('product_regis')->result_array() as $r) {
			if (!empty($r['bill_number'])) { $existingBills[trim($r['bill_number'])] = $r['id']; }
		}

		$curent_date = date('Y-m-d H:i:s');
		$inserted = 0; $matched = 0; $skippedEmpty = 0; $updatedDup = 0;
		$unmatchedNames = [];

		$this->db->trans_begin();

		for ($i = $headerRowIdx + 1; $i < count($rows); $i++) {
			$row = $rows[$i];
			$bill_number = isset($col['เลขที่เอกสาร']) ? trim((string) ($row[$col['เลขที่เอกสาร']] ?? '')) : '';
			if ($bill_number === '') { $skippedEmpty++; continue; }

			$productName = isset($col['ชื่อสินค้า/บริการ']) ? trim((string) ($row[$col['ชื่อสินค้า/บริการ']] ?? '')) : '';
			$product_id = null;
			if ($productName !== '') {
				if (isset($byRegisName[$productName]))    { $product_id = $byRegisName[$productName]; $matched++; }
				elseif (isset($byName[$productName]))     { $product_id = $byName[$productName]; $matched++; }
				else { $unmatchedNames[$productName] = true; }
			}

			$tel_idcart = isset($col['เลขที่ 13 หลัก']) ? trim((string) ($row[$col['เลขที่ 13 หลัก']] ?? '')) : '';

			// เลขที่เอกสารซ้ำกับที่มีอยู่แล้ว -> อัปเดตข้อมูลสินค้า + เลขบัตรประชาชนของแถวเดิม
			// (ไม่แตะ ชื่อลูกค้า/สาขา/แท็ก/วันที่/รายละเอียด ของแถวเดิม เพราะระบุให้อัปเดตเฉพาะ
			// ข้อมูลสินค้ากับเลขบัตรประชาชนเท่านั้น — ส่วนเบอร์โทรลูกค้าไม่มีคอลัมน์ต้นทางในไฟล์นี้
			// เลยไม่มีค่าใหม่ให้อัปเดต จึงไม่แตะค่าเดิมที่มีอยู่)
			if (isset($existingBills[$bill_number])) {
				$updateObj = [
					'product_id' => $product_id,
					'updated'    => $curent_date,
				];
				if ($tel_idcart !== '') { $updateObj['tel_idcart'] = $tel_idcart; }
				$this->db->where('id', $existingBills[$bill_number])->update('product_regis', $updateObj);
				$updatedDup++;
				continue;
			}

			$customer_name = isset($col['ชื่อลูกค้า'])       ? trim((string) ($row[$col['ชื่อลูกค้า']] ?? '')) : '';
			$branch        = isset($col['สาขา'])             ? trim((string) ($row[$col['สาขา']] ?? '')) : '';
			$tags          = isset($col['แท็ก'])             ? trim((string) ($row[$col['แท็ก']] ?? '')) : '';

			$purchase_date = null;
			if (isset($col['วันที่ออก'])) {
				$raw = trim((string) ($row[$col['วันที่ออก']] ?? ''));
				if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $raw, $m)) {
					$purchase_date = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
				}
			}

			$detailParts = [];
			if (isset($col['คำอธิบาย'])) {
				$d = trim((string) ($row[$col['คำอธิบาย']] ?? ''));
				if ($d !== '') { $detailParts[] = $d; }
			}
			if (isset($col['หมายเหตุ'])) {
				$n = trim((string) ($row[$col['หมายเหตุ']] ?? ''));
				if ($n !== '') { $detailParts[] = $n; }
			}

			$obj = [
				'product_id'    => $product_id,
				'bill_number'   => $bill_number,
				'customer_name' => ($customer_name !== '') ? $customer_name : null,
				'tel_idcart'    => ($tel_idcart !== '') ? $tel_idcart : null,
				'branch'        => ($branch !== '') ? $branch : null,
				'tags'          => ($tags !== '') ? $tags : null,
				'purchase_date' => $purchase_date,
				'detail'        => !empty($detailParts) ? implode("\n", $detailParts) : null,
				'created'       => $curent_date,
				'updated'       => $curent_date,
			];
			$this->db->insert('product_regis', $obj);
			$existingBills[$bill_number] = $this->db->insert_id(); // กันไฟล์เดียวกันมี bill_number ซ้ำกันเองในไฟล์ด้วย
			$inserted++;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$res->massege = 'บันทึกข้อมูลไม่สำเร็จ กรุณาลองใหม่อีกครั้ง';
			echo json_encode($res, JSON_UNESCAPED_UNICODE); return;
		}
		$this->db->trans_commit();

		$res->status = true;
		$res->status_code = '000';
		$res->massege = "นำเข้าข้อมูลใหม่สำเร็จ {$inserted} รายการ, อัปเดตข้อมูลสินค้า/เลขบัตรประชาชนของรายการที่มีเลขที่เอกสารซ้ำ {$updatedDup} รายการ (จับคู่สินค้าได้ {$matched} รายการ, ข้ามแถวว่าง {$skippedEmpty} รายการ)";
		$res->inserted = $inserted;
		$res->updated = $updatedDup;
		$res->matched = $matched;
		$res->unmatched_count = count($unmatchedNames);
		$res->unmatched_names = array_values(array_keys($unmatchedNames));
		echo json_encode($res, JSON_UNESCAPED_UNICODE);
	}

	public function regis_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$product_id = $this->input->post('product');
		$bill_number = $this->input->post('bill_number');
		$tel_cus = $this->input->post('tel_cus');
		$tel_idcart = $this->input->post('tel_idcart');
        $link = $this->input->post('link');
        $detail = $this->input->post('detail');
		
        $obj = array( 
			'product_id' => $product_id,
			'bill_number' => $bill_number,
			'tel_cus' => $tel_cus,
			'tel_idcart' => $tel_idcart,
			'link' => $link,
			'detail' => $detail,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('product_regis', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_product_regis');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("product_regis", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_product_regis');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		//###  thumnal ###///
		if (!empty($_FILES['pdfFile']['name'])) {
			$upload = $this->do_upload_regis('pdfFile', $product_id);
			if($upload->status){
				$pdf['file_path'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('product_regis', $pdf);
			}
		}

		echo json_encode($res);
	}
	public function do_upload_regis($files, $product_id){
        $res = new stdClass();
        $config['allowed_types'] = 'pdf'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		$_FILES[$files]['name'] = 'product.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/product_regis/pdf/product/".$product_id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		@unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function del_regis() {   

		$id = $this->input->post('id');
		//### delete category ###///
		$this->db->where('id', $id);
		$this->db->delete('product_regis');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function del_regis_PDF() {   

		$id = $this->input->post('id');
		$product_id = $this->input->post('product_id');
		$curent_date = Date('Y-m-d H:i:s');

		$Query = " SELECT * FROM product_regis WHERE id = '".$id."' AND product_id = '".$product_id."' ";
		$result = $this->db->query($Query)->result();

		//### del PDF ###///
		foreach($result as $item){
			
			//### del files ###///
			$this->load->helper('file');
			delete_files('./uploads/product_regis/pdf/product/'.$item->product_id.'/', true); // Delete files into the folder
			@rmdir('./uploads/product_regis/pdf/product/'.$item->product_id.'/'); // Delete the folder

			//### update files ###///
			$obj['file_path'] = '';
			$obj['updated'] = $curent_date;
			$this->db->where("id", $item->id);
			$this->db->where("product_id", $item->product_id);
			$this->db->update("product_regis", $obj); 
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}

	
	//###   SLIDE   ###/
	public function slide_page(){	
		$menu['mainmenu'] = 'slide';
		$menu['submenu'] = 'slide';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/slide_page');
		$this->load->view('admin/footer');
	}
	public function slide_add(){	
		$menu['mainmenu'] = 'slide';
		$menu['submenu'] = 'slide';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/slide_add');
		$this->load->view('admin/footer');
	}
	public function slide_edit($id){	
		$menu['mainmenu'] = 'slide';
		$menu['submenu'] = 'slide';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/slide_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_slide_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `slide`.* FROM `slide`  WHERE `slide`.`id` = ".$id;
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_slide() {   
		
		$Query = "SELECT `slide`.* FROM `slide` ORDER BY `sortting` asc ";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function slide_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $title = $this->input->post('title');
        $sub_title = $this->input->post('sub_title');
        $link = $this->input->post('link');
        $active = $this->input->post('active');
		
        $obj = array( 
			'title' => $title,
			'sub_title' => $sub_title,
			'link' => $link,
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('slide', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_slide');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("slide", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_slide');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		//###  thumnal ###///
		if (!empty($_FILES['image']['name'])) {
			$upload = $this->do_upload_slide('image', $id);
			if($upload->status){
				$pdf['path'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('slide', $pdf);
			}
		}

		echo json_encode($res);
	}
	public function do_upload_slide($files, $id){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        //##### thumanl name ####//
		$_FILES[$files]['name'] = 'image_slide.'.pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		
        ##### create path ####
		$upload_path = "./uploads/slide/".$id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        //##### create img to dir ####//
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		@unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->data = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->data = $fullPath;
		}
        return $res;
    }
	public function del_slide_image() {   

		$id = $this->input->post('id');
		$Query = " SELECT * FROM slide WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result();

		//### del PDF ###///
		foreach($result as $item){
			
			//### del files ###///
			$this->load->helper('file');
			delete_files('./uploads/slide/'.$item->product_id.'/', true); // Delete files into the folder
			@rmdir('./uploads/slide/'.$item->product_id.'/'); // Delete the folder
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function del_slide_result() {   

		$id = $this->input->post('id');
		$curent_date = Date('Y-m-d H:i:s');

		$Query = " SELECT * FROM slide WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result();

		//### del PDF ###///
		foreach($result as $item){
			
			//### del files ###///
			$this->load->helper('file');
			delete_files('./uploads/slide/'.$item->id.'/', true); // Delete files into the folder
			@rmdir('./uploads/slide/'.$item->id.'/'); // Delete the folder

			//### DElete files ###///]
			$this->db->where('id', $item->id);
    		$this->db->delete('slide');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}
	public function update_slide_sorting(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		
		$id = $this->input->post('id');
        $sortable = $this->input->post('sortable');
		
        $obj = array( 
			'sortting' => $sortable,
		); 

		$obj['updated'] = date(date_format(date_create(),"Y-m-d H:i:s"));
        $this->db->where("id", $id);
        $this->db->update("slide", $obj); 

		$res->status = true;
		//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
		$res->datas = base_url('admin_slide');
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';

		echo json_encode($res);
	}

	
	
	//###   General Setting   ###/
	public function generalsetting_page(){	
		$menu['mainmenu'] = 'generalsetting';
		$menu['submenu'] = 'generalsetting';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/generalsetting_page');
		$this->load->view('admin/footer');
	}
	public function callcenter_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('callcenter');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'callcenter',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_callcenter_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'callcenter'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	public function companyname_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('companyname');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'companyname',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_companyname_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'companyname'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function servicenumber_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('servicenumber');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'servicenumber',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_servicenumber_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'servicenumber'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	public function emailcompany_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('emailcompany');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'emailcompany',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_emailcompany_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'emailcompany'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	public function taxidentification_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('taxidentification');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'taxidentification',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_taxidentification_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'taxidentification'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function facebook_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('facebook');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'facebook',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_facebook_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'facebook'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function line_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $text = $this->input->post('line');
		$active = $this->input->post('active');
		
        $obj = array( 
			'text' => $text,
			'method' => 'line',
			'active' => $active,
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$this->db->insert('general_setting', $obj);
   			$id = $this->db->insert_id();

			$res->status = true;
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("general_setting", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product_cate_edit/'.$cate_id);
			$res->datas = base_url('admin_generalsetting');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';

        }

		echo json_encode($res);
	}
	public function get_line_onc() {   
		$id = $this->input->post('id');

		$Query = "SELECT `general_setting`.* FROM `general_setting`  WHERE `general_setting`.`method` = 'line'";
		$result = $this->db->query($Query)->result(); 

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}



	// 	$id = $this->input->post('id');
	// 	$curent_date = Date('Y-m-d H:i:s');

	// 	$Query = " SELECT * FROM slide WHERE id = '".$id."' ";
	// 	$result = $this->db->query($Query)->result();

	// 	//### del PDF ###///
	// 	foreach($result as $item){
			
	// 		//### del files ###///
	// 		$this->load->helper('file');
	// 		delete_files('./uploads/slide/'.$item->id.'/', true); // Delete files into the folder
	// 		@rmdir('./uploads/slide/'.$item->id.'/'); // Delete the folder

	// 		//### DElete files ###///]
	// 		$this->db->where('id', $item->id);
    // 		$this->db->delete('slide');
	// 	}

	// 	$res = new stdClass();
	// 	$res->status = true;
	// 	$res->massege = 'ลบข้อมูล สำเร็จ';
	// 	$res->status_code = '000';
	// 	echo json_encode($res);
		
	// }
	
















































	
	public function do_upload_product($files, $product_id, $lang){
        $res = new stdClass();
        $config['allowed_types'] = 'jpeg|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config["overwrite"] = 	true;
        //$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

        ##### name img ####
        $today = strtotime(date("d-m-Y H:i:s")); 
		if (!empty($_FILES[$files]['name'])) {
			$_FILES[$files]['name'] = 'product_'.$lang.'_'.$product_id.".".pathinfo($_FILES[$files]['name'], PATHINFO_EXTENSION);
		}
        ##### create path ####
		$upload_path = "./uploaded/ImageUpload/product/".$product_id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        ##### create img to dir ####
        $fullPath = $upload_path.'/'.$_FILES[$files]['name'];
		unlink($fullPath);
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload($files)) {
			$path = $this->upload->data();
            $res->status = true;
            $res->message = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->message = $fullPath;
		}
        return $res;
    }
	public function do_upload_product_image($files, $product_id, $i){
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
		$_fileType = pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);
        $_FILES['file']['name'] = rand().".".pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);

        ##### create path ####
		$upload_path = "./uploaded/ImageUpload/product/".$product_id;
		if (!file_exists($upload_path)) {
			if (!mkdir($upload_path, 0777, true)) {//0777
				die($upload_path.' Failed to create folders...');
			}
        }

        ##### create img to dir ####
        $fullPath = $upload_path.'/'.$_FILES['file']['name'];
		$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
		//$config['file_name'] = $_FILES['file']['name'];
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$path = $this->upload->data();
            $res->status = true;
			$res->fileType = $_fileType;
            $res->message = $fullPath;
		}else{
            $res->status = false;
            $res->message = $this->upload->display_errors();
            $res->message = $fullPath;
		}
        return $res;
    }
	public function del_product_image() {   
		
		$cate_id = $this->input->post('cate_id');
		$product_id = $this->input->post('product_id');
		$id = $this->input->post('id');

		$Query = " SELECT * FROM product_image WHERE product_cate = '".$cate_id."' AND product_id = '".$product_id."' AND id = '".$id."'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);

			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('product_cate', $cate_id);
			$this->db->where('product_id', $product_id);
    		$this->db->delete('product_image');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function deleted_product($product_id) { 
		if(isset($_POST['product_id'])){
			$product_id= $_POST['product_id'];
		}
		//### del imgage files ###///
		$dir_path = 'uploaded/images/product/'.$product_id;
		$del_path = './uploaded/images/product/'.$product_id.'/';

		$this->load->helper('file'); // Load codeigniter file helper
		if(is_dir($dir_path))
		{
			delete_files($del_path, true); // Delete files into the folder
			rmdir($del_path); // Delete the folder
		}

		//### del imgage files ###///
		$this->db->where('id', $product_id);
		$this->db->delete('products');

		// //### del imgage ###///
		$this->db->where('product_id', $product_id);
		$this->db->delete('product_image');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_image() {   
		$product_id = $this->input->post('product_id');

		$Query = " SELECT * FROM product_image WHERE product_id = '".$product_id."'  order by orders asc";
		//$Query = " SELECT * FROM product_image WHERE product_id = '".$product_id."'  and file_type in('jpeg','jpg','png','pdf','xlsx','xls')  order by orders asc";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_product_by_cate() {  
		$cate_id = $this->input->post('cate_id');
        $Query = " SELECT p.*, pc.name_th cate_name 
		FROM products p 
		LEFT JOIN product_category pc ON p.category = pc.id
		where p.category = '".$cate_id."'
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
	public function update_product_table_sort(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		
		$product_id = $this->input->post('product_id');
        $sortable = $this->input->post('sortable');
		
        $obj = array( 
			'orders' => $sortable,
		); 

		$obj['udate'] = date(date_format(date_create(),"Y-m-d H:i:s"));
		$this->db->where("id", $product_id);
		$this->db->update("products", $obj); 
		
		$res->status = true;
		//$res->datas = base_url('admin/product_edit/'.$cate_id);
		$res->datas = base_url('admin/product/');
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';

		echo json_encode($res);
	}
	public function update_product_image_sort(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');

		$product_cate = $this->input->post('category_id');
        $product_id = $this->input->post('product_id');
        $id = $this->input->post('image_id');
		$sortable = $this->input->post('sortable');
		
        $obj = array( 
			'orders' => $sortable,
		); 

		//$obj['udate'] = date(date_format(date_create(),"Y-m-d H:i:s"));
		$this->db->where("id", $id);
		$this->db->where("product_cate", $product_cate);
		$this->db->where("product_id", $product_id);
		$this->db->update("product_image", $obj); 
		
		$res->status = true;
		$res->datas = base_url('admin/product_edit/'.$product_id);
		$res->massege = 'บันทึกสำเร็จ';
		$res->status_code = '000';

		echo json_encode($res);
	}

	//## product files ###//
	public function do_upload_files(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$cate_id = $this->input->post('cate_id');
		$product_id = $this->input->post('product_id');

		$files = 'files-4-dowload';
		$cpt = count($_FILES[$files]['name']);
		if($cpt > 0){
			for($i=0; $i < $cpt; $i++){    
				$res = new stdClass();
				$config['allowed_types'] = 'pdf|xlsx|xls'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
				$config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
				$config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
				$config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
				$config["overwrite"] = 	false;
				//$config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ

				//$files = 'files-4-dowload';

				$_FILES['file']['name'] = $_FILES[$files]['name'][$i];
				$_FILES['file']['type'] = $_FILES[$files]['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES[$files]['error'][$i];
				$_FILES['file']['size'] = $_FILES[$files]['size'][$i];

				##### name img ####
				$_fileType = pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);
				$_FILES['file']['name'] = rand().".".pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION);

				##### create path ####
				$upload_path = "./uploaded/ImageUpload/product/".$product_id;
				if (!file_exists($upload_path)) {
					if (!mkdir($upload_path, 0777, true)) {//0777
						die($upload_path.' Failed to create folders...');
					}
				}

				##### create img to dir ####
				$fullPath = $upload_path.'/'.$_FILES['file']['name'];
				$config['upload_path'] = $upload_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
				//$config['file_name'] = $_FILES['file']['name'];
				
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file')) {
					$path = $this->upload->data();

					$obj_product_file = array( 
						'orders' => $i,
						'product_cate' => $cate_id, 
						'product_id' => $product_id, 
						'path' => $fullPath,
						'file_type' =>$_fileType,
						'cdate' => date(date_format(date_create(),"Y-m-d H:i:s"))
					);  
					$this->db->insert('product_image', $obj_product_file);


					$res->status = true;
					$res->fileType = $_fileType;
					$res->message = $fullPath;
				}else{
					$res->status = false;
					$res->message = $this->upload->display_errors();
					$res->message = $fullPath;
				}
			}
		}

		echo json_encode($res);
	}
	public function get_product_files() {   
		$product_id = $this->input->post('product_id');

		$Query = " SELECT * FROM product_image WHERE product_id = '".$product_id."' and file_type in('pdf','xlsx','xls') order by orders asc";
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function del_product_files() {   
		
		$cate_id = $this->input->post('cate_id');
		$product_id = $this->input->post('product_id');
		$id = $this->input->post('id');

		$Query = " SELECT * FROM product_image WHERE product_cate = '".$cate_id."' AND product_id = '".$product_id."' AND id = '".$id."'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);

			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('product_cate', $cate_id);
			$this->db->where('product_id', $product_id);
    		$this->db->delete('product_image');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}


}
