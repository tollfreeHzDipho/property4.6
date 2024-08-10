<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?> ">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/font-awesome/css/font-awesome.css"); ?>">
    <title>Reset Password - DotCom Values</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      
      <div class="login-box">
        <?php echo $this->session->flashdata('rpass2'); ?>
        <form class="login-form" method="post"  action="<?php echo base_url('login/set_password'); ?>?r_c=<?php echo $_GET['r_c']; ?>&f_e=<?php echo $_GET['f_e']; ?>" >
          <h4 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Set New Password</h4>
          <div class="form-group">
            <label class="control-label">New Password</label>
            <input type="password" required name="pass" placeholder="New Password..." class="form-password form-control" id="form-password">
            <?php echo form_error('pass'); ?>
          </div>
          <div class="form-group">
            <label class="control-label">Confirm New Password</label>
          <input type="password" required name="repass" placeholder="Confirm New Password..." class="form-password form-control" id="form-password">
            <?php echo form_error('repass'); ?>
          </div>
          
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SUBMIT</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/validate/jquery.validate.min.js'); ?>"></script>
   
    <!-- Page specific javascripts-->
    <script type="text/javascript">
$('#formLogin').validate({submitHandler: saveData2});
  
    </script>
    <?php $this->view('includes/helpers'); ?>
  </body>
</html>