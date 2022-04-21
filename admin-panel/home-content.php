<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$p_nm = isset($_POST['p_nm']) ? $_POST['p_nm'] : '';
$c_nm = isset($_POST['c_nm']) ? $_POST['c_nm'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$pic_file = isset($_POST['pic_file']) ? $_POST['pic_file'] : '';

$content2=$content;

?>

<?php
/*---------------- submit --------------------*/
if($submit=="Submit")
{
  
    $sql_ct="select count(id) as ct from home_content_mas ";
    $sql_ct.="where id='1' ";
    $sthc = $conn->prepare($sql_ct);
    $sthc->execute();
    $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
    $rowc = $sthc->fetchAll();
    foreach ($rowc as $keyc => $valuec) 
    {
      $total=$valuec['ct'];
    }
if($total<=0)
{
    $sql =" insert into home_content_mas (hedding,content) ";
    $sql.=" values ";
    $sql.=" (trim(:p_nm),trim(:content2)) ";
    //echo $sql;
    $sth = $conn->prepare($sql);
    $sth->bindParam(':p_nm', $p_nm);
    $sth->bindParam(':content2', $content2);
    $sth->execute();
    ?>
    <script language="javascript">
      alert('Home Content Insert Successfully');
    window.location.href='./max-home-content.php';  
    </script>
    <?php

    /*----------------------Profile update end----------------------*/
    }


else{
  
    $sql =" update home_content_mas set hedding=trim(:p_nm),content=trim(:content2) ";
    $sql.=" where ";
    $sql.=" id='1' ";
  
    $sth = $conn->prepare($sql);
    $sth->bindParam(':p_nm', $p_nm);
    $sth->bindParam(':content2', $content2);
    $sth->execute();
    
?>
 <script language="javascript">
  alert('Home Content update Successfully');
  window.location.href='./home-content.php';  
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
        <p class="block-heading">Home Content</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
    <?php
    $sql4=" select id,hedding,content ";
    $sql4.=" from  home_content_mas where ";
    $sql4.=" id='1'";
    //echo $sql4;
    $sth4 = $conn->prepare($sql4);
    $sth4->execute();
    $ss4=$sth4->setFetchMode(PDO::FETCH_ASSOC);
    $row4 = $sth4->fetchAll();
    foreach ($row4 as $key4 => $value4) 
    {

        $s_hedding=$value4['hedding'];
        $s_content=$value4['content'];
   
    }
    ?>
      <tr >
      <td>Name </td>
      <td colspan="3"><input type="text" id="p_nm" name="p_nm" value="<?php echo $s_hedding; ?>" style="width:98%;"/></td>
      </tr>
     
       <tr >
      <td colspan="4">
        <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"><?php echo $s_content ?></textarea>
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
  $("#sub").text(" Name cannot be Blank").show().fadeOut(1500);
  $('#p_nm').css("border-color","#FF0000");
  $('#p_nm').focus();
      return false;                  
}
   
   });
</script>

<?php
include('./footer.php');
?>
