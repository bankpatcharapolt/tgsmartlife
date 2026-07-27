<style>
    /* CSS ในไฟล์ของคุณ */
    /* สำหรับมุมมอง mobile (เล็กกว่า 768px) */
    @media (max-width: 768px) {
        .hide-mobile {
            display: none;
            /* ซ่อน icon ในมุมมอง mobile */
        }
    }

    /* สำหรับมุมมอง desktop (มากกว่า 768px) */
    @media (min-width: 769px) {
        .hide-desktop {
            display: none;
            /* ซ่อน icon ในมุมมอง desktop */
        }
    }


    .btnSubmit {
        background-color: #005EB8;
    }

    a {
        /* text-decoration: underline; */
    }

    .btnProfile {
        color: #007bff;
        text-decoration: underline;
        cursor: pointer;
    }

    .btnProfile:hover {
        color: #007bff;
        text-decoration: underline;
    }

    .btnProfile:focus {
        color: #005EB8;
        text-decoration: underline;
    }

    .btnAddr {
        color: #007bff;
        text-decoration: underline;
        cursor: pointer;
    }


    .btnAddr:hover {
        color: #007bff;
        text-decoration: underline;
    }

    .btnAddr:focus {
        color: #005EB8;
        text-decoration: underline;
    }


    .card-header-divider::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        border-top: 1px solid #dee2e6;
        z-index: -1;
    }

    .card-header-divider .left-content,
    .card-header-divider .right-content {
        position: relative;
        z-index: 1;
        background-color: #fff;
        padding: 0 10px;
    }

    */

    /* .login .container-2 {
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: 1px solid #717171;
  position: relative;
  margin: 0 0 25px 2px;
  padding: 12px 23px 17px 23px;
  width: fit-content;
  box-sizing: border-box;
} */
    .btn {
        line-height: 32px;
    }

    .form-control {
        line-height: 32px;
        height: 48px;
        width: 100%;
    }

    .title {
        font-weight: bold;
    }
</style>
<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">
<?php

function getAddr($value, $province, $amphur, $districts, $addr)
{
    $addr_name = empty($value['address_name']) ? "-" : $value['address_name'];
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

    return $addr;
}


?>

