<?php 
include("./inc/dblib.inc.php");

OpenDB();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Signup</title>
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
<body>
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

 
   <SCRIPT type="text/javascript">
<!--
/*
Credits: Bit Repository
Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html 
*/

pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#u_id").change(function() { 

var usr = $("#u_id").val();

if(usr.length >= 4)
{
$("#status").html('<img src="./images/loader.gif" align="absmiddle">');

    $.ajax({  
    type: "POST",  
    url: "./back/check.php",  
    data: "u_id="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#u_id").removeClass('object_error'); // if necessary
		$("#u_id").addClass("object_ok");
		$(this).html('&nbsp;<img src="./images/tick.gif" align="absmiddle"/>');
	}  
	else  
	{  
		$("#u_id").removeClass('object_ok'); // if necessary
		$("#u_id").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
	$("#u_id").removeClass('object_ok'); // if necessary
	$("#u_id").addClass("object_error");
	}

});

});

//-->
</SCRIPT>
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
<?php
$sqlh="select comp_nm,comp_addr from company_master ";
$resh=execSelect($sqlh);
while($rowh=getRows($resh))
{

 $comp_nm=$rowh['comp_nm'];
 $comp_addr=$rowh['comp_addr'];
}
//$comp_nm1 = substr("$comp_nm", -34)


?>


<?php
$submit=$_REQUEST['submit'];
$u_nm=$_REQUEST['u_nm'];
$u_id=$_REQUEST['u_id'];
$dob_date=$_REQUEST['dob_date'];
$pic_file=$_REQUEST['pic_file'];
$n_pwd=$_REQUEST['n_pwd'];
$u_status=$_REQUEST['u_status'];
$customer=$_REQUEST['customer'];
$dob_date1=british_to_ansi($dob_date);

?>


<!-------------------------- profile update start----------------------->
<?php
if($submit=="Submit"){
	$max_file_size = 1024*200; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
  $sql_b="select * from image_master ";
	  $res_b=execSelect($sql_b);
	  // echo $sql_b;	
	while($row_b=getRows($res_b))
	  {
	     $c_u_width=$row_b['u_width'];
         $c_u_height=$row_b['u_height'];
		 $c_s_width=$row_b['s_width'];
         $c_s_height=$row_b['s_height'];
		 $c_b_width=$row_b['b_width'];
		 $c_b_height=$row_b['b_height'];
		 $c_sl_width=$row_b['sl_width'];
		 $c_sl_height=$row_b['sl_height'];
	   }
$sizes = array( $c_u_width => $c_u_height);

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
if( $_FILES['image']['size'] < $max_file_size ){
	
$sql_ct="select count(uid) as ct from user_mas ";
$sql_ct.="where user_id='$u_id' ";
$result=execSelect($sql_ct);
//echo $sql_ct;
while ($row=getRows($result))
{
$total=$row['ct'];
}
if($total<=0)
{	
/*------------------ file upload process-----------------------*/

    // get file extension
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $valid_exts)) {
      /* resize image */
     foreach ($sizes as $w => $h) {
        $files[] = resize($w, $h);
	 }	
	}
	$sql =" insert into user_mas (user_nm,user_id,pwd,dob,user_status,photo_path,cust_id) ";
$sql.=" values ";
$sql.=" (trim(upper('$u_nm')),trim('$u_id'),trim('$n_pwd'),trim('$dob_date1'),trim('$u_status'),'$files[0]','$customer') ";
echo $sql;
execInsert($sql);
?>
<script language="javascript">
	alert('User Creation Successfully');
	window.location.href='./login.php';	
</script>
<?php

/*----------------------Profile update end----------------------*/
}
else{
	?>
 <script language="javascript">
	alert('User Allready Created');
window.location.href='./login.php';	
</script>
<?php
	}
	
  
}else{
	?>
    <script language="javascript">
	alert('Please upload image smaller than 200KB');
	window.location.href='./signup.php';	
	</script>
<?php
}   
}
}
	?>



        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
       
        <div id="sub"><?php echo $comp_nm; ?></div>
    </div>

    
</div>
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
 <div class="row-fluid">
