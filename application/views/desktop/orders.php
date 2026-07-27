<style>
    .order-menu {
        padding: 8px;
        border: 1px solid #E2E2E2;
    }

    .order-menu.active {
        background: rgba(0, 94, 184, 0.1);
        border: 1px solid #E2E2E2;
    }

    .order-menu>a {
        color: black;
        text-decoration: underline;

    }

    .order-menu>a:hover {
        color: black;
        text-decoration: underline;
    }

    .btn {
        background-color: #005EB8;
    }

    .swal2-icon.swal2-icon-show {
        border: none;
    }

    .swal2-confirm.swal2-styled {
        background-color: #005EB8 !important;
        width: 139px;
    }


    .btn {
        line-height: 32px;
    }

    .form-control {
        line-height: 32px;
        height: 48px;
        width: 100%;
    }

    .text-success-remark {
        color: #0DA45F;
    }

    .btn-pending {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }

    .btn-sending {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }

    .btn-success {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }

    .btn-pending:disabled {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }

    .btn-sending:disabled {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }

    .btn-success:disabled {
        border: none;
        background-color: #E2E2E2;
        color: #0DA45F;
    }
</style>
<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">
<?php
function getStatusTitles($status)
{
    $title = "";
    $payment_title = "";
    $btn_submit = "";
    $remark_btn = "";
    $btn_class = "";
    $is_disabled_btn = "";
    $remark_class = "";
    switch ($status) {
        case null:
        case '0':
            $title = "รอชำระเงิน";
            $payment_title = "จำนวนเงินที่ต้องชำระ";
            $btn_submit = "ชำระเงิน";
            $remark_btn = "*การชำระเงินของท่านไม่สำเร็จกรุณาชำระเงินอีกครั้ง";
            break;
        case '1':
            $title = "ที่ต้องจัดส่ง";
            $payment_title = "ชำระเงิน";
            $btn_submit = "ชำระเงินสำเร็จ";
            $remark_btn = "*เรากำลังดำเนินการจัดส่งพัสดุให้กับท่าน";
            $btn_class = "btn-pending";
            $is_disabled_btn = "disabled";
            break;
        case '2':
            $title = "จัดส่งแล้ว";
            $payment_title = "ชำระเงิน";
            $btn_submit = "จัดส่งแล้ว";
            $remark_btn = "*เรากำลังดำเนินการจัดส่งพัสดุให้กับท่าน";
            $btn_class = "btn-sending";
            $is_disabled_btn = "disabled";
            break;
        case '3':
            $title = "สำเร็จ";
            $payment_title = "ชำระเงิน";
            $btn_submit = "จัดส่งสำเร็จ";
            $remark_btn = "*เราได้ทำการจัดส่งพัสดุให้กับท่านเรียบร้อยแล้ว สามารถติดตามพัสดุได้ที่หมายเลขด้านล่าง";
            $btn_class = "btn-success";
            $is_disabled_btn = "disabled";
            $remark_class = "text-success";
            break;
        case 'all':
            $title = "ประวัติการสั่งซื้อทั้งหมด";
            $payment_title = "ชำระเงิน";
            $btn_submit = "";
            $remark_btn = "";
            $btn_class = "";

            break;
        default:
            $title = "";
            $payment_title = "";
            $btn_submit = "";
            $remark_btn = "";
            $btn_class = "";
            break;
    }

    return array('title' => $title, 'payment_title' => $payment_title, "btn_submit" => $btn_submit, "remark_btn" => $remark_btn, "btn_class" => $btn_class, "is_disabled_btn" => $is_disabled_btn, "remark_class" => $remark_class);
}

$status = isset($_GET['status']) ? $_GET['status'] : null;
$titles = getStatusTitles($status);
$title = $titles['title'];
$payment_title = $titles['payment_title'];

// Now $title and $payment_title contain the respective titles based on $_GET['status']


