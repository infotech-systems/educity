<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ses_uid = $this->session->userdata('uid');
$ses_chk_id = $this->session->userdata('chk_id');
$ses_user_name = $this->session->userdata('user_nm');
$ses_contact_no = $this->session->userdata('user_id');

if($this->session->userdata('photo_path'))
{
	$ses_photo_path=$this->session->userdata('photo_path');
}
else
{
	$ses_photo_path="assets/admin/dist/img/user.png";
}
$orgn_logo=$this->session->userdata('orgn_logo');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $soft->soft_nm; ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php echo link_tag('assets/admin/plugins/fontawesome-free/css/all.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/font-awesome/css/font-awesome.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/morris/morris.css'); ?>
<?php echo link_tag('assets/admin/dist/css/adminlte.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/iCheck/flat/blue.css'); ?>
<?php echo link_tag('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>
<?php echo link_tag('assets/admin/plugins/datepicker/datepicker3.css'); ?>
<?php echo link_tag('assets/admin/plugins/daterangepicker/daterangepicker-bs3.css'); ?>
<?php echo link_tag('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?> 
 <!-- bootstrap wysihtml5 - text editor -->
<?php echo link_tag('assets/admin/css/ionicons.min.css'); ?>
<?php echo link_tag('assets/admin/css/alertify.core.css'); ?>
<?php echo link_tag('assets/admin/css/alertify.default.css'); ?>
<?php echo link_tag('assets/admin/plugins/select2/select2.min.css'); ?>
<script src="<?php echo base_url(); ?>assets/admin/js/alertify.min.js"></script>
<script src = "<?php echo base_url(); ?>assets/admin/js/jquery-1.9.1.js"></script>
<?php echo link_tag('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>
<?php echo link_tag('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/admin/js/html5shiv.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/respond.min.js"></script>
<![endif]-->
</head>

<!--<body class="hold-transition sidebar-mini sidebar-collapse">-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('dashboard'); ?>" class="nav-link" style="margin-top:-7px;"> 
        	
			
        </a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
       <?php 
        if($this->session->userdata('user_type')!='C'):
      //  echo $this->dynamic_alert->build_info();
        endif;
        ?>  
         
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><img src="<?php echo base_url($ses_photo_path); ?>" alt="<?php echo $ses_user_name; ?>" class="img-size-50 mr-3 img-circle"></span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo site_url('admin/user/profile');  ?>" class="dropdown-item">
            <i class="fa fa-user-secret"></i>	Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('admin/Signout');  ?>" class="dropdown-item">
            <i class="fa fa-sign-out"></i>	Sign Out
          </a>
        </div>
      </li>
      
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
      <img src="<?php echo base_url($soft->soft_logo); ?>" alt="<?php echo $soft->soft_nm; ?>" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $soft->soft_nm; ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url($ses_photo_path); ?>" class="img-circle elevation-2" alt="<?php echo $ses_user_name; ?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $ses_user_name; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <?php 
		$portal='W';
        $type=$this->session->userdata('user_type');
        $cur_id='1';
        echo $this->dynamic_menu->build_menu($cur_id,$type,$portal);
        ?>    
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height:auto !important;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">
          <?php
			$link1=$this->uri->segment(1);
			if(!empty($child->title))
			{
				?>
                
				<i class="<?php echo $child->uri; ?>"></i> 
				<?php
				echo $child->title;
			}
			else
			{
				?>
				<i class="<?php  echo $parent->uri; ?>"></i> 
				<?php
				 echo $parent->title;
			}
			?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <?php
			$orgn_id = $this->session->userdata('orgn_id');
			 
			if($parent->url!='admin/dashboard')
			{
				?>
				<li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li> 
			   <?php
			}
			if(!empty($main_p->title))
			{
				?>
				<li  class="breadcrumb-item"><a href="<?php  echo base_url($main_p->url); ?>"><i class="<?php  echo $main_p->uri; ?>"></i>&nbsp;<?php echo $main_p->title; ?></a></li> 
			   <?php
			} 
			if(!empty($parent->title))
			{
				?>
				<li class="breadcrumb-item"><a href="<?php  echo base_url($parent->url); ?>"><i class="<?php  echo $parent->uri; ?>"></i>&nbsp;<?php echo $parent->title; ?></a></li> 
			   <?php
			}
			if(!empty($child->title))
			{
				?>
				<li class="breadcrumb-item"><a href="#"><i class="<?php echo $child->uri; ?>"></i>&nbsp;<?php echo $child->title; ?></a></li>
			   <?php
			}
			?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">  
  <script>
  
 <?php
  if($this->session->flashdata('message')) 
  {
  	echo $this->session->flashdata('message');
    if(isset($_SESSION['message'])){
      unset($_SESSION['message']);
  }
  
   }
?>   
</script>
