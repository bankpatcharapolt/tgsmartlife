
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Webhook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
  
   
    public function index(){
        
        $payload = $this->input->post();
        // ใส่ข้อมูลลงในฐานข้อมูลเก็บ log
        $order_id = "";
        if(isset($payload['refno'])){
            $order_id = $payload['refno'];
        }
        $this->db->insert('payment_logs', [ 'order_id'=>$order_id,'jsonData' => json_encode($payload) , 'created' => DATE("Y-m-d H:i:s")]);

        $query = $this->db->select('*')->from('orders')->where('order_id',$payload['refno'])->get();
        if($query->num_rows() > 0  && isset($payload['status'])){
            $this->db->where('order_id', $payload['refno']);
            $this->db->update('orders', ['payment_status' => 1,'status'=>1]);
        }
  
    }

    
}

?>
