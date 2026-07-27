
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
   
    public function index(){
        $menu['mainmenu'] = 'orders';
		$menu['submenu'] = 'orders';
        $menu['seo'] = "";
        $status = '0';
        if(isset($_GET['status'])){
            $status = $_GET['status'];
        }
        $user_id = $this->session->userdata('user_id'); 
        $result  = $this->db->select("orders.*,order_detail.*,product.name,product.thumnal")->from('orders')
        ->join('order_detail' , 'orders.order_id = order_detail.order_id','left')
        ->join('payment_logs' , 'orders.order_id = payment_logs.order_id','left')
        ->join('product' , 'order_detail.product_id = product.id','left')
        ->where("user_id",$user_id);
      
        // เพิ่มเงื่อนไขการตรวจสอบ status
        if ($status !== 'all') {
            $this->db->where("status", $status);
        }

        $result = $this->db->get();
       // echo $this->db->last_query();exit();
        $return_data = [];
        $count_status = [];

        $count_result = $this->db->select('count(*) as total,status')->from('orders')->where('user_id',$user_id)->group_by('status')->get();
        $return_count = [
            '0'=>"0",
            '1'=>"0",
            '2'=>"0",
            '3'=>"0",
            '4'=>"0",
            '5'=>"0",
        ];
        foreach($count_result->result() as $keyCount => $valueCount){
            if(isset($return_count[$valueCount->status])){
                $return_count[$valueCount->status] = $valueCount->total;
            }
        }
        if($result->num_rows() > 0){
            foreach($result->result() as $key => $value){
                if(!isset($return_data[$value->order_id])){
                   
                    $return_data[$value->order_id] = [
                        'order_id'=>$value->order_id,
                        'addrCurrent'=>$value->addrCurrent,
                        'addrComp'=>$value->addrComp,
                        'total_amount'=>$value->total_amount,
                        'total_amount_with_shipping_cost'=>$value->total_amount_with_shipping_cost,
                        'status'=>$value->status,
                        'payment_status'=>$value->payment_status,
                        'shipping'=>$value->shipping,
                        'tax_invoice'=>$value->tax_invoice,
                        'created'=>$value->created,
                        'send_by'=>$value->send_by,
                        'parcel_number'=>$value->parcel_number,
                        'order_detail'=> []
                    ];
                  
                }
                $order_detail = [];

                if($value->product_id != "" && $value->product_id != null){
                    $order_detail= [
                        'product_id'=>$value->product_id,
                        'price'=>$value->price,
                        'amount'=>$value->amount,
                        'name'=>$value->name,
                        'thumnal'=>$value->thumnal,
                    ];
                }
                if(!empty($order_detail)){
                    // $return_data[$value->order_id]['order_detail'][] = $order_detail;
                    array_push($return_data[$value->order_id]['order_detail'],$order_detail);
                }
            }
        }
        
        
		$this->load->view('desktop/header',$menu);
		$this->load->view('desktop/orders' ,['return_data'=>$return_data,"count_result"=>$return_count]);
		$this->load->view('desktop/footer');    
    }
}

?>