<div class="block span12">
        <p class="block-heading">Signup</p>
        <div class="block-body">
           <div class="Generator" >  
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <tr >
      <td width="15%">User Name </td>
      <td width="35%"><input type="text" id="u_nm" name="u_nm" value="" maxlength="25" /></td>
      <td width="15%">User Id </td>
      <td width="35%"><input type="text" id="u_id" name="u_id" value="" maxlength="10"/><div id="status"></div></td>
      </tr>
     
       <tr >
      <td width="15%">D.O.B</td>
      <td width="35%"><input type="text" id="dob_date" name="dob_date" value=""/> &nbsp;<img src="./images/cal.gif" align="top"  onclick="displayCalendar(document.forms[0].dob_date,'dd/mm/yyyy',this)" style="height:22px; "/></td>
      <td width="15%">Photo </td>
      <td width="35%"><input type="file" name="pic_file" id="pic_file" /></td>
      </tr>
      <tr>   
      <td width="15%">New Password </td>
      <td width="35%"><input type="password" id="n_pwd" name="n_pwd" value="" maxlength="10" /></td>
      
      <td width="10%">Re-enter Password </td>
      <td width="12%"><input type="password" id="r_pwd" name="r_pwd" value="" maxlength="10" /></td>
      </tr>
      <tr>
      <td width="10%">User Status </td>
      <td width="12%">
      <select name="u_status" id="u_status" >
    <option value="A">   Activate    </option>
    <option value="D">   Deactivate    </option>
    </select>
    </td>
     <td width="10%">Customer</td>
      <td width="12%">
      <select name="customer" id="customer" >
      <option value="">Select customer  Name</option>
      <?php
      $sql_c="select cust_id,cust_nm,deprt from cust_mas ";
     $result=execSelect($sql_c);
	//echo $sql_ct;
	while ($row=getRows($result))
  		{
			$cust_id=$row['cust_id'];
			$cust_nm=$row['cust_nm'];
			$deprt=$row['deprt'];
			
			
	?>

    <option value="<?php echo $cust_id; ?>">  <?php echo  $cust_nm; if(!empty($deprt)){?>(<?php echo $deprt; ?> ) <?php }?></option>
    <?php
		}
		?>
    
    </select>
    </td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
     <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Refresh" />
      </div>
      </td>
      </tr>
      </table>
       </div>
        </div>
    </div>
    
    
</div>
      </form>

<script language="javascript">
jQuery("input:text").click( function() {
	$(this).css("border-color","#D6E4F5"); 
	
 });
 jQuery("select").click( function() {
	$(this).css("border-color","#D6E4F5"); 
 });
 jQuery("textarea").click( function() {
	$(this).css("border-color","#D6E4F5"); 
 });

/*-------------- submit function----------*/
jQuery('#submit').click( function() {

if ($('#u_nm').val() == "") {
	$("#sub").text("Name cannot be Blank").show().fadeOut(1500);
	$('#u_nm').css("border-color","#FF0000");
	$('#u_nm').focus();
      return false;								   
}
if ($('#u_id').val() == "") {
	$("#sub").text(" User ID  cannot be Blank").show().fadeOut(1500);
	$('#u_id').css("border-color","#FF0000");
	$('#u_id').focus();
      return false;								   
}
if ($('#n_pwd').val() == "") {
	$("#sub").text(" New Password  cannot be Blank").show().fadeOut(1500);
	$('#n_pwd').css("border-color","#FF0000");
	$('#n_pwd').focus();
      return false;								   
}
if ($('#r_pwd').val() == "$('#n_pwd').val() ") {
	$("#sub").text(" Re-enter Password & New Password cannot be same ").show().fadeOut(1500);
	$('#r_pwd').css("border-color","#FF0000");
	$('#r_pwd').focus();
      return false;								   
}
if ($('#customer').val() == "") {
	$("#sub").text("Pl. Select Customer Name").show().fadeOut(1500);
	$('#customer').css("border-color","#FF0000");
	$('#customer').focus();
      return false;								   
}


	 
	 });
</script>
<?php
CloseDB();
?>
                    
            </div>
        </div>
    </div>
    


    <script src="./js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>