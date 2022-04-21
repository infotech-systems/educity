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
$delete=$_REQUEST['delete'];
$del_id=$_REQUEST['del_id'];
$del_data=$_REQUEST['del_data'];
$check=$_REQUEST['check'];
$name=$_REQUEST['name'];

?>
<?php
/*-------------------------- user multi delete start-------------------------------------------*/
if($delete=="Delete")
{
	//echo $check;
	//print_r($check);
	foreach($check as $ck)
	{
		
    $sqld1=" delete from cat_master where cat_id=:ck ";
  //echo $sqld1;
    $sth = $conn->prepare($sqld1);
    $sth->bindParam(':ck', $ck);
    $sth->execute();
	}
?>
<script language="javascript">
	alert('Multi Record(s) Deleted Successfully');
	window.location.href='./category-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>


<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
	
  $sqld1=" delete from cat_master where cat_id=:del_id ";
  //echo $sqld1;
  $sth = $conn->prepare($sqld1);
  $sth->bindParam(':del_id', $del_id);
  $sth->execute();
  ?>
  <script language="javascript">
  	alert('One Record Deleted Successfully');
  	window.location.href='./category-master.php';
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

    
</div>         <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
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
        <p class="block-heading">Category Master </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>Category Name</th>
                  
                  <th><a href="./category-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
              <?php

               $sqle=" select * ";
          	   $sqle.=" from cat_master";
            	 if(!empty($name))
               {
            	 $sqle.=" where cat_nm like '%:name%' ";
            	 }
          	    $sthe = $conn->prepare($sqle);
                $sthe->bindParam(':hid_id', $hid_id);
                $sthe->execute();
                $sse=$sthe->setFetchMode(PDO::FETCH_ASSOC);
                $rowe = $sthe->fetchAll();
                foreach ($rowe as $keye => $valuee) 
                {
                  $e_photo_id=$valuee['cat_id'];
          		    $e_photo_nm=$valuee['cat_nm'];
          	
          		?>
                <tr>
                   <td><input type="checkbox" name="check[]" id="check" value="<?php echo $e_photo_id; ?>"/></td>
                   <td><?php echo $e_photo_nm; ?></td>
                 
                  <td><a href="./category-edit.php?hr_id=<?php echo $e_photo_id;?>"><img src="./images/edit.png" style="height:20px;" /></a></td>
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
