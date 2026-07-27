<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
//require_once APPPATH . '/libraries/Main.php';
require_once APPPATH . '/libraries/Main.php';
class Others extends Main {

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
	//###  tgsmartlifeservice   ###/
	public function tgsmartlifeservice(){	
		$menu['mainmenu'] = 'tgsmartlifeservice';
		$menu['submenu'] = 'tgsmartlifeservice';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/tgsmartlifeservice');
		$this->load->view('admin/footer');
	}
	public function get_tgsmartlifeservice() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM others  WHERE method = 'tgsmartlifeservice' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function actions_tgsmartlifeservice(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$detail = $this->input->post('detail');
        $topic = $this->input->post('topic');
		$active = $this->input->post('active');
		
        $obj = array( 
            'topic' => $topic,
			'detail' => $detail, 
			'method' => 'tgsmartlifeservice', 
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('others', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_tgsmartlifeservice');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("others", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_tgsmartlifeservice');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}

	
	//###  tgsmartlifeproject  ###/
	public function tgsmartlifeproject(){	
		$menu['mainmenu'] = 'tgsmartlifeproject';
		$menu['submenu'] = 'tgsmartlifeproject';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/tgsmartlifeproject');
		$this->load->view('admin/footer');
	}
	public function get_tgsmartlifeproject() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT * FROM others WHERE method = 'tgsmartlifeproject' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function actions_tgsmartlifeproject(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$detail = $this->input->post('detail');
        $topic = $this->input->post('topic');
		$active = $this->input->post('active');
		
        $obj = array( 
            'topic' => $topic,
			'detail' => $detail, 
			'method' => 'tgsmartlifeproject', 
			'active' => $active
		);

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('others', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_tgsmartlifeproject');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("others", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_tgsmartlifeproject');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}
}
