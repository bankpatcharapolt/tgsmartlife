<style>
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

    @media (max-width: 991.98px) {

        /* Tablet and below */
        .addtocart {
            height: auto;
        }
    }

    .addtocart {
        background-color: #005EB8;
        color: #fff;
        border-radius: unset;
        height: auto;
        font-size: inherit;
        /* ให้ไอคอนเท่ากับขนาดของปุ่ม */
    }

    .numberCart {
        width: 45px;
        height: 40px;
        text-align: center;
        border-radius: unset;
        border: 1px solid #A4A4A4;
        box-sizing: border-box;
        background-color: #FFF;

    }

    div.form-increase {
        position: relative;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .value-button {
        width: 40px;
        height: 40px;
        border-radius: unset;
        border: 1px solid #A4A4A4;
        box-sizing: border-box;
        background-color: #FFF;

    }

    .value-button:hover {
        cursor: pointer;
    }

    /* .card-header-divider {
        position: relative;
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
    } */

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

    .footer-tbl {
        background-color: #fff;
        margin-top: 20px;
        /* กำหนด margin ด้านบน */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-tbl .column {
        flex: 1;
        padding: 10px;
        border: 1px solid #dee2e6;
    }
</style>
<style>
   
    .table {
       
        max-width: 100%; 
        border-collapse: separate;
        border-spacing: 0 12px;
        overflow-x:scroll;
      
    }

    .table th,
    .table td {
        padding: 8px;
        
        text-align: left;
        /* border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6; */
    }

    .table th {
        
        background-color: #fff;
        font-weight: normal;
        padding: 20px;


    }


    .table th:first-child {
        background-color: #fff;
        border-left: 1px solid #dee2e6;
        /* เพิ่ม border left สำหรับ header */
    }

    .table th:last-child {
        background-color: #fff;
        border-right: 1px solid #dee2e6;
        /* เพิ่ม border right สำหรับ header */
    }



    @media only screen and (max-width: 600px) {
        .hide-on-mobile {
            display: none;
        }
    }

    #cart-table-body tr:first-child {
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    #cart-table-body tr:last-child td {
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    #cart-table-body tr td:first-child {
        border-left: 1px solid #dee2e6;
    }

    #cart-table-body tr td:last-child {
        border-right: 1px solid #dee2e6;
    }



    #cart-table-body tr td {
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
        margin-top: 10px;
        /* กำหนด margin-top ระหว่างแถว */
        margin-bottom: 10px;
        /* กำหนด margin-bottom ระหว่างแถว */
    }
</style>
<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">


<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 col-lg-12">
            <div class="card" style="border:0px;">
                <div class="card-header" style="background:none;border:0px;max-width:100%;" id="card-header">
                    <!-- <h5 class="p-1" style="background-color:#E2E2E2;background: rgba(0, 94, 184, 0.1);">ตระกร้าสินค้า</h5> -->

                    <div id="titleCart" class="addr-div p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;">
                        <h6 id="h6-cart">ตระกร้าสินค้า</h6>
                    </div>
                </div>
                <div class="card-body"  id="card-body" style="max-width:100%;overflow-x:scroll;">
                    
                    <table class="table" id="tableCart">
                        <thead>
                            <tr>
                                <th scope="col" style="border-left:1px solid #dee2e6">สินค้า</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">ราคารวม</th>
                                <th scope="col" style="border-right:1px solid #dee2e6">Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body" class="">
                            <!-- ข้อมูลสินค้าในตะกร้าจะถูกเพิ่มตรงนี้ . -->
                        </tbody>
                    </table>
                
                   

                </div>

                <style>
                
                .container {
                    padding: 20px;
                }

              
                .align-middle {
                    display: flex;
                    align-items: center;
                }
            </style>
            <div class="container mt-4" style="border: 1px solid #dee2e6;max-width:100%;" id="footerDivCart">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-end flex-wrap">
                                    <div class="mr-3 mb-2 mb-md-0" style="display:flex;align-items:center;">รวม (<span id="totalSum">0</span>)</div>
                                    <div class="ml-3 mr-3 mb-2 mb-md-0" style="display:flex;align-items:center;">
                                        ราคา&nbsp;<span class="text-danger" id="priceAmount">0</span>&nbsp;บาท
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" onclick="gotoPayment('<?php echo base_url('payment');?>')">สั่งซื้อสินค้า</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">




<script>
  
   $(document).ready(function() {
        getCartData(base_url);

         // เรียกใช้งานฟังก์ชันเมื่อหน้าต่างถูกโหลดเสร็จ
        resizeCardBody();

        // เมื่อมีการ resize หน้าต่าง
        $(window).resize(function() {
            resizeCardBody();
          
        });

    });


    function gotoPayment(url){
     // รับค่าจาก totalSum.val()
        var value = $("#totalSum").text();

        // เช็คว่ามี , ใน value หรือไม่
        if (value.includes(',')) {
            // ถ้ามี , ให้ replace ด้วย ""
            value = value.replace(/,/g, '');
        }
       
        if(parseInt(value) > 0){

            if(user_id != 0){
                window.location.href = url;
            }else{
                window.location.href = './login';
            }
        }else{
            Swal.fire({ icon: 'warning',  text: 'กรุณาเพิ่มสินค้าลงในตระกร้ามากกว่า 1 ชิ้น' });
        }
    }
    function resizeCardBody() {
        // หาความกว้างของ div.card-body
        var cardBodyWidth = $('#titleCart').width(); // แก้เป็น #card-body หากต้องการหาตาม id ของ div.card-body
        
        // กำหนดความกว้างของตารางเท่ากับความกว้างของ div.card-body
        $('#card-body').width(cardBodyWidth);

        var cardHeader = $("#h6-cart").width();
 
        $("#footerDivCart").width(cardHeader);
    }
</script>