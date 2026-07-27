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
    /* CSS: ตกแต่งปุ่มลูกตาและ input */
    .toggle-password {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
    }

    .toggle-password i {
        color: #666;
        font-size: 1.2rem;
    }

    .form-control {
        padding-right: 35px;
        /* เพื่อให้ปุ่มลูกตาอยู่ในส่วนขวาของ input */
    }

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
        <div class="col-md-8">
            <h5 class="mb-2" style="text-align: center;">กรุณากำหนด Password ใหมสำหรับ Login เข้าใช้งานเว็ปไซต์ TG Smart Life</h5>
        </div>
        <div class="col-md-8">

            <div class="card" style="border:0px;">
                <div class="card-header" style="background:none;border:0px;">

                </div>
                <div class="card-body" id="setnewpassword-div">
                    <form action="#" method="post" id="setnewpassword-form">
                        
                        <!-- HTML: เพิ่มปุ่มลูกตาใน input -->
                        <div class="form-group row mb-4">
                            <label for="password" class="col-sm-12 col-md-2 col-form-label">รหัสผ่านใหม่:</label>
                            <div class="col-md-8 col-sm-10 position-relative">
                                <input tabindex="1" type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่านใหม่" required>
                                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="newpassword" class="col-sm-12 col-md-2 col-form-label">ยืนยันรหัสผ่านใหม่:</label>
                            <div class="col-md-8 col-sm-10 position-relative">
                                <input tabindex="2"  type="password" class="form-control" id="newpassword" name="newpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('newpassword')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="offset-md-2 col-md-8 col-sm-12">
                                <button type="submit" tabindex="3" class="btn btn-primary btn-block " style="background-color:#005EB8;color:white;"> ตกลง</button>

                            </div>
                        </div>



                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">


<script>
      var user_id = '<?php echo isset($data[0]['user_id']) ? $data[0]['user_id'] : 0;?>';
    $( document ).ready(function() {
     

    });

    $('#setnewpassword-form').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally
        var formData = new FormData(document.getElementById('setnewpassword-form')); // Select the form element by ID

        var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData
        formData.append('user_id', user_id);


        if ($("#password").val() !== $("#newpassword").val()) {
            // ถ้าไม่ตรงกัน ให้แสดงข้อความเตือน
            Swal.fire({
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน',
                text: 'กรุณาใส่รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ให้ตรงกัน',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
            return; // หยุดการดำเนินการต่อ
        }


        $.ajax({
            url: base_url + 'Resetpassword_by_email/set_new_password',
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

                        html: '<p>ตั้งรหัสผ่านเสร็จสมบูรณ์</p>',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'ตกลง',
                        customClass: {
                            container: 'swal-container-lg' // ใช้คลาสขนาดใหญ่ของ Bootstrap
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = base_url;
                        }
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">ไม่สามารถตั้งรหัสผ่านได้</span>',
                        html: 'ไม่สามารถตั้งรหัสผ่านได้'
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>


<script>
    // JavaScript: สร้างฟังก์ชันเพื่อเปิด/ปิดการแสดงรหัสผ่าน
    function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        var icon = input.nextElementSibling.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>