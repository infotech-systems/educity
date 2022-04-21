<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$p_nm = isset($_POST['p_nm']) ? $_POST['p_nm'] : '';
$v_date = isset($_POST['v_date']) ? $_POST['v_date'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$pic_file = isset($_POST['pic_file']) ? $_POST['pic_file'] : '';
if(!empty($v_date))
{
  $valid_date1=british_to_ansi($v_date);
}

  //echo $valid_date1;
$content2=$content;

?>

<?php

if($submit=="Submit")
{


$files=fileCkecking($_FILES['pic_file']['name']); 
//echo "$files";
if(!empty($files))
 {
   foreach ($files as $file_key => $file_value)
    {
          $upload_file ="$file_value";
     }
  }
  
$sql =" insert into news_mas (news,valid_upto,news_title ";
if(!empty($upload_file))
{
$sql.=" ,attach_file "; 
}
$sql.=" )values ";
$sql.=" (trim(:content2),trim(:valid_date1),trim(:p_nm) ";
if(!empty($upload_file))
{
$sql.=" ,:upload_file ";  
}
$sql.=" ) ";
echo $sql;
$sth = $conn->prepare($sql);
$sth->bindParam(':content2', $content2);
$sth->bindParam(':valid_date1', $valid_date1);
$sth->bindParam(':p_nm', $p_nm);
if(!empty($upload_file))
{
  $sth->bindParam(':upload_file', $upload_file);
}

$sth->execute();

//echo "mmmm: ".mysql_insert_id();
?>
<script language="javascript">
  alert('News Add Successfully');
window.location.href='./news-insert.php'; 
</script>
<?php
  

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
        <p class="block-heading">News Add</p>
        <div class="block-body">
           <div class="Generator" >
     
    
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
     
      <tr >
      <td>News Hedding </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="" maxlength="25" /></td>
      <td>Date</td>
      <td><input type="text" id="v_date" name="v_date" value="" class="input-small"/> &nbsp;<img src="./images/cal.gif" align="top"  onclick="displayCalendar(document.forms[1].v_date,'dd/mm/yyyy',this)" style="height:22px; "/>  </td>
      </tr>
     
       <tr >
      <td colspan="4">
       <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"></textarea></td>
      
      
      </tr>
       <tr>   
      <td width="15%">Attachment</td>
      <td width="35%"><input type="file" name="pic_file" id="pic_file" /></td>
      
      <td width="10%"></td>
      <td width="12%"></td>
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
