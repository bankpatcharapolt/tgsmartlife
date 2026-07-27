<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Maintain extends Main {

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
		
		$this->load->model('maintain_model'); // โหลด maintain_model
    }

	public function ma_actions($id = null){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = [];
		$data['status'] = $status;

		$this->db->where('id', $id);
		$this->db->update('service_requests', $data);

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'แก้ไขสำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);

	}
	public function maintain_edit($id){	
		$menu['mainmenu'] = 'maintain';
		$menu['submenu'] = 'maintain';
	
      
        $ma = $this->maintain_model->get_all_maintains($id); 
        
        $data['issues'] =$ma;

		$this->load->view('admin/header',$menu);
		$this->load->view('admin/maintain_edit',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function del_result() { 
		$id = $this->input->post('id');
		//### del career ###///
		$this->db->where('id', $id);
		$this->db->delete('service_requests');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

    public function index() {
        $data['maintains'] = $this->maintain_model->get_all_maintains(); 
		$menu['mainmenu'] = 'maintain';
		$menu['submenu'] = 'maintain';
		
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/maintain_list', $data); 
		$this->load->view('admin/footer');

      
    }
}
