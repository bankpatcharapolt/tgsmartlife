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
        <div class="col-md-8 text-center">    
            <h5 class="mb-2" style="text-align: center;">ไม่พบรหัสผู้ใช้ของท่าน อาจเป็นไปได้ว่าลิ้งค์ Reset Password ของท่านได้หมดอายุแล้ว<br>หรือท่านเคยเปลี่ยนรหัสแล้ว <br>กรุณาร้องขอ Email Reset Password อีกครั้ง</h5>
            <a href="<?php echo base_url('resetpassword')?>" class="btn btn-primary mb-4 "  >กรุณาคลิ๊กที่นี่</a>
                  
        </div>
      
    </div>
</div>

