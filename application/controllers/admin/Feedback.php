<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Feedback extends Main {

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
		
		$this->load->model('Feedback_model'); // โหลด Feedback_model
    }
	

    public function index() {
        $data['feedbacks'] = $this->Feedback_model->get_all_feedbacks(); 
		$menu['mainmenu'] = 'feedback';
		$menu['submenu'] = 'feedback';
		
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/feedback_list', $data); 
		$this->load->view('admin/footer');

      
    }
	public function del_result() { 
		$id = $this->input->post('id');

		//### del article ###///
		$this->db->where('id', $id);
		$this->db->delete('service_feedback');
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

}
