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
		
$sqld1=" delete from link_master where link_id='$ck' ";
//echo $sqld1;
execDelete($sqld1);
	}
?>
<script language="javascript">
	alert('Multi Record Deleted Successfully');
	window.location.href='./video-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>


<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
	
$sqld1=" delete from link_master where link_id='$del_id' ";
//echo $sqld1;
execDelete($sqld1);
?>
<script language="javascript">
	alert('Record Deleted Successfully');
	window.location.href='./video-master.php';
</script>
<?php

}
/*-----------------------------------------------user delete end--------------------------------*/

?>

<script language="javascript">
function delete_rec(id)
{
//  alert(id);
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
   <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
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
<input type="submit" name="delete" id="delete" value="Delete"  class="btn btn-primary btn-small" /> 

<div class="row-fluid">
<div class="block span16">
        <p class="block-heading">Video Master </p>
        <div class="block-body">
      

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>Video Name</th>
                   <th>Link</th>
                  <th><a href="./video-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                   $sqle=" select link_id,link_title,link";
              	   $sqle.=" from link_master  ";
              	   if(!empty($name))
                   {
              	   $sqle.=" where link_title like '%:name%' ";
                	 }
                	 $sthe = $conn->prepare($sqle);
                   $sthe->bindParam(':hid_id', $hid_id);
                   $sthe->execute();
                   $sse=$sthe->setFetchMode(PDO::FETCH_ASSOC);
                   $rowe = $sthe->fetchAll();
                   foreach ($rowe as $keye => $valuee) 
                    {
                      $e_link_id=$valuee['link_id'];
                  		$e_link_title=$valuee['link_title'];
                      $e_link=$valuee['link'];
          		?>
           
                <tr>
                   <td><input type="checkbox" name="check[]" id="check" value="<?php echo $e_link_id; ?>"/></td>
                  <td><?php echo $e_link_title; ?></td>
                  <td><?php echo $e_link; ?></td>
                  <td><a href="video-edit.php?hr_id=<?php echo $e_link_id;?>"><img src="./images/edit.png" style="height:20px;" /></a></td>
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
