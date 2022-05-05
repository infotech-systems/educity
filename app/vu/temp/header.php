<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$cur_id1=$this->uri->segment(1);
$cur_id2=$this->uri->segment(2);
$cur_id3=$this->uri->segment(3);
?>
<!DOCTYPE html>
<html lang="zxx">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $pageinfo['title']; ?> | <?php echo $orgn[0]['orgn_nm']; ?></title>
    <meta name="keywords" content="<?php echo $pageinfo['meta_keywords']; ?>">
    <meta name="description" content="<?php echo $pageinfo['meta_desc']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url($orgn[0]['favicon']); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/animate.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/jquery-ui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/meanmenu.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/owl.carousel.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/font-awesome.min.css'); ?>">
   <!--     <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/nice-select.css'); ?>">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/custom-slider/css/nivo-slider.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/jquery.fancybox.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/fakeLoader.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/lightcase.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/responsive.css'); ?>">
        <script src="<?php echo base_url(); ?>assets/public/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body id="top">

        <!-- header-area start Here -->
        <header class="navigation">
            <div class="header-area">
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="topbar-left">
                                    <p> <a href="#"><i class="fa fa-angle-down"></i></a> Welcome To <?php echo $orgn[0]['orgn_nm']; ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="topbar-right text-right">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-send"></i> <?php echo $orgn[0]['orgn_addr1']; ?></a></li>
                                        <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $orgn[0]['cont_per_no']; ?></a></li>
                                        <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $orgn[0]['cont_per_no2']; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom" id="sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="logo-area">
                                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url($orgn[0]['orgn_logo']); ?>" alt="<?php echo $orgn[0]['orgn_nm']; ?> - <?php echo $orgn[0]['orgn_tag']; ?>" title="<?php echo $orgn[0]['orgn_nm']; ?>"> </a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="menu-area">
                                    <nav class="main-menu" id="nav">
                                        <ul>
                                            <?php echo $this->dynamic_site_menu->build_page($cur_id2,$cur_id3); ?> 

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-area end Here -->
        <!-- mobile-menu-area start -->
        <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                              <ul>
                              <?php echo $this->dynamic_site_menu->build_page($cur_id2,$cur_id3); ?> 

                            </ul>
                            </nav>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile menu area end Here -->