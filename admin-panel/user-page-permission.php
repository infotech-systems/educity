<?php
include('./header.php');
include('./side-bar.php');
include('./header-bottom.php');
?>
<?php
$mitem=$_REQUEST['mitem']; 

$submit=$_REQUEST['submit'];
$hr_id=$_REQUEST['hr_id'];
$u_nm=$_REQUEST['u_nm'];
$u_id=$_REQUEST['u_id'];

$dob_date=$_REQUEST['dob_date'];
$pic_file=$_REQUEST['pic_file'];
$n_pwd=$_REQUEST['n_pwd'];
$u_status=$_REQUEST['u_status'];
$dob_date1=british_to_ansi($dob_date);
 ?>
<!-------------------------- profile update start----------------------->

<?php
if($submit=="Submit"){
	

for($i=0;$i<=count($mitem)-1;$i++)
{ $str_mid.= $mitem[$i].",";
}
$str_mid.="0";

$sql =" update user_mas set page_per=trim('$str_mid') ";
$sql.=" where  ";
$sql.=" uid='$hr_id' ";
//echo $sql;
execUpdate($sql);
?>
<script language="javascript">
	alert('Page Permission Successfully');
window.location.href='./user-master.php';	
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
  <?php
	 $sql=" select uid,user_nm,page_per ";
	 $sql.=" from user_mas ";
	  $sql.=" where uid='$hr_id' ";
	// $sql.=" where user_type!='A' ";
	// echo $sql;
	 $res=execSelect($sql);	
	while($row=getRows($res))
	  {
        $user_nm=$row['user_nm'];
        $page_par_temp=$row['page_per'];
		      $page_pars_temp=explode(",",$page_par_temp);
	  }
	 ?>  
<div class="row-fluid">
<div class="block span12">
        <p class="block-heading">Page Permission for <?php echo $user_nm; ?> </p>
        <div class="block-body">
           <div class="Generator" >
     <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate()">
            <table  border="0"  cellpadding="0" cellspacing="0">
        <?php
      $sql="select * from menu_master where parent_id='0' order by mid";
      $result=execSelect($sql);
       while($row=getRows($result))
       {
       $mbody=$row['mbody'];
       $mid=$row['mid'];
       ?>
          <tr> <td colspan=2> <font color='#993300'> <?php echo $mbody; ?>  </font>    <br>
                      <?php
                        $sql1="select * from menu_master where parent_id='$mid' order by mid";
                        $result1=execSelect($sql1); 
                         while($row1=getRows($result1))
                         {
                         $mbody1=$row1['mbody'];
                         $mid1=$row1['mid'];
           
                         for($l=0;$l<count($page_pars_temp); $l++)
                         {
                          if ($page_pars_temp[$l]==$mid1) {
                          $flag="checked";
                          break;
                          }
                          else
                          $flag="";
                        }
                         $sql11="select count(*) as totm from menu_master where mid='$mid1' ";
                         $result11=execSelect($sql11);
                         $tot11=rowCount($result11);
                         
                         if($tot11>0) echo  "<input type='CHECKBOX' name='mitem[]' value='$mid1' $flag >$mbody1";
                         else echo "$mbody1";
                         echo  "&nbsp";
                            $sql2="select * from menu_master where parent_id='$mid1' order by mid";
                            $result2=execSelect($sql2);
                            $tot2=rowcount($result2);
                            while($row2=getRows($result2))
                            {
                            $mbody2=$row2['mbody'];
                            $midch2=$row2['mid'];
                            for($l=0;$l<count($page_pars_temp); $l++)
                             {
                             if ($page_pars_temp[$l]==$midch2) {
                              $flag="checked";
                             break;
                             }
                             else
                             $flag="";
                             }
                            echo "<input type='CHECKBOX' name='mitem[]' value='$midch2' $flag >".$mbody2."<br>";
                            }

                       }
                       

                       ?>
         </td>
           </tr>
       <?php  
       }
       ?>
       <tr>
      <td colspan="2">
       <div id="button_pos">
       <input type="submit" class="btn btn-primary btn-small" name="submit" id="submit" value="Submit" />&nbsp; <input type="reset" class="btn btn-primary btn-small" name="refresh" id="refresh" value="Refresh" onClick="window.location.reload()"/>
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

if ($('#m_nm').val() == "") {
	$("#sub").text("Name cannot be Blank").show().fadeOut(1500);
	$('#m_nm').css("border-color","#FF0000");
	$('#m_nm').focus();
      return false;								   
}
if ($('#position').val() == "") {
	$("#sub").text("Type Menu Position").show().fadeOut(1500);
	$('#Position').css("border-color","#FF0000");
	$('#Position').focus();
      return false;								   
}
if ($('#email').val() == "") {
	$("#sub").text("Email cannot be Blank").show().fadeOut(1500);
	$('#email').css("border-color","#FF0000");
	$('#email').focus();
      return false;								   
}
 if(!validateEmail('email')){
    $("#sub").text("Invalid Email").show().fadeOut(1500);
	$('#email').css("border-color","#FF0000");
	$('#email').focus();
    return false;								  
}

	 
	 });
</script>

<?php
include('./footer.php');
?>
