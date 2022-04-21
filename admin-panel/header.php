<?php
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>
<?php $current_page=curPageName(); ?>
<?php 
require_once("./inc/operator_class.php");
require_once("./inc/dblib.inc.php");
require_once('./inc/function.php');
$Session = new Session('Script');
$ses_uid = $Session->Get('uid');
$ses_comp_nm = $Session->Get('comp_nm');
$ses_web_addr = $Session->Get('web_addr');
$ses_user_nm = $Session->Get('user_nm');
$ses_user_id = $Session->Get('user_id');
$ses_page_per = $Session->Get('page_per');
$ses_user_type = $Session->Get('user_type');
$ses_user_status = $Session->Get('user_status');
$ses_current_status = $Session->Get('current_status');
$ses_photo_path = $Session->Get('photo_path');
$ses_id = $Session->Get('id');
$ses_ip_addr= $Session->Get('ip_addr');
$conn = OpenDB();
//if(empty($ses_page_per)) $ses_page_per="3,5";
if(empty($ses_uid))
{
  ?>
<script language=javascript>
    window.location.href='./login.php';
    </script>
<?php   
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin Panel Of <?php echo $ses_comp_nm; ?> </title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="./css/theme.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
<script type="text/javascript" src="./js/allscript.js"></script>
<script src="./ckeditor/adapters/jquery.js"></script>
    <script src="./js/jquery-1.7.2.min.js" type="text/javascript"></script>
   <script src="./ckeditor/ckeditor.js"></script>
   <script src=".8ckeditor/build-config.js"></script>
 <link type="text/css" rel="stylesheet" href="./dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
  <SCRIPT type="text/javascript" src="./dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

  

<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    skin : "o2k7",
    skin_variant : "silver",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",

    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Example word content CSS (should be your site CSS) this one removes paragraph margins
    content_css : "css/word.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "./lists/template_list.js",
    external_link_list_url : "./lists/link_list.js",
    external_image_list_url : "./lists/image_list.js",
    media_external_list_url : "./lists/media_list.js",

    // Replace values for the template plugin
    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    }
  });
</script>
 
    <script>

$(function () {
    $("#tab1 #checkAll").click(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).attr("checked", true);
            });

        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).attr("checked", false);
            });
        }
    });
});
  </script>
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./images/favicon.ico">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
  <?php
if($ses_user_type!='A'){
if($current_page!='index.php')
{
  if($current_page!='my-account.php')
  {
  /*-------------- get the current page id------------------------*/
    $sql_p="select mid from menu_master ";
    $sql_p.="where murl=:current_page ";
    $sthP = $conn->prepare($sql_p);
    $sthP->bindParam(':current_page', $current_page);
    $sthP->execute();
    $ssP=$sthP->setFetchMode(PDO::FETCH_ASSOC);
    $rowP = $sthP->fetchAll();
    foreach ($rowP as $keyP => $valueP) 
    {

      $mid_p=$valueP['mid'];
    }
//echo "Current Page: $mid_p Page Per: $ses_page_per<br>";
/*--------------- search the current page if it has permission---------------------*/
$arr_page_per=explode(",",$ses_page_per);
$found=array_search($mid_p,$arr_page_per);
//echo "<br>Found: $found";
//echo "<br>len Found:".strlen($found);

if(strlen($found)<=0 ){
  

?>
<script language=javascript>
    window.location.href='./index.php';
    </script>
        
<?php

}
}
}

}
?>
    <div class="navbar">
      
        <div class="navbar-inner">
        <?php
    if($current_page!='media-upload-master.php')
      {
  ?>
       <ul class="nav pull-right">
       
       <li><a href="./media-upload-master.php" class="hidden-phone visible-tablet visible-desktop" role="button" target="_blank"><img src="images/media.png" ></a> </li>
        <li id="fat-menu" class="dropdown">
            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                      
        <?php 
if(!empty($ses_photo_path))
{ 
?>
<img src="./<?php echo $ses_photo_path; ?>" />
<?php 
}
else{
  ?>
  <img src="./profile/officers.png"  height="20px"/>
<?php 
}

?>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="./my-account.php">My Account</a></li>
                            <li class="divider"></li>
                            <?php if($ses_user_type=='A')
                            {
                              ?>
                              <li><a tabindex="-1" href="./setting.php">Settings</a></li>
                              <li class="divider"></li>
                              <?php
                            }
                            ?>
                            
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="./logout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <?php
        }
        ?>
                
             <!--   <a class="brand" href="index.html"><span class="first">Infotch</span> <span class="second">Systems</span></a>--><a class="brand" href="http://www.<?php echo $ses_web_addr; ?>" target="_blank"><span class="first"><?php echo $ses_comp_nm; ?></span> </a>
        </div>
    </div>
  <!-- -----------------------photo upload code--------------------->
