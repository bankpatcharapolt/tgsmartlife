<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/Teamsales.php';
class Teamsale extends Teamsales {

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
    }
    
	public function product_page()
	{	
        $menu['mainmenu'] = 'product';
		$menu['submenu'] = 'product';
		$this->load->view('teamsale/header',$menu);
		$this->load->view('teamsale/product_page');
		$this->load->view('teamsale/footer');
	}
	public function get_product() {   
		$teamsale_id = $this->session->userdata('teamsale_id');
		$Query = "SELECT product.*, team_product.counts as team_product_count, team_product.active as  team_product_active  FROM `team_product` 
		INNER JOIN product ON team_product.product_id = product.id
		WHERE team_product.team_id = ".$teamsale_id;
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	
	public function product_sold_out()
	{	
        $menu['mainmenu'] = 'product';
		$menu['submenu'] = 'soldout';
		$this->load->view('teamsale/header',$menu);
		$this->load->view('teamsale/product_sold_out_page');
		$this->load->view('teamsale/footer');
	}
	public function get_product_sold_out() {   
		$teamsale_id = $this->session->userdata('teamsale_id');
		$Query = "SELECT team_product_sold_out.*, product.thumnal, product.productcode, product.name,product.price,product.saleprice
		FROM `team_product_sold_out` 
		INNER JOIN product ON team_product_sold_out.product_id = product.id
		WHERE team_product_sold_out.team_id = ".$teamsale_id;
		$result = $this->db->query($Query)->result();

		$res = new stdClass();
		$res->status = true;
		$res->datas = $result;
		$res->massege = 'ดึงข้อมูล สำเร็จ';
		$res->status_code = '000';
		echo json_encode($res);
	}

	public function product_sold_out_add(){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'soldout';
		$this->load->view('teamsale/header',$menu);
		$this->load->view('teamsale/product_sold_out_add');
		$this->load->view('teamsale/footer');
	}
	public function product_sold_out_edit($id){	
		$menu['mainmenu'] = 'product';
		$menu['submenu'] = 'soldout';
		$data['id'] = $id;
		$this->load->view('teamsale/header',$menu);
		$this->load->view('teamsale/product_sold_out_edit',$data);
		$this->load->view('teamsale/footer');
	}

	
	public function team_product_actions(){
        $res = new stdClass();
        $curent_date = Date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$team_id = $this->session->userdata('teamsale_id');
		$id = $this->input->post('id');
		$product_id = $this->input->post('product_id');
		$counts = (int)$this->input->post('counts');
		$detail = $this->input->post('detail');
		$sold_out_date = $this->input->post('sold_out_date');

        $obj = array(
			'counts' => $counts,
			'detail' => $detail,
			'sold_out_date' => $sold_out_date
		);

		$main_product = $this->db->query("SELECT `team_product`.* FROM `team_product` WHERE `team_product`.`team_id` =  '".$team_id."' AND `team_product`.`product_id` =  '".$product_id."'")->result();
		//$team_product = $this->db->query("SELECT `team_product`.* FROM `team_product` WHERE `team_product`.`team_id` =  '".$team_id."' AND `team_product`.`product_id` =  '".$product_id."'")->result();
		
		//print_r($action);exit();
		//###  INSERT ###//
        if($action == 'insert'){
			if(count($main_product) > 0){
				$main_product_counts = (int)$main_product[0]->counts;
				if( $counts <= $main_product_counts){
					$obj['team_id'] = $team_id;
					$obj['product_id'] = $product_id;
					$obj['created'] = $curent_date;
					$obj['updated'] = $curent_date;

					
					$insert = $this->db->insert('team_product_sold_out', $obj);
					if($insert){
						$product_counts = $main_product_counts - $counts;
						$product_obj['counts'] = $product_counts;
						$this->db->where("product_id", $product_id);
						$this->db->where("team_id", $team_id);
						$this->db->update("team_product", $product_obj); 

						$res->status = true;
						$res->datas = base_url('teamsale/product_sold_out/');
						$res->massege = 'บันทึกสำเร็จ';
						$res->text = '';
					}
				}else{
					$res->status = false;
					$res->massege = 'จำนวนสินค้ามีไม่เพียงพอ';
					$res->text = 'กรุณาลองใหม่อีกครั้ง';
				}
			}
        }
		
		//###  UPDATE ###//
        // if($action == 'update'){
		// 	// update main product stock
		// 	if(count($team_product) > 0){

		// 		$team_product_counts = (int)$team_product[0]->counts;
		// 		$main_product_counts = (int)$main_product[0]->counts;

		// 		$res->massege = 'บันทึกสำเร็จ';
		// 		//print_r( gettype($team_product[0]->counts));exit();
		// 		if( $counts < $team_product_counts){
		// 			$obj['updated'] = $curent_date;
		// 			$this->db->where("id", $id);
		// 			$this->db->where("team_id", $team_id);
		// 			$this->db->update("team_product", $obj); 

		// 			$curent_count = $team_product_counts - $counts;
		// 			$product_counts = $main_product_counts + $curent_count;
		// 			$product_obj['counts'] = $product_counts;
		// 			$this->db->where("id", $product_id);
		// 			$this->db->update("product", $product_obj); 

		// 			$res->massege = 'บันทึกสำเร็จ';
		// 		}

		// 		if( $counts > $team_product_counts){
		// 			$curent_count = $counts - $team_product_counts;
		// 			if( $main_product_counts < $curent_count){
		// 				$res->massege = 'จำนวนสินค้ามีไม่เพียงพอ';
		// 			}
		// 			if( $main_product_counts >= $curent_count){
		// 				$obj['updated'] = $curent_date;
		// 				$this->db->where("id", $id);
		// 				$this->db->where("team_id", $team_id);
		// 				$this->db->update("team_product", $obj); 

		// 				$product_counts = $main_product_counts - $curent_count;
		// 				$product_obj['counts'] = $product_counts;
		// 				$this->db->where("id", $product_id);
		// 				$this->db->update("product", $product_obj); 
		// 				$res->massege = 'บันทึกสำเร็จ';
		// 			}
		// 		}
		// 		if( $counts == $team_product_counts){
		// 			$obj['updated'] = $curent_date;
		// 			$this->db->where("id", $id);
		// 			$this->db->where("team_id", $team_id);
		// 			$this->db->update("team_product", $obj);
		// 			$res->massege = 'บันทึกสำเร็จ';
		// 		}
		// 	}
			
		// 	$res->status = true;
		// 	$res->id = $id;
		// 	$res->datas = base_url('admin_team_product_action/'.$team_id);
		// 	//$res->massege = 'บันทึกสำเร็จ';
		// 	$res->status_code = '000';
        // }

		echo json_encode($res);
	}

}