?>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-6 mt-2 ">
            <div class="box order-menu <?php echo $title == "รอชำระเงิน"  ? "active" : ""; ?>"><a href="<?php echo base_url('orders'); ?>">รอการชำระเงิน(<span id="wait"><?php echo $count_result['0']; ?></span>)</a></div>
        </div>
        <div class="col-md-2 col-sm-6 mt-2 ">
            <div class="box order-menu <?php echo $title == "ที่ต้องจัดส่ง"  ? "active" : ""; ?>"><a href="<?php echo base_url('orders?status=1'); ?>">ที่ต้องจัดส่ง(<span id="pending"><?php echo $count_result['1']; ?></span>)</a></div>
        </div>
        <div class="col-md-2 col-sm-6 mt-2 ">
            <div class="box order-menu <?php echo $title == "จัดส่งแล้ว"  ? "active" : ""; ?>"><a href="<?php echo base_url('orders?status=2'); ?>">จัดส่งแล้ว(<span id="sending"><?php echo $count_result['2']; ?></span>)</a></div>
        </div>
        <div class="col-md-2 col-sm-6 mt-2 ">
            <div class="box order-menu <?php echo $title == "สำเร็จ"  ? "active" : ""; ?>"><a href="<?php echo base_url('orders?status=3'); ?>">สำเร็จ(<span id="success"><?php echo $count_result['3']; ?></span>)</a></div>
        </div>
        <div class="col-md-3 col-sm-6 mt-2">
            <div class="box order-menu <?php echo $title == "ประวัติการสั่งซื้อทั้งหมด"  ? "active" : ""; ?>"><a href="<?php echo base_url('orders?status=all'); ?>">ประวัติการสั่งซื้อทั้งหมด</a></div>
        </div>
    </div>
    <?php
    // echo '<PRE>';print_r($return_data);exit();
    ?>
    <div class="row justify-content-center mt-5  mb-5">
        <div class="col-md-8 col-lg-12">
            <div class="card" style="border:0px;">
                <div class="p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;">
                    <h6 style="font-weight: bold;"><?php echo $title; ?></h6>
                </div>
                <!-- order : -->
                 <?php
                   // echo "<PRE>";print_r($return_data);exit();
                 ?>
                <?php foreach ($return_data as $key => $value) { ?>

                    <div class="card mt-2">
                        <div class="card-body" id="card-div" style="min-height:150px;">
                            <!-- เลขที่คำสั่งซื้อ:<?php echo $value['order_id'] ?> -->
                            <div class="container ">
                                <?php foreach ($value['order_detail'] as $subkey => $subvalue) { ?>
                                    <div class="row align-items-center mt-2">
                                        <div class="col-md-3 col-sm-6 mt-2">
                                            <img src="<?= base_url($subvalue['thumnal']) ?>" class="img-fluid">
                                        </div>
                                        <div class="col-md-3 col-sm-6 mt-2 d-flex justify-content-center">
                                            <span><?= $subvalue['name'] ?></span>
                                        </div>
                                        <div class="col-md-2 col-sm-6 mt-2 text-center">
                                            <?= number_format($subvalue['price']) ?> บาท
                                        </div>
                                        <div class="col-md-2 col-sm-6 mt-2 text-center">
                                            จำนวน <?= number_format($subvalue['amount']) ?>
                                        </div>
                                        <div class="col-md-2 col-sm-6 mt-2 text-center">
                                            ราคา <?= number_format($subvalue['price'] * $subvalue['amount']) ?> บาท
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <div id="sec" class="row justify-content-center">
                                    <div class="col-md-4 col-sm-6 mt-2 ">
                                        ใบสั่งซื้อสินค้าหมายเลข <?php echo $value['order_id'] ?>
                                        <br>
                                        <small>วันที่/เวลาสั่งซื้อ <?php echo $value['created'] ?></small>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2 row  justify-content-center justify-content-md-end">
                                        <?php
                                        $titleArr = getStatusTitles($value['status']);
                                        $btnSubmit = getStatusTitles($value['status']);
                                        ?>
                                        <?php echo $titleArr['payment_title']; ?>&nbsp;<span style="font-size: 18px;color:red;"><?php echo number_format($value['total_amount_with_shipping_cost']) ?></span>&nbsp;บาท
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2 row  justify-content-center justify-content-md-end">
                                        <?php if($value['status'] == 0){ ?>
                                        <button style="min-width:120px;background:red;color:white;" class="btn btn-danger mr-1" onclick="delOrder('<?php echo $value['order_id'] ?>')">ยกเลิกคำสั่งซื้อ</button>
                                            <?php } ?>
                                        <button style="min-width:120px;" <?php echo $btnSubmit['is_disabled_btn']; ?> class="btn btn-primary <?php echo $btnSubmit['btn_class']; ?>" onclick="gotoPayment('<?php echo base_url('payment?order_id=' . $value['order_id']); ?>')"><?php echo $titleArr['btn_submit']; ?></button>
                                    </div>
                                </div>


                                <div class="row justify-content-center justify-content-md-end">
                                    <div class="col-auto">
                                        <p class="<?php echo $btnSubmit['remark_class']; ?>"><?php echo $titleArr['remark_btn']; ?></p>
                                    </div>
                                </div>
                                <?php

                                ?>
                                <?php
                                if ($value['status'] == "2") {
                                    $sender = [
                                        'kerry'=>["name" =>"Kerry Express","link"=>"https://th.kerryexpress.com/th/track"],
                                        'flash'=>["name" =>"Flash Express","link"=>"https://www.flashexpress.co.th/fle/tracking"],
                                        'ems'=>["name" =>"ไปรษณีย์ไทย","link"=>"https://track.thailandpost.com/"],
                                        'lalamove'=>["name" =>"Lalamove","link"=>"https://www.aftership.com/th/carriers/lalamove"],
                                    ];

                                ?>
                                    <div class="row" style="margin-left:15px;margin-right:15px;">
                                        <div class="col-md-3 col-sm-6 mt-2">
                                            <span>จัดส่งโดย</span>&nbsp;<span class="text-success"><?php echo isset($sender[$value['send_by']]) ? $sender[$value['send_by']]['name']: "-";?></span>
                                        </div>
                                        <div class="col-md-3 col-sm-6 mt-2">
                                            <button onclick="openUrl('<?php echo isset($sender[$value['send_by']]) ? $sender[$value['send_by']]['link']: 0 ?>')" style="min-width:120px;" class="btn btn-primary">ติดตามพัสดุคลิก</button>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mt-2 d-flex align-items-center justify-content-center justify-content-md-end">
                                            <label for="ship_<?php echo $value['order_id']; ?>" class="col-md-auto mr-2">เลขพัสดุ</label>
                                            <input type="text" id="ship_<?php echo $value['order_id']; ?>" class="form-control col-md-6" readonly value="<?php echo $value['parcel_number'];?>" />
                                        </div>


                                    </div>
                                <?php } ?>
                                <?php ?>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">


<script>
      function delOrder(order_id) {
        
        if (confirm("คุณต้องการที่จะลบรายการคำสั่งซื้อนี้หรือไม่ ")) {
            var res = null;
            $.ajax({
                url: base_url + '/Payment/del_order', //ทำงานกับไฟล์นี้
                data: {
                    "order_id": order_id
                }, //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async: false,
                success: function(data, status) {
                    var res = data;
                

                    if (res.status == true) {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span style="font-weight:bold;">ลบข้อมูลไม่สำเร็จ</span>',
                            html: "ลบข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ"
                        });
                    }
                },
                error: function(xhr, status, exception) {
                    //console.log(xhr);
                }
            });
            // return res;
        }

    }

    function openUrl(url){
        window.location.href = url;
    }
    function gotoPayment(url) {
        window.location.href = url;
    }
</script>