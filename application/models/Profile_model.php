<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    
    public function get_province() {  
		$Query = "SELECT *
		FROM `provinces` 
		 ";
		$result = $this->db->query($Query)->result_array();
		return $result;
	}

	public function get_districts($district_id = null) {  
		$Query = "SELECT *
		FROM `districts` 
		
		 ";
 $subWhere = "";
		 if(!empty($district_id)){
			$subWhere .= " district_id='".$district_id."'";
		}

		$result = $this->db->query($Query)->result_array();
		return $result;
	}


	public function get_amphur($provice_id = null , $code = null) {  
		$Query = "SELECT *
		FROM `amphures` 
		 ";
		 $subWhere = "";
		if(!empty($provice_id)){
			$subWhere .= " provice_id='".$provice_id."'";
		}
		if(!empty($code)){
			if(!empty($subWhere)){
				$subWhere .= " and ";
			}
			$subWhere .= " code='".$code."'";
		}



		$result = $this->db->query($Query)->result_array();
		return $result;
	}
	public function getProfile($user_id = null){
        $query = "select users.*  
        from users ";
        if(!empty($user_id)){
            $query .= " WHERE users.id={$user_id}";
        }
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            $row = $result->result_array();
            return $row;
        }else{
            return false;
        }
    }

    // เมธอดสำหรับการดึงข้อมูลที่เกี่ยวข้องกับโปรไฟล์
    public function getAddrByOrderId($user_id , $order_id){
        
        $query = "select orders.*
        from orders        
        ";
        if(!empty($user_id)){
            $query .= " WHERE orders.user_id={$user_id} AND order_id = '{$order_id}'";
        }
    
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            $row = $result->result_array();
            return $row;
        }else{
            return false;
        }
    }
    public function getAddr($user_id){
        
        $query = "select address.*
        from address        
        ";
        if(!empty($user_id)){
            $query .= " WHERE address.user_id={$user_id}";
        }
    
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            $row = $result->result_array();
            return $row;
        }else{
            return false;
        }
    }

    // เพิ่มเมธอดอื่น ๆ ที่จำเป็นตามความต้องการของแอปพลิเคชัน
}
