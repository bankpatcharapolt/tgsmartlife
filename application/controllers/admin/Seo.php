<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Seo extends Main {

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
	//###  SEO   ###/
	public function seo_page(){	
		$menu['mainmenu'] = 'seo';
		$menu['submenu'] = 'seo';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/seo_page');
		$this->load->view('admin/footer');
	}
	
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM page_seo ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

    public function seo_add(){	
		$menu['mainmenu'] = 'seo';
		$menu['submenu'] = 'seo';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/seo_add');
		$this->load->view('admin/footer');
	}
    public function seo_edit($id){	
		$menu['mainmenu'] = 'seo';
		$menu['submenu'] = 'seo';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/seo_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_results_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM page_seo WHERE id = $id ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function seo_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$page_seo = $this->input->post('page');
        $seo_title = $this->input->post('seo_title');
        $seo_keyword = $this->input->post('seo_keyword');
		$seo_description = $this->input->post('seo_description');
		$category = $this->input->post('category');
		
        $obj = array( 
            'page' => $page_seo, 
            'seo_title' => $seo_title, 
			'seo_keyword' => $seo_keyword,
			'seo_description' => $seo_description,
			'category' => $category
		); 
        
		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('page_seo', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_seo');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("page_seo", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_seo');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}

	public function del_result() { 
		$id = $this->input->post('id');
		//### del career ###///
		$this->db->where('id', $id);
		$this->db->delete('page_seo');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
