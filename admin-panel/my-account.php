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
$pic_file=$_REQUEST['pic_file'];
$n_pwd=$_REQUEST['n_pwd'];
$o_pwd=$_REQUEST['o_pwd'];
$old_pwd=$_REQUEST['old_pwd'];
$hr_id=$_REQUEST['hr_id'];
$hid_id=$_REQUEST['hid_id'];
$u_type=$_REQUEST['u_type'];

$dob_date1=british_to_ansi($dob_date);

?>

<?php
if($submit=="Submit")
{
    $max_file_size = 1024*2200; // 200kb
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif');

    $sql_b="select * from image_master ";
    $sthb = $conn->prepare($sql_b);
    $sthb->execute();
    $ssb=$sthb->setFetchMode(PDO::FETCH_ASSOC);
    $row_b = $sthb->fetch();
    $c_u_width=$row_b['u_width'];
    $c_u_height=$row_b['u_height'];
    $c_s_width=$row_b['s_width'];
    $c_s_height=$row_b['s_height'];
    $c_b_width=$row_b['b_width'];
    $c_b_height=$row_b['b_height'];
    $c_sl_width=$row_b['sl_width'];
    $c_sl_height=$row_b['sl_height'];
  

    $sizes = array( $c_u_width => $c_u_height);

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) 
{
  if( $_FILES['image']['size'] < $max_file_size )
  {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $valid_exts)) 
    {
      /* resize image */
       foreach ($sizes as $w => $h) 
       {
          $files[] = resize($w, $h);
       }  
    } 
  
  if(!empty($n_pwd))
  {
  if($o_pwd!=$old_pwd)
  {
  ?>
  <script language="javascript">
    alert('Old Password is wrong');
  </script>
<?php 
  }
  else
  {
    if(!empty($files[0]))
    {
      $sqlmd="select photo_path from user_mas  where uid=:hid_id ";
      $sthmd = $conn->prepare($sqlmd);
      $sthmd->bindParam(':hid_id', $hid_id);
      $sthmd->execute();
      $ssmd=$sthmd->setFetchMode(PDO::FETCH_ASSOC);
      $rowmd = $sthmd->fetch();
      $md_photo_path=$rowmd['photo_path'];
      unlink($md_photo_path);
    }   
      
    $sql =" update user_mas set user_nm=trim(:u_nm),dob=trim(:dob_date1),pwd=trim(:n_pwd)";
    if(!empty($files[0]))
    {
      $sql.=", photo_path =:files[0] ";
    }

    $sql.="where uid=:hid_id ";

    $sth = $conn->prepare($sql);
    $sth->bindParam(':u_nm', $u_nm);
    $sth->bindParam(':dob_date1', $dob_date1);
    $sth->bindParam(':n_pwd', $n_pwd);
    if(!empty($files[0]))
    {
    $sth->bindParam(':files', $files[0]);
    }
    $sth->bindParam(':hid_id', $hid_id);
    $sth->execute();
    
  ?>
  <script language="javascript">
    alert('Self Profile Modification Successfully');
  window.location.href='./my-account.php';  
  </script>
  <?php
  }
}
else
{
  
  
if(!empty($files[0]))
{
  $sqlmd="select photo_path from user_mas  where uid=:hid_id ";
  $sthmd = $conn->prepare($sqlmd);
  $sthmd->bindParam(':hid_id', $hid_id);
  $sthmd->execute();
  $ssmd=$sthmd->setFetchMode(PDO::FETCH_ASSOC);
  $rowmd = $sthmd->fetch();
  $md_photo_path=$rowmd['photo_path'];
  unlink($md_photo_path);
}   


  $sql =" update user_mas set user_nm=trim(:u_nm),dob=trim(:dob_date1)";
  if(!empty($files[0]))
  {
  $sql.=", photo_path =:files ";
  }
  $sql.="where uid=:hid_id ";

  $sth = $conn->prepare($sql);
  $sth->bindParam(':u_nm', $u_nm);
  $sth->bindParam(':dob_date1', $dob_date1);
  if(!empty($files[0]))
  {
  $sth->bindParam(':files', $files[0]);
  }
  $sth->bindParam(':hid_id', $hid_id);
  $sth->execute();
?>
<script language="javascript">
  alert('Self Profile Modification Successfully');
window.location.href='./my-account.php';  
</script>
<?php
}
//echo $sql;

}
}else{
  ?>
    <script language="javascript">
  alert('Please upload image smaller than 200KB');
  window.location.href='./my-account.php';  
  </script>
<?php
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
        <p class="block-heading">Self Profile Modification<div id="image">[Image Size 75px x 75px ]</div></p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      <?php
       $sqle=" select uid,user_nm,user_id,dob,pwd,user_type,user_status,current_status";
       $sqle.=",photo_path,page_per,cust_id ";
       $sqle.=" from user_mas  where uid=:ses_uid ";
    
       //echo $sqle;
       $sthe = $conn->prepare($sqle);
       $sthe->bindParam(':ses_uid', $ses_uid);
       $sthe->execute();
       $sse=$sthe->setFetchMode(PDO::FETCH_ASSOC);
       $rowe = $sthe->fetch();

       $e_uid=$rowe['uid'];
       $e_user_nm=$rowe['user_nm'];
       $e_user_id=$rowe['user_id'];
       $e_pwd=$rowe['pwd'];
       $e_user_status=$rowe['user_status'];
       $e_photo_path=$rowe['photo_path'];
       $e_dob=$rowe['dob'];
       $e_cust_id=$rowe['cust_id'];
       $e_dob1=ansi_to_british($e_dob);
           
       
    ?>
     <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $ses_uid; ?>" /> 
      <input type="hidden" id="old_pwd" name="old_pwd" value="<?php echo $e_pwd; ?>" /> 
      <tr >
      <td>User Name </td>
      <td><input type="text" id="u_nm" name="u_nm" value="<?php echo $e_user_nm; ?>" maxlength="25" /></td>
      <td>User Id </td>
      <td><input type="text" id="u_id" name="u_id" value="<?php echo $e_user_id; ?>" maxlength="10" readonly="readonly"/></td>
      </tr>
     
       <tr >
      <td>D.O.B</td>
      <td><input type="text" id="dob_date" name="dob_date" class="input-medium" value="<?php echo $e_dob1; ?>"/> &nbsp;<img src="./images/cal.gif" align="top"  onclick="displayCalendar(document.forms[1].dob_date,'dd/mm/yyyy',this)" style="height:22px; "/></td>
      <td >Photo </td>
      <td>
      <?php if(!empty($e_photo_path)){
      ?>
      <div id="photo"><img src="./<?php echo $e_photo_path; ?>" /></div>
      <?php
    }
    ?>
      <input type="file" name="image" accept="image/*" /></td>
      </tr>
     <tr>   
      <td width="15%">New Password </td>
      <td width="35%"><input type="password" id="n_pwd" name="n_pwd" value="" maxlength="14" /></td>
      
      <td width="10%">Old Password </td>
      <td width="12%"><input type="password" id="o_pwd" name="o_pwd" value="" maxlength="14" /></td>
      </tr>
      
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="cancel" id="cancel" class="btn btn-primary btn-small" value="Cancel" onclick="window.location='./user-master.php'"/>
  
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
