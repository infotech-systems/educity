<?php
 function OpenDB()
  {
   $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
   $DBUser   = 'root';
   $DBPass   = '';
   $DBName   = 'pafa_site';
   $DBLink = new PDO('mysql:host='.$DBServer.';dbname='.$DBName, $DBUser, $DBPass);
   $DBLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
   return $DBLink;
  }

  function execTest($sql)
  {
  global $DBLink;
  $ret_arr=array();
  $ret=mysql_query($sql,$DBLink);
  if(!$ret)
   {
   $ret_arr[0]=false;
   $ret_arr[1]=mysql_errno();
   $ret_arr[2]=mysql_error();
   }
  else
   {
   $ret_arr[0]=true;
   }

  if($ret_arr[0])
   {
   echo "<h1>Query OK and Validated</h1>";
   //$rCount=rowCount($ret);
   //echo "Affected Rows:$rCount";
   }
  else
   {
   echo "<font color=red><h1 >Query Not OK Validation Error!";
   echo "<br>Error No  :{$ret_arr[1]}";
   echo "<br>Error Desc:{$ret_arr[2]}";
   echo "</h1></font>";
   }

  }

  function getTables()
  {
  global $DBLink;
  global $DBName;
  $ret=mysql_list_tables($DBName,$DBLink)
   or die(mysql_errno().":".mysql_error());
  return $ret;
  }
 function getNameType($result,$ctr)
  {
  global $DBLink;
  global $DBName;
  $name_type=array();
  $name_type[0]=mysql_field_name($result,$ctr)
   or die(mysql_errno().":".mysql_error());
  $name_type[1]=mysql_field_type($result,$ctr)
   or die(mysql_errno().":".mysql_error());
  $name_type[2]=mysql_field_flags($result,$ctr);
   //or die(mysql_errno().":".mysql_error());
  return $name_type;
  }
 function execInsert($sql)
  {
  global $DBLink;
  $ret=mysql_query($sql,$DBLink)
   or die(mysql_errno().":".mysql_error());
   $rows=mysql_affected_rows();
   return $rows;
  }
 function execUpdate($sql)
  {
  global $DBLink;
  $ret=mysql_query($sql,$DBLink)
   or die(mysql_errno().":".mysql_error());
  $rows=mysql_affected_rows();
  return $rows;
  }
 function execSelect($sql)
  {
  global $DBLink;
  $ret=mysql_query($sql,$DBLink)
   or die(mysql_errno().":".mysql_error());
  return $ret;
  }

 function rowCount($result)
  {
  global $DBLink;
  $ret=mysql_num_rows($result);
  //or die(mysql_error()."<br>Error SQL ==>>$sql");
  return $ret;
  }

 function execDelete($sql)
  {
  global $DBLink;
  $ret=mysql_query($sql,$DBLink)
   or die(mysql_errno().":".mysql_error());
  $rows=mysql_affected_rows();
  return $rows;
  }

 function execLock($table)
  {
  global $DBLink;
  $sql="LOCK TABLE $table";
  //$ret=pg_exec($DBLink,$sql);
  }

 function getRows($result)
  {
  global $DBLink;
  return mysql_fetch_array($result);

  }
  
  function british_to_ansi($date)
 {
    list($day, $month, $year) = explode('/', $date);
    $day = strlen($day) < 2 ? "0".$day : $day ;
    $month = strlen($month) < 2 ? "0".$month : $month ;
    $date = $year . "-" . $month . "-" . $day ;
    return $date ;
 }


 function ansi_to_british($date)
 {
    list($year,$month,$day) = explode('-', $date);
    $day = strlen($day) < 2 ? "0".$day : $day ;
    $month = strlen($month) < 2 ? "0".$month : $month ;
    $date = $day."/".$month."/".$year ;
    return $date ;
 }   

 function CloseDB()
  {
  global $DBLink;
  mysql_close($DBLink);
  }

function quote2entities($string,$entities_type='number')
{
    $search                     = array("\"","'");
    $replace_by_entities_name   = array("&quot;","&apos;");
    $replace_by_entities_number = array("&#34;","&#39;");
    $do = null;
    if ($entities_type == 'number')
    {
        $do = str_replace($search,$replace_by_entities_number,$string);
    }
    else if ($entities_type == 'name')
    {
        $do = str_replace($search,$replace_by_entities_name,$string);
    }
    else
    {
        $do = addslashes($string);
    }
    return $do;
}
?>

<?php

