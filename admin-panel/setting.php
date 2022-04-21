<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
/*---------------image-------------*/
$submit=$_REQUEST['submit'];
$b_width=$_REQUEST['b_width'];
$b_height=$_REQUEST['b_height'];
$s_width=$_REQUEST['s_width'];
$s_height=$_REQUEST['s_height'];
$u_width=$_REQUEST['u_width'];
$u_height=$_REQUEST['u_height'];
$sl_width=$_REQUEST['sl_width'];
$sl_height=$_REQUEST['sl_height'];
/*---------------company-------------*/
$c_name=$_REQUEST['c_name'];
$c_address=$_REQUEST['c_address'];
$pro_name=$_REQUEST['pro_name'];
$pro_email=$_REQUEST['pro_email'];
$land_number=$_REQUEST['land_number'];
$cont_person=$_REQUEST['cont_person'];
$cont_person_no=$_REQUEST['cont_person_no'];
$cont_person_email=$_REQUEST['cont_person_email'];
$website=$_REQUEST['website'];
$c_name2=$c_name;

/*---------------social link-------------*/
$facebook=$_REQUEST['facebook'];
$youtube=$_REQUEST['youtube'];
$google_plus=$_REQUEST['google_plus'];
$twitter=$_REQUEST['twitter'];
$picasa=$_REQUEST['picasa'];
$flickr=$_REQUEST['flickr'];
?>

<?php
if($submit=="Submit")
{
  
$sql_comp="select count(comp_id) as ct from company_master ";
$sql_comp.="where comp_id='1' ";
$sthc = $conn->prepare($sql_comp);
$sthc->execute();
$ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
$rowc = $sthc->fetch();
$total_comp=$rowc['ct'];

if($total_comp<=0)
{ 

  

$sql_comp1 =" insert into company_master (comp_nm,comp_addr,comp_pro,email_id,land_no,cont_per ";
$sql_comp1.=",cont_per_no,cont_per_email,web_addr,comp_logo) ";
$sql_comp1.=" values ";
$sql_comp1.=" (trim(:c_name2),trim(:c_address),:pro_name,:pro_email,:land_number,:cont_person";
$sql_comp1.=",:cont_person_no,:cont_person_email,:website,:upload_file) ";

$sthc1 = $conn->prepare($sql_comp1);
$sthc1->bindParam(':c_name2', $c_name2);
$sthc1->bindParam(':c_address', $c_address);
$sthc1->bindParam(':pro_name', $pro_name);
$sthc1->bindParam(':pro_email', $pro_email);
$sthc1->bindParam(':land_number', $land_number);
$sthc1->bindParam(':cont_person', $cont_person);
$sthc1->bindParam(':cont_person_no', $cont_person_no);
$sthc1->bindParam(':cont_person_email', $cont_person_email);
$sthc1->bindParam(':website', $website);
$sthc1->bindParam(':upload_file', $upload_file);
$sthc1->execute();

}
else
{

  $sql_comp_u =" update company_master set comp_nm=trim(:c_name2), comp_addr=trim(:c_address)";
  $sql_comp_u.=" , comp_pro=trim(:pro_name)";
  $sql_comp_u.=" ,email_id=trim(:pro_email), land_no=trim(:land_number), cont_per=trim(:cont_person)";
  $sql_comp_u.=" ,cont_per_no=trim(:cont_person_no), cont_per_email=trim(:cont_person_email)";
  $sql_comp_u.=" ,web_addr=trim(:website)";
 
  $sql_comp_u.=" where comp_id='1'";
  //echo $sql_comp_u;
  $sthcu = $conn->prepare($sql_comp_u);
  $sthcu->bindParam(':c_name2', $c_name2);
  $sthcu->bindParam(':c_address', $c_address);
  $sthcu->bindParam(':pro_name', $pro_name);
  $sthcu->bindParam(':pro_email', $pro_email);
  $sthcu->bindParam(':land_number', $land_number);
  $sthcu->bindParam(':cont_person', $cont_person);
  $sthcu->bindParam(':cont_person_no', $cont_person_no);
  $sthcu->bindParam(':cont_person_email', $cont_person_email);
  $sthcu->bindParam(':website', $website);
  if(!empty($upload_file))
  {
  $sthcu->bindParam(':upload_file', $upload_file);
  }
  $sthcu->execute();
}   
}
  ?>

