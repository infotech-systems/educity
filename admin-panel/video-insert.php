<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');

?>
<?php
$submit=$_REQUEST['submit'];
$c_nm=$_REQUEST['c_nm'];
$link_nm=$_REQUEST['link_nm'];
$link_nm2=addslashes($link_nm);

?>


<?php
if($submit=="Submit")
{
  	
  $sql_ct="select count(link_id) as ct from link_master ";
  $sql_ct.="where link_title=:c_nm ";
  $sth_ct = $conn->prepare($sql);
  $sth->bindParam(':c_nm', $c_nm);
  $sth->execute();
  $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
  $row = $sth->fetchAll();
  $total=$row['ct'];

  if($total<=0)
  {	

  $sql =" insert into link_master (link_title,link) ";
  $sql.=" values ";
  $sql.=" (trim(:c_nm),trim(:link_nm2)) ";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':c_nm', $c_nm);
  $sth->bindParam(':link_nm2', $link_nm2);
  $sth->execute();
  ?>
  <script language="javascript">
  	alert('Video Link Creation Successfully');
  window.location.href='./video-insert.php';	
  </script>
  <?php

  /*----------------------Profile update end----------------------*/
  }
  else{
  	?>
   <script language="javascript">
  	alert('Video Link Allready Created');
  window.location.href='./video-insert.php';	
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
        <p class="block-heading">Video Creation</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      <tr >
      <td>Name </td>
      <td ><input type="text" id="c_nm" name="c_nm" value=""/></td>
       <td>Link</td>
      <td><input type="text" id="link_nm" name="link_nm" value=""  /></td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()"/>
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

if ($('#c_nm').val() == "") {
	$("#sub").text("Name cannot be Blank").show().fadeOut(1500);
	$('#c_nm').css("border-color","#FF0000");
	$('#c_nm').focus();
      return false;								   
}
if ($('#link_nm').val() == "") {
	$("#sub").text("Link cannot be Blank").show().fadeOut(1500);
	$('#link_nm').css("border-color","#FF0000");
	$('#link_nm').focus();
      return false;								   
}

	 
	 });
</script>

<?php
include('./footer.php');
?>
