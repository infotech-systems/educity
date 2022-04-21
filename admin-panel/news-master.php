<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
$submit=$_REQUEST['submit'];
$check=$_REQUEST['check'];
$del_id=$_REQUEST['del_id'];
$del_data=$_REQUEST['del_data'];
$delete_rec=$_REQUEST['delete_rec'];
$delete=$_REQUEST['delete'];
?>
<?php
/*-------------------------- user multi delete start-------------------------------------------*/
if($delete=="Delete")
{
  foreach($check as $ck)
  {
    
  $sqld1=" delete from news_mas where news_id=:ck ";
    $sth = $conn->prepare($sqld1);
    $sth->bindParam(':ck', $ck);
    $sth->execute();


  }
?>
<script language="javascript">
  alert('Multi Record Deleted Successfully');
  window.location.href='./news-master.php';
</script>
<?php
}
/*-----------------------------------------------user multi delete end--------------------------------*/
?>


<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
  
  $sqld1=" delete from news_mas where news_id=:del_id ";
  $sth = $conn->prepare($sqld1);
  $sth->bindParam(':del_id', $del_id);
  $sth->execute();

  ?>
  <script language="javascript">
    alert('Data Deleted Successfully');
    window.location.href='./news_list.php';
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
            <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
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
        <p class="block-heading">News Master </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
      <table  border="0"  cellpadding="0" cellspacing="0" class="table" id="tab1">
      <thead>
      <tr >
    
      
      <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
      <th>News Hedding</th>
      <th>News Body</th>
      <th>Valid Upto</th>
       <th><a href="./news-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
      </tr>
   </thead>
     <tbody>
 <?php
   $sql=" select * ";
   $sql.=" from news_mas ";
  // echo $sql;
    $sth = $conn->prepare($sql);
    $sth->execute();
    $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sth->fetchAll();
    foreach ($row as $key => $value) 
    {

        $news_id=$value['news_id'];
        $news=$value['news'];
        $news_title=$value['news_title'];
        $valid_upto=$value['valid_upto'];
        
    
  $valid_upto1=ansi_to_british($valid_upto); 
  
  
   ?>  
     
      <tr >
      <td><input type="checkbox" name="check[]" id="check" value="<?php echo $news_id; ?>"/></td>
      <td ><?php echo $news_title; ?> </td>
      <td width="500px" ><?php echo $news; ?> </td>
      <td ><?php echo $valid_upto1; ?> </td>
      <td ><a href="news-edit.php?hr_id=<?php echo $news_id;?>"><img src="images/edit.png" style="height:20px;" /></a></td>
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
  <!--    
     
     </div>
</div>
-->
<?php
include('./footer.php');
?>
