<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    skin : "o2k7",
    skin_variant : "silver",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",

    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Example word content CSS (should be your site CSS) this one removes paragraph margins
    content_css : "css/word.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "./lists/template_list.js",
    external_link_list_url : "./lists/link_list.js",
    external_image_list_url : "./lists/image_list.js",
    media_external_list_url : "./lists/media_list.js",

    // Replace values for the template plugin
    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    }
  });
  
</script>
<?php
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';
$p_nm = isset($_POST['p_nm']) ? $_POST['p_nm'] : '';
$parent_name = isset($_POST['parent_name']) ? $_POST['parent_name'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$page_url = isset($_POST['page_url']) ? $_POST['page_url'] : '';
$page_srl = isset($_POST['page_srl']) ? $_POST['page_srl'] : '';
$show = isset($_POST['show']) ? $_POST['show'] : '';
$content2=$content;
if(empty($parent_name))
 $parent_name='0';

?>

<?php
if($submit=="Submit")
{
  $sql_ct="select count(page_id) as ct from page_master ";
  $sql_ct.="where page_name=:p_nm ";
  //echo $sql_ct;
  $sthc = $conn->prepare($sql_ct);
  $sthc->bindParam(':p_nm', $p_nm);
  $sthc->execute();
  $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
  $rowc = $sthc->fetch();
  $total=$rowc['ct'];

  if($total<=0)
  { 
/*------------------ file upload process-----------------------*/


    $sql =" insert into page_master (page_name,parent_id,page_content,page_link,srl,show_tag) ";
    $sql.=" values ";
    $sql.=" (trim(:p_nm),trim(:parent_name),trim(:content2),trim(:page_url),trim(:page_srl),trim(:show)) ";
    
    $sth = $conn->prepare($sql);
    $sth->bindParam(':p_nm', $p_nm);
    $sth->bindParam(':parent_name', $parent_name);
    $sth->bindParam(':content2', $content2);
    $sth->bindParam(':page_url', $page_url);
    $sth->bindParam(':page_srl', $page_srl);
    $sth->bindParam(':show', $show);
    $sth->execute();
  

?>
<script language="javascript">
  alert('Page Creation Successfully');
window.location.href='./page-insert.php'; 
</script>
<?php

/*----------------------Profile update end----------------------*/
}
else{
  ?>
 <script language="javascript">
  alert('Page Allready Created');
window.location.href='./page-insert.php'; 
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
        <p class="block-heading">Page Creation</p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <tr >
      <td>Page Name </td>
      <td ><input type="text" id="p_nm" name="p_nm" value="" maxlength="50" /></td>
      <td>Parent Name </td>
      <td>
        <?php
         $sql=" select page_id,page_name ";
         $sql.=" from page_master where ";
         $sql.=" parent_id=''";
         $sth = $conn->prepare($sql);
         $sth->execute();
         $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
         $row = $sth->fetchAll();
      
        ?>
        <select name="parent_name" id="parent_name">
      <option value="">-----Select Parent Name------</option>
      <?php
      
         foreach ($row as $key => $value) 
          {
            $s_page_id=$value['page_id'];
            $s_page_name=$value['page_name'];
        ?>
             <option value="<?php echo $s_page_id; ?>"><?php echo $s_page_name; ?></option>
<?php 
          }
  ?> 
   </select></td>
      </tr>
     
       <tr >
      <td colspan="4">    
        <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"></textarea>
     </td>
      </tr>
      <tr>   
      <td width="15%">Page url </td>
      <td width="35%"><input type="text" id="page_url" name="page_url" value=""  size="100%" maxlength="50"/></td>
      <td width="15%">Page Srl</td>
      <td width="35%"> 
      <input type="text" id="page_srl" name="page_srl" value=""   maxlength="5"/>
      </td>
      </tr>
      <tr>
      <td width="15%">Page Publish</td>
      <td width="35%"> 
      <select name="show" id="show">
       <option value="T">Published </option>
        <option value=""> Not Published</option>
       </select>
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
  $("#sub").text("Name cannot be Blank").show().fadeOut(1500);
  $('#p_nm').css("border-color","#FF0000");
  $('#p_nm').focus();
      return false;                  
}
if ($('#page_srl').val() == "") {
  $("#sub").text("Type Page Position").show().fadeOut(1500);
  $('#page_srl').css("border-color","#FF0000");
  $('#page_srl').focus();
      return false;                  
}

   
   });
</script>

<?php
include('./footer.php');
?>
