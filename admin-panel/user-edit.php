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
$hr_id=$_REQUEST['hr_id'];
$hid_id=$_REQUEST['hid_id'];
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
$sql_ct.="where user_id='$u_id' and uid!='$hid_id' ";
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
	if(!empty($files[0])){
$sqlmd="select photo_path from user_mas  where uid='$hid_id' ";
$resultmd=execSelect($sqlmd);
//echo $sql_ct;
while ($rowmd=getRows($resultmd))
{
$md_photo_path=$rowmd['photo_path'];
}
unlink($md_photo_path);
	}
$sql=" update user_mas set user_nm=trim('$u_nm'),dob=trim('$dob_date1'),user_status=trim('$u_status'),user_type=trim('$u_type')";
if(!empty($files[0])){
$sql.=", photo_path ='$files[0]'";
}
$sql.=" where uid='$hid_id' ";
//echo $sql;
execUpdate($sql);
?>
<script language="javascript">
	alert('User Modification Successfully');
window.location.href='./user-master.php';	
</script>
<?php

/*----------------------Profile update end----------------------*/
}
else{
	?>
 <script language="javascript">
	alert('User Allready Created');
window.location.href='./user-master.php';	
</script>
<?php
	}
	
  
}else{
	?>
    <script language="javascript">
	alert('Please upload image smaller than 200KB');
	window.location.href='./user-master.php';	
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
       
        <div id="sub"></div>
    </div>

    
</div>

<div class="row-fluid">
<div class="block span12">
        <p class="block-heading">User Modification<div id="image">[Image Size <?php echo $c_u_width;?> x <?php echo $c_u_height;?> ]</div></p>
        <div class="block-body">
           <div class="Generator" >
      <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
                   <?php
     $sqle=" select uid,user_nm,user_id,dob,pwd,user_type,user_status,current_status";
	 $sqle.=",photo_path,page_per ";
	 $sqle.=" from user_mas  where uid='$hr_id'";
	
	// echo $sqle;
	 $rese=execSelect($sqle);	
	while($rowe=getRows($rese))
	  {
        $e_uid=$rowe['uid'];
		$e_user_nm=$rowe['user_nm'];
        $e_user_id=$rowe['user_id'];
		$e_user_type=$rowe['user_type'];
		$e_user_status=$rowe['user_status'];
		$e_photo_path=$rowe['photo_path'];
		$e_dob=$rowe['dob'];
		$e_dob1=ansi_to_british($e_dob);
       
	  }
	  ?>
     <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $hr_id; ?>" /> 
      <tr >
      <td width="15%">User Name </td>
      <td width="35%"><input type="text" id="u_nm" name="u_nm" value="<?php echo $e_user_nm; ?>" maxlength="25" /></td>
      <td width="15%">User Id </td>
      <td width="35%"><input type="text" id="u_id" name="u_id" value="<?php echo $e_user_id; ?>" maxlength="10" readonly="readonly"/></td>
      </tr>
     
       <tr >
      <td width="15%">D.O.B</td>
      <td width="35%"><input type="text" id="dob_date" name="dob_date" value="<?php echo $e_dob1; ?>"/> &nbsp;<img src="./images/cal.gif" align="top"  onclick="displayCalendar(document.forms[1].dob_date,'dd/mm/yyyy',this)" style="height:22px; "/></td>
      <td width="15%">Photo </td>
      <td width="35%">
       <?php
	  if(!empty($e_photo_path)){
		  ?>
          <div id="photo"><img src="./<?php echo $e_photo_path; ?>" /></div>
           <?php
	  }
	  ?>
     <input type="file" name="image" accept="image/*" /></td>
      </tr>
     
      <tr>
      <td width="10%">User Status </td>
      <td width="12%">
      <select name="u_status" id="u_status" >
    <option value="A" <?php if($e_user_status=="A") echo "SELECTED";?>>   Activate    </option>
    <option value="D"<?php if($e_user_status=="D") echo "SELECTED";?>>   Deactivate    </option>
    </select>
    </td>
     <td width="10%">User Type </td>
      <td width="12%">
      <select name="u_type" id="u_type" >
      <option value="G" <?php if($e_user_type=="G") echo "SELECTED";?>>   General    </option>
      <option value="A" <?php if($e_user_type=="A") echo "SELECTED";?>>   Admin    </option>
    </select>
    </td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="cancel" id="cancel" class="btn btn-primary btn-small" value="Cancel" onclick="window.location='./user-master.php'"/>
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

if ($('#m_nm').val() == "") {
	$("#sub").text("Name cannot be Blank").show().fadeOut(1500);
	$('#m_nm').css("border-color","#FF0000");
	$('#m_nm').focus();
      return false;								   
}
if ($('#position').val() == "") {
	$("#sub").text("Type Menu Position").show().fadeOut(1500);
	$('#Position').css("border-color","#FF0000");
	$('#Position').focus();
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
