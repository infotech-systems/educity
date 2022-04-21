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
    
    $sqld1=" delete from quick_link_master where quick_id=:ck ";
    //echo $sqld1;
    $sth1 = $conn->prepare($sqld1);
    $sth1->bindParam(':ck', $ck);
    $sth1->execute();
  }
?>
<script language="javascript">
  alert('Multi Record Deleted Successfully');
  window.location.href='./quick-master.php';
</script>
<?php

}
/*-----------------------------------------------user multi delete end--------------------------------*/

?>



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
        <p class="block-heading">Quick Link Master </p>
        <div class="block-body">

     <input type="hidden" name="del_data" />
     <input type="hidden" name="del_id" />
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>Quick Link Name</th>
               <!--   <th>Parent Name</th>-->
                  <th>Quick Link Srl</th>
                  <th>Quick Link Status</th>
                  
                  <th><a href="./quick-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
        <?php
   $sql=" select * ";
   $sql.=" from quick_link_master ";
   if(!empty($name)){
    $sql.=" where quick_name like '%:name%' ";
   }
   $sql.="order by quick_parent_id,srl ";
  // echo $sql;
    $sth = $conn->prepare($sql);
    if(!empty($name))
    {
    $sth->bindParam(':name', $name);
    }
    $sth->execute();
    $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sth->fetchAll();
    foreach ($row as $key => $value) 
    {

        $page_id=$value['quick_id'];
        $page_name=$value['quick_name'];
        $parent_id=$value['quick_parent_id'];
        $page_content=$value['quick_content'];
        $show_tag=$value['show_tag'];
        $srl=$value['srl'];
        $i++
   ?>  
           
                <tr>
                <td><input type="checkbox" name="check[]" id="check" value="<?php echo $page_id; ?>"/></td>
                  <td><?php echo $page_name; ?></td>
                <!--  <td>
                  <?php 
                  if($parent_id>0)
                     {
                      $sqlc=" select quick_name ";
                      $sqlc.=" from quick_link_master ";
                      $sqlc.="where quick_id=:parent_id ";
                    //echo $sqlc;
                      $sthc = $conn->prepare($sqlc);
                      $sthc->bindParam(':parent_id', $parent_id);
                      $sthc->execute();
                      $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
                      $rowc = $sthc->fetchAll();
                      foreach ($rowc as $keyc => $valuec) 
                        {

                          $c_page_name=$valuec['quick_name'];
                        }
                      
                   echo $c_page_name; 
                     }
                ?>
        </td>-->
     <td><?php  echo $srl; ?></td>
                  
                     <td><?php
           if($show_tag=='T'){
            $show_tag='Published';
           }else{
             $show_tag='Not published'; 
           }
           
            echo $show_tag; ?></td>
                  
                
                  <td><a href="quick-edit.php?hr_id=<?php echo $page_id; ?>"><img src="images/edit.png" style="height:20px;" /></a></td>
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
