<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>

<?php
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$p_nm = isset($_POST['p_nm']) ? $_POST['p_nm'] : '';
$page_url = isset($_POST['page_url']) ? $_POST['page_url'] : '';
$page_srl = isset($_POST['page_srl']) ? $_POST['page_srl'] : '';
$show = isset($_POST['show']) ? $_POST['show'] : '';

?>




<?php
if($submit=="Submit"){
	
$sql_ct="select count(quick_id) as ct from quick_link_master ";
$sql_ct.="where quick_name=:p_nm ";
$sth_ct = $conn->prepare($sql_ct);
$sth_ct->bindParam(':p_nm', $p_nm);
$sth_ct->execute();
$ss_ct=$sth_ct->setFetchMode(PDO::FETCH_ASSOC);
$row_ct = $sth_ct->fetch();
$total=$row_ct['ct'];

if($total<=0)
{	
/*------------------ file upload process-----------------------*/


$sql =" insert into quick_link_master (quick_name,quick_link,srl,show_tag) ";
$sql.=" values ";
$sql.=" (trim(:p_nm),trim(:page_url),trim(:page_srl),trim(:show)) ";
//echo $sql;
$sth = $conn->prepare($sql);
$sth->bindParam(':p_nm', $p_nm);
$sth->bindParam(':page_url', $page_url);
$sth->bindParam(':page_srl', $page_srl);
$sth->bindParam(':show', $show);
$sth->execute();
?>
<script language="javascript">
	alert('Quick Link Creation Successfully');
window.location.href='./quick-insert.php';	
</script>
<?php

/*----------------------Profile update end----------------------*/
}
else{
	?>
 <script language="javascript">
	alert('Quick Link Allready Created');
window.location.href='./quick-insert.php';	
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
        <p class="block-heading">Quick Link Creation</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <tr >
      <td>Quick Link Name </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="" maxlength="50" /></td>
     
      <td width="15%">Quick Link url </td>
      <td width="35%"><input type="text" id="page_url" name="page_url" value=""  size="100%" maxlength="95"/></td>
      </tr>
      <tr>
      <td width="15%">Quick Link Srl</td>
      <td width="35%"> 
      <input type="text" id="page_srl" name="page_srl" value=""   maxlength="5"/>
      </td>
      
      <td width="15%">Quick Link Publish</td>
      <td width="35%"> 
      <select name="show" id="show">
       <option value="T">Published </option>
        <option value=""> Not Published</option>
       </select>
      </td>
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
	$("#sub").text("Name cannot be Blank").show().fadeOut(1500);
	$('#p_nm').css("border-color","#FF0000");
	$('#p_nm').focus();
      return false;								   
}
if ($('#page_srl').val() == "") {
	$("#sub").text("Type Page Position").show().fadeOut(1500);
	$('#page_srl').css("border-color","#FF0000");
	$('#page_srl').focus();
      return false;								   
}

	 
	 });
</script>

<?php
include('./footer.php');
?>
