<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teamsales extends CI_Controller {

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
		
		$this->_authemtication();    
    }

	public function _authemtication() {
		if(!$this->session->userdata('teamsale_login')){
			redirect(base_url('teamsale'));
		}
	}
}
