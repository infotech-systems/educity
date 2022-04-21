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
$hr_id=$_REQUEST['hr_id'];
$hid_id=$_REQUEST['hid_id'];
$sm_nm=$_REQUEST['sm_nm'];
?>
<?php
if($submit=="Submit"){

	
	

$sqlU =" update menu_master set parent_id='$p_nm',murl=trim('$m_link'),srl=trim('$position')";
$sqlU.=",mbody=trim('$m_nm'),show_tag='$m_status',sub_id=trim('$sm_nm') ";
$sqlU.=" where ";
$sqlU.=" mid='$hid_id' ";
//echo $sqlU;
execUpdate($sqlU);
?>
<script language="javascript">
alert('Menu Modification Successfully');
	window.location.href='./menu-master.php';
</script>
<?php

}  

	?>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
       
        <div id="sub"><?php echo $sub; ?></div>
    </div>

    
</div>

<div class="row-fluid">
<div class="block span12">
        <p class="block-heading">Menu Modification</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0" >
      <input type="hidden" name="hid_id" id="hid_id" value="<?php echo $hr_id; ?>">
      <?php
     $sql_c=" select mid,mbody,parent_id,sub_id,murl,srl,show_tag ";
	 $sql_c.=" from menu_master where ";
	 $sql_c.=" mid='$hr_id'";
	//echo $sql_c;
	 $res_c=execSelect($sql_c);	
	while($row_c=getRows($res_c))
	  {
        $c_mid=$row_c['mid'];
		$c_sub_id=$row_c['sub_id'];
        $c_parent_id=$row_c['parent_id'];
		$c_mbody=$row_c['mbody'];
		$c_murl=$row_c['murl'];
		$c_srl=$row_c['srl'];
		$c_show_tag=$row_c['show_tag'];
	  }
		?>
      <tr >
      <td width="15%" >Menu Name </td>
      <td width="35%"><input type="text" id="m_nm" name="m_nm" value="<?php echo $c_mbody; ?>" maxlength="50" /></td>
      <td width="15%">Menu Link</td>
      <td ><input type="text" id="m_link" name="m_link" value="<?php echo $c_murl; ?>" maxlength="50"/></td>
      </tr>
     
       <tr >
      <td width="15%">Parent Name</td>
      <td > <select name="p_nm" id="p_nm" >
     <option value="">---- Select Parent Name -----</option>
      <?php
     $sql=" select mid,mbody ";
	 $sql.=" from menu_master where ";
	 $sql.=" parent_id=''";
	// echo $sql;
	 $res=execSelect($sql);	
	while($row=getRows($res))
	  {
        $s_mid=$row['mid'];
        $s_mbody=$row['mbody'];
		?>
             <option value="<?php echo $s_mid; ?>" <?php if($s_mid=="$c_parent_id") echo "SELECTED";?>><?php echo $s_mbody; ?></option>
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
	 $sql_s.=" parent_id >'0'";
	 //echo $sql_s;
	 $res_s=execSelect($sql_s);	
	while($row_s=getRows($res_s))
	  {
        $sm_mid=$row_s['mid'];
        $sm_mbody=$row_s['mbody'];
		?>
             <option value="<?php echo $sm_mid; ?>"<?php if($sm_mid=="$c_sub_id") echo "SELECTED";?>><?php echo $sm_mbody; ?></option>
<?php 
	  }
  ?> 
   </select> </td>
   </tr>
      <tr>
      <td width="15%">Position </td>
      <td width="35%"><input type="text" id="position" name="position" value="<?php echo $c_srl;  ?>"/></td>
      
      <td width="15%">Status</td>
      <td width="35%">
      <select name="m_status" id="m_status" >
    <option value="T" <?php if($c_show_tag=="T") echo "SELECTED";?>>   Published    </option>
    <option value="F" <?php if($c_show_tag=="F") echo "SELECTED";?>>   Not Published    </option>
    </select>
    </td>
    <td width="15%"></td>
      <td width="35%">
     
    </td>
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh" class="btn btn-primary btn-small" value="Cancel"  onClick="window.location.href='./menu-master.php';"/>
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
