<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Teams extends Main {

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
	public function page(){	
		$menu['mainmenu'] = 'team';
		$menu['submenu'] = 'team';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/team_page');
		$this->load->view('admin/footer');
	}
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT `team`.* FROM `team`";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
    public function add(){	
		$menu['mainmenu'] = 'team';
		$menu['submenu'] = 'team';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/team_add');
		$this->load->view('admin/footer');
	}
    public function edit($id){	
		$menu['mainmenu'] = 'team';
		$menu['submenu'] = 'team';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/team_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_results_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM team WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$detail = $this->input->post('detail');
        $name = $this->input->post('name');
		$active = $this->input->post('active');
		
        $obj = array( 
            'name' => $name,
			'detail' => $detail,
			'active' => $active
		); 

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('team', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_team');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("team", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_team');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		echo json_encode($res);
	}
	public function del_result() { 
		$id = $this->input->post('id');

		//### del article ###///
		$this->db->where('id', $id);
		$this->db->delete('team');

		$this->db->where('ref_id', $id);
		$this->db->delete('administrator');

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_user_pass_results() {  
		$ref_id = $this->input->post('ref_id');
		$Query = "SELECT `administrator`.* FROM `administrator` WHERE ref_id = '".$ref_id."'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function userpass_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$ref_id = $this->input->post('ref_id');
		$id = $this->input->post('id');
		$user = $this->input->post('user');
        $pass = $this->input->post('pass');
		
        // $obj = array(
        //     'firstname' => $user,
		// 	'password' => md5($pass)
		// );
		$obj['firstname'] = $user;
		if(!empty($pass)){
			$obj['password'] = md5($pass); 
		}
		

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['ref_id'] = $ref_id;
			$obj['type'] = 'teamsale';
			$obj['active'] = 1;
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('administrator', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_team');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->where("ref_id", $ref_id);
            $this->db->update("administrator", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_team');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

		echo json_encode($res);
	}

	//### Products ####//
	public function team_product_page(){	
		$menu['mainmenu'] = 'team';
		$menu['submenu'] = 'team_product';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/team_product_page');
		$this->load->view('admin/footer');
	}
    public function team_product_action_page($team_id){	
		$menu['mainmenu'] = 'team';
		$menu['submenu'] = 'team_product';
		$data['team_id'] = $team_id;
		$data['team'] = $this->get_teams($team_id);
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/team_product_action',$data);
		$this->load->view('admin/footer');
	}
	public function get_team_product_results(){
		$Query = "SELECT `product`.* FROM `product` WHERE active = '1'";
		$result = $this->db->query($Query)->result();
		
		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_team_products() {  
		$team_id = $this->input->post('team_id');
		$Query = "SELECT `team_product`.*, `product`.`name` as product_name 
		FROM `team_product` 
		LEFT JOIN `product` ON `team_product`.`product_id` = `product`.`id`
		WHERE `team_product`.`team_id` =  '".$team_id."'";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	
	public function get_teams($team_id) {
		$Query = "SELECT `team`.* FROM `team` WHERE `team`.`id` =  '".$team_id."'";
		$result = $this->db->query($Query)->result_array();
		return $result;
	}
	public function team_product_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$team_id = $this->input->post('team_id');
		$id = $this->input->post('id');
		$product_id = $this->input->post('product_id');
		$counts = (int)$this->input->post('counts');
		$detail = $this->input->post('detail');
		$active = $this->input->post('active');

        $obj = array(
			'counts' => $counts,
			'detail' => $detail,
			'active' => $active
		);

		$main_product = $this->db->query("SELECT `product`.counts FROM `product` WHERE `product`.`id` =  '".$product_id."'")->result();
		$team_product = $this->db->query("SELECT `team_product`.* FROM `team_product` WHERE `team_product`.`team_id` =  '".$team_id."' AND `team_product`.`product_id` =  '".$product_id."'")->result();
			
		
		//###  INSERT ###//
        if($action == 'insert'){
			if(count($team_product) > 0){
				$res->status = true;
				$res->id = $id;
				$res->datas = base_url('admin_team_product_action/'.$team_id);
				$res->massege = 'มีสินค้านี้อยู่แล้ว';
				$res->status_code = '000';
			}else{

				if(count($main_product) > 0){
					$main_product_counts = (int)$main_product[0]->counts;
					if( $counts <= $main_product_counts){
						$obj['team_id'] = $team_id;
						$obj['product_id'] = $product_id;
						$obj['created'] = $curent_date;
						$obj['updated'] = $curent_date;
						$insert = $this->db->insert('team_product', $obj);
						if($insert){
							$product_counts = $main_product_counts - $counts;
							$product_obj['counts'] = $product_counts;
							$this->db->where("id", $product_id);
							$this->db->update("product", $product_obj); 
							$res->massege = 'บันทึกสำเร็จ';
						}
					}else{
						$res->massege = 'จำนวนสินค้ามีไม่เพียงพอ';
					}
				}
			}
        }
		
		//###  UPDATE ###//
        if($action == 'update'){
			// update main product stock
			if(count($team_product) > 0){

				$team_product_counts = (int)$team_product[0]->counts;
				$main_product_counts = (int)$main_product[0]->counts;

				$res->massege = 'บันทึกสำเร็จ';
				//print_r( gettype($team_product[0]->counts));exit();
				if( $counts < $team_product_counts){
					$obj['updated'] = $curent_date;
					$this->db->where("id", $id);
					$this->db->where("team_id", $team_id);
					$this->db->update("team_product", $obj); 

					$curent_count = $team_product_counts - $counts;
					$product_counts = $main_product_counts + $curent_count;
					$product_obj['counts'] = $product_counts;
					$this->db->where("id", $product_id);
					$this->db->update("product", $product_obj); 

					$res->massege = 'บันทึกสำเร็จ';
				}

				if( $counts > $team_product_counts){
					$curent_count = $counts - $team_product_counts;
					if( $main_product_counts < $curent_count){
						$res->massege = 'จำนวนสินค้ามีไม่เพียงพอ';
					}
					if( $main_product_counts >= $curent_count){
						$obj['updated'] = $curent_date;
						$this->db->where("id", $id);
						$this->db->where("team_id", $team_id);
						$this->db->update("team_product", $obj); 

						$product_counts = $main_product_counts - $curent_count;
						$product_obj['counts'] = $product_counts;
						$this->db->where("id", $product_id);
						$this->db->update("product", $product_obj); 
						$res->massege = 'บันทึกสำเร็จ';
					}
				}
				if( $counts == $team_product_counts){
					$obj['updated'] = $curent_date;
					$this->db->where("id", $id);
					$this->db->where("team_id", $team_id);
					$this->db->update("team_product", $obj);
					$res->massege = 'บันทึกสำเร็จ';
				}
			}
			
			$res->status = true;
			$res->id = $id;
			$res->datas = base_url('admin_team_product_action/'.$team_id);
			//$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }

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

}