<?php
/*
if($submit=="Submit")
{
  $sql_ct="select count(img_id) as ct from image_master ";
  $sthct = $conn->prepare($sql_ct);
  $sthct->execute();
  $ssct=$sthct->setFetchMode(PDO::FETCH_ASSOC);
  $rowct = $sthct->fetch();
  $total=$rowct['ct'];
  
  if($total<=0)
  { 

    $sql =" insert into image_master (u_width,u_height,s_width,s_height,b_width,b_height,sl_width,sl_height) ";
    $sql.=" values ";
    $sql.=" (trim(:u_width),trim(:u_height),trim(:s_width),trim(:s_height)";
    $sql.=",trim(:b_width),trim(:b_height),trim(:sl_width),trim(:sl_height)) ";
    //echo $sql;
    $sthi = $conn->prepare($sql);
    $sthi->bindParam(':u_width', $u_width);
    $sthi->bindParam(':u_height', $u_height);
    $sthi->bindParam(':s_width', $s_width);
    $sthi->bindParam(':s_height', $s_height);
    $sthi->bindParam(':b_width', $b_width);
    $sthi->bindParam(':b_height', $b_height);
    $sthi->bindParam(':sl_width', $sl_width);
    $sthi->bindParam(':sl_height', $sl_height);
    $sthi->execute();

  }
  else
  {

    $sqlu =" update image_master set b_width=trim(:b_width), b_height=trim(:b_height),u_width=trim(:u_width)";
    $sqlu.=", u_height=trim(:u_height),s_width=trim(:s_width), s_height=trim(:s_height)";
    $sqlu.=",sl_height=trim(:sl_height), sl_width=trim(:sl_width) where img_id='1'";
    //echo $sqlu;
    $sthu = $conn->prepare($sqlu);
    $sthu->bindParam(':u_width', $u_width);
    $sthu->bindParam(':u_height', $u_height);
    $sthu->bindParam(':s_width', $u_width);
    $sthu->bindParam(':s_height', $s_height);
    $sthu->bindParam(':b_width', $b_width);
    $sthu->bindParam(':b_height', $b_height);
    $sthu->bindParam(':sl_width', $sl_width);
    $sthu->bindParam(':sl_height', $sl_height);
    $sthu->execute();

  }   
}*/
?>  

