<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
	public function index()
	{
		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}
		
		$menu['main'] = (object)$this->getmainmenu();
        $menu['mainmenu'] = 'company';
		$menu['submenu'] = 'contact';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$data['lang'] = $lang;
		$data['content'] = $this->ToObject($this->contents($lang));

		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/contact',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}
	public function getmainmenu()
	{
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$results = json_decode(file_get_contents("assete/datafile/main.json", false, stream_context_create($arrContextOptions)), true);
		$obj = $this->ToObject($results);
		return $obj;
	}
	public function ToObject($Array) {
		$object = new stdClass();
		foreach ($Array as $key => $value) {
			if (is_array($value)) {
				$value = $this->ToObject($value);
			}
			$object->$key = $value;
		}
		return $object;
	}
	public function contents($lang){
		$res = array();
		$contents = array(
			'th' => array(
				'header' => 'ติดต่อสอบถาม',
				'label' => 'ต้องการสอบถามข้อมูลหรือสนใจสั่งซื้อสินค้า กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน จากนั้นเจ้าหน้าที่จะติดต่อกลับหาคุณ',
				'fname' => 'ชื่อ',
				'sname' => 'นามสกุล',
				'tel' => 'เบอร์โทรที่สามารถติดต่อได้',
				'serial_number'=>'Serial number ของ  inverter solarcell (ถ้ามี)',
				'email' => 'อีเมล',
				'message' => 'รายละเอียดเนื้อหาที่ต้องการติดต่อ',
				'btn_label' => 'ส่งข้อมูล',

				'call' => 'โทรสอบถาม',
				'business_topic' => 'เวลาทำการ',
				'business_1' => 'วันจันทร์ ถึง วันศุกร์ 08:00 - 17:00 น.',
				'business_2' => 'วันเสาร์ 08:00 - 15:00 น.',
				'business_3' => 'หยุดวันอาทิตย์',
			),
			'en' => array(
				'header' => 'Contact us',
				'label' => 'Want to ask questions or want to place an order? Please enter correct and complete information. The staff will then contact your back.',
				'fname' => 'Name',
				'sname' => 'Lastname',
				'tel' => 'Contact number',
				'serial_number'=>'Serial Number of solar cell inverter (if any)',
				'email' => 'E-mail',
				'message' => 'Contact detail',
				'btn_label' => 'Send',

				'call' => 'Call to inquire',
				'business_topic' => 'Business hours',
				'business_1' => 'Moday to Friday 08:00 am - 05:00 pm',
				'business_2' => 'Saturday 08:00 am - 03:00 pm',
				'business_3' => 'Sunday off',

			)
		);

		foreach($contents as $k => $item){
			if($k == $lang){
				array_push($res, $item);
			}
		}
		return $res[0];
	}

	public function sending_email()
	{
		$name = $this->input->post('fname');
		$sname = $this->input->post('sname');
		$tel = $this->input->post('tel');
		$serial = $this->input->post('serial');
		$email = $this->input->post('email');
		$desc = $this->input->post('desc');
		
		$to_email = "psicustomer_care@psisat.com";
        //$to_email = "kraiwut@psisat.com";
        //$to_email = "kbu.engicom@gmail.com";
		//$fullname = $name.' '.$sname;
		$fullname = 'PSI Energy website ';
		$message = $this->email_messege($name, $sname, $email, $tel, $serial, $desc);
		
		//Load email library
        $this->load->library('email');
		$config = array();
		$config['smtp_crypto'] = 'ssl';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.psisat.com';
		$config['smtp_user'] = 'psienergy@psisat.com';
		$config['smtp_pass'] = 'B$wlFit&6a47';
		$config['smtp_port'] = 465;
		$config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
		$config['charset'] = 'UTF-8';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('psienergy@psisat.com',$fullname);
        $this->email->to($to_email);
        $this->email->subject('PSI Energy');
        $this->email->message($message);
        //Send mail
		$sending = $this->email->send();
        if($sending){
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			redirect(base_url('contact'));
		}else{
            $this->session->set_flashdata("email_sent","You have encountered an error");
			redirect(base_url('contact'));
		}
	}
	public function email_messege($name, $sname, $email, $tel, $serial, $desc) {
		$string ='
			<table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
				<tbody>
					<tr style="vertical-align: top">
					<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
						<div class="u-row-container" style="padding: 0px;background-color: transparent">
						<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
							<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
							<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
								<div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
								<div style="padding: 10px 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
									<table id="u_content_heading_2" style="font-family:Montserrat,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
									<tbody>
										<tr>
										<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:Montserrat,sans-serif;" align="left">
											<h1 class="v-text-align v-font-size" style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 25px;">
											<strong>ข้อมูลติดต่อจาก PSI Energy</strong>
											</h1>
										</td>
										</tr>
									</tbody>
									</table>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="u-row-container" style="padding: 0px;background-color: #f1f1f1">
						<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
							<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
							<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
								<div style="background-color: #f1f1f1;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
								<div style="padding: 30px 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
									<table id="u_content_text_1" style="font-family:Montserrat,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
									<tbody>
										<tr>
										<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 30px;font-family:Montserrat,sans-serif;" align="left">
											<div class="v-text-align" style="line-height: 160%; text-align: justify; word-wrap: break-word;">
											<p style="font-size: 14px; line-height: 160%;">
												<span style="font-size: 16px; line-height: 25.6px;">
													<strong>คุณ '.$name.' '. $sname.'</strong>
												</span>
											</p>
											<p style="font-size: 14px; line-height: 160%;">
												<span style="font-size: 16px; line-height: 25.6px;">
													<strong>Email: '.$email.'</strong>
												</span>
											</p>
											<p style="font-size: 14px; line-height: 160%;">
												<span style="font-size: 16px; line-height: 25.6px;">
													<strong>Tel:'.$tel.'</strong>
												</span>
											</p>
											<p style="font-size: 14px; line-height: 160%;">
												<span style="font-size: 16px; line-height: 25.6px;">
													<strong>Serial number ของ inverter solarcell :'.$serial.'</strong>
												</span>
											</p>
											<p style="font-size: 14px; line-height: 160%;"></p>
											<p style="font-size: 14px; line-height: 160%;">'.$desc.'</p>
											</div>
										</td>
										</tr>
									</tbody>
									</table>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="u-row-container" style="padding: 0px;background-color: transparent">
						<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
							<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
							<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
								<div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
								<div style="padding: 30px 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
								
									<table style="font-family:Montserrat,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
									<tbody>
										<tr>
										<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:Montserrat,sans-serif;" align="left">
											<h1 class="v-text-align v-font-size" style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: Montserrat,sans-serif; font-size: 19px;">
											บริษัท พีเอสไอ คอร์ปอเรชั่น จำกัด
											</h1>
										</td>
										</tr>
									</tbody>
									</table>

								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
					</td>
					</tr>
				</tbody>
			</table>';

		return $string;
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
