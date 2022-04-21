<?php
include('./header.php');
?>
<?php
include('./side-bar.php');
?>
<?php
include('./header-bottom.php');
?>
<?php
$submit=$_REQUEST['submit'];
$m_nm=$_REQUEST['m_nm'];
$m_link=$_REQUEST['m_link'];
$p_nm=$_REQUEST['p_nm'];
$position=$_REQUEST['position'];
$m_status=$_REQUEST['m_status'];
$sm_nm=$_REQUEST['sm_nm'];
?>
<?php
if($submit=="Submit"){
if(!empty($m_link)){	
$sql_ct="select count(mid) as ct from menu_master ";
$sql_ct.="where murl='$m_link' ";
$result=execSelect($sql_ct);
//echo $sql_ct;
while ($row=getRows($result))
{
$total=$row['ct'];
}
}
if($total<=0)
{	
	

$sql =" insert into menu_master (parent_id,murl,srl,mbody,sub_id,show_tag) ";
$sql.=" values ";
$sql.=" (trim('$p_nm'),trim('$m_link'),trim('$position'),trim('$m_nm'),trim('$sm_nm'),trim('$m_status')) ";
//echo $sql;
execInsert($sql);
?>
<script language="javascript">
	alert('Menu Creation Successfully');
window.location.href='./menu-insert.php';	
</script>
<?php
}
else{

?>
<script language="javascript">
	alert('Allready Menu Page Creation');
window.location.href='./menu-insert.php';	
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
        <p class="block-heading">Menu Creation</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0" >
      
      <tr >
      <td width="15%" >Menu Name </td>
      <td width="35%"><input type="text" id="m_nm" name="m_nm" value="" maxlength="50" /></td>
      <td width="15%">Menu Link</td>
      <td ><input type="text" id="m_link" name="m_link" value="" maxlength="50"/></td>
      </tr>
     
       <tr >
      <td width="15%">Parent Name</td>
      <td > <select name="p_nm" id="p_nm" >
     <option value="">---- Select Parent Name -----</option>
      <?php
     $sql=" select mid,mbody ";
	 $sql.=" from menu_master where ";
	 $sql.=" parent_id=''";
	 //echo $sql;
	 $res=execSelect($sql);	
	while($row=getRows($res))
	  {
        $s_mid=$row['mid'];
        $s_mbody=$row['mbody'];
		?>
             <option value="<?php echo $s_mid; ?>"><?php echo $s_mbody; ?></option>
<?php 
	  }
  ?> 
   </select> </td>
   <td width="15%">Sub Menu </td>
      <td > <select name="sm_nm" id="sm_nm" >
     <option value="">---- Select Sub-Menu -----</option>
      <?php
     $sql_s=" select mid,mbody ";
	 $sql_s.=" from menu_master where ";
	 $sql_s.=" parent_id >'0' and sub_id=''";
	 //echo $sql_s;
	 $res_s=execSelect($sql_s);	
	while($row_s=getRows($res_s))
	  {
        $sm_mid=$row_s['mid'];
        $sm_mbody=$row_s['mbody'];
		?>
             <option value="<?php echo $sm_mid; ?>"><?php echo $sm_mbody; ?></option>
<?php 
	  }
  ?> 
   </select> </td>
   </tr>
   <tr>
      <td width="15%">Position </td>
      <td width="35%"><input type="text" id="position" name="position" value=""/></td>
     
      <td width="15%">Status</td>
      <td width="35%">
      <select name="m_status" id="m_status" >
    <option value="T">   Published    </option>
    <option value="F">   Not Published    </option>
    </select>
    </td>
    <td width="15%"></td>
      <td width="35%">
     
    </td>
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