function fileCkecking($FILES)
{

$msg=array();
$error=array();
$allowedExtensions = array("txt","doc","pdf","jpg","jpeg","gif","zip","png");
//print_r($FILES);
 	foreach ($_FILES as $key => $file) {
  
	if(!empty($file['name']))
	  {
	    $bas_dir="./uploads/";
        $name_of_file = basename($file['name']);
        $path_of_uploaded_file=$bas_dir.$name_of_file;
        $tmp_path = $file["tmp_name"];
        $myfile=strtolower($file['name']);



//	    if ($file['tmp_name'] > '') 
	    if ($tmp_path > '') 
		{

     
           if(file_exists($path_of_uploaded_file))
             {
             $name_of_file = basename($file['name']);
             $ren_file=explode(".",$name_of_file);
             $r_file=$ren_file[0].date('d-m-i-s').'.'.$ren_file[1];
             $path_of_uploaded_file=$bas_dir.$r_file;

             $remove_file["$key"]=$r_file;
             move_uploaded_file($tmp_path,$path_of_uploaded_file);
             }
             else
             {
              $remove_file["$key"]=$file['name'];
              move_uploaded_file($tmp_path,$path_of_uploaded_file);
             }
        
    }
  }
} 
echo $msg['invalid'];   
return $remove_file;
}
?>


<?php
/*---------------------- compress image site---------------------*/
	function compress($source, $destination, $quality) {
	//echo "\\\\\ $source <br> $destination";
		$info = getimagesize($source);
		
		//echo "<br> Info:$info";
		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}
?>

<?php
/*-------------------- create array of two date value-----*/
function createDateRangeArray($strDateFrom,$strDateTo)
{
    $aryRange=array();
    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}
?>

<?php

function fileCkecking2($FILES)
{

$msg=array();
$error=array();
$allowedExtensions = array("txt","doc","pdf","jpg","jpeg","gif","zip","png");
//print_r($FILES);
 	foreach ($_FILES as $key => $file) {
  
	if(!empty($file['name']))
	  {
	    $bas_dir="./uploads/";
        $name_of_file = basename($file['name']);
        $path_of_uploaded_file=$bas_dir.$name_of_file;
        $tmp_path = $file["tmp_name"];
        $myfile=strtolower($file['name']);



//	    if ($file['tmp_name'] > '') 
	    if ($tmp_path > '') 
		{

     
           if(file_exists($path_of_uploaded_file))
             {
             $name_of_file = basename($file['name']);
             $ren_file=explode(".",$name_of_file);
             $r_file=$ren_file[0].date('d-m-i-s').'.'.$ren_file[1];
             $path_of_uploaded_file=$bas_dir.$r_file;

             $remove_file["$key"]=$r_file;
             copy($tmp_path,$path_of_uploaded_file);
             }
             else
             {
              $remove_file["$key"]=$file['name'];
              copy($tmp_path,$path_of_uploaded_file);
             }
        
    }
  }
} 
echo $msg['invalid'];   
return $remove_file;
}
function fileCkecking3($FILES)
{
$msg=array();
$error=array();
$allowedExtensions = array("jpg","jpeg","gif","png");
//print_r($FILES);
  foreach ($_FILES as $key => $file) {
  
  if(!empty($file['name']))
  {
  $bas_dir="./uploads/fullsize/";
        $name_of_file = basename($file['name']);
        $path_of_uploaded_file=$bas_dir.$name_of_file;
        $tmp_path = $file["tmp_name"];

    if ($file['tmp_name'] != '') {
      if (!in_array(end(explode(".",
            strtolower($file['name']))),
            $allowedExtensions)) {
        $msg['invalid']='<font color="red" size="3">This <b>('.$file['name'].')</b> is an invalid file type</font>';
        $error['errorfile']="Error";
      }
      else
      {
          // echo "Path: $path_of_uploaded_file";
       if(file_exists($path_of_uploaded_file))
             {
             $name_of_file = basename($file['name']);
             $ren_file=explode(".",$name_of_file);
             $r_file=$ren_file[0].date('d-m-i-s').'.'.$ren_file[1];
             $path_of_uploaded_file=$bas_dir.$r_file;

             $remove_file["$key"]=$r_file;
             move_uploaded_file($tmp_path,$path_of_uploaded_file);
             }
             else
             {
              $remove_file["$key"]=$file['name'];
              move_uploaded_file($tmp_path,$path_of_uploaded_file);
             }
      }
    }
  }
  } 
   echo $msg['invalid'];   
  return $remove_file; 
}



function resize_image($file, $w, $h, $crop=false) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    
    //Get file extension
    $exploding = explode(".",$file);
    $ext = end($exploding);
    
    switch($ext){
        case "png":
            $src = imagecreatefrompng($file);
        break;
        case "jpeg":
        case "jpg":
            $src = imagecreatefromjpeg($file);
        break;
        case "gif":
            $src = imagecreatefromgif($file);
        break;
        default:
            $src = imagecreatefromjpeg($file);
        break;
    }
    
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $dst;
}
?>
