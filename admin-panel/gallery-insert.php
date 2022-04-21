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
$content2=$content;

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


  
  if(!empty($_FILES['image']))
  {

    $sql_ct="select count(photo_id) as ct from gallery_master ";
    $sql_ct.="where photo_nm=:p_nm ";
    $sth_ct = $conn->prepare($sql_ct);
    $sth_ct->bindParam(':p_nm', $p_nm);
    $sth_ct->execute();
    $ss_ct=$sth_ct->setFetchMode(PDO::FETCH_ASSOC);
    $row_ct = $sth_ct->fetch();
    $total=$row_ct['ct'];


    if($total<=0)
    {	
  
      $sql =" insert into gallery_master (photo_nm,cat_id";
      $sql.=",photo_content";
      $sql.=",small_path, big_path";
      $sql.=") ";
      $sql.=" values ";
      $sql.=" (trim(:p_nm),trim(:c_nm)";

      $sql.=" ,trim(:content2)";     
      $sql.=" , :files1,:files2";
      $sql.=") ";
      //echo $sql;
      $sth = $conn->prepare($sql);
      $sth->bindParam(':p_nm', $p_nm);
      $sth->bindParam(':c_nm', $c_nm);
      $sth->bindParam(':content2', $content2);
      $sth->bindParam(':files1', $resizedFilename);
      $sth->bindParam(':files2', $upload_file);
      $sth->execute();
  ?>
  <script language="javascript">
  	alert('Photo Add Successfully');
  window.location.href='./gallery-insert.php';	
  </script>
  <?php
}
 else
 {
	?>
 <script language="javascript">
	alert('other Photo Is Same Name');
window.location.href='./gallery-insert.php';	
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
        <p class="block-heading">Gallery Creation<div id="image">[Image Size <?php echo $c_b_width; ?> x <?php echo $c_b_height; ?> ]</div></p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">

      <tr >
      <td>Photo Title </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="" maxlength="25" /></td>
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
             <option value="<?php echo $sm_cat_id; ?>"><?php echo $sm_cat_nm; ?></option>
<?php 
	  }
  ?> 
   </select> 
    
       </td>
      </tr>
     
       <tr >
      <td colspan="4">
        <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"></textarea>
      </td>
      
      
      </tr>
      <tr>   
      <td >Photo Upload</td>
      <td > <input type="file" name="image" accept="image/*" />
      </td>
      
      <td></td>
      <td ></td>
      </tr>
      
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()" />
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
