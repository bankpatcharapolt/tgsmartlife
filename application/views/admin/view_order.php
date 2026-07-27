<!----  Content ------>
<style>
    div {
        margin-top: 2px;
    }
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ตรวจสอบสถานะ</h2>
            <input name="base_url" value="<?= base_url(); ?>" type="hidden">
            <div class="clearfix"></div>
        </div>
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


        function getAddr($value, $province, $amphur, $districts, $addr)
        {
            $addr_name = empty($value['address_name']) ? "-" : $value['address_name'];
            if (!empty($value['name'])) {
                $addr_name = $value['name'];
            }
            //$addr_name = !empty($value['address_name']) ? "-" : $value['address_name'];
            $province_name = "-";
            $keyP = array_search($value['province_id'], array_column($province, 'id'));

            if (is_numeric($keyP)) {
                $province_name = $province[$keyP]['name_th'];
            }

            $amphur_name = "-";
            $keyA = array_search($value['amphur_id'], array_column($amphur, 'id'));
            if (is_numeric($keyA)) {
                $amphur_name = $amphur[$keyA]['name_th'];
            }
            $district_name = "-";
            $keyD = array_search($value['district_id'], array_column($districts, 'id'));
            if (is_numeric($keyD)) {
                $district_name = $districts[$keyD]['name_th'];
            }
            $zip_code = empty($value['zipcode']) ? "-" : $value['zipcode'];
            $addr .= " ชื่อสถานที่ " . $addr_name;
            $addr .= " จังหวัด " . $province_name;
            $addr .= " เขต " . $amphur_name;
            $addr .= " แขวง " . $district_name;
            $addr .= " รหัสไปรษณีย์ " . $zip_code;
            $phone = empty($value['phone']) ? "-" : $value['phone'];
            $addr .= " เบอร์ " . $phone;

            return $addr;
        }
        function handlePaymentMsg($payment_status){
            if($payment_status == "1"){
                return "ชำระเงินแล้ว";
            }else{
                return "ยังไม่ชำระเงิน";
            }

        }
        ?>
        <div class="x_content">
            <h4>รายละเอียดคำสั่งซื้อ</h4>
            <form method="post" action="<? //=base_url('admin/Product/product_actions');
                                        ?>" enctype="multipart/form-data" id="action-form">
                <div class="form-group row">
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">เลขที่คำสั่งซื้อ :

                                </label>
                            </div>
                            <div class="col-md-4">
                                <?php echo $data[0]['order_id'] ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">วันที่ทำรายการสั่งซื้อ :
                                </label>
                            </div>
                            <div class="col-md-4">
                                <?php echo $data[0]['created'] ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">สถานะการชำระเงิน :
                                </label>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo handlePaymentMsg($data[0]['payment_status']); ?></strong> 
                            </div>
                        </div>


                    </div>
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">ยอดรวม :
                                </label>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo number_format($data[0]['total_amount_with_shipping_cost']); ?></strong> บาท
                            </div>
                        </div>


                    </div>
                    <div class="col-md-12 ">

                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">ที่อยู่จัดส่ง :<?php
                                                                            $addr = "";
                                                                            foreach ($address as $addrk => $value) {
                                                                                if ($value['addr_type'] == 1) {
                                                                                    $addr = getAddr($value, $province, $amphur, $districts, $addr);
                                                                                }
                                                                            }
                                                                            ?>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <?php
                                echo $addr; ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">ลูกค้าขอใบกำกับภาษีหรือไม่ : </label>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo $data[0]['tax_invoice'] == "1" ? "ขอใบกำกับภาษี" : "ไม่ขอใบกำกับภาษี"; ?></strong>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">ที่อยู่ขอใบกำกับภาษี :<?php
                                                                                    $addr = "";
                                                                                    foreach ($address as $addrk => $value) {
                                                                                        if ($value['addr_type'] == 2) {
                                                                                            $addr = getAddr($value, $province, $amphur, $districts, $addr);
                                                                                        }
                                                                                    }
                                                                                    ?>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <?php
                                echo $addr; ?>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-12  mt-2">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">อีเมล : </label>
                            </div>
                            <div class="col-md-4">
                                <?php echo $data[0]['email']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $status = $data[0]['status'];
                    $send_by = $data[0]['send_by'];
                    $parcel_number = $data[0]['parcel_number'];
                    $order_id = $data[0]['order_id'];

                    ?>
                    <div class="col-md-12  mt-2">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">สถานะ :</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="status" onchange="handleStatus()" id="status" required="required">
                                    <option value="0" <?php echo $status == "0" ? "selected" : "" ?>>รอการชำระเงิน</option>
                                    <option value="1" <?php echo $status == "1" ? "selected" : "" ?>>ที่ต้องจัดส่ง</option>
                                    <option value="2" <?php echo $status == "2" ? "selected" : "" ?>>จัดส่งแล้ว</option>
                                    <option value="3" <?php echo $status == "3" ? "selected" : "" ?>>จัดส่งสำเร็จ</option>
                                </select>
                            </div>
                         
                        </div>
                        <div id="remark" class="offset-md-2  text-danger">
                                <label>** หมายเหตุ: ลูกค้าชำระเงินแล้วรอจัดส่ง</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2" id="div_send_by">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">จัดส่งโดย :</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="send_by" id="send_by" required="required">
                                    <option value="" <?php echo $send_by == "" ? "selected" : "" ?>>---กรุณาเลือก---</option>
                                    <option value="kerry" <?php echo $send_by == "kerry" ? "selected" : "" ?>>Kerry Express</option>
                                    <option value="flash" <?php echo $send_by == "flash" ? "selected" : "" ?>>Flash Express</option>
                                    <option value="ems" <?php echo $send_by == "ems" ? "selected" : "" ?>>ไปรษีย์ไทย</option>
                                    <option value="lalamove" <?php echo $send_by == "lalamove" ? "selected" : "" ?>>Lalamove</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2" id="div_parcel_number">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">เลขพัสดุจัดส่ง :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="<?php echo $parcel_number; ?>" name="parcel_number" id="parcel_number" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row justify-content-between">
                            <div class="col-md-6 mt-2">
                                <a onclick="goBack()" class="btn btn-primary" style="background-color:#35495D;color:#FFF;min-width:100px;" data-toggle="tooltip" title="กลับ">กลับ</a>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn btn-primary ml-2 float-md-right" style="background-color:#005EB8;color:#FFF;min-width:100px;" data-toggle="tooltip" title="บันทึก">บันทึก</button>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            </form>
        </div>
    </div>
</div>
</div>

<script>
    var base_url = $('input[name="base_url"]').val();
    $(document).ready(function() {
        handleStatus();
    });

    function goBack() {

        window.location.href = base_url + "order";
    }

    function handleStatus() {
        var status = $("#status").val();
        if(status == 1){
            $("#remark").show();
        }else{
            $("#remark").hide();
        }
        if (status == 2 || status == 3) {
            $("#div_send_by").show();
            $("#div_parcel_number").show();
        } else {
            $("#div_send_by").hide();
            $("#div_parcel_number").hide();
        }
    }
</script>