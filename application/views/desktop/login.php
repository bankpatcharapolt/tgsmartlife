<style>
    .login {
        background-color: #005EB8;
    }

    .login-tab.active,
    .register-tab.active {

        color: #005EB8;
        /* เพิ่มสีข้อความเป็นสีขาว */
    }

    .login .facebook {
        overflow-wrap: break-word;
        font-family: 'Inter';
        font-weight: 400;
        font-size: 16px;
        color: #2F2F2F;
    }

    select {
        width: 100%;
    }

    .loginBtn {
        border: 1px solid #717171;
    }

    .resetBtn:hover{
        color:black;
    }

    .loginSection {}

    
    .btn {
        line-height: 32px;
    }

    .form-control {
        line-height: 32px;
        height: 48px;
        width: 100%;
    }
</style>
<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card" style="border:0px;">
                <div class="card-header" style="background:none;border:0px;;">
                    <div class="row">
                        <div class="col text-right" style="border-right:1px solid black">
                            <span class="login-tab active" style="cursor: pointer;">เข้าสู่ระบบ</span>
                        </div>
                        
                        <div class="col text-left">
                            <span class="register-tab" style="cursor: pointer;">สมัครสมาชิก</span>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="login-div">
                    <form action="#" method="post" id="login-form">
                        <div class="form-group">

                            <input type="text" class="form-control loginSection" style="height:auto;" id="username" name="username" placeholder="ชื่อผู้ใช้" required>
                        </div>
                        <div class="form-group">

                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" style="height:auto;" placeholder="รหัสผ่าน" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block login" style="margin-bottom:16px;">เข้าสู่ระบบ</button>
                        <div class="col-md-12" style="margin-bottom:16px;">
                            <a style="float:right;" class="resetBtn" href="<?=base_url('resetpassword');?>">ลืมรหัสผ่าน?</a>
                        </div>

                        <div class="col-md-12 d-flex justify-content-center" style="margin-bottom:16px;">
                            หรือ
                        </div>

                        <a href="<?php echo base_url('google_login'); ?>" class="btn btn-default btn-block loginBtn" style="margin-bottom:16px;">
                            <img src="assete/icons/Google.png" alt="Google Icon" style="vertical-align: middle; margin-right: 8px;"> เข้าสู่ระบบด้วยบัญชี Google
                        </a>

                        <a href="<?php echo base_url('facebook_login'); ?>" class="btn btn-default btn-block loginBtn" style="margin-bottom:16px;">
                        <img src="assete/icons/Facebook.png" alt="Facebook Icon" style="vertical-align: middle; margin-right: 8px;"> เข้าสู่ระบบด้วยบัญชี Facebook
                        </a>

<!-- 
                        <button type="submit" class="btn btn-default btn-block loginBtn" style="margin-bottom:16px;">
                            <img src="assete/icons/Facebook.png" alt="Google Icon" style="vertical-align: middle; margin-right: 8px;"> เข้าสู่ระบบด้วยบัญชี Facebook
                        </button> -->


                        <!-- <button type="submit" class="btn btn-default btn-block loginBtn" style="margin-bottom:16px;"> 
                        เข้าสู่ระบบด้วยบัญชี Google</button> -->


                    </form>
                </div>
                <div class="card-body" id="register-div">
                    <form action="#" method="post" id="register-form">
                        <div class="form-group">
                            <label for="fullname">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="กรอกชื่อและนามสกุล" required>
                        </div>
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="กรอกชื่อผู้ใช้" required>
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" required>
                        </div>
                        <!-- เพิ่ม input fields อื่น ๆ ตามที่ต้องการ -->
                        <!-- เช่น อีเมล, เบอร์โทร, ที่อยู่, จังหวัด, เขต, แขวง, รหัสไปรษณีย์ -->
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="กรอกอีเมล" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">เบอร์โทร</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="กรอกเบอร์โทร" required>
                        </div>
                        <?php $register_page = true;?>
                        <div class="form-group">
                            <label style="font-weight: bold;">ที่อยู่จัดส่ง</label>
                        </div>
                        <?php include_once('address_current.php');?>
                        <!-- เพิ่ม checkbox การขอใบกำกับภาษี -->
                        <div class="form-check mb-4 mt-2">
                            <input class="form-check-input" type="checkbox" id="is_tax_invoice" name="is_tax_invoice">
                            <label class="form-check-label" for="is_tax_invoice">
                                ขอใบกำกับภาษี
                            </label>
                        </div>
                        <div id="companySec" style="display: none;">
                            <!-- เพิ่มช่องกรอกข้อมูล -->
                            <?php include_once('address_company.php');?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">สมัครสมาชิก</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0&appId=252960368604914" nonce="K8KUrFDu"></script>

<script>

//   <!-- Add the Facebook SDK for Javascript -->

