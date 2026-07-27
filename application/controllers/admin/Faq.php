<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'admin/Main.php';
require_once APPPATH . '/libraries/Main.php';

class Faq extends Main {

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
	//###  PRODUCT   ###/
	public function faq_page(){	
		$menu['mainmenu'] = 'career';
		$menu['submenu'] = 'career';
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/faq_page');
		$this->load->view('admin/footer');
	}
	
	public function get_results() {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT faq_main.topic as faq_main_topic , faq_sub.* FROM faq_main inner join faq_sub on faq_main.id = faq_sub.faq_main_id ";
		$result = $this->db->query($Query)->result_array();
    
		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

    public function faq_add(){	
		$menu['mainmenu'] = 'faq';
		$menu['submenu'] = 'faq';

        $faq_main = $this->get_faq_main();
   
		$this->load->view('admin/header',$menu);
		$this->load->view('admin/faq_add' , ["faq_main" =>$faq_main]);
		$this->load->view('admin/footer');
	}

    public function get_result_faq($faq_id = null) {  
		//$cate_id = $this->input->post('cate_id');
        $Query = "SELECT faq_main.topic as faq_main_topic 
        , faq_sub.* FROM faq_main inner join faq_sub on faq_main.id = faq_sub.faq_main_id ";
        if($faq_id != null){
            $Query .= " where faq_sub.id = " . $faq_id;
        }
		$result = $this->db->query($Query)->result_array();
        return $result;
	}

    public function get_faq_onc() {   
		$id = $this->input->post('id');
        $result = $this->get_result_faq($id);
      

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
    public function faq_edit($id){	
		$menu['mainmenu'] = 'faq';
		$menu['submenu'] = 'faq';
		$data['id'] = $id;
        $faq_main = $this->get_faq_main();
        $faq_sub = $this->get_result_faq($id);
        
        $data['faq_main'] =$faq_main;

		$this->load->view('admin/header',$menu);
		$this->load->view('admin/faq_edit',$data);
		$this->load->view('admin/footer');
	}
	
    public function get_faq_main($id = null) {   
		
		$Query = " SELECT * FROM faq_main  ";
        if(!empty($id)){
            $Query .= " where id = " .$id;
        }
		$result = $this->db->query($Query)->result_array();

		return $result;
	}
	public function del_image() { 
		$id = $this->input->post('id');
		$ref_id = $this->input->post('ref_id');
		$group = $this->input->post('group');

		$Query = " SELECT * FROM images WHERE id = '".$id."' AND ref_id = '".$ref_id."' AND `group` = '".$group."'";
		$result = $this->db->query($Query)->result();

		//### del imgage ###///
		foreach($result as $item){
			unlink($item->path);
			//$this->db->query(" DELETE FROM product_image  WHERE id ='".$item->id."' AND product_cate = '".$cate_id."' AND product_id = '".$product_id."'");
			$this->db->where('id', $item->id);
			$this->db->where('ref_id', $item->ref_id);
			$this->db->where('group', $item->group);
    		$this->db->delete('images');
		}

		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
		
	}
	public function get_results_once() {  
		$id = $this->input->post('id');
        $Query = "SELECT * FROM career WHERE id = '".$id."' ";
		$result = $this->db->query($Query)->result_array();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
	public function faq_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$method = $this->input->post('method');
		$faq_main_id = $this->input->post('faq_main_id');
        $topic = $this->input->post('topic');
        $desc = $this->input->post('desc');
	
		
        $obj = array( 
            'faq_main_id' => $faq_main_id, 
            'topic' => $topic, 
            'desc' => $desc, 
			"created"=> DATE("Y-m-d H:i:s")
		); 
        
		//###  INSERT ###//
        if($method == 'insert'){
			$obj['created'] = $curent_date;
			$obj['updated'] = $curent_date;
			$insert = $this->db->insert('faq_sub', $obj);
            if($insert){
                $id = $this->db->insert_id();
                $res->status = true;
                //$res->datas = base_url('admin/product');
                $res->datas = base_url('admin_faq_sub/faq_add');
                $res->massege = 'บันทึกสำเร็จ';
                $res->status_code = '000';
            }
        }

		//###  UPDATE ###//
        if($method == 'update'){
            $id = $this->input->post('id');
			$obj['updated'] = $curent_date;
            $this->db->where("id", $id);
            $this->db->update("faq_sub", $obj); 
			
			$res->status = true;
			$res->datas = base_url('admin_faq_sub/faq_edit/'.$id);
			$res->massege = 'บันทึกสำเร็จ';
			$res->status_code = '000';
        }
		echo json_encode($res);
	}

	public function del_result() { 
		$id = $this->input->post('id');
		//### del career ###///
		$this->db->where('id', $id);
		$this->db->delete('faq_sub');
			
		$res = new stdClass();
		$res->status = true;
		$res->massege = 'ลบข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}
}
