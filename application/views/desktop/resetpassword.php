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
        <div class="col-md-8 col-lg-6">
            <div class="card" style="border:0px;">
                <div class="card-header" style="background:none;border:0px;">
                    <h5 class="mb-2" style="text-align: center;">ลืมรหัสผ่าน</h5>
                    <h6 style="text-align: center;">รีเซ็ตรหัสผ่านด้วยอีเมลที่ใช้งาน</h6>
                </div>
                <div class="card-body" id="resetbyemail-div">
                    <form action="#" method="post" id="resetbyemail-form">

                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-12 col-md-2 col-lg-2  col-form-label">อีเมล:</label>
                            <div class="col-md-10 col-lg-10 col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block " style="background-color:#005EB8;color:white;"> รีเซ็ตรหัสผ่าน</button>

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
    $('#resetbyemail-form').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally
        var formData = new FormData(document.getElementById('resetbyemail-form')); // Select the form element by ID

        var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

        // Additional data can be appended to the FormData object if needed
        // formData.append('key', 'value');

        $.ajax({
            url: base_url + 'Resetpassword/reset_by_email',
            type: "POST",
            dataType: 'json',
            data: formData, // Use FormData object as the data
            contentType: false, // Prevent jQuery from setting contentType
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                console.log(response);
                if (response.status == "success") {
                    Swal.fire({
                        iconHtml: '<img style="margin-top:20px;" src="<?= base_url('assete/icons/email.jpg'); ?>" >',

                        html: '<p style="font-size:16px;">ระบบได้ทำการส่งลิ้งค์เพื่อรีเซ็ตรหัสผ่านใหม่ ไปยังอีเมลของท่านเรียบร้อยแล้ว<br>หากไม่พบอีเมลดังกล่าวกรุณาตรวจสอบที่ Junk mail ของท่าน <br>หากมีข้อสงสัยเพิ่มเติมกรุณาติดต่อที่เบอร์ 0652958885 <br>หรือ line @tgsmartlife</p>',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'ตกลง',
                        customClass: {
                            container: 'swal-container-lg' // ใช้คลาสขนาดใหญ่ของ Bootstrap
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // โหลดหน้าเว็บใหม่
                        }
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">ไม่สามารถส่งลิ้งค์เปลี่ยนรหัสผ่านได้</span>',
                        html: response.message
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

</script>