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
$submit=$_REQUEST['submit'];
$check=$_REQUEST['check'];
$delete=$_REQUEST['delete'];
$del_data=$_REQUEST['del_data'];
$del_id=$_REQUEST['del_id'];
$menu=$_REQUEST['menu'];
$submit=$_REQUEST['submit'];
?>
<?php
/*-------------------------- user multi delete start-------------------------------------------*/
if($delete=="Delete")
{
	//echo $check;
	//print_r($check);
	foreach($check as $ck)
	{		
	$sqld1=" delete from menu_master where mid='$ck' ";
	//echo $sqld1;
	execDelete($sqld1);
	}
	$sub="Record(s) Deleted Successfully";
}
/*-----------------------------------------------user multi delete end--------------------------------*/
//echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.$del_data<br>";
?>

<?php
/*-------------------------- user delete start-------------------------------------------*/
if($del_data=="delete")
{
	
$sqld1=" Delete from menu_master WHERE mid='$del_id' ";
echo $sqld1;
execDelete($sqld1);
$sub="One Record Deleted Successfully";
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
alert(unicode)
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
 <form name="form" method="post" enctype="multipart/form-data" onSubmit="return validate()">
 
 <div class="row-fluid">
<div class="block span12">
      <a href="#page-stats1" class="block-heading" data-toggle="collapse">Search</a>
        <div id="page-stats1" class="block-body collapse out">
           <div class="Generator" >
      <table  border="0"  cellpadding="0" cellspacing="0">
      <tr >
      <td >Menu Name</td>
      <td> 
      <input type="text" name="menu" id="menu" value="<?php echo $menu; ?>"/>
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
 </form>
   <form name="form" method="post" enctype="multipart/form-data" onSubmit="return validate()">
<input type="submit" name="delete" id="delete" value="Delete"  class="btn btn-primary btn-small" /> 
<div class="row-fluid">
<div class="block span16">
        <p class="block-heading">Menu Master </p>
        <div class="block-body">
        

     
     <div class="CSSTableGenerator" style="width:99%; -moz-width:500%;">
     <input type="hidden" name="del_data" value="<?php echo $delete; ?>" />
     <input type="hidden" name="del_id" value="<?php echo $id; ?>"/>
           <table class="table" id="tab1">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="checkAll" /></th>
                  <th>Menu Name</th>
                  <th>Parent Name</th>
                  <th>Menu Link</th>
                  <th>Status</th>
                  <th><a href="./menu-insert.php"><img src="images/add.png" style="height:20px; "/></a></th>
                </tr>
              </thead>
              <tbody>
                       <?php
     $sqle=" select mid,mbody,parent_id,sub_id,murl,show_tag ";
	 $sqle.=" from menu_master ";
	 if(!empty($menu)){
	  $sqle.=" where mbody like '%$menu%' ";
	 }
	 $sqle.="  order by mid,parent_id,sub_id";
	 //echo $sqle;
	 $rese=execSelect($sqle);	
	while($rowe=getRows($rese))
	  {
        $e_mbody=$rowe['mbody'];
		$e_mid=$rowe['mid'];
		$e_sub_id=$rowe['sub_id'];
        $e_parent_id=$rowe['parent_id'];
		$e_show_tag=$rowe['show_tag'];
		$e_smurl=$rowe['murl'];
		if($e_show_tag=="T"){
			$show="Published";
		}
		else{
			$show="Not Published";
		}
		?>
           
                <tr>
                <td><input type="checkbox" name="check[]" id="check" value="<?php echo $e_mid; ?>"/></td>
                  <td><?php echo $e_mbody; ?></td>
                  
        <td>
		<?php
     $sqlf=" select mbody ";
	 $sqlf.=" from menu_master where  ";
	 if(!($e_sub_id)){
	  $sqlf.="mid='$e_parent_id'   ";
	 }
	 else{
	 $sqlf.="mid='$e_sub_id'  ";
	 }
	// echo $sqlf;
	 $resf=execSelect($sqlf);	
	while($rowf=getRows($resf))
	  {
        $e_p_nm=$rowf['mbody'];
	  }
	  echo $e_p_nm;
		?></td>
        
                   <td><?php echo $e_smurl; ?></td>
                  <td><?php echo $show; ?></td>
                  <td><a href="menu-edit.php?hr_id=<?php echo $e_mid;?>"><img src="images/edit.png" style="height:20px;" /></a></td>
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