<div class="container">

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-12">
            <div class="p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;">
                <h6 style="font-weight: bold;">ทำการสั่งซื้อ</h6>
            </div>
            <div class="card mt-2">
                <div class="card-body" id="payment-div">
                    <div class="container">
                        <!-- ที่อยู่ในการจัดส่ง -->
                        <div class="row">

                            <div class="col-md-12">
                                <form id="addrCurrent" method="post">
                                    <?php include_once('address_current.php'); ?>
                                </form>
                            </div>

                        </div>
                        <!-- eof -->
                    </div>
                </div>
            </div>
            <!-- ขอใบกำกับภาษี-->
            <div class="card mt-2">
                <div class="card-body" id="shipping-addr-div">
                    <div class="container">
                        <!-- ที่อยู่ในการจัดส่ง -->
                        <div class="row">

                            <div class="col-12 col-sm-3">
                                <div style="display: flex; align-items: center;">
                                    <input type="checkbox" id="taxInvoiceCheckbox" name="tax_invoice" style="margin-right: 5px;" <?php echo $tax_invoice == "1" ? "checked" : ""; ?>>
                                    <label for="taxInvoiceCheckbox" class="title" style="margin-bottom: 0;cursor:pointer;">ขอใบกำกับภาษี</label>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <form id="addrCompany" method="post">
                                    <?php include_once('address_company.php'); ?>
                                </form>

                            </div>

                        </div>
                        <!-- eof -->
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body" id="shipping-addr-div">
                    <div class="container" id="cartContainer">
                        <!-- cart -->
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-2">

                            </div>

                        </div>
                        <!-- eof -->
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body" id="footer-payment-div">
                    <div class="container" id="footerContainer">
                        <!-- cart -->
                        <div class="row">
                            <div class="col-3" style="display:flex;align-items:center;">
                                รวม(<span id="totalAmount">0</span>)
                            </div>
                            <div class="col-3" style="display:flex;align-items:center;">
                                ที่ต้องชำระทั้งสิ้น
                            </div>
                            <div class="col-4" style="display:flex;align-items:center;">
                                <span class="total_amount_with_ship"></span>
                            </div>
                            <?php
                            $customer_email = $_SESSION['email'];
                            ?>
                            <div class="col-2 pl-0 pr-0" style="display:flex;align-items:center;">
                                <!-- <button class="btn btn-primary" style="background-color:#005EB8;">ชำระเงิน</button> -->
                                 
                                <button class="btn btn-primary" style="background-color:#005EB8;" onclick="submitBtn()" id="submitBtn">ชำระเงิน</button>

                                <form id="paymentForm" method="post" action="https://www.thaiepay.com/epaylink/payment.aspx">
                                    <input type="hidden" id="refno" name="refno" value="">
                                    <input type="hidden" id="merchantid" name="merchantid" value="">
                                    <input type="hidden" id="customeremail" name="customeremail" value="">
                                    <input type="hidden" name="cc" value="00"> <!-- สกุลเงิน TH -->
                                    <input type="hidden" id="productdetail" name="productdetail" value="">
                                    <input type="hidden" id="total" name="total" value="1">
                                </form>
                            </div>
                        </div>
                        <!-- eof -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var isChange = '0';
    var base_url = "<?= base_url(); ?>";
    var province = '<?php echo json_encode($province) ?>';
    province = JSON.parse(province);

    var profile = '<?php echo !empty($profile) ? json_encode($profile) : "0"; ?>';
    profile = JSON.parse(profile);



    var amphur = '<?php echo json_encode($amphur) ?>';
    amphur = JSON.parse(amphur);



    var AddressValue = '<?php echo !empty($addr_array) ? json_encode($addr_array) : "0"; ?>';

    AddressValue = JSON.parse(AddressValue);

    var AddressValueTax = '<?php echo !empty($addr_tax_array) ? json_encode($addr_tax_array) : "0"; ?>';
    AddressValueTax = JSON.parse(AddressValueTax);
</script>
<script src="<?= base_url('./assete/js/handleDropdown.js'); ?>"></script>
<?php
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;
?>

