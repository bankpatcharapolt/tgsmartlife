<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintain_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // โหลดฐานข้อมูล
    }

    public function insert_maintain($data) {
        return $this->db->insert('service_requests', $data);
    }

    public function get_all_maintains() {
        $this->db->select('sf.* ,si.path as image_path');
        $this->db->from('service_requests sf');
        $this->db->join('service_maintain_images si', 'sf.id = si.ref_id', 'left'); // ใช้ left join เพื่อรวมข้อมูลรูปภาพถ้ามี
        $query = $this->db->get();
        //echo $this->db->last_query();exit();
        $results = $query->result_array();

        // จัดกลุ่มรูปภาพตาม ref_id
        $maintains = [];
        foreach ($results as $row) {
            if (!isset($maintains[$row['id']])) {
                $maintains[$row['id']] = $row;
                $maintains[$row['id']]['images'] = [];
            }
            if ($row['image_path']) {
                
                $maintains[$row['id']]['images'][] = $row['image_path'];
            }
        }
        //echo "<PRE>";print_r($maintains);

        return array_values($maintains); // แปลงเป็น array ของผลลัพธ์ที่จัดกลุ่มแล้ว
    }
}
