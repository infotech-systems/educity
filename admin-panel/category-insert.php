<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
$submit=$_REQUEST['submit'];
$p_nm=$_REQUEST['p_nm'];
$c_nm=$_REQUEST['c_nm'];
$content=$_REQUEST['content'];
$pic_file=$_REQUEST['pic_file'];
$content2=addslashes($content);
$submit=$_REQUEST['submit'];
$p_nm=$_REQUEST['p_nm'];
$c_nm=$_REQUEST['c_nm'];
$content=$_REQUEST['content'];
$image=$_REQUEST['image'];
$hr_id=$_REQUEST['hr_id'];
$hid_id=$_REQUEST['hid_id'];
$conten_s=$_REQUEST['conten_s'];
$content2=$content;
$conten_s2=$conten_s;

$sql_b="select * from image_master ";
$sth_b = $conn->prepare($sql_b);
$sth_b->execute();
$ss=$sth_b->setFetchMode(PDO::FETCH_ASSOC);
$row_b = $sth_b->fetch();

$c_u_width=$row_b['u_width'];
$c_u_height=$row_b['u_height'];
$c_s_width=$row_b['s_width'];
$c_s_height=$row_b['s_height'];
$c_b_width=$row_b['b_width'];
$c_b_height=$row_b['b_height'];
$c_sl_width=$row_b['sl_width'];
$c_sl_height=$row_b['sl_height'];
?>

<?php
if($submit=="Submit")
{
  	
  $sql_ct="select count(cat_id) as ct from cat_master ";
  $sql_ct.="where cat_nm=:p_nm   ";
  $sth_ct = $conn->prepare($sql_ct);
  $sth_ct->bindParam(':p_nm', $p_nm);
  $sth_ct->execute();
  $ss_ct=$sth_ct->setFetchMode(PDO::FETCH_ASSOC);
  $row_ct = $sth_ct->fetch();
  $total=$row_ct['ct'];

  if($total<=0)
  {	
  	$max_file_size = 1024*1024; // 200kb
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif');

  	 
  $sizes = array( $c_s_width => $c_s_height, $c_b_width => $c_b_height);
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) 
  {
    if( $_FILES['image']['size'] < $max_file_size )
    {
      // get file extension
      $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
      if (in_array($ext, $valid_exts)) 
      {
        /* resize image */
       foreach ($sizes as $w => $h) 
       {
          $files[] = resize($w, $h);
  	   }	
  	}

  $sql =" insert into cat_master (cat_nm";
  if(!empty($content2))
  $sql.=",cat_cont";
  if(!empty($files[0]))
  $sql.=",cat_path,cat_big_path";
  $sql.=") ";
  $sql.=" values ";
  $sql.=" (trim(:p_nm)";
  if(!empty($content2))
  $sql.=",trim(:content2)";
  if(!empty($files[0]))
  $sql.=",trim(:files1),trim(:files2)";
  $sql.=")";
  //echo $sql;
  $sthu = $conn->prepare($sql);
  $sthu->bindParam(':p_nm', $p_nm);
  if(!empty($content2))
  $sthu->bindParam(':content2', $content2);
  if(!empty($files[0]))
  {
  $sthu->bindParam(':files1', $files[0]);
  $sthu->bindParam(':files2', $files[1]);
  }
  $sthu->execute();
  ?>
  <script language="javascript">
  	alert('Category Creation Successfully');
  window.location.href='./category-insert.php';	
  </script>
  <?php

  /*----------------------Profile update end----------------------*/
  }
  }else{
  	?>
      <script language="javascript">
  	alert('Please upload image smaller than 500KB');
  	</script>
  <?php
  	
  }
  }
  else{
  	?>
   <script language="javascript">
  	alert('Category Allready Created');
  window.location.href='./category-insert.php';	
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
    <p class="block-heading">Category Creation<div id="image">[Image Size <?php echo $c_b_width; ?> x <?php echo $c_b_height; ?> ]</div></p>
        <div class="block-body">
        <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
     <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $hr_id; ?>" /> 
      <table  border="0"  cellpadding="0" cellspacing="0">
      <tr >
      <td>Category Name </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="" /></td>
      <td></td>
      <td> 
    
       </td>
      </tr>
      <tr >
      <td colspan="4">    
        <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"></textarea>
     </td>
      </tr>
       <tr>   
      <td width="15%">Photo Upload</td>
      <td width="35%">
      <input type="file" name="image" accept="image/*" /></td>
      
      <td width="10%"></td>
      <td width="12%"></td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Cancel"  onClick="window.location.href='./category-master.php';" />
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

if ($('#p_nm').val() == "") {
	$("#sub").text("Photo Name cannot be Blank").show().fadeOut(1500);
	$('#p_nm').css("border-color","#FF0000");
	$('#p_nm').focus();
      return false;								   
}
	 
	 });
</script>

<?php
include('./footer.php');
?>
