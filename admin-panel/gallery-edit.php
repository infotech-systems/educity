<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$p_nm = isset($_POST['p_nm']) ? $_POST['p_nm'] : '';
$c_nm = isset($_POST['c_nm']) ? $_POST['c_nm'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$hid_id = isset($_POST['hid_id']) ? $_POST['hid_id'] : '';
$content2=$content;


$hr_id=$_REQUEST['hr_id'];

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
	

$max_file_size = 1024*1024; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

	
$sizes = array( $c_s_width =>$c_s_height, $c_b_width => $c_b_height);
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
if( $_FILES['image']['size'] < $max_file_size ){
			 	
$sql_ct="select count(photo_id) as ct from gallery_master ";
$sql_ct.="where photo_nm=:p_nm and cat_id=:c_nm and photo_id!=:hid_id ";
$sth_ct = $conn->prepare($sql_ct);
$sth_ct->bindParam(':p_nm', $p_nm);
$sth_ct->bindParam(':c_nm', $c_nm);
$sth_ct->bindParam(':hid_id', $hid_id);
$sth_ct->execute();
$ss_ct=$sth_ct->setFetchMode(PDO::FETCH_ASSOC);
$row_ct = $sth_ct->fetch();
$total=$row_ct['ct'];
if($total<=0)
{	
/*------------------ file upload process-----------------------*/
  $upload_file='';
   if(!file_exists('uploads')) { mkdir("uploads", 777); }  
  //echo "xxx $photo".$_FILES['photo']['name']; 
  $files=fileCkecking3($_FILES['image']); 
  //print_r($files);
  if(!empty($files))
  {
  foreach ($files as $file_key => $file_value)
          {
          $upload_file ="./uploads/fullsize/$file_value";
          }
  }
  if(!empty($_FILES['image']))
  {
  //echo "xxxxxxxxxxxxxxxxx";

  $imgData =resize_image($upload_file, $c_s_width, $c_s_height);
  $resizedFilename = "./uploads/$file_value";
  // save the image on the given filename
  imagepng($imgData, $resizedFilename);
  
  }
		if(!empty($upload_file))
    {
      $sqlmd="select small_path,big_path from gallery_master  where photo_id=:hid_id ";
      $sth = $conn->prepare($sqlmd);
      $sth->bindParam(':hid_id', $hid_id);
      $sth->execute();
      $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
      $rowmd = $sth->fetch();
      $md_small_path=$rowmd['small_path'];
      $md_big_path=$rowmd['big_path'];
      unlink($md_small_path);
      unlink($md_big_path);

	}	

    $sqlu =" update gallery_master set photo_nm=trim(:p_nm),cat_id=trim(:c_nm),photo_content=trim(:content2)";
    if(!empty($upload_file))
    {
    $sqlu.=", small_path =:files1, big_path =:files2 ";
    }
    $sqlu.=" where photo_id=:hid_id ";
    $sthu = $conn->prepare($sqlu);
    $sthu->bindParam(':p_nm', $p_nm);
    $sthu->bindParam(':c_nm', $c_nm);
    $sthu->bindParam(':content2', $content2);
	if(!empty($upload_file))
    {
    $sthu->bindParam(':files1', $resizedFilename);
    $sthu->bindParam(':files2', $upload_file);
	}
    $sthu->bindParam(':hid_id', $hid_id);
    $sthu->execute();
	
?>
<script language="javascript">
	alert('Photo Modification Successfully');
window.location.href='./gallery-master.php';	
</script>
<?php
}
 else{
	?>
 <script language="javascript">
	alert('other Photo Is Same Name');
window.location.href='./gallery-master.php';	
</script>
<?php
	}
	
  
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
        <p class="block-heading">Gallery Modification<div id="image">[Image Size <?php echo $c_b_width; ?> x <?php echo $c_b_height; ?> ]</div></p>
        <div class="block-body">
        <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
     <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $hr_id; ?>" /> 
      <table  border="0"  cellpadding="0" cellspacing="0">
      <?php    
        $sql_k="select * from gallery_master where photo_id=:hr_id ";
    	  $sth_k = $conn->prepare($sql_k);
        $sth_k->bindParam(':hr_id', $hr_id);
        $sth_k->execute();
        $ss_k=$sth_k->setFetchMode(PDO::FETCH_ASSOC);
        $row_k = $sth_k->fetch();
        $k_photo_nm=$row_k['photo_nm'];
        $k_cat_id=$row_k['cat_id'];
    	  $k_small_path=$row_k['small_path'];
        $k_photo_content=$row_k['photo_content'];
    	 
	  ?>
      <tr >
      <td>Photo Name </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="<?php echo $k_photo_nm; ?>" maxlength="25" /></td>
     <td>Category Name </td>
      <td> <select name="c_nm" id="c_nm" >
       <option value=""> ----Select Category Name----- </option>
       <?php
        $sql_s=" select cat_id,cat_nm ";
    	  $sql_s.=" from cat_master ";
    	  $sth_s = $conn->prepare($sql_s);
        $sth_s->execute();
        $ss_s=$sth_s->setFetchMode(PDO::FETCH_ASSOC);
        $row_s = $sth_s->fetchAll();
        foreach ($row_s as $key_s => $value_s) 
        {
            $sm_cat_id=$value_s['cat_id'];
            $sm_cat_nm=$value_s['cat_nm'];
		?>
             <option value="<?php echo $sm_cat_id; ?>" <?php if($sm_cat_id=="$k_cat_id") echo "SELECTED";?>><?php echo $sm_cat_nm; ?></option>
<?php 
	  }
  ?> 
   </select> 
    
       </td>
      </tr>
     
       <tr >
      <td colspan="4">
       <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"><?php echo $k_photo_content; ?></textarea></td>
      
      
      </tr>
      <tr>   
      <td >Photo Upload</td>
      <td ><div id="photo"><img src="./<?php echo $k_small_path; ?>" /></div>
        <input type="file" name="image" accept="image/*" />
      
      <td ></td>
      <td></td>
      </tr>
      
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Cancel"  onClick="window.location.href='./gallery-master.php';" />
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
