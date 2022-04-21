<?php 
require_once("./inc/operator_class.php");
require_once("./inc/dblib.inc.php");
$conn = OpenDB();
$sql_c="SELECT *";
$sql_c.="from  company_master ";
$sth = $conn->prepare($sql_c);
$sth->execute();
$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
$row = $sth->fetchAll();
foreach ($row as $key => $value) 
{
  $comp_nm=$value['comp_nm'];
  $web_addr=$value['web_addr'];
}
$base_dir  = __DIR__; 
$doc_root  = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); 
$base_url  = preg_replace("!^${doc_root}!", '', $base_dir);
$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$port      = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
$domain    = $_SERVER['SERVER_NAME'];
$full_url  = "${protocol}://${domain}${disp_port}${base_url}";
?>
<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$csrftoken = isset($_POST['csrftoken']) ? $_POST['csrftoken'] : '';

$randomtoken = md5(uniqid(rand(), true));


$ip_addr=$_SERVER['REMOTE_ADDR'];

$Session = new Session('Script');
$protect = $Session->Get('protect');
if(!$protect)
{
  $Session->Set('protect','0');
}

if($protect>2)
{
  die('You Are Blocked! Contact Portal Admin');
}
/*---------------- row count----------------*/
if($action=='Login')
{

  $protect = $Session->Get('protect');  
  $protect++;
    
  $Session->Set('protect',$protect);
  if(!empty($randomtoken))
  {
      $sql_ct="select count(uid) as ct from user_mas ";
      $sql_ct.="where user_id=:user_id and pwd=:password ";
      $sthct = $conn->prepare($sql_ct);
      $sthct->bindParam(':user_id', $user_id);
      $sthct->bindParam(':password', $password);
      $sthct->execute();
      $ssct=$sthct->setFetchMode(PDO::FETCH_ASSOC);
      $rowct = $sthct->fetchAll();
      foreach ($rowct as $keyct => $valuect) 
      {

        $total=$valuect['ct'];
      }

        if($total>0)
      {
        
        $sqlc=" select current_status from user_mas where ";
        $sqlc.=" user_id=:user_id";

        $sthc = $conn->prepare($sqlc);
        $sthc->bindParam(':user_id', $user_id);
        $sthc->execute();
        $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
        $rowc = $sthc->fetchAll();
        foreach ($rowc as $keyc => $valuec) 
        {
            $c_current_status=$valuec['current_status'];
        }

        
        $sql="select uid,user_nm,user_id,user_type,user_status,photo_path,current_status,page_per ";
        $sql.="from user_mas ";
        $sql.=" where user_id=:user_id and pwd=:password ";

        $sth = $conn->prepare($sql);
        $sth->bindParam(':user_id', $user_id);
        $sth->bindParam(':password', $password);
        $sth->execute();
        $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
        $row = $sth->fetchAll();
        foreach ($row as $key => $value) 
        {
          $uid=$value['uid'];
          $user_nm=$value['user_nm'];
          $user_id=$value['user_id'];
          $user_type=$value['user_type'];
          $user_status=$value['user_status'];
          $photo_path=$value['photo_path'];
          $current_status=$value['current_status'];
          $page_per=$value['page_per'];
        } 
        
        if($user_status=='A')
        {
          
          
          $sql="update user_mas set current_status='A' where user_id='$user_id' ";
          $sth = $conn->prepare($sql);
          $sth->execute();

          $sql1 ="select current_timestamp as login_time ";

          $sth1 = $conn->prepare($sql1);
          $sth1->execute();
          $ss1=$sth1->setFetchMode(PDO::FETCH_ASSOC);
          $row1 = $sth1->fetchAll();
          foreach ($row1 as $key1 => $value1) 
          {
            $login_time=$value1['login_time'];
          }

          $sqlI="insert into user_log_mas (uid,login_on) values(:uid,:login_time) ";
          
          $sthu = $conn->prepare($sqlI);
          $sthu->bindParam(':uid', $uid);
          $sthu->bindParam(':login_time', $login_time);
          $sthu->execute();

          $sqlC="select max(id) as id from user_log_mas WHERE uid='$uid' ";
          //echo $sqlC;
          $sthc = $conn->prepare($sqlC);
          $sthc->execute();
          $ssc=$sthc->setFetchMode(PDO::FETCH_ASSOC);
          $rowc = $sthc->fetchAll();
          foreach ($rowc as $keyc => $valuec) 
          {
            $chk_id=$valuec['id'];
          }
        
          
          /*---------------------- session data----------------*/
          $Session = new Session('Script');
           
          // Clean setting of the session data
          $Session->Set('uid',$uid);
          $Session->Set('user_nm',$user_nm);
          $Session->Set('comp_nm',$comp_nm);
          $Session->Set('web_addr',$web_addr);
          $Session->Set('user_id',$user_id);
          $Session->Set('user_status',$user_status);
          $Session->Set('user_type',$user_type);
          $Session->Set('current_status',$current_status);
          $Session->Set('photo_path',$photo_path);
          $Session->Set('ip_addr',$ip_addr);
          $Session->Set('page_per',$page_per);
          $Session->Set('id',$chk_id);

          ?>
          <script language=javascript>
          window.location.href='./index.php';
          </script>
          
          <?php
        }
        else
        {
          $msg="User ID Deactivated. Please contact Administrator ....";   
          }
         /*
         }
         
         else {
           $msg="User Allready Login";
         }
         */
      }
      else
      {
         $msg="Wrong User-Id/Password ...."; 
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin Panel Login</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo $full_url; ?>/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo $full_url; ?>/css/theme.css">
    <link rel="stylesheet" href="<?php echo $full_url; ?>/css/font-awesome.css">

    <script src="<?php echo $full_url; ?>/js/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
             <a class="brand" href="<?php echo $full_url; ?>/index.php"><span class="first"><?php echo $comp_nm; ?></span> </a>
        </div>
    </div>
    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign In</p>
            <div class="block-body">
                <form name="form" method="post">
                    <label>Username</label>
                    <input type="text" class="span12" name="user_id"  title="user_id" maxlength="25">
                    <label>Password</label>
                    <input type="password" class="span12" name="password"  title="password" maxlength="25">
                    <input type="submit" name="action" value="Login" class="btn btn-primary pull-right" onClick="return validation();" />

                   <!-- <label class="remember-me"><input type="checkbox"> Remember me</label>-->
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#http://mysite.infotechsystems.in/" target="blank">Powered by WinFo</a></p>
       <!--  <p><a href="reset-password.html">Forgot your password?</a></p>-->
    </div>
</div>
    <script src="<?php echo $full_url; ?>/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>

<?php
$conn=null;
?>
