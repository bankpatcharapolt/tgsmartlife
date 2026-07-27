<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Helpservice extends Main {

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
	public function helpservice_page(){	
		$menu['mainmenu'] = 'helpservice';
		$menu['submenu'] = 'helpservice';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/helpservice_page');
		$this->load->view('admin/footer');
	}
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
		$Query = "SELECT `register`.* FROM `register` order by `register`.updated desc ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
    public function helpservice_add(){	
		$menu['mainmenu'] = 'helpservice';
		$menu['submenu'] = 'helpservice';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/helpservice_add');
		$this->load->view('admin/footer');
	}
    public function helpservice_edit($id){	
		$menu['mainmenu'] = 'helpservice';
		$menu['submenu'] = 'helpservice';
		$data['id'] = $id;
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/helpservice_edit',$data);
		$this->load->view('admin/footer');
	}
	public function get_results_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM register WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function helpservice_actions(){
        $res = new stdClass();
        //$post = $this->input->post();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
        $reg_name = $this->input->post('reg_name');
		$reg_address = $this->input->post('reg_address');
        $reg_telephone = $this->input->post('reg_telephone');
        $reg_email = $this->input->post('reg_email');
        $latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$active = $this->input->post('active');
		
        $obj = array( 
            'reg_name' => $reg_name, 
            'reg_address' => $reg_address,
			'reg_telephone' => $reg_telephone,
			'reg_email' => $reg_email,
			'active' => $active,
			'latitude' => $latitude,
			'longitude' => $longitude
		); 

		//###  INSERT ###//
        if($action == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('register', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_helpservice');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($action == 'update'){
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("register", $obj); 
			
			$res->status = true;
			//$res->datas = base_url('admin/product');
			$res->datas = base_url('admin_helpservice');
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}
	public function del_result() { 
		$id = $this->input->post('id');

		//### del article ###///
		$this->db->where('id', $id);
		$this->db->delete('register');
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
