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
$hid_id = isset($_POST['hid_id']) ? $_POST['hid_id'] : '';

$hr_id=$_REQUEST['hr_id'];

?>

<?php
if($submit=="Submit")
{
  $sql_ct="select count(quick_id) as ct from quick_link_master ";
  $sql_ct.="where quick_name=:p_nm and quick_id!=:hid_id ";
  //echo $sql_ct;
  $sthct = $conn->prepare($sql_ct);
  $sthct->bindParam(':p_nm', $p_nm);
  $sthct->bindParam(':hid_id', $hid_id);
  $sthct->execute();
  $ssct=$sthct->setFetchMode(PDO::FETCH_ASSOC);
  $rowct = $sthct->fetchAll();
  $total=$rowct['ct'];
 
  if($total<=0)
  { 
    $sql =" update quick_link_master set quick_name=trim(:p_nm) ";
    $sql.=" ,quick_link=trim(:page_url) ,srl=trim(:page_srl),show_tag=trim(:show) ";
    $sql.=" where ";
    $sql.=" quick_id=:hid_id ";
    //echo $sql;
    $sth = $conn->prepare($sql);
    $sth->bindParam(':p_nm', $p_nm);
    $sth->bindParam(':page_url', $page_url);
    $sth->bindParam(':page_srl', $page_srl);
    $sth->bindParam(':show', $show);
    $sth->bindParam(':hid_id', $hid_id);
    $sth->execute();
    

?>
<script language="javascript">
  alert('Quick Link Modification Successfully');
window.location.href='./quick-master.php';  
</script>
<?php
}
else{
  ?>
 <script language="javascript">
  alert('Quick Allready Created');
window.location.href='./quick-master.php';  
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
        <p class="block-heading">Quick Link Modification</p>
        <div class="block-body">
           <div class="Generator" >
     <?php
     $sql=" select * ";
     $sql.=" from quick_link_master where ";
     $sql.=" quick_id=:hr_id ";
     //echo $sql;
     $sth = $conn->prepare($sql);
     $sth->bindParam(':hr_id', $hr_id);
     $sth->execute();
     $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
     $row = $sth->fetchAll();
     foreach ($row as $key => $value) 
      {

          $s_page_content=$value['quick_content'];
          $s_page_name2=$value['quick_name'];
          $s_parent_id2=$value['quick_parent_id'];
          $s_page_link=$value['quick_link'];
          $s_show_tag=$value['show_tag'];
          $s_srl=$value['srl'];
          $s_new_blink=$value['new_blink'];
      }
    ?> 
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      <input type="hidden" name="hid_id" id="hid_id" value="<?php echo $hr_id; ?>" />
       <tr >
      <td>Quick Link Name</td>
      <td><input type="text" id="p_nm" name="p_nm" value="<?php echo $s_page_name2; ?>"  size="100%" /></td>
      
      <td>Quick Link url </td>
      <td><input type="text" id="page_url" name="page_url" value="<?php echo $s_page_link; ?>"  size="100%" maxlength="95"/></td>
       </tr>
     <tr>
      <td width="15%">Quick Link Srl </td>
      <td width="35%"><input type="text" id="page_srl" name="page_srl" value="<?php echo $s_srl; ?>"   maxlength="5"/></td>
     
       
     
      <td width="15%">Quick Link Publish</td>
      
      <td width="35%"> 
   
      <select name="show" id="show">
       <option value="T" <?php if($s_show_tag=="T") echo "SELECTED";?>>Published </option>
        <option value="F"<?php if($s_show_tag=="F") echo "SELECTED";?>> Not Published</option>
   </select>
      </td>
      
      </tr>
      <tr>
      <td colspan="4">
       <div id="button_pos">
      <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />
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
  $("#sub").text("Photo Name cannot be Blank").show().fadeOut(1500);
  $('#p_nm').css("border-color","#FF0000");
  $('#p_nm').focus();
      return false;                  
}
   
   });
</script>

<?php
include('./footer.php');
?>
