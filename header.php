<?php
error_reporting(0);
include('./admin-panel/inc/dblib.inc.php');
$conn=OpenDB();


function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
 $current_page=curPageName(); 


$sqlt="select *  from company_master ";
$sth = $conn->prepare($sqlt);
$sth->execute();
$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
$rowt = $sth->fetch();
$land_no=$rowt['land_no'];
$comp_nm=$rowt['comp_nm'];
$comp_logo=$rowt['comp_logo'];
$cont_per_no=$rowt['cont_per_no'];
$comp_addr=$rowt['comp_addr'];
$email_id=$rowt['email_id'];
$cont_per_email=$rowt['cont_per_email'];

$web_addr=$rowt['web_addr'];
	

$sqlt="select map_adr  from contact_us_mas ";
$sth = $conn->prepare($sqlt);
$sth->execute();
$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
$rowt = $sth->fetch();
$map_adr=$rowt['map_adr'];
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="StudyPress | Education & Courses HTML Template" />
<meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title><?php echo $comp_nm; ?></title>

<!-- Favicon and Touch Icons -->
<link href="images/favicon.ico" rel="shortcut icon" type="image/png">
<link href="images/apple-icon.png" rel="apple-touch-icon">
<link href="images/apple-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="images/apple-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="images/apple-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href="css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<!-- CSS | Custom Margin Padding Collection -->
<link href="css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
 <script src="js/jquery.marquee.js?v=3" type="text/javascript"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- Header -->
  <header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center p-0">
      <div class="container">
        <div class="row">
          <div class="col-xs-7 col-sm-9 col-md-10" style="margin-right:0px;padding:0px;">
         	<div class="widget m-0 pull-right sm-pull-none sm-text-center" style="width:100% !important;">
            <marquee direction="left" behavior="scroll" scrollamount="2" onMouseOver="0" onMouseDown="2">
           	<?php
			$sqlt="select content  from flash_mas ";
			$sth = $conn->prepare($sqlt);
			$sth->execute();
			$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
			$rowt = $sth->fetchAll();
			foreach ($rowt as $keyt => $valuet) 
			{
				$fcontent=$valuet['content']; 
				?>               
				<h5 style="color: #fff;"><?php echo $fcontent; ?></h5>  
			   <?php
			}
			?> 
            </marquee>
            </div>
            
          </div>
          <div class="col-xs-5 col-sm-3 col-md-2" style="margin-right:0px; padding:0px;">
            <div class="widget m-0 pull-right sm-pull-none sm-text-center">
              <ul class="list-inline pull-right">
                <li class="mb-0 pb-0">
                  <div class="top-dropdown-outer pt-5 pb-5">
                    <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i class="fa fa-sign-in font-13"></i>&nbsp;Admin</a>
                  </div>
                </li>
                <li class="mb-0 pb-0">
                  <div class="top-dropdown-outer pt-5 pb-5">
                    <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i class="fa fa-sign-in font-13"></i>&nbsp;Parent</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-5">
            <div class="widget no-border m-0">
              <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="javascript:void(0)"><img src="images/logo-wide.png" alt=""></a>
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                <li>
                  <a href="#" class="font-12 text-gray text-uppercase">Call us today!</a>
                  <h5 class="font-14 m-0"> +(91) <?php echo $cont_per_no; ?></h5>
                </li>
              </ul>
            </div>
          </div>  
          <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                <li>
                  <a href="#" class="font-12 text-gray text-uppercase">We are open!</a>
                  <h5 class="font-13 text-black m-0"> Mon-Sat 9:00-15:30</h5>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
        <div class="container">
          <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
            <ul class="menuzord-menu">
              <li class="active"><a href="index.php">Home</a></li>
              <?php
			$sqlp =" select * from page_master where parent_id ='0' ";
			$sqlp .=" and show_tag = 'T' order by srl Asc";
			$sthp = $conn->prepare($sqlp);
			$sthp->execute();
			$ssp=$sthp->setFetchMode(PDO::FETCH_ASSOC);
			$rowp = $sthp->fetchAll();
			foreach ($rowp as $keyp => $valuep) 
			{
				$page_id = md5($valuep['page_id']);
				$page_name = $valuep['page_name'];
				$page_link = $valuep['page_link'];
				if(!empty($page_link))
				{
					$murl="$page_link";
				}
				else
				{
					$murl="page.php?hr_id=$page_id";
				}
				?>
				<li><a href="<?php echo $murl; ?>"><?php echo $page_name; ?></a>
					<?php
					$sqlc ="select * from page_master ";
					$sqlc.="where md5(parent_id)=:page_id and  ";
					$sqlc.="show_tag='T' order by srl Asc ";
					$sthc = $conn->prepare($sqlc);
					$sthc->bindParam(':page_id', $page_id);
					$sthc->execute();
					$ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
					$cnt=$sthc->rowCount();
					$rowc = $sthc->fetchAll();
					if($cnt>0)
					{
						?>
						<ul class="dropdown">
							<?php
							foreach ($rowc as $keyc => $valuec) 
							{
								$page_name_c = $valuec['page_name'];
								$page_id_c = md5($valuec['page_id']);
								$page_link_c = $valuec['page_link'];
								if(!empty($page_link_c))
								{
									$murl_sub="$page_link_c";
								}
								else
								{
									$murl_sub="page.php?hr_id=$page_id_c";
								}
								?>
								<li><a href="<?php echo $murl_sub; ?>"><?php echo $page_name_c; ?></a></li>
								<?php 
							}
							?>
						</ul>
						<?php
					}
					?>
				</li>
			<?php
			}
			?>
            </ul>
            <ul class="pull-right flip hidden-sm hidden-xs">
              <li>
                <!-- Modal: Book Now Starts -->
                <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15" data-toggle="modal" data-target="#BSParentModal" href="#"><img src="./images/admission.gif" height="35px;"></a>
                <!-- Modal: Book Now End -->
              </li>
            </ul>
            <div id="top-search-bar" class="collapse">
              <div class="container">
                <form role="search" action="#" class="search_form_top" method="get">
                  <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                  <span class="search-close"><i class="fa fa-search"></i></span>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  
  <!-- Start main-content -->
  <div class="main-content"> 