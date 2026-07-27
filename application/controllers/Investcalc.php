<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investcalc extends CI_Controller {

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
        $menu['mainmenu'] = 'investcalc';
		$menu['submenu'] = 'investcalc';
		$menu['lang'] = $lang;
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		
		$data['lang'] = $lang;
		$content = $this->ToObject($this->contents($lang));
		$data['content'] = $content;
		$data['family'] = $content->family;
		$data['family_form'] = $content->family->form;
		$data['family_table'] = $content->family->table;
		$data['business'] = $content->business;
		$data['business_form'] = $content->business->form;
		$data['business_table'] = $content->business->table;


		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/investcalc',$data);
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
				'header' => 'คำนวณการลงทุนการติดตั้งโซลาร์เซลล์',
				'family' => array(
					'tab' => 'ภาคครัวเรือน',
					'form' => array(
						'label' => 'ใส่ตัวเลขเพื่อคำนวณภาคครัวเรือน',
						'totalamount' => 'จำนวนเงินลงทุนทั้งหมด (บาท)',
						'pvtotal' => 'ขนาดกำลังแผง PV ทั้งระบบ (kWp)',
						'electricbill' => 'อัตราค่าไฟฟ้า (บาท/หน่วย)',
						'iamount' => 'จำนวนเงินลงทุน/วัตต์ (บาท)',
						'calculate_btn' => 'คำนวณ',
					),
					'table' => array(
						'label' => 'ตารางคำนวณจุดคุ้มทุน',
						'year' => 'ปีที่',
						'power_generation_unit' => 'หน่วยผลิตไฟฟ้าที่ได้',
						'electricity_received' => 'ค่าไฟฟ้าที่ได้รับ (บาท)',
						'accumulated_electricity_cost' => 'ค่าไฟฟ้าที่ผลิตได้สะสม',
						'payback' => 'คืนทุน (บาท)',
						'note'=>'* หมายเหตุ แถบสีฟ้าคือ ค่าผลิตไฟที่ได้สะสมมากกว่า จำนวนเงินลงทุนทั้งหมด'
					)
				),
				'business' => array(
					'tab' => 'ภาคธุรกิจ',
					'form' => array(
						'label' => 'ใส่ตัวเลขเพื่อคำนวณภาคธุรกิจ',
						'totalamount' => 'จำนวนเงินลงทุนทั้งหมด (บาท)',
						'pvtotal' => 'ขนาดกำลังแผง PV ทั้งระบบ (kWp)',
						'eleconpeak' => 'อัตราค่าไฟฟ้าช่วง on peak (บาท/หน่วย)',
						'elecoffpeak' => 'อัตราค่าไฟฟ้าช่วง off peak (บาท/หน่วย)',
						'onpeakper' => '% การใช้ไฟฟ้าช่วง on peak (สูงสุด 100%)',
						'offpeakper' => '% การใช้ไฟฟ้าช่วง off peak (สูงสุด 100%)',
						'iamount' => 'จำนวนเงินลงทุน/วัตต์ (บาท)',
						'calculate_btn' => 'คำนวณ',
					),
					'table' => array(
						'label' => 'ตารางคำนวณจุดคุ้มทุน',
						'year' => 'ปีที่',
						'pgu' => array(
							'detailhead' => 'รายละเอียดหน่วยผลิตไฟฟ้าที่ได้',
							'head' => 'หน่วยผลิตไฟฟ้าที่ได้',
							'column' => array(
								'onpeak' => 'On Peak',
								'offpeak' => 'Off Peak',
								'total' => 'รวม'
							),
						),
						'er' => array(
							'detailhead' => 'รายละเอียดค่าไฟฟ้าที่ได้รับ (บาท)',
							'head' => 'ค่าไฟฟ้าที่ได้รับ (บาท)',
							'column' => array(
								'onpeak' => 'On Peak',
								'offpeak' => 'Off Peak',
								'total' => 'รวม'
							),
						),
						'accumulated_electricity_cost' => 'ค่าไฟฟ้าที่ผลิตได้สะสม',
						'payback' => 'คืนทุน (บาท)',
						'note'=>'* หมายเหตุ แถบสีฟ้าคือ ค่าผลิตไฟที่ได้สะสมมากกว่า จำนวนเงินลงทุนทั้งหมด'
					)
				)
			),
			'en' => array(
				'header' => 'Calculate solarcell installation investment',
				'family' => array(
					'tab' => 'Household sector',
					'form' => array(
						'label' => 'Enter a numerical value to calculate the household sector.',
						'totalamount' => 'Total investment amount (Baht)',
						'pvtotal' => 'Total PV panel power (kWp)',
						'electricbill' => 'Electricity rate (Baht/Unit)',
						'iamount' => 'Investment amount/watt (Baht)',
						'calculate_btn' => 'Calculate',
					),
					'table' => array(
						'label' => 'Break-even point calculation table',
						'year' => 'Year',
						'power_generation_unit' => 'Power generation unit',
						'electricity_received' => 'Electricity received (Baht)',
						'accumulated_electricity_cost' => 'Accumulated electricity cost',
						'payback' => 'Payback (Bath)',
						'note'=>'Note : The blue bar is the more accumulated power generation. total investment amount'
					)
				),
				'business' => array(
					'tab' => 'Business sector',
					'form' => array(
						'label' => 'Enter a numerical value to calculate the business sector.',
						'totalamount' => 'Total investment amount (Baht)',
						'pvtotal' => 'Total PV panel power (kWp)',
						'eleconpeak' => 'On-peak electricity tariff (Baht/unit)',
						'elecoffpeak' => 'Off-peak electricity tariff (Baht/unit)',
						'onpeakper' => 'Percentage of electricity consumption during on peak (up to 100%)',
						'offpeakper' => 'Percentage of electricity consumption during off peak (up to 100%)',
						'iamount' => 'Investment amount/watt (Baht)',
						'calculate_btn' => 'Calculate',
					),
					'table' => array(
						'label' => 'Break-even point calculation table',
						'year' => 'Year',
						'pgu' => array(
							'detailhead' => 'Detail of power generation unit',
							'head' => 'Power generation unit',
							'column' => array(
								'onpeak' => 'On Peak',
								'offpeak' => 'Off Peak',
								'total' => 'Total'
							),
						),
						'er' => array(
							'detailhead' => 'Detail of electricity received (Baht)',
							'head' => 'Electricity received (Baht)',
							'column' => array(
								'onpeak' => 'On Peak',
								'offpeak' => 'Off Peak',
								'total' => 'Total'
							),
						),
						'accumulated_electricity_cost' => 'Accumulated electricity cost',
						'payback' => 'Payback (Bath)',
						'note'=>'Note : The blue bar is the more accumulated power generation. total investment amount'
					)
				)
			)
		);

		foreach($contents as $k => $item){
			if($k == $lang){
				array_push($res, $item);
			}
		}
		return (object)$res[0];
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
