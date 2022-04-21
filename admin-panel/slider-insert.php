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
$show = isset($_POST['show']) ? $_POST['show'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$FILES = isset($_POST['FILES']) ? $_POST['FILES'] : '';

$content2=$content;
$sql_b="select * from image_master ";
$sthb = $conn->prepare($sql_b);

$sthb->execute();
$ssb=$sthb->setFetchMode(PDO::FETCH_ASSOC);
$rowb = $sthb->fetchAll();
foreach ($rowb as $keyb => $valueb) 
{

  $c_u_width=$valueb['u_width'];
  $c_u_height=$valueb['u_height'];
  $c_s_width=$valueb['s_width'];
  $c_s_height=$valueb['s_height'];
  $c_b_width=$valueb['b_width'];
  $c_b_height=$valueb['b_height'];
  $c_sl_width=$valueb['sl_width'];
  $c_sl_height=$valueb['sl_height'];
}
?>
<?php

if($submit=="Submit")
{

  $files=fileCkecking($_FILES['image']); 
  if(!empty($files))
    {
    foreach ($files as $file_key => $file_value)
      {
      $upload_file ="$file_value";
      }
    }
      
$sql =" insert into slider_img (slider_nm,slider_content,image_path,show_tag) ";
$sql.=" values ";
$sql.=" (trim(:p_nm),trim(:content2),:upload_file,:show) ";
//echo $sql;
$sth = $conn->prepare($sql);
$sth->bindParam(':p_nm', $p_nm);
$sth->bindParam(':content2', $content2);
$sth->bindParam(':upload_file', $upload_file);
$sth->bindParam(':show', $show);
$sth->execute();

?>
<script language="javascript">
  alert('Slider Creation Successfully');
 //window.location.href='./slider-insert.php'; 
</script>
<?php

/*----------------------Profile update end----------------------*/
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
        <p class="block-heading">Slider Creation<div id="image">[Image Size <?php echo $c_sl_width; ?> x <?php echo $c_sl_height; ?> ]</div></p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">

      <tr >
      <td>Slider Name </td>
      <td ><input type="text" id="p_nm" name="p_nm" value=""/></td>
    <td width="15%">Slider Published</td>
      <td width="35%">
     <select name="show" id="show" >
          <option value="T">  Slider Published  </option>
          <option value="F">  Slider Not Published</option>
        
    </select>
    
    </td>
      </tr>
     
       <tr >
      <td colspan="4">
        <textarea id="elm1" name="content" rows="20" cols="100" style="width: 100%"></textarea>
      </td>
      
      
      </tr>
      <tr>   
      <td width="15%">Photo Upload</td>
      <td width="35%"> <input type="file" name="image" accept="image/*" /></td>
      
      <td width="10%"></td>
      <td width="12%"></td>
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
