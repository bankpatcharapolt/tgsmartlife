<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registation TG Smart Life</title>
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

  <style>
    

  </style>
  <body class="login">
    <div>
      <!-- <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a> -->


      <div id="loading-spinner"><div class="cv-spinner"><span class="spinner"></span> </div> </div>


      <div class="login_wrapper">
        <input name="base_url" value="<?=base_url();?>" type="hidden" >
        <div id="register" class="animate form ">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" id="username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" id="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" id="pass" required="" />
              </div>
              <div>
                <button style="margin: 0; background-color: #00000012;" class="btn btn-default submit" type="button" >Submit</button>
                <!-- <a style="margin: 0; background-color: #00000012;color: #1d1d1d;" class="btn btn-default submit" type="button">Submit</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="admin" class="to_register"> Log in </a>
                </p>

                <!-- <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  var base_url = $('input[name="base_url"]').val();
  $('.submit').click(function(){
      var username = $('#username').val();
      var email = $('#email').val();
      var pass = $('#pass').val();
      $("#loading-spinner").fadeIn(300);
      _submit(username, email, pass);
  });
  function _submit(username, email, pass) {
      $.ajax({
          type: "POST",
          url: base_url+'teamsale/Admin/validate_regis',
          data:  {
              'username': username,
              'email': email,
              'pass': pass
              },  //ส่งตัวแปร
          type: "POST",
          dataType: 'json',
          async:false,
          success: function(data, status) {
              $("#loading-spinner").hide();
              if(data.status){
                  Swal.fire({ icon: 'success',  text: data.message });
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

