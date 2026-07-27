<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Career extends Main {

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
	public function career_page(){	
		$menu['mainmenu'] = 'career';
		$menu['submenu'] = 'career';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/career_page');
		$this->load->view('admin/footer');
	}
	
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM career ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

    public function career_add(){	
		$menu['mainmenu'] = 'career';
		$menu['submenu'] = 'career';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/career_add');
		$this->load->view('admin/footer');
	}
    public function career_edit($id){	
		$menu['mainmenu'] = 'career';
		$menu['submenu'] = 'career';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/career_edit',$data);
		$this->load->view('admin/footer');
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
		$group = $this->input->post('group');

		$Query = " SELECT * FROM images WHERE id = '".$id."' AND ref_id = '".$ref_id."' AND `group` = '".$group."'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);
			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('ref_id', $item->ref_id);
			$this->db->where('group', $item->group);
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
        $Query = "SELECT * FROM career WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function career_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$method = $this->input->post('method');
		//$category = $this->input->post('category');
		$id = $this->input->post('id');
		$detail = $this->input->post('details');
        $topic = $this->input->post('topic');
        $counts = $this->input->post('counts');
		$active = $this->input->post('active');
		
        $obj = array( 
            'topic' => $topic, 
            'counts' => $counts, 
			//'article_type' => $category, 
			'detail' => $detail, 
			// 'rewrite_url' => $category, 
			// 'seo_title' => $category, 
			// 'seo_keyword' => $category, 
			// 'seo_description' => $category, 
			'active' => $active
		); 
        
		//###  INSERT ###//
        if($method == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('career', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_career_edit/'.$id);
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($method == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("career", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_career_edit/'.$id);
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}

	public function del_result() { 
		$id = $this->input->post('id');
		//### del career ###///
		$this->db->where('id', $id);
		$this->db->delete('career');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
