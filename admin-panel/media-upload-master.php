<?php
include('./header.php');
?>
<?php
$submit=$_REQUEST['submit'];
$pic_file=$_REQUEST['pic_file'];
$delete=$_REQUEST['delete'];
$check=$_REQUEST['check'];

?>

<?php
if($delete=="Delete")
{
  echo $check;
  //print_r($check);
  foreach($check as $ck)
  {
    $sqlmd="select path from media_upload_master where med_id=:ck ";
    $sthm = $conn->prepare($sqlmd);
    $sthm->bindParam(':ck', $ck);
    $sthm->execute();
    $ssm=$sthm->setFetchMode(PDO::FETCH_ASSOC);
    $rowm = $sthm->fetch();
    $md_path=$rowm['path'];
    
    unlink('uploads/'.$md_path);        
    $sqld1=" delete from media_upload_master where med_id=:ck ";
    //echo $sqld1;
    $sthd = $conn->prepare($sqld1);
    $sthd->bindParam(':ck', $ck);
    $sthd->execute();
  }
?>
<script language="javascript">
  alert('Record(s) Deleted Successfully');
  window.location.href='./media-upload-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>

<?php
if($submit=="Submit")
{

//if(!file_exists('uploads')) { mkdir("uploads", 777); }   
  $files=fileCkecking2($FILES); 
//echo "$files";
  if(!empty($files))
    {
    foreach ($files as $file_key => $file_value)
            {
            $upload_file ="$file_value";
            }
    }
      
$sql =" insert into media_upload_master (path) ";
$sql.=" values ";
$sql.=" (:upload_file) ";
//echo $sql;
$sth = $conn->prepare($sql);
$sth->bindParam(':upload_file', $upload_file);
$sth->execute();

?>
<script language="javascript">
  alert('Media Creation Successfully');
window.location.href='./media-upload-master.php'; 
</script>
<?php

/*----------------------Profile update end----------------------*/
}
  ?> 


        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
       
        <div id="sub"></div>
    </div>

    
</div>
 <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
<div class="row-fluid">
<div class="block span12">
        <p class="block-heading">Media Upload</p>
        <div class="block-body">
           <div class="Generator" >
    
      <table  border="0"  cellpadding="0" cellspacing="0">
      <tr>   
      <td width="15%">Media Upload</td>
      <td width="35%"> <input type="file" name="pic_file" id="pic_file" /></td>
      
      <td width="10%"></td>
      <td width="12%"></td>
      </tr>
      
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()" />
      </div>
      </td>
      </tr>
      </table>
     
      </div>
        </div>
    </div>
    
    
</div>
<div class="row-fluid">
<div class="block span16">
        <p class="block-heading">Media List <div id="image"><input type="submit" name="delete" id="delete" value="Delete"  class="btn btn-primary btn-small" /> </div> </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="Generator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th width="30px">Sl.</th>
                  <th>File Type</th>
                  <th>Path</th>
                </tr>
              </thead>
              <tbody>
              <?php
                 $sqle=" select med_id,path";
                 $sqle.=" from media_upload_master";
               //echo $sqle;
                 $sl='0';
                 $sthe = $conn->prepare($sqle);
                 $sthe->execute();
                 $sse=$sthe->setFetchMode(PDO::FETCH_ASSOC);
                 $rowe = $sthe->fetchAll();
                foreach ($rowe as $keye => $valuee) 
                {
                    $e_med_id=$valuee['med_id'];
                    $e_path=$valuee['path'];
                
                $sl++
                ?>
              <tr>
              <td> <input type="checkbox" name="check[]" id="check" value="<?php echo $e_med_id; ?>"/></td>
              <td><?php echo $sl; ?></td>
              <td>
          <?php 
              $file_parts = pathinfo($e_path);
              $file_parts['extension'];
              $cool_extensions = Array('jpg','png','jpeg','gif');
              if (in_array($file_parts['extension'], $cool_extensions))
              {
          ?>
          <img src="./uploads/<?php echo $e_path; ?>"  style="height:40px;"/>
          <?php
               }
      ?>
          <?php
       $cool_extensions = Array('pdf');
           if (in_array($file_parts['extension'], $cool_extensions)){
          ?>
          <img src="./images/pdf.png"  style="height:40px;"/>
          <?php
      }
      ?>
          <?php
       $cool_extensions = Array('doc','docx');
           if (in_array($file_parts['extension'], $cool_extensions))
           {
          ?>
          <img src="./images/doc.png"  style="height:40px;"/>
          <?php
          }
      ?>
          <?php
       $cool_extensions = Array('xls','xlsx');
           if (in_array($file_parts['extension'], $cool_extensions)){
          ?>
          <img src="./images/xls.png"  style="height:40px;"/>
          <?php
      }
      ?>
           <?php
       $cool_extensions = Array('zip','rar');
           if (in_array($file_parts['extension'], $cool_extensions)){
          ?>
          <img src="./images/zip.jpg"  style="height:40px; margin-left:-15px;"/>
          <?php
      }
      ?>
          </td>
          <td>
          <input type="text" name="path_img" id="path_img" value="./admin-panel/uploads/<?php echo $e_path; ?>" style="width:700px;"/>
            </p>
          </td>    
     
          </tr>         
         <?php
    }
    ?>
     
             
              </tbody>
            </table>
            </div>
  
        </div>
   
    </div>
    
    
</div>
 </form>
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
