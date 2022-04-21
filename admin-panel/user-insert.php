<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');

?>
<?php
$submit=$_REQUEST['submit'];
$u_nm=$_REQUEST['u_nm'];
$u_id=$_REQUEST['u_id'];
$dob_date=$_REQUEST['dob_date'];
$image=$_REQUEST['image'];
$n_pwd=$_REQUEST['n_pwd'];
$u_status=$_REQUEST['u_status'];
$u_type=$_REQUEST['u_type'];
$dob_date1=british_to_ansi($dob_date);
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
?>


<!-------------------------- profile update start----------------------->

<?php
if($submit=="Submit"){
	$max_file_size = 1024*200; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
 
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
$sql =" insert into user_mas (user_nm,user_id,pwd,dob,user_status,photo_path,user_type) ";
$sql.=" values ";
$sql.=" (trim('$u_nm'),trim('$u_id'),trim('$n_pwd'),trim('$dob_date1'),trim('$u_status'),'$files[0]','$u_type') ";
//echo $sql;
execInsert($sql);
?>
<script language="javascript">
	alert('User Creation Successfully');
	window.location.href='./user-insert.php';	
</script>
<?php

/*----------------------Profile update end----------------------*/
}
else{
	?>
 <script language="javascript">
	alert('User Allready Created');
window.location.href='./user-insert.php';	
</script>
<?php
	}
	
  
}else{
	?>
    <script language="javascript">
	alert('Please upload image smaller than 200KB');
	window.location.href='./user-insert.php';	
	</script>
<?php
}   
}
}
	?>

        <div class="container-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
       
        <div id="sub"></div>
    </div>

    
</div>

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
<div class="row-fluid">
<div class="block span12">
        <p class="block-heading">User Creation<div id="image">[Image Size <?php echo $c_u_width;?> x <?php echo $c_u_height;?> ]</div></p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <tr >
      <td width="15%">User Name </td>
      <td width="35%"><input type="text" id="u_nm" name="u_nm" value="" maxlength="25" /></td>
      <td width="15%">User Id </td>
      <td width="35%"><input type="text" id="u_id" name="u_id" value="" maxlength="10"/><div id="status"></div></td>
      
      </tr>
     
       <tr >
      <td width="15%">D.O.B</td>
      <td width="35%"><input type="text" id="dob_date" name="dob_date" value="" /> &nbsp;<img src="./images/cal.gif" align="top"  onclick="displayCalendar(document.forms[1].dob_date,'dd/mm/yyyy',this)" style="height:22px; "/></td>
      <td width="15%">Photo </td>
      <td width="35%"><input type="file" name="image" accept="image/*" /></td>
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
     <td width="10%">User Type </td>
      <td width="12%">
      <select name="u_type" id="u_type" >
   
    <option value="G">   General    </option>
     <option value="A">   Admin    </option>
    </select>
    </td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()"/>
  <!--    <?php// if(isset($msg)): ?>
			<p class='alert'><?php// echo $msg ?></p>
		<?php// endif ?>-->
		
		<!-- file uploading form -->
		<!--<form action="" method="post" enctype="multipart/form-data">
			<label>
				<span>Choose image</span>
				<input type="file" name="image" accept="image/*" />
			</label>
			<input type="submit" value="Upload" />
		</form>-->
		
		<?php
		// show image thumbnails
	//	if(isset($files)){
	//		foreach ($files as $image) {
		//		echo "<img class='img' src='{$image}' /><br /><br />";
		//	}
		//}
		?>
      </div>
      </td>
      </tr>
      </table>
      </form>
      </div>
        </div>
    </div>
    
    
</div>
<script language="javascript">
/*--------------- email id verification function-------------*/
 function validateEmail(txtEmail){
   var a = document.getElementById(txtEmail).value;
   var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
    if(filter.test(a)){
        return true;
    }
    else{
        return false;
    }
}

/*------------- if false then click to write----*/
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
if ($('#email').val() == "") {
	$("#sub").text("Email cannot be Blank").show().fadeOut(1500);
	$('#email').css("border-color","#FF0000");
	$('#email').focus();
      return false;								   
}
 if(!validateEmail('email')){
    $("#sub").text("Invalid Email").show().fadeOut(1500);
	$('#email').css("border-color","#FF0000");
	$('#email').focus();
    return false;								  
}

	 
	 });
</script>

<?php
include('./footer.php');
?>