//   (function(d, s, id){
//                         var js, fjs = d.getElementsByTagName(s)[0];
//                         if (d.getElementById(id)) {return;}
//                         js = d.createElement(s); js.id = id;
//                         js.src = "https://connect.facebook.net/en_US/sdk.js";
//                         fjs.parentNode.insertBefore(js, fjs);
//                       }(document, 'script', 'facebook-jssdk')
//   );


 
</script>
<!-- 

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> -->
<script>
    var base_url = "<?= base_url(); ?>";
    var province = '<?php echo json_encode($province) ?>';
    province = JSON.parse(province);



    var amphur = '<?php echo json_encode($amphur) ?>';
    amphur = JSON.parse(amphur);
    console.log(amphur);

    function onchangeTaxType(value){
        if(value == '2'){
            $("#passport_div").hide();
        }else{
            $("#passport_div").show();
        }
    }
</script>

<script src="<?=base_url('./assete/js/handleDropdown.js');?>"></script>
    
<script>
    $(document).ready(function() {


      
        checkTaxInvoiceDiv();
        populateProvinceSelect();
        populateProvinceCompSelect();
        if ($('.login-tab').hasClass('active')) {
            $('#register-div').hide(); // ซ่อนฟอร์มสมัครสมาชิก
        }
        if ($('.register-tab').hasClass('active')) {
            $('#login-div').hide(); // ซ่อนฟอร์มสมัครสมาชิก
        }

        $('.login-tab').on('click', function() {
            $(this).addClass('active'); // เพิ่มคลาส active
            $('.register-tab').removeClass('active'); // ลบคลาส active จากปุ่ม "สมัครสมาชิก"
            $('#login-div').show(); // แสดงฟอร์มเข้าสู่ระบบ
            $('#register-div').hide(); // ซ่อนฟอร์มสมัครสมาชิก
        });

        // เมื่อคลิกที่ปุ่ม "สมัครสมาชิก"
        $('.register-tab').on('click', function() {
            $(this).addClass('active'); // เพิ่มคลาส active
            $('.login-tab').removeClass('active'); // ลบคลาส active จากปุ่ม "เข้าสู่ระบบ"
            $('#register-div').show(); // แสดงฟอร์มสมัครสมาชิก
            $('#login-div').hide(); // ซ่อนฟอร์มเข้าสู่ระบบ


        });

        $('#is_tax_invoice').on('change', function() {
            checkTaxInvoiceDiv();
        });

        function checkTaxInvoiceDiv() {
            if ($('#is_tax_invoice').is(':checked')) {

                $('#companySec').show();
                $("#home_no_comp").prop('required', true);
                $("#building_comp").prop('required', true);
                $("#road_comp").prop('required', true);
                $('#fullnameComp').prop('required', true);
                $('#tax_id').prop('required', true);
                $('#phoneComp').prop('required', true);
                $('#addrComp').prop('required', true);
                $('#provinceComp').prop('required', true);
                $('#districtComp').prop('required', true);
                $('#subdistrictComp').prop('required', true);
                $('#zipcodeComp').prop('required', true);

            } else {

                $('#companySec').hide();
                $("#home_no_comp").removeAttr('required');
                $("#building_comp").removeAttr('required');
                $("#road_comp").removeAttr('required');
                $('#fullnameComp').removeAttr('required');
                $('#tax_id').removeAttr('required');
                $('#phoneComp').removeAttr('required');
                $('#addrComp').removeAttr('required');
                $('#provinceComp').removeAttr('required');
                $('#districtComp').removeAttr('required');
                $('#subdistrictComp').removeAttr('required');
                $('#zipcodeComp').removeAttr('required');
            }
        }
        $('#togglePassword').on('click', function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#login-form').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally
            var formData = new FormData(document.getElementById('login-form')); // Select the form element by ID

            var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

            // Additional data can be appended to the FormData object if needed
            // formData.append('key', 'value');

            $.ajax({
                url: base_url + 'Login/user_login',
                type: "POST",
                dataType: 'json',
                data: formData, // Use FormData object as the data
                contentType: false, // Prevent jQuery from setting contentType
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    console.log(response);
                    if (response.status == "success") {
                        window.location.href = base_url;

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span style="font-weight:bold;">เข้าสู่ระบบไม่สำเร็จ</span>',
                            html: response.err_msg
                        });
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        $('#register-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

            // Additional data can be appended to the FormData object if needed
            // formData.append('key', 'value');

            $.ajax({
                url: base_url + 'Login/create_user',
                type: "POST",
                dataType: 'json',
                data: formData, // Use FormData object as the data
                contentType: false, // Prevent jQuery from setting contentType
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    console.log(response);
                    if (response.status == "success") {

                        Swal.fire({
                            icon: 'success',
                            title: '<span style="font-weight:bold;">สมัครสมาชิกสำเร็จ</span>',
                            html: 'ระบบได้ส่งe-mail เพื่อยืนยันการเข้าใช้งาน กรุณายืนยัน e-mail ของท่าน หากไม่พบe-mail ดังกล่าวกรุณาตรวจสอบใน Junk mail ของท่าน',
                            allowOutsideClick: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // โหลดหน้าเว็บใหม่
                            }
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span style="font-weight:bold;">สมัครสมาชิกไม่สำเร็จ</span>',
                            html: response.message
                        });
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    });

   

</script>