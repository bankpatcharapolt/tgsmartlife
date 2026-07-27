<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?=base_url('assete/logo/cropped-icon-32x32.png')?>">
    <title>ADMIN TGSmartlife</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?=base_url('assete/admin-themplate/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url('assete/admin-themplate/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url('assete/admin-themplate/vendors/nprogress/nprogress.css')?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url('assete/admin-themplate/vendors/animate.css/animate.min.css')?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=base_url('assete/admin-themplate/build/css/custom.min.css')?>" rel="stylesheet">

    <!-- Loading spinner -->
    <link href="<?=base_url('assete/loading-spinner/css.css')?>" rel="stylesheet">
    <!-- Loading spinner -->
    <script src="<?=base_url('assete/sweetalert2/sweetalert2.all.min.js')?>"></script>
<link href="<?=base_url('assete/sweetalert2/sweetalert2.min.css')?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <!-- <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a> -->

      <div class="login_wrapper">
        <div class="animate form login_form">
          <input name="base_url" value="<?=base_url();?>" type="hidden" >
          <section class="login_content">
          <!-- <form method="post" action="<?=base_url('admin/admin/validate_login');?>"> -->
            <form>
              <h1>Login</h1>
              <div class="col-12">
                <input type="email" class="form-control" placeholder="Username" required="" name="username" id="username"/>
              </div>
              <div class="col-12">
                <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password"/>
              </div>
              <div class="col-12">
              </div>
              <div class="col-12">
                <button style="margin: 0; background-color: #00000012;" class="btn btn-default submit" type="button" >Log in</button>
                <!--<a class="btn btn-default submit" href="<?php //echo base_url('admin/user/regis');?>">Registration</a>-->
              </div>
            </form>
          </section>
        </div>

        <!-- <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> -->
      </div>
    </div>
  </body>
</html>
<script>
  var base_url = $('input[name="base_url"]').val();
  $('.submit').click(function(){
      var user = $('#username').val();
      var pass = $('#password').val();
      
      $("#loading-spinner").fadeIn(300);
      _submit(user, pass);
  });
  function _submit(user, pass) {
    $.ajax({
        type: "POST",
        url: base_url+'admin/Admin/validate_login',
        data:  {
            'user': user,
            'pass': pass
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            $("#loading-spinner").hide();
            if(data.status){
                window.location.href = data.data;
                //Swal.fire({ icon: 'success',  text: data.message });
            }else{
                Swal.fire({ icon: 'warning',  text: data.message });
            }
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
  }
</script>
