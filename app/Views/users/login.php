<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- Toastr style -->
    <link href="<?php echo base_url('public/assets/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/main.css'); ?> ">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/font-awesome/css/font-awesome.css'); ?>">
    <title>Login - DotCom Values</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>DotCom Values</h1>
      </div>
      <div class="login-box">
        <?php echo session()->getFlashdata('message'); ?>
        <form class="login-form" method="post" action="<?=base_url('login'); ?>">
          <h4 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Sign In</h4>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Enter your Email" >
            <?php //echo form_error('username', '<p class="text-danger">', '</p>'); 
            ?>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password">
            <?php //echo form_error('password', '<p class="text-danger">', '</p>'); 
            ?>
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
        <form class="forget-form formValidate" id="formLogin" name="formLogin" method="post" action="<?php echo site_url("login/checkmail"); ?>">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" type="email" name="email" required placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button  id="btn-submit" type="submit" class="btn btn-primary btn-block save_data" type="button"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url('public/assets/js/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
    <!-- Toastr script -->
    <script src="<?php echo base_url('public/assets/js/plugins/toastr/toastr.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/plugins/validate/jquery.validate.min.js'); ?>"></script>
   
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
      $(document).ready( function () {
      $('#formLogin').validate({submitHandler: saveData2});
       })
    </script>
    <?= $this->include('includes/helpers'); ?>

  </body>
</html>