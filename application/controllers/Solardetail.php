<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solardetail extends CI_Controller {

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
	public function index()
	{
		//$this->load->view('welcome_message');
        $menu['mainmenu'] = 'solardetail';
		$menu['submenu'] = 'solardetail';

		//hide menu (app)
		// $headers = $this->getRequestHeaders();
		// if($headers['Ishidestatus'] == '1'){
		// 	$this->load->view('desktop/header_assete');
		// 	$this->load->view('desktop/solardetail');
		// 	$this->load->view('desktop/footer_assete');
		// }else{
		// 	$this->load->view('desktop/header_assete',$menu);
		// 	$this->load->view('desktop/header',$menu);
		// 	$this->load->view('desktop/solardetail');
		// 	$this->load->view('desktop/footer');
		// 	$this->load->view('desktop/footer_assete');
		// }
		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/solardetail');
		$this->load->view('desktop/footer');
		$this->load->view('desktop/footer_assete');
	
	}
	

	public function getRequestHeaders() {
		$headers = array();
		$headers['Ishidestatus'] = '0';
		
		foreach($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') { continue; }
			
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			if($header == 'Ishidestatus'){
				$headers['Ishidestatus'] = $value;
			}else{
				$headers[$header] = $value;
			}
		}
		return $headers;
	}
}
