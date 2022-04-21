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
$del_id=$_REQUEST['del_id'];
$del_data=$_REQUEST['del_data'];
$check=$_REQUEST['check'];
$name=$_REQUEST['name'];
$delete=$_REQUEST['delete'];
?>
<?php
/*-------------------------- user multi delete start-------------------------------------------*/
if($delete=="Delete")
{
	//echo $check;
	//print_r($check);
	foreach($check as $ck)
	{
		$sqlmd="select photo_path from user_mas  where uid='$ck' ";
$resultmd=execSelect($sqlmd);
//echo $sql_ct;
while ($rowmd=getRows($resultmd))
{
$md_photo_path=$rowmd['photo_path'];
}
unlink($md_photo_path);
$sqld1=" delete from user_mas where uid='$ck' ";
//echo $sqld1;
execDelete($sqld1);
	}
?>
<script language="javascript">
	alert('Multi User Deleted Successfully');
	window.location.href='./user-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>


<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
	$sqlmd="select photo_path from user_mas  where uid='$del_id' ";
$resultmd=execSelect($sqlmd);
//echo $sql_ct;
while ($rowmd=getRows($resultmd))
{
$md_photo_path=$rowmd['photo_path'];
}
unlink($md_photo_path);
$sqld1=" delete from user_mas where uid='$del_id' ";
//echo $sqld1;
execDelete($sqld1);
?>
<script language="javascript">
	alert('User Deleted Successfully');
	window.location.href='./user-master.php';
</script>
<?php

}
/*-----------------------------------------------user delete end--------------------------------*/

?>

<script language="javascript">
function delete_rec(id)
{
 // alert(id);
  var answer = confirm("Are You Want To Delete?");
	if (answer){
        document.form1.del_data.value="delete";
        document.form1.del_id.value=id;
        document.form1.submit();

	}
}
</script>
<script type="text/javascript">
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
alert(unicode)
}
</script>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
       <div id="sub"><?php echo $sub; ?></div>
    </div>

    
</div>
         <form name="form" method="post" enctype="multipart/form-data" onSubmit="return validate()">
<div class="row-fluid">
<div class="block span12">
      <a href="#page-stats1" class="block-heading" data-toggle="collapse">Search</a>
        <div id="page-stats1" class="block-body collapse out">
           <div class="Generator" >
      <table  border="0"  cellpadding="0" cellspacing="0">
      <tr >
      <td >Name</td>
      <td> 
      <input type="text" name="name" id="name" value="<?php echo $name; ?>"/>
     </td>
      <td></td>
      <td></td>
      </tr>
      <tr >
      <td  colspan="4">
<div id="button_pos">
      <input type="submit"  class="btn btn-primary btn-small" name="submit" id="submit" value="Search" />&nbsp; <input type="button" name="refresh" id="refresh"  class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()"/>
      </div>  
      </td>
      </tr>    
      </table>
      </div>
        </div>
    </div>
</div>
</form>
         <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">

<input type="submit" name="delete" id="delete" value="Delete"  class="btn btn-primary btn-small" /> 

<div class="row-fluid">
<div class="block span16">
        <p class="block-heading">User Master </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>User Name</th>
                  <th>User ID</th>
                  <th>User Type</th>
                  <th>User Status</th>
                  <th>Current Status</th>
                  <th>User Photo</th>
                  <th>Page Permission</th>
                  <th><a href="./user-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
                       <?php
     $sqle=" select uid,user_nm,user_id,pwd,user_type,user_status,current_status";
	 $sqle.=",photo_path,page_per ";
	 $sqle.=" from user_mas  ";
	  $sqle.=" where user_type!='A' ";
	if(!empty($name)){
	  $sqle.=" and user_nm like '%$name%' ";
	 }
	 //echo $sqle;
	 $rese=execSelect($sqle);	
	while($rowe=getRows($rese))
	  {
        $e_uid=$rowe['uid'];
		$e_user_nm=$rowe['user_nm'];
        $e_user_id=$rowe['user_id'];
		$e_user_type=$rowe['user_type'];
		$e_user_status=$rowe['user_status'];
		$e_current_status=$rowe['current_status'];
		$e_photo_path=$rowe['photo_path'];
		if($e_show_tag=="T"){
			$show="Published";
		}
		else{
			$show="Not Published";
		}
		?>
           
                <tr>
                <td><input type="checkbox" name="check[]" id="check" value="<?php echo $e_uid; ?>"/></td>
                  <td><?php echo $e_user_nm; ?></td>
                  <td><?php	  echo $e_user_id;	?></td>
                   <td><?php
				   if($e_user_type=='A'){
					  $e_user_type='Admin';
				   }else{
					   $e_user_type='General'; 
				   }
				   
				    echo $e_user_type; ?></td>
                  <td><?php 
				  if($e_user_status=='A'){
					  $e_user_status='Active';
				   }else{
					   $e_user_status='De-active'; 
				   }
				  echo $e_user_status; ?></td>
                  <td><?php 
				  if($e_current_status=='A'){
					  $e_current_status='Working';
				   }else{
					   $e_current_status='Not Working'; 
				   }echo $e_current_status; ?></td>
                  <td>
                  <?php 
				  if(!empty($e_photo_path)){
					  ?>
                  <img src="./<?php echo $e_photo_path; ?>" style="height:20px;">
				  <?php
				  }
				  ?></td>
                    <td><a href="user-page-permission.php?hr_id=<?php echo $e_uid; ?>"><img src="./images/permission_icon.ico" style="height:20px;" /></a></td>
                  <td><a href="user-edit.php?hr_id=<?php echo $e_uid;?>"><img src="./images/edit.png" style="height:20px;" /></a>&nbsp;&nbsp;<a href="#"onClick="delete_rec(<?php echo $e_uid;?>);"><img src="images/delete.png" /></a></td>
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

<?php
include('./footer.php');
?>
