<?php
function resize($width, $height){
	list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	$path = 'uploads/'.$width.'x'.$height.'_'.$_FILES['image']['name'];
	
	/*-------------check if file exists---------------------*/
    if(file_exists($path))
	 {
	 $name_of_file = basename($_FILES['image']['name']);
	 $ren_file=explode(".",$name_of_file);
	 $r_file=$ren_file[0].date('d-m-i-s').'.'.$ren_file[1];
	 $path='uploads/'.$width.'x'.$height.'_'.$r_file;
	 }
	
	/*--------------- file checking end-----------------------------*/
	$imgString = file_get_contents($_FILES['image']['tmp_name']);
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	switch ($_FILES['image']['type']) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	return $path;
	imagedestroy($image);
	imagedestroy($tmp);
}
?>
