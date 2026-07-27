<style>
    .btnSubmit {
        background-color: #005EB8;
    }

    a {
        text-decoration: underline;
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

<div class="container">

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-12">
            <div class="p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;">
                <h6 style="font-weight: bold;">ชำระเงินสำเร็จ</h6>
            </div>
            <div class="card mt-2">
                <div class="card-body" id="payment-div">
                    <div class="container">
                    ท่านสามารถตรวจสอบประวัติคำสั่งซื้อและข้อมูลสถานะการจัดส่งของท่านได้ที่เมนูข้อมูลส่วนตัว
                    หากท่านขอใบกำกับภาษี ระบบจะดำเนินการส่งใบกำกับภาษีไปที่อีเมล์ของท่านภายหลังโดยใช้เวลาไม่เกิน 7 วันทำการ
                       
                        <!-- eof -->
                    </div>
                </div>
            </div>
          
         
        </div>
    </div>
</div>


<script type="text/javascript">


    $(document).ready(function() {
     
    });

    function submitBtn(){
         
            var total_amount_with_shipping_cost = $("#paymentDetail").attr("attr-totalwithship");
            var shipping = 350;
            var total_amount = total_amount_with_shipping_cost -shipping;
            var amountitem = $("#paymentDetail").attr("attr-totalamount");
            if(parseInt(amountitem) == 0){
                window.location.href = './products';
            }else{

            // Prevent default form submission
            event.preventDefault();
            // Serialize form data
            var formData = $(this).serialize();
            var tax_invoice = 0;
            if ($('#taxInvoiceCheckbox').prop('checked')) {
                tax_invoice = 1;
            }
            
            // AJAX request to save data
            $.ajax({
                url: base_url + 'Payment/insert',
                type: "POST",
                dataType: 'json',
                data: { tax_invoice:tax_invoice,user_id:user_id , total_amount:total_amount,total_amount_with_shipping_cost:total_amount_with_shipping_cost,shipping:shipping}, // Use FormData object as the data
                success: function(response) {
                    // Success callback
                    var res = response;
                  
                    if(res.status == true){
                        $("#refno").val(res.order_id);
                        $("#merchantid").val(45743362);
                        $("#customeremail").val('<?php echo $_SESSION['email'];?>');
                        $("#productdetail").val(res.product_name);
                        $("#total").val(total_amount_with_shipping_cost);

                         $("#paymentForm").submit();
                        
                        

                    }else{
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
    function drawCart(cartDatas){
     
    }
    function goToChangeAddr(addr_type){
        window.location.href="./profile?isChange=" + addr_type;
    }
</script>