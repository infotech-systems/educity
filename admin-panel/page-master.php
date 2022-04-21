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
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$delete = isset($_POST['delete']) ? $_POST['delete'] : '';
$del_id = isset($_POST['del_id']) ? $_POST['del_id'] : '';
$del_data = isset($_POST['del_data']) ? $_POST['del_data'] : '';
$check = isset($_POST['check']) ? $_POST['check'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$sub = isset($_POST['sub']) ? $_POST['sub'] : '';

?>
<?php
/*-------------------------- user multi delete start-------------------------------------------*/
if($delete=="Delete")
{
  //echo $check;
  //print_r($check);
  foreach($check as $ck)
  {
    $sqlmd="select page_photo from page_master  where page_id=:ck ";

    $sth = $conn->prepare($sqlmd);
    $sth->bindParam(':ck', $ck);
    $sth->execute();
    $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sth->fetch();
    $md_page_photo=$rowmd['page_photo'];
    unlink($md_page_photo);       
      
    $sqld1=" delete from page_master where page_id=:ck ";
    //echo $sqld1;
    $sth1 = $conn->prepare($sqld1);
    $sth1->bindParam(':ck', $ck);
    $sth1->execute();
  }
?>
<script language="javascript">
  alert('Multi Page Deleted Successfully');
  window.location.href='./page-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>


<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
  
$sqld1=" delete from page_master where page_id=:del_id ";
//echo $sqld1;
 $sth1 = $conn->prepare($sqld1);
 $sth1->bindParam(':del_id', $del_id);
 $sth1->execute();
?>
<script language="javascript">
  alert('Page Deleted Successfully');
  window.location.href='./page-master.php';
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
//alert(unicode)
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
        <p class="block-heading">Page Master </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>Page Name</th>
                  <th>Parent Name</th>
                  <th>Page Srl</th>
                  <th>Page Status</th>
                  
                  <th><a href="./page-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
            <?php
             $sql=" select page_id,page_name,parent_id,page_content,srl,show_tag ";
             $sql.=" from page_master ";
             if(!empty($name))
             {
              $sql.=" where page_name like '%:name%' ";
             }
             $sql.="order by parent_id,srl ";
            // echo $sql;
               $sth = $conn->prepare($sql);
               $sth->bindParam(':name', $name);
               $sth->execute();
               $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
               $row = $sth->fetchAll();
               foreach ($row as $key => $value) 
               {
                $page_id=$value['page_id'];
                $page_name=$value['page_name'];
                $parent_id=$value['parent_id'];
                $page_content=$value['page_content'];
                $show_tag=$value['show_tag'];
                $srl=$value['srl'];
             ?>  
           
                <tr>
                <td><input type="checkbox" name="check[]" id="check" value="<?php echo $page_id; ?>"/></td>
                  <td><?php echo $page_name; ?></td>
                  <td><?php 
              if($parent_id>0)
                 {
            
          
                  $sqlc=" select page_name ";
                  $sqlc.=" from page_master ";
                  $sqlc.="where page_id=:parent_id ";
                //echo $sqlc;
                  $sthc = $conn->prepare($sqlc);
                  $sthc->bindParam(':parent_id', $parent_id);
                  $sthc->execute();
                  $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
                  $rowc = $sthc->fetch();
                  $c_page_name=$rowc['page_name'];

                  echo $c_page_name; 
             }
    ?>
        </td>
        <td><?php  echo $srl; ?></td>
                  
        <td>
          <?php
           if($show_tag=='T'){
            $show_tag='Published';
           }else{
             $show_tag='Not published'; 
           }
           
            echo $show_tag; ?>
              
        </td>
                
                  <td><a href="page-edit.php?hr_id=<?php echo $page_id; ?>"><img src="images/edit.png" style="height:20px;" /></a></td>
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
