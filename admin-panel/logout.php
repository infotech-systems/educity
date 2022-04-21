<?php

include("./inc/operator_class.php");
include("./inc/dblib.inc.php");
$conn=OpenDB(); 

$Session = new Session('Script');
$ses_uid = $Session->Get('uid');
$ses_user_nm = $Session->Get('user_nm');
$ses_user_id = $Session->Get('user_id');
$ses_user_status = $Session->Get('user_status');
$ses_current_status = $Session->Get('current_status');
$ses_ip_addr= $Session->Get('ip_addr');
$ses_id = $Session->Get('id');

/*----------- get logout time ---------------------*/
$sqlt ="select current_timestamp as logout_time ";

$stht = $conn->prepare($sqlt);
$stht->execute();
$sst=$stht->setFetchMode(PDO::FETCH_ASSOC);
$rowt = $stht->fetch();
$logout_time=$rowt['logout_time'];
		 
/*----------------- update user log---------------------*/
$sqlu ="update user_log_mas set logout_on=:logout_time where uid=:ses_uid  ";
$sqlu.="and id=:ses_id ";
//echo $sqlu;
$sthu = $conn->prepare($sqlu);
$sthu->bindParam(':logout_time', $logout_time);
$sthu->bindParam(':ses_uid', $ses_uid);
$sthu->bindParam(':ses_id', $ses_id);
$sthu->execute();

$sql="update user_mas set current_status='I' where user_id=:ses_user_id ";
$sth = $conn->prepare($sql);
$sth->bindParam(':ses_user_id', $ses_user_id);
$sth->execute();

unset($_SESSION['user_id']);
unset($_SESSION['user_nm']);
unset($_SESSION['user_status']);
unset($_SESSION['current_status']);

session_destroy();
$conn=null;

?>
<script language=javascript>
	window.location.href='./login.php';
		</script>
	<?php	
ob_flush();

?>
