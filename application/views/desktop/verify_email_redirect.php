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
            <h5 class="mb-2" style="text-align: center;"> ท่านได้ทำการยืนยัน e-mail เรียบร้อยแล้ว กรุณาคลิ๊กที่นี่เพื่อเข้าสู่ระบบ</h5>
          
        </div>
        <div class="col-md-12 mb-4" align="center">
             <a href="./login" class="btn btn-primary">กรุณาคลิ๊กที่นี่</a>
        </div>
    </div>
</div>