<script type="text/javascript">
    var order_id = '<?php echo $order_id ?>';

    $(document).ready(function() {
        var cartDatas = getCartMember(base_url, order_id);
        $("#label_address_current").css("font-weight", "bold");

        // ซ่อนปุ่มบันทึก
        $("#divSaveAddr .btn").hide();

        populateProvinceSelect();
        populateProvinceCompSelect();

    });

    function goToChangeAddrTax() {

        $("#btnCancleEditAddrTax").show();
        $("#btnEditAddrTax").hide();


        $("#address-div").hide();
        $("#profile-div").hide();

        $(".addr-div").hide();
        $(".addr-tax-div").show();
    }

    window.onload = function() {
        // โค้ด JavaScript ที่คุณต้องการเรียกใช้งานหลังจากที่หน้าเว็บโหลดเสร็จสมบูรณ์

        // ใช้ setTimeout เพื่อเรียกใช้ฟังก์ชันหลังจากผ่านไปเวลาที่กำหนด (ในที่นี้คือ 3000 มิลลิวินาทีหรือ 3 วินาที)

        // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
        setInitAddrValue(AddressValue);
        setInitAddrValueTax(AddressValueTax, profile);


        if (isChange != '0') {
            if (isChange == "1") {
                goToChangeAddr();
            } else if (isChange == '2') {
                goToChangeAddrTax();
            }
        }
    };

    function setInitAddrValue(AddressValue) {

        if (AddressValue.addr != undefined) {
            $("#name").val(AddressValue.name);
            $("#home_no").val(AddressValue.home_no);
            $("#building").val(AddressValue.building);
            $("#road").val(AddressValue.road);
            $("#addr").val(AddressValue.addr);
            //$("#province").val(AddressValue.province_id).trigger('change');
            document.getElementById('province').value = AddressValue.province_id;
            document.getElementById('province').dispatchEvent(new Event('change'));

            document.getElementById('district').value = AddressValue.amphur_id;
            document.getElementById('district').dispatchEvent(new Event('change'));


            setTimeout(function() {
                // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
                setsub(AddressValue)
            }, 2000);


            // $("#zipcode").val(AddressValue.zipcode);


        }



    }

    function setsub(AddressValue) {

        document.getElementById('subdistrict').value = String(AddressValue.district_id);
        document.getElementById('subdistrict').dispatchEvent(new Event('change'));



    }

    function onchangeTaxType(value) {
        if (value == '2') {
            $("#passport_div").hide();
        } else {
            $("#passport_div").show();
        }
    }

    function setInitAddrValueTax(AddressValue, profile) {
        console.log(AddressValue);
        if (AddressValue.addr != undefined) {

            if (AddressValue.tax_type != null) {
                $("input[name=tax_type][value='" + AddressValue.tax_type + "']").prop("checked", true);
                onchangeTaxType(AddressValue.tax_type);
            }
            //  alert(AddressValue.home_no);
            $("#home_no_comp").val(AddressValue.home_no);
            $("#building_comp").val(AddressValue.building);
            $("#road_comp").val(AddressValue.road);
            if (AddressValue.tax_type == '1') {
                $("#passport_number").val(AddressValue.passport_number);
            }
            $("#fullnameComp").val(AddressValue.name);

            $("#tax_id").val(profile[0].tax_id);

            $("#phoneComp").val(AddressValue.phone);

            // var addr = 0
            $("#addrComp").val(AddressValue.addr);

            //$("#province").val(AddressValue.province_id).trigger('change');
            document.getElementById('provinceComp').value = AddressValue.province_id;
            document.getElementById('provinceComp').dispatchEvent(new Event('change'));

            document.getElementById('districtComp').value = AddressValue.amphur_id;
            document.getElementById('districtComp').dispatchEvent(new Event('change'));


            setTimeout(function() {
                // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
                setsubtax(AddressValue)
            }, 2000);


            // $("#zipcode").val(AddressValue.zipcode);


        }



    }

    function setsubtax(AddressValue) {

        document.getElementById('subdistrictComp').value = String(AddressValue.district_id);
        document.getElementById('subdistrictComp').dispatchEvent(new Event('change'));



    }

    function goToUndoChangeAddrTax() {
        $("#btnCancleEditAddrTax").hide();
        $("#btnEditAddrTax").show();


        $("#address-div").show();
        $("#profile-div").show();

        $(".addr-div").hide();
        $(".addr-tax-div").hide();


    }

    function goToChangeAddr() {

        $("#btnCancleEditAddr").show();
        $("#btnEditAddr").hide();

        $("#address-tax-div").hide();
        $("#profile-div").hide();


        $(".addr-div").show();


    }

    function goToUndoChangeAddr() {
        $("#btnCancleEditAddr").hide();
        $("#btnEditAddr").show();
        $("#address-tax-div").show();
        $("#profile-div").show();
        $(".addr-div").hide();


    }

    function submitBtn() {

        var total_amount_with_shipping_cost = $("#paymentDetail").attr("attr-totalwithship");
        var shipping = 350;
        var total_amount = total_amount_with_shipping_cost - shipping;
       
        var amountitem = $("#paymentDetail").attr("attr-totalamount");
        if (parseInt(amountitem) == 0) {
            window.location.href = './products';
        } else {

            // Prevent default form submission
            event.preventDefault();
            // Serialize form data
            var formData = $(this).serialize();
            var tax_invoice = 0;
            if ($('#taxInvoiceCheckbox').prop('checked')) {
                tax_invoice = 1;
            }

            var formAddrCurrentData = $('#addrCurrent').serializeArray();
            var formaddrCompData = $("#addrCompany").serializeArray();

            // AJAX request to save data
            if (order_id != 0) {
                $.ajax({
                    url: base_url + 'Payment/update',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        tax_invoice: tax_invoice,
                        user_id: user_id,
                        order_id: order_id,
                        total_amount: total_amount,
                        total_amount_with_shipping_cost: total_amount_with_shipping_cost,
                        shipping: shipping,
                        addrCurrent: formAddrCurrentData,
                        addrComp: formaddrCompData
                    }, // Use FormData object as the data
                    success: function(response) {
                        // Success callback
                        var res = response;

                        if (res.status == true) {
                            $("#refno").val(res.order_id);
                            $("#merchantid").val(45743362);
                            $("#customeremail").val('<?php echo $_SESSION['email']; ?>');
                            $("#productdetail").val(res.product_name);
                            $("#total").val(total_amount_with_shipping_cost);
                            //$("#productdetail").val("UAT TGSMARTLIFE");
                            //$("#total").val(1);

                            $("#paymentForm").submit();



                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '<span style="font-weight:bold;">ไม่สามารถชำระเงินได้</span>',
                                html: "เกิดข้อผิดพลาดระหว่างการชำระเงิน<br>หากมีข้อสงสัยเพิ่มเติมกรุณาติดต่อที่เบอร์ 0652958885 <br>หรือ line @tgsmartlife</p>"
                            });
                        }
                        console.log('Data saved to database:', response);
                        // window.location.href = "www.google.com";
                        // window.location.href = 'https://www.thaiepay.com/epaylink/payment.aspx';
                    },
                    error: function(xhr, status, error) {
                        // Error callback
                        console.error('Error saving data:', error);
                        // Handle error scenario (optional)
                    }
                });

            } else {
                $.ajax({
                    url: base_url + 'Payment/insert',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        tax_invoice: tax_invoice,
                        user_id: user_id,
                        total_amount: total_amount,
                        total_amount_with_shipping_cost: total_amount_with_shipping_cost,
                        shipping: shipping,
                        addrCurrent: formAddrCurrentData,
                        addrComp: formaddrCompData
                    }, // Use FormData object as the data
                    success: function(response) {
                        // Success callback
                        var res = response;

                        if (res.status == true) {
                            $("#refno").val(res.order_id);
                            $("#merchantid").val(45743362);
                            $("#customeremail").val('<?php echo $_SESSION['email']; ?>');
                            $("#productdetail").val(res.product_name);
                            $("#total").val(total_amount_with_shipping_cost);
                            //$("#productdetail").val("UAT TGSMARTLIFE");
                            //$("#total").val(1);

                            $("#paymentForm").submit();



                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '<span style="font-weight:bold;">ไม่สามารถชำระเงินได้</span>',
                                html: "เกิดข้อผิดพลาดระหว่างการชำระเงิน<br>หากมีข้อสงสัยเพิ่มเติมกรุณาติดต่อที่เบอร์ 0652958885 <br>หรือ line @tgsmartlife</p>"
                            });
                        }
                        console.log('Data saved to database:', response);
                        // window.location.href = "www.google.com";
                        // window.location.href = 'https://www.thaiepay.com/epaylink/payment.aspx';
                    },
                    error: function(xhr, status, error) {
                        // Error callback
                        console.error('Error saving data:', error);
                        // Handle error scenario (optional)
                    }
                });
            }
        }
    }

    function drawCart(cartDatas) {
        console.log(cartDatas);
    }

    // function goToChangeAddr(addr_type) {
    //     window.location.href = "./profile?isChange=" + addr_type;
    // }
</script>