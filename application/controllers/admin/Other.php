<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Other extends Main {

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
	public function webcontact_page(){	
		$menu['mainmenu'] = 'webcontact';
		$menu['submenu'] = 'webcontact';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/webcontact_page');
		$this->load->view('admin/footer');
	}
    // public function webcontact_add(){	
	// 	$menu['mainmenu'] = 'career';
	// 	$menu['submenu'] = 'career';
	// 	$this->load->view('admin/header',$menu);
	// 	$this->load->view('admin/career_add');
	// 	$this->load->view('admin/footer');
	// }
    public function webcontact_edit($id){	
		$menu['mainmenu'] = 'webcontact';
		$menu['submenu'] = 'webcontact';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/webcontact_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_webcontact() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM web_contact ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function get_webcontact_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM web_contact WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function webcontact_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$active = $this->input->post('active');
		
        $obj = array( 
			'active' => $active
		); 
        
		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('web_contact', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_webcontact');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("web_contact", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_webcontact');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}

	public function del_webcontact() { 
		$id = $this->input->post('id');
		//### del career ###///
		$this->db->where('id', $id);
		$this->db->delete('web_contact');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