<?php
if($submit=="Submit")
{

  $sql_so="select count(sid) as ct from social_link ";
  $sql_so.="where sid='1' ";
  $stho = $conn->prepare($sql_so);
  $stho->execute();
  $sso=$stho->setFetchMode(PDO::FETCH_ASSOC);
  $rowo = $stho->fetch();
  $total_so=$rowo['ct'];

  if($total_so<=0)
  { 

  $sql_so1 =" insert into social_link (fb_link,tw_link,gp_link,yt_link,picasa_link,fl_link) ";
  $sql_so1.=" values ";
  $sql_so1.=" (trim(:facebook),trim(:twitter),trim(:google_plus)";
  $sql_so1.=" ,trim(:youtube),trim(:picasa),trim(:flickr)) ";

  $sthso = $conn->prepare($sql_so1);
  $sthso->bindParam(':facebook', $facebook);
  $sthso->bindParam(':twitter', $twitter);
  $sthso->bindParam(':google_plus', $google_plus);
  $sthso->bindParam(':youtube', $youtube);
  $sthso->bindParam(':picasa', $picasa);
  $sthso->bindParam(':flickr', $flickr);
  $sthso->execute();

  }
  else
  {

  $sql_so_u =" update social_link set fb_link=trim(:facebook), tw_link=trim(:twitter)";
  $sql_so_u.=", gp_link=trim(:google_plus)";
  $sql_so_u.=" ,yt_link=trim(:youtube),picasa_link=trim(:picasa),fl_link=trim(:flickr) where sid='1'";

  $sthsou = $conn->prepare($sql_so_u);
  $sthsou->bindParam(':facebook', $facebook);
  $sthsou->bindParam(':twitter', $twitter);
  $sthsou->bindParam(':google_plus', $google_plus);
  $sthsou->bindParam(':youtube', $youtube);
  $sthsou->bindParam(':picasa', $picasa);
  $sthsou->bindParam(':flickr', $flickr);
  $sthsou->execute();

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
  <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
  <div class="row-fluid">
<div class="block span12">
      <a href="#page-stats1" class="block-heading" data-toggle="collapse">Company Profile Setting<span class="label label-warning">Edit</span></a>
        <div id="page-stats1" class="block-body collapse out">
           <div class="Generator" >
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <?php
      $sql_c="select comp_nm,comp_addr,email_id,land_no,comp_pro,cont_per";
      $sql_c.=",cont_per_no,cont_per_email,web_addr from company_master ";

      $sthc = $conn->prepare($sql_c);
      $sthc->execute();
      $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
      $rowc = $sthc->fetchAll();
      foreach ($rowc as $keyc => $valuec) 
      {
        $c_comp_nm=$valuec['comp_nm'];
        $c_comp_addr=$valuec['comp_addr'];
        $c_email_id=$valuec['email_id'];
        $c_land_no=$valuec['land_no'];
        $c_comp_pro=$valuec['comp_pro'];
        $c_cont_per=$valuec['cont_per'];
        $c_cont_per_no=$valuec['cont_per_no'];
        $c_cont_per_email=$valuec['cont_per_email'];
        $c_web_addr=$valuec['web_addr'];
      }
      
    ?>
      <tr >
      <td >Company Name</td>
      <td> <input type="text" id="c_name" name="c_name"  maxlength="50"  value="<?php echo $c_comp_nm; ?>"  /></td>
      <td>Company Address </td>
      <td><input type="text" id="c_address" name="c_address" value="<?php echo $c_comp_addr; ?>"/></td>
      </tr>
     
      <tr >
      <td >Propiter Name</td>
      <td><input type="text" id="pro_name" name="pro_name" value="<?php echo $c_comp_pro; ?>" maxlength="50" /></td>
      <td>Email Id </td>
      <td><input type="text" id="pro_email" name="pro_email" value="<?php echo $c_email_id; ?>" maxlength="50"/></td>
      </tr>
      <tr >
      <td >Land No</td>
      <td><input type="text" id="land_number" name="land_number" value="<?php echo $c_land_no; ?>" maxlength="18" /></td>
      <td>Contact Person </td>
      <td><input type="text" id="cont_person" name="cont_person" value="<?php echo $c_cont_per; ?>" maxlength="50"/></td>
      </tr>
      <tr >
      <td >Contact Person No</td>
      <td><input type="text" id="cont_person_no" name="cont_person_no" value="<?php echo $c_cont_per_no; ?>" maxlength="15" /></td>
      <td>Contact Person Email  </td>
      <td><input type="text" id="cont_person_email" name="cont_person_email" value="<?php echo $c_cont_per_email; ?>" maxlength="50"/></td>
      </tr>
      <tr >
      
      <td> Website</td>
      <td><input type="text" id="website" name="website" value="<?php echo $c_web_addr; ?>" maxlength="50"/></td>
      
      </tr>
      
      </table>
      </div>
        </div>
    </div>
</div>

<div class="row-fluid">
<div class="block span12">
      <a href="#page-stats3" class="block-heading" data-toggle="collapse">Social Network Setting<span class="label label-warning">Edit</span></a>
        <div id="page-stats3" class="block-body collapse out">
           <div class="Generator" >
      <table  border="0"  cellpadding="0" cellspacing="0">
      
      <?php
      $sql_c="select fb_link,tw_link,gp_link,yt_link,picasa_link,fl_link from social_link ";
      $sth = $conn->prepare($sql_c);
      $sth->execute();
      $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
      $row = $sth->fetchAll();
      foreach ($row as $key => $value) 
      {
        $c_fb_link=$value['fb_link'];
        $c_tw_link=$value['tw_link'];
        $c_gp_link=$value['gp_link'];
        $c_yt_link=$value['yt_link'];
        $c_picasa_link=$value['picasa_link'];
        $c_fl_link=$value['fl_link'];
        
       }
        
    ?>
      <tr >
      <td >Facebook</td>
      <td> <input type="text" id="facebook" name="facebook"  value="<?php echo $c_fb_link; ?>"  /></td>
      <td>Youtube</td>
      <td><input type="text" id="youtube" name="youtube" value="<?php echo $c_yt_link; ?>"/></td>
      </tr>
     
      <tr >
      <td >Google Plus</td>
      <td><input type="text" id="google_plus" name="google_plus" value="<?php echo $c_gp_link; ?>"  /></td>
      <td>Twitter </td>
      <td><input type="text" id="twitter" name="twitter" value="<?php echo $c_tw_link; ?>" /></td>
      </tr>
     <tr >
      
      <td>Instagram</td>
      <td><input type="text" id="picasa" name="picasa" value="<?php echo $c_picasa_link; ?>" /></td>
      <!--
      <td >Flickr</td>-->
      <td><input type="hidden" id="flickr" name="flickr" value="<?php echo $c_fl_link; ?>"  /></td>
      </tr>
      </table>
      </div>
        </div>
    </div>
</div>
<!--
<div class="row-fluid">
<div class="block span12">
      <a href="#page-stats" class="block-heading" data-toggle="collapse">Image Size Setting<span class="label label-warning">Edit</span></a>
      
        <div id="page-stats" class="block-body collapse out">
           <div class="Generator" >
      <table  border="0"  cellpadding="0" cellspacing="0">
      <?php
        $sql_b="select * from image_master ";
        $sth = $conn->prepare($sql_b);
        $sth->execute();
        $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
        $row = $sth->fetchAll();
        foreach ($row as $key => $value) 
        {
          $c_u_width=$value['u_width'];
          $c_u_height=$value['u_height'];
          $c_s_width=$value['s_width'];
          $c_s_height=$value['s_height'];
          $c_b_width=$value['b_width'];
          $c_b_height=$value['b_height'];
          $c_sl_width=$value['sl_width'];
          $c_sl_height=$value['sl_height'];
         }
    ?>
      <tr>
      <td colspan="4">
      <fieldset>
      <legend>Big Image  Size</legend>
      <table>
      
      <tr >
      <td >Width</td>
      <td> <input type="text" id="b_width" name="b_width" value="<?php echo $c_b_width; ?>" maxlength="10" /></td>
      <td>Height </td>
      <td><input type="text" id="b_height" name="b_height"  maxlength="10" value="<?php echo $c_b_height; ?>"/></td>
      </tr>
     </table>
     </fieldset>
     </td>
       <tr >
      <td colspan="4">
      <fieldset>
      <legend>Small Image Size</legend>
      <table>
      <tr >
      <td >Width</td>
      <td><input type="text" id="s_width" name="s_width" value="<?php echo $c_s_width; ?>" maxlength="10" /></td>
      <td>Height </td>
      <td><input type="text" id="s_height" name="s_height" value="<?php echo $c_s_height; ?>" maxlength="10"/></td>
      </tr>
     </table>
     </fieldset>
     </td>
      </tr>
      <tr >
      <td colspan="4">
      <fieldset>
      <legend>User Image Size</legend>
      <table>
      <tr >
      <td >Width</td>
      <td><input type="text" id="u_width" name="u_width" value="<?php echo $c_u_width; ?>" maxlength="5" /></td>
      <td>Height </td>
      <td><input type="text" id="u_height" name="u_height" value="<?php echo $c_u_height; ?>" maxlength="5"/></td>
      </tr>
     </table>
     </fieldset>
     </td>
      </tr>
      <tr>
      <tr >
      <td colspan="4">
      <fieldset>
      <legend>Slider Image Size</legend>
      <table>
      <tr >
      <td >Width</td>
      <td><input type="text" id="sl_width" name="sl_width" value="<?php echo $c_sl_width; ?>" maxlength="6" /></td>
      <td>Height </td>
      <td><input type="text" id="sl_height" name="sl_height" value="<?php echo $c_sl_height; ?>" maxlength="6"/></td>
      </tr>
     </table>
     </fieldset>
     </td>
      </tr>
      </table>
      </div>
        </div>
    </div>
</div>-->
 <div id="button_pos">
      <input type="submit"  class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="button" name="refresh" id="refresh"  class="btn btn-primary btn-small" value="Refresh" onClick="window.location.reload()"/>
      </div>
        </form>
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

if ($('#b_width').val() == "") {
  $("#sub").text("Big Image Size Width cannot be Blank").show().fadeOut(1500);
  $('#b_width').css("border-color","#FF0000");
  $('#b_width').focus();
      return false;                  
}
if ($('#b_height').val() == "") {
  $("#sub").text("Big Image Size Height cannot be Blank").show().fadeOut(1500);
  $('#b_height').css("border-color","#FF0000");
  $('#b_height').focus();
      return false;                  
}
if ($('#s_width').val() == "") {
  $("#sub").text("Small Image Size Width cannot be Blank").show().fadeOut(1500);
  $('#s_width').css("border-color","#FF0000");
  $('#s_width').focus();
      return false;                  
}
if ($('#s_height').val() == "") {
  $("#sub").text("Small Image Size Height cannot be Blank").show().fadeOut(1500);
  $('#s_height').css("border-color","#FF0000");
  $('#s_height').focus();
      return false;                  
}
if ($('#u_width').val() == "") {
  $("#sub").text("User Image Size Width cannot be Blank").show().fadeOut(1500);
  $('#u_width').css("border-color","#FF0000");
  $('#u_width').focus();
      return false;                  
}

if ($('#u_height').val() == "") {
  $("#sub").text("user Image Size Height cannot be Blank").show().fadeOut(1500);
  $('#u_height').css("border-color","#FF0000");
  $('#u_height').focus();
      return false;                  
}
if ($('#c_name').val() == "") {
  $("#sub").text("Company Name cannot be Blank").show().fadeOut(1500);
  $('#c_name').css("border-color","#FF0000");
  $('#c_name').focus();
      return false;                  
}
if ($('#c_address').val() == "") {
  $("#sub").text("Company Address cannot be Blank").show().fadeOut(1500);
  $('#c_address').css("border-color","#FF0000");
  $('#c_address').focus();
      return false;                  
}
if ($('#cont_person').val() == "") {
  $("#sub").text("Contact Person Name cannot be Blank").show().fadeOut(1500);
  $('#cont_person').css("border-color","#FF0000");
  $('#cont_person').focus();
      return false;                  
}
if ($('#cont_person_no').val() == "") {
  $("#sub").text("Contact Person Mobile No cannot be Blank").show().fadeOut(1500);
  $('#cont_person_no').css("border-color","#FF0000");
  $('#cont_person_no').focus();
      return false;                  
}
if ($('#pro_email').val() == "") {
  $("#sub").text("Email cannot be Blank").show().fadeOut(1500);
  $('#pro_email').css("border-color","#FF0000");
  $('#pro_email').focus();
      return false;                  
}
 if(!validateEmail('pro_email')){
    $("#sub").text("Invalid Email").show().fadeOut(1500);
  $('#pro_email').css("border-color","#FF0000");
  $('#pro_email').focus();
    return false;                 
}
if ($('#cont_person_email').val() == "") {
  $("#sub").text("Email cannot be Blank").show().fadeOut(1500);
  $('#cont_person_email').css("border-color","#FF0000");
  $('#cont_person_email').focus();
      return false;                  
}
 if(!validateEmail('cont_person_email')){
    $("#sub").text("Invalid Email").show().fadeOut(1500);
  $('#cont_person_email').css("border-color","#FF0000");
  $('#cont_person_email').focus();
    return false;                 
}

   
   });
</script>

<?php
include('./footer.php');
?>
