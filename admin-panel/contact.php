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
$submit=$_REQUEST['submit'];
$p_nm=$_REQUEST['p_nm'];
$c_nm=$_REQUEST['c_nm'];
$content=$_REQUEST['content'];
$pic_file=$_REQUEST['pic_file'];
$content=$_REQUEST['content'];
$fat_content=$_REQUEST['fat_content'];
$reg_content=$_REQUEST['reg_content'];
$map=$_REQUEST['map'];
$content2=$content;
$reg_content2=$reg_content;
$fat_content2=$fat_content;
$map2=$map;

?>

<?php
if($submit=="Submit")
{
		
	$sql_ct="select count(id) as ct from contact_us_mas ";
	$sql_ct.="where id='1' ";
	$sth = $conn->prepare($sql_ct);
	$sth->execute();
	$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
	$row = $sth->fetch();
	$total=$row['ct'];

	if($total<=0)
	{	
		
	$sql =" insert into contact_us_mas (hedding,content,map_adr) ";
	$sql.=" values ";
	$sql.=" (trim(:p_nm'),trim(:content2),trim(:map2)) ";
	
	$sth3 = $conn->prepare($sql);
    $sth3->bindParam(':p_nm', $p_nm);
    $sth3->bindParam(':content2', $content2);
    $sth3->bindParam(':map2', $map2);
    $sth3->execute();
	?>
	<script language="javascript">
		alert('Contact Content Insert Successfully');
	window.location.href='./contact.php';	
	</script>
	<?php

	/*----------------------Profile update end----------------------*/
	}
	else{
	 
	$sqlu =" update contact_us_mas set hedding=trim(:p_nm),content=trim(:content2)";
	$sqlu.=",map_adr=trim(:map2) ";
	$sqlu.=" where ";
	$sqlu.=" id='1' ";
	//echo $sql;
	$sthu = $conn->prepare($sqlu);
    $sthu->bindParam(':p_nm', $p_nm);
    $sthu->bindParam(':content2', $content2);
    $sthu->bindParam(':map2', $map2);
    $sthu->execute();
	?>
	<script language="javascript">
		alert('Contact Content update Successfully');
	window.location.href='./contact.php';	
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
        <p class="block-heading">Contact Content</p>
        <div class="block-body">
        <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
      <table  border="0"  cellpadding="0" cellspacing="0">
  	  <?php
		$sql=" select * ";
		$sql.=" from contact_us_mas where ";
		$sql.=" id='1'";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
		$row = $sth->fetch();
        $s_hedding=$row['hedding'];
        $s_content=$row['content'];
		$s_map_adr=$row['map_adr'];
		$s_fact_add=$row['fact_add'];
		$s_reg_off=$row['reg_off'];
	  
	  ?>
      <tr >
      <td>Name </td>
      <td colspan="3"><input type="text" id="p_nm" name="p_nm" value="<?php echo $s_hedding; ?>" style="width:98%;"/></td>
      </tr>
     <tr >
      <td colspan="4">Correspondence Address</td>
      </tr>
       <tr >
      <td colspan="4">
        <textarea id="elm1" name="content" rows="20" cols="50" style="width: 100%"><?php echo $s_content ?></textarea>
      </td>
      </tr>
      <tr >
      <td>Map Address </td>
      <td colspan="3"><input type="text" id="map" name="map" value="<?php echo $s_map_adr; ?>" style="width:98%;"/></td>
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
