<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

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
		$menu['submenu'] = 'about';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$data['lang'] = $lang;
		$data['content'] = $this->ToObject($this->contents($lang));
		
		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/about',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}
	
	public function company_profile()
	{	
		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}

		$menu['main'] = (object)$this->getmainmenu();
        $menu['mainmenu'] = 'company';
		$menu['submenu'] = 'about';
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		$menu['lang'] = $lang;

		$data['lang'] = $lang;
		$data['content'] = $this->ToObject($this->contents($lang));
		
		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/companyprofile',$data);
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
				'header' => 'เกี่ยวกับเรา',
				'vision' => array(
					'header' => 'วิสัยทัศน์',
					'content' => array(
						'c1' => 'จะมุ่งมั่นพัฒนาในทุกด้าน',
						'c2' => 'จะสืบสานปณิธานไปทุกที่',
						'c3' => 'จะยืนหยัดปรัชญาทุกนาที',
						'c4' => 'ทุกครัวเรือนจะต้องมี PSI',
					)
				),
				'paragraph1' => 'บริษัท พีเอสไอ คอร์ปอเรชั่น จำกัด (PSI Corporation Co,.Ltd.) ศูนย์รวมจานดาวเทียม แอร์ กล้องวงจรปิด ผู้ผลิตและจำหน่ายจานดาวเทียม ที่ก่อตั้งมายาวนาน กว่า 30 ปี หนึ่งในความภูมิใจของคนไทยภายใต้สินค้ายี่ห้อ PSI เป็นบริษัทผู้นำทางด้านการผลิต และจำหน่ายอุปกรณ์ที่ใช้ระบบการสื่อสาร ผ่านดาวเทียมของประเทศ เพื่อเป็นการตอบสนองความต้องการของลูกค้าให้ครอบคลุมทุกกลุ่ม',
				'paragraph2' => 'PSI ได้เพิ่มการผลิตสินค้า และอุปกรณ์ที่ใช้สำหรับงานระบบ MATV , กล้องรักษาความปลอดภัย OCS (Online Camera Security) และโซลาร์เซลล์ โดยมีทีมวิจัยที่มีความเชี่ยวชาญโดยตรง ประกอบกับการนำเทคโนโลยี ดิจิตอลชั้นสูงมาใช้ในการผลิตสินค้าทุกขั้นตอน ทำให้สินค้าของเรามีมาตรฐาน เป็นที่ยอมรับของลูกค้าทั้งในประเทศ และส่งออกไปยังต่างประเทศในแถบ ตะวันออกกลาง ออสเตรเลีย แอฟริกา แอฟริกาใต้',
				'mission' => array(
					'header' => 'พันธกิจ',
					'content' => array(
						'c1' => '1. มุ่งมั่นยกระดับความรู้และคุณภาพชีวิตของพนักงาน',
						'c2' => '2. ให้ผลตอบแทนอย่างเป็นธรรมกับผู้ที่เกี่ยวข้อง',
						'c3' => '2. ให้ผลตอบแทนอย่างเป็นธรรมกับผู้ที่เกี่ยวข้อง',
						'c4' => '4. ปรับปรุงระบบการทำงานให้โปร่งใสและได้มาตรฐานสากล',
						'c5' => '5. ใช้เทคโนโลยีสมัยใหม่ในการบริหารจัดการองค์กร',
						'c6' => '6. ส่งมอบบริการและสินค้าในราคาที่เหมาะสม',
						'c7' => '7. สร้างความสำเร็จร่วมกับตัวแทนช่างและซัพพลายเออร์',
						'c8' => '8. รับผิดชอบต่อสังคม สิ่งแวดล้อม และยึดหลักธรรมาภิบาล',
					)
				),
				'companyprofile' => array(
					'c1' => 'พรีเซนเทชั่น',
					'c2' => 'คอมปานี โปรไฟล์',
					'c3' => 'เปิด'
				)
			),
			'en' => array(
				'header' => 'About us',
				'vision' => array(
					'header' => 'Vision',
					'content' => array(
						'c1' => 'Will strive to develop in all aspects.',
						'c2' => 'Will carry on the aspirations everywhere.',
						'c3' => 'Will stand up to the philosophy every minute.',
						'c4' => 'Every household must have a PSI.',
					)
				),
				'paragraph1' => "PSI Corporation Company Limited Satellite dish center Air conditioning, CCTV, manufacturer and distributor of satellite dishes. Established for more than 30 years, one of the pride of Thai people under the brand PSI is a leading company in production. and sells equipment that uses the country's satellite communication system In order to meet the needs of customers to cover all groups.",
				'paragraph2' => 'PSI has increased production of the product. and equipment used for MATV systems, OCS (Online Camera Security) security cameras and solar cells with a research team with direct expertise coupled with the introduction of technology Advanced digital is used in every step of the production. make our products standard It is accepted by customers both in the country. and exported to foreign countries in the Middle East, Australia, Africa, South Africa.',
				'mission' => array(
					'header' => 'Mission',
					'content' => array(
						'c1' => '1. Committed to improving the knowledge and quality of life of employees.',
						'c2' => '2. Provide fair returns to those involved.',
						'c3' => '2. Encourage work and engagement.',
						'c4' => '4. Improve the working system to be transparent and meet international standards.',
						'c5' => '5. Use modern technology to manage the organization.',
						'c6' => '6. Deliver services and products at reasonable prices.',
						'c7' => '7. Build success together with technician representatives and suppliers.',
						'c8' => '8. Responsibility to society, environment and adhere to good governance.',
					)
				),
				'companyprofile' => array(
					'c1' => 'Presentation',
					'c2' => 'Company profile',
					'c3' => 'View'
					
				)
			)
		);

		foreach($contents as $k => $item){
			if($k == $lang){
				array_push($res, $item);
			}
		}
		return $res[0];
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
