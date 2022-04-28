<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$password="admin@1234#";
//echo password_hash($password,PASSWORD_BCRYPT);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $soft->soft_nm; ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
	<?php echo link_tag('assets/admin/bootstrap/css/bootstrap.min.css');?>
    <?php echo link_tag('assets/admin/css/font-awesome.min.css');?>
    <?php echo link_tag('assets/admin/css/ionicons.min.css');?>
    <?php echo link_tag('assets/admin/dist/css/adminlte.min.css');?>
 <?php echo link_tag('assets/admin/css/alertify.core.css'); ?>
    <?php echo link_tag('assets/admin/css/alertify.default.css'); ?>
    <script src="<?php echo base_url(); ?>assets/admin/js/alertify.min.js"></script>
    <script src = "<?php echo base_url(); ?>assets/admin/js/jquery-1.9.1.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets/admin/js/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
  <script>
 <?php
  if($this->session->flashdata('message')) 
  {
 	 echo $this->session->flashdata('message');
  }
?>   
</script>
<div class="login-box">
  <div class="login-logo">
  <b><?php echo $soft->soft_nm; ?></b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">&nbsp;</p>
	<?php echo form_open('admin/login/admin_login', array('id'=>'login-form')); ?>	
      <div class="form-group has-feedback <?php if(form_error('username')){ echo 'has-error'; } ?>">
      <div class="input-group mb-2">
		 <?php echo form_input(array('name' => 'username','id'=>'username','autocomplete'=>'off','class'=>'form-control','placeholder'=>'User Name','value'=>set_value('username') )); ?>
         <div class="input-group-append">
            <span class="input-group-text fa fa-user form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="form-group has-feedback <?php if(form_error('password')){ echo 'has-error'; } ?>">
      	<div class="input-group mb-3">
       	<?php echo form_password(array('name' => 'password','class'=>'form-control','placeholder'=>'Password','value'=>set_value('password') )); ?>
         <div class="input-group-append">
            <span class="input-group-text fa fa-lock form-control-feedback"></span>
          </div>
        </div>
        <?php echo form_error('password','<em for="password" class="help-block">','</em>'); ?>
      </div>
      <div class="row">
        <div class="col-8">
        </div>
        <!-- /.col -->
        <div class="col-4">
        	<?php  echo form_submit(array('name'=>'submit','value'=>'Login','class'=>'btn btn-primary btn-block btn-flat')); ?>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
</div>
<!--<script src="<?php echo base_url(); ?>/assets/admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>-->
<script src="<?php echo base_url(); ?>/assets/admin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
