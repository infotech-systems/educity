<?php 
include("../inc/operator_class.php");
include("../inc/dblib.inc.php");
OpenDB();
?>
<?php

if(isSet($_POST['u_id']))
{
	$u_id = $_POST['u_id'];

	$sql_ui="select count(uid) as ck from user_mas where user_id='$u_id '  ";
    $result_ui=execSelect($sql_ui);
while ($row_ui=getRows($result_ui))
{
$total_ck=$row_ui['ck'];
}
if($total_ck>0)
	{
	echo '<font color="red"><img src="./images/not_avil.png" align="absmiddle"/>';
	?>
    <style>
	input[type="submit"] {
	visibility:hidden;
}
</style>
	<?php
	}
	else
	{
	echo '<img src="./images/tick.gif" align="absmiddle"/>'.' OK';
	}
}
?>
<?php
CloseDB();
?>
