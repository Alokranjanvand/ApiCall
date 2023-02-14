<?php
session_start();
$RandomStr = '123456789bcdfghjkmnpqrstvwxyz';
//$RandomStr = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
for($i=0;$i<5;$i++)
{
	$ResultStr.=substr($RandomStr, rand(0, strlen($RandomStr)-1), 1);
}
$NewImage = imagecreatefromjpeg("img.jpg");//image create by existing image and as back ground 
$LineColor = imagecolorallocate($NewImage,233,239,239);//line color 
$TextColor = imagecolorallocate($NewImage, 255, 255, 255);//text color-white
//imageline($NewImage,1,1,40,40,$LineColor);//create line 1 on image 
//imageline($NewImage,1,100,60,0,$LineColor);//create line 2 on image 
imagestring($NewImage,5,15,6, $ResultStr, $TextColor);// Draw a random string horizontally 
$_SESSION['security_code'] = $ResultStr;// carry the data through session
header("Content-type: image/jpeg");// out out the image 
imagejpeg($NewImage);//Output image to browser 
?>
