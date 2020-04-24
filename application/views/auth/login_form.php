<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Klinik App | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=base_url()?>asset/dist/img/cleanlogo.png" type="image">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/custom.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page " style="background-image: url( '<?= base_url() ?>asset/dist/img/newpattern.jpg' )">
<div class="container">
  <div class="login-box">
    <div class="login-logo">
    
    </div><!-- login-logo -->
    <div class="login-box-body">
    <div class="clinic-logo" style="background-image: url( '<?= base_url() ?>asset/dist/img/cliniclog.png' )"></div>
       <p class="login-box-msg">Clinic Manager</p>
       <p class="login-msg-sign">Sign in to your account</p>
        <?php
          echo form_open('Authentication/validate_credentials','class = "form-group"');
          echo form_input('username','','class="form-control input-marg" autofocus placeholder="username"');
          echo form_password('password', '', 'class="form-control password input-marg" placeholder="password"' );
          echo form_submit('submit', 'Sign-in ', 'class="btn btn-custom-login pull-right "');
          echo form_close();
        ?>
        <p class="login-custom-p">Create New Account</p>
        <!-- <button onclick="modalchoose();" class="btn btn-primary btn-sm moveup">Sign-up</button> -->
        <!-- <div class="social-log">
          <div class="logincircle pull-right"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
          <div class="logincirclefacebook pull-right"><i class="fa fa-facebook" aria-hidden="true"></i></div>
        </div> -->
        
    </div><!-- login-box-body -->
  </div><!-- login-box -->
</div><!-- container -->

<!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header login_modal_header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" id="myModalLabel">Login to Your Account</h2>
          </div>
          <div class="modal-body login-modal">
            <br/>
            <div class="clearfix"></div>
            <div id='social-icons-conatainer'>
              <div class='modal-body-left'>
                <div class="form-group">
                      <input type="text" id="username" placeholder="Enter your name" value="" class="form-control login-field">
                      <i class="fa fa-user login-field-icon"></i>
                  </div>

                  <div class="form-group">
                      <input type="password" id="login-pass" placeholder="Password" value="" class="form-control login-field">
                      <i class="fa fa-lock login-field-icon"></i>
                  </div>

                  <a href="#" class="btn btn-success modal-login-btn">Login</a>
                  <a href="#" class="login-link text-center">Lost your password?</a>
              </div>

              <div class='modal-body-right'>
                <div class="modal-social-icons">
                  <a href="<?php echo $login_url?>" class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
                  <a href='<?php echo site_url('Authentication/googleplus_request'); ?>' class="btn btn-default google"> <i class="fa fa-google-plus modal-icons"></i> Sign In with Google </a>
                </div> 
              </div>  
              <div id='center-line'> OR </div>
            </div>                                                        
            <div class="clearfix"></div>

            <div class="form-group modal-register-btn">
              <button class="btn btn-default"> New User Please Register</button>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer login_modal_footer">
          </div>
      </div>
    </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?= base_url() ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url() ?>asset/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url() ?>asset/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
});

function modalchoose() {
  $('#login-modal').modal('show');
}
</script>
</body>
</html>