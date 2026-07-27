<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_email extends CI_Controller {

	private $data = array();

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

		// $this->load->library('session');
		// $this->load->library('email');
		// $this->load->library("pagination");
		
     	//เรียกใช้งาน Class helper     
        $this->load->helper('url'); 
      	$this->load->helper('form');
		$this->load->helper('file'); 
        // Load email library
        $this->load->library('email');
       
   


	
    }
	public function index(){
		$menu['mainmenu'] = 'home';
		$menu['submenu'] = 'home';
		$menu['seo'] = "";
		if(isset($_GET['user_id'])){
			$this->db->set('updated', DATE("Y-m-d H:i:s")); // กำหนดรหัสผ่านใหม่
			$this->db->set('is_email_verify', 1); // กำหนดรหัสผ่านใหม่
			$this->db->where('id', $_GET['user_id']);
			$this->db->update('users'); // อัพเดทข้อมูลในตาราง users
		}
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/verify_email_redirect' ,[]);
		$this->load->view('desktop/footer');                          
	}


	

}