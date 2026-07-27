<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Electriccalc extends CI_Controller {

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
        $menu['mainmenu'] = 'electriccalc';
		$menu['submenu'] = 'electriccalc';

		$lang = 'th';
		$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}
		
		$menu['main'] = (object)$this->getmainmenu();
		$menu['lang'] = $lang;
		$menu['langlogo'] = '<img src="'.$langlogourl.'">';
		
		$data['lang'] = $lang;

		//$data['category'] = 'nnnnnnnnnnnnnnn';
		//$headers = $this->getRequestHeaders();

		//lang
		// $language = $headers['Language'];
		// $data['lang'] = $language;
		// /$data['content'] = $this->contents($lang);
		$content = $this->contents($lang);
		$data['content'] = $content;
		$data['device'] = $this->device();

		$this->advert($lang);

		$this->load->view('desktop/header_assete',$menu);
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/electric_calc',$data);
		$this->load->view('desktop/footer',$menu);
		$this->load->view('desktop/footer_assete');
	}

    public function get_content()
	{
		$lang = 'th';
		//$langlogourl = base_url("assete/icons/language_icon/flag_thai_icon.png");
		if($this->session->userdata('Language') == 'en'){ 
			//$langlogourl = base_url("assete/icons/language_icon/flag_eng_icon.png");
			$lang = $this->session->userdata('Language');
		}

		$content = $this->contents($lang);
        echo Json_encode($content);
	}
    public function get_device()
	{
		$device = $this->device();
        echo Json_encode($device);
	}
	public function get_advert()
	{
		$power = (int)$this->input->get('power');
		$lang = 'th';
		if($this->session->userdata('Language') == 'en'){ 
			$lang = $this->session->userdata('Language');
		}
		$advert = $this->advert($lang);
		$adv = '';
		foreach($advert as $item){
			if($item['min'] <= $power && $item['max'] >= $power){
				$adv = $item;
			}
		}
        echo Json_encode($adv);
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
				'calc_panel' => array(
					'add_btn' => 'เพิ่มอุปกรณ์',
					'del_btn' => 'ลบอุปกรณ์',
					'device' => 'เครื่องใช้ไฟฟ้า',
					'quantity' => 'จำนวน',
					'power' => 'กำลังไฟ (วัตต์)',
					'time' => 'เวลาที่ใช้ต่อวัน (ชั่วโมง)',
					'calc_btn' => 'คำนวณ'
				),
				'final_panel' => array(
                    'topic'=>'กำลังไฟที่ใช้ทั้งหมด',
                    'text'=>'ตารางแสดงกำลังไฟที่ใช้ภายในบ้าน',
					'device' => 'เครื่องใช้ไฟฟ้า',
					'quantity' => 'จำนวน',
					'power' => 'กำลังไฟ (วัตต์)',
					'time' => 'เวลาที่ใช้ต่อวัน (ชั่วโมง)',
					'sum_power' => 'รวมกำลังไฟ',
					'total_power' => 'รวมกำลังไฟทั้งหมด (วัตต์)'
				)
			),
			'en' => array(
				'calc_panel' => array(
					'add_btn' => 'Add device',
					'del_btn' => 'Delete device',
					'device' => 'Device',
					'quantity' => 'Quantity',
					'power' => 'Power(watts)',
					'time' => 'Time spent per day (hours)',
					'calc_btn' => 'Calculate'
					
                ),
				'final_panel' => array(
                    'topic'=>'Total power consumed',
                    'text'=>'The table shows the power used within the house.',
					'device' => 'Device',
					'quantity' => 'Quantity',
					'power' => 'Power(watts)',
					'time' => 'Time spent per day (hours)',
					'sum_power' => 'Total power',
					'total_power' => 'Total power (watts)'
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
    public function device(){
		$contents = '[
            { "id":"1", "th":"เครื่องทำน้ำอุ่น", "en":"Water heater", "watt":"5000" },
            { "id":"2", "th":"เครื่องปรับอากาศ", "en":"Air conditioner", "watt":"2000" },
            { "id":"3", "th":"เครื่องซักผ้า แบบมีเครื่องอบ", "en":"Washing machine with oven", "watt":"3000" },
            { "id":"4", "th":"เตารีดไฟฟ้า", "en":"Electric iron", "watt":"900" },
            { "id":"5", "th":"หม้อหุงข้าว", "en":"Rice cooker", "watt":"600" },
            { "id":"6", "th":"เตาหุงต้มไฟฟ้า", "en":"Electric cooker", "watt":"1000" },
            { "id":"7", "th":"เครื่องดูดฝุ่น", "en":"Vacuum cleaner", "watt":"900" },
            { "id":"8", "th":"เครื่องปิ้งขนมปัง", "en":"Toaster", "watt":"400" },
            { "id":"9", "th":"ไดร์เป่าผม", "en":"Hair dryer", "watt":"150" },
            { "id":"10", "th":"เตาไมโครเวฟ", "en":"Microwave oven", "watt":"500" },
            { "id":"11", "th":"เครื่องชงกาแฟ", "en":"Coffee machine", "watt":"500" },
            { "id":"12", "th":"โทรทัศน์สี", "en":"Television", "watt":"180" },
            { "id":"13", "th":"ตู้เย็น", "en":"Fridge", "watt":"85" },
            { "id":"14", "th":"พัดลมเพดาน", "en":"Ceiling fan", "watt":"90" },
            { "id":"15", "th":"พัดลมตั้งพื้น", "en":"Floor fan", "watt":"70" },
            { "id":"16", "th":"หลอดไฟ", "en":"Light bulb", "watt":"10" },
            { "id":"17", "th":"คอมพิวเตอร์", "en":"Computer", "watt":"250" }
        ]';
        
		return JSON_decode($contents) ;
	}
	public function advert($lang){
		$res = [];
		$contents = array(
			'th' => array(
				[
					'min' => '0',
					'max' => '4200',
					'product_label' => 'แนะนำชุดโซลาร์เซลล์รุ่นที่เหมาะสมกับการใช้งาน 0 - 4,200 วัตต์',
					'product_image' => base_url("assete/images/product_adv/hybrid_pro_4_thumbnail.png")
				],[
					'min' => '4201',
					'max' => '6200',
					'product_label' => 'แนะนำชุดโซลาร์เซลล์รุ่นที่เหมาะสมกับการใช้งาน 4,200 - 6,200 วัตต์',
					'product_image' => base_url("assete/images/product_adv/hybrid_pro_6_thumbnail.png")
			]),
			'en' => array(
				[
					'min' => '0',
					'max' => '4200',
					'product_label' => 'Recommend a solar cell kit model that is suitable for use. 0 - 4,200 watts',
					'product_image' => base_url("assete/images/product_adv/hybrid_pro_4_thumbnail.png")
				],[
					'min' => '4201',
					'max' => '6200',
					'product_label' => 'Recommend a solar cell kit model that is suitable for use. 4,200 - 6,200 watts',
					'product_image' => base_url("assete/images/product_adv/hybrid_pro_6_thumbnail.png")
			])
		);

		foreach($contents as $k => $item){
			if($k == $lang){
				$res = $item;
			}
		}
		return (object)$res;
	}
}
