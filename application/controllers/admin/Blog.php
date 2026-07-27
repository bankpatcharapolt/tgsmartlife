<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Blog extends Main {

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

	//###  PRODUCT   ###/
	public function blog_page(){	
		$menu['mainmenu'] = 'blog';
		$menu['submenu'] = 'blog';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/blog_page');
		$this->load->view('admin/footer');
	}
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT `article`.*, `product_category`.`name` as category_name 
		FROM `article` 
		LEFT JOIN `product_category` ON `article`.`product_cate` = `product_category`.`id` ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
    public function blog_add(){	
		$menu['mainmenu'] = 'blog';
		$menu['submenu'] = 'blog';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/blog_add');
		$this->load->view('admin/footer');
	}
    public function blog_edit($id){	
		$menu['mainmenu'] = 'blog';
		$menu['submenu'] = 'blog';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/blog_edit',$data);
		$this->load->view('admin/footer');
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
		$Query = " SELECT * FROM images WHERE ref_id = '".$id."' and `group` = 'blog' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function del_image() { 
		$id = $this->input->post('id');
		$ref_id = $this->input->post('ref_id');

		$Query = " SELECT * FROM images WHERE id = '".$id."' AND ref_id = '".$ref_id."' AND `group` = 'blog'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);
			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('ref_id', $item->ref_id);
			$this->db->where('group', 'blog');
    		$this->db->delete('images');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}
	public function get_results_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM article WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function blog_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$method = $this->input->post('method');
		$id = $this->input->post('id');
		$detail = $this->input->post('detail');
        $product_cate = $this->input->post('product_cate');
        $topic = $this->input->post('topic');
        $sub_header = $this->input->post('sub_header');
		$seo = $this->input->post('seo');
		$active = $this->input->post('active');
		
        $obj = array( 
            'topic' => $topic, 
            'sub_header' => $sub_header,
			'detail' => $detail,
			'product_cate' => $product_cate,
			'seo_id' => $seo,
			'active' => $active
		); 

		//###  INSERT ###//
        if($method == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('article', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_blog_edit/'.$id);
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($method == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("article", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_blog_edit/'.$id);
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		
		//###  thumnal ###///
		if (!empty($_FILES['thumnal']['name'])) {
			$upload = $this->do_upload_thumnel('thumnal', $id);
			if($upload->status){
				$img['picture'] = trim($upload->data);
				$this->db->where('id', $id);
				$this->db->update('article', $img);
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
						'group' => 'blog',
						'created' => $curent_date,
						'updated' => $curent_date
					);  
					$this->db->insert('images', $obj_image);
				}
			}  
		}


		//###  DRAG & DROP IMAGE ###//
		// $cpt = count($_FILES['photos']['name']);
		// if($cpt > 0){
		// 	//$this->del_product_image($category, $product_id);
		// 	for($i=0; $i < $cpt; $i++){      
		// 		if(!empty($_FILES['photos']['name'][$i])){
		// 			$upload_image = $this->do_upload_product_image('photos', $product_id, $i);
		// 			if($upload_image->status){
		// 				$obj_product_image = array( 
		// 					'orders' => $i,
		// 					'product_cate' => $cate_id, 
		// 					'product_id' => $product_id, 
		// 					'path' => $upload_image->message,
		// 					'file_type' => $upload_image->fileType,
		// 					'cdate' => date(date_format(date_create(),"Y-m-d H:i:s"))
		// 				);  
		// 				$this->db->insert('product_image', $obj_product_image);
		// 				//$cate_id = $this->db->insert_id();  
		// 			}
		// 		}
		// 	}
		// }

		echo json_encode($res);
	}
	public function do_upload_thumnel($files, $id){
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
		$upload_path = "./uploads/images/blog/".$id;
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
		$uploads_path = "./uploads/images/blog/".$id;
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
	public function del_result() { 
		$id = $this->input->post('id');

		//### del files ###///
		$this->load->helper('file');
		delete_files('./uploads/images/blog/'.$id.'/', true); // Delete files into the folder
		@rmdir('./uploads/images/blog/'.$id.'/'); // Delete the folder
		
		//### del article ###///
		$this->db->where('id', $id);
		$this->db->delete('article');

		// //### del images ###///
		$this->db->where('ref_id', $id);
		$this->db->where('group', 'blog');
		$this->db->delete('images');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_blog_seo_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM page_seo WHERE category = 'knowledge'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
