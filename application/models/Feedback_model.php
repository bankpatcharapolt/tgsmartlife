<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // โหลดฐานข้อมูล
    }

    public function insert_feedback($data) {
        return $this->db->insert('service_feedback', $data);
    }

    // public function get_all_feedbacks() {
    //     $query = $this->db->get('service_feedback');
    //     return $query->result_array();
    // }
    public function get_all_feedbacks() {
        $this->db->select('sf.id, sf.name, sf.last_name, sf.phone, sf.service_date, sf.work_order_number, sf.service_feedback ,si.path as image_path');
        $this->db->from('service_feedback sf');
        $this->db->join('suggesstion_images si', 'sf.id = si.ref_id', 'left'); // ใช้ left join เพื่อรวมข้อมูลรูปภาพถ้ามี
        $query = $this->db->get();
        $results = $query->result_array();

        // จัดกลุ่มรูปภาพตาม ref_id
        $feedbacks = [];
        foreach ($results as $row) {
            if (!isset($feedbacks[$row['id']])) {
                $feedbacks[$row['id']] = $row;
                $feedbacks[$row['id']]['images'] = [];
            }
            if ($row['image_path']) {
                $feedbacks[$row['id']]['images'][] = $row['image_path'];
            }
        }

        return array_values($feedbacks); // แปลงเป็น array ของผลลัพธ์ที่จัดกลุ่มแล้ว
    }
}
