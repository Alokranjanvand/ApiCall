<?php
session_start();
$num1=rand(1,9); //Generate First number between 1 and 9  
$num2=rand(1,9); //Generate Second number between 1 and 9  
$captcha_total=$num1+$num2;
$math = "$num1"." + "."$num2"." =";
$NewImage = imagecreatefromjpeg("img.jpg");//image create by existing image and as back ground 
$LineColor = imagecolorallocate($NewImage,233,239,239);//line color 
$TextColor = imagecolorallocate($NewImage, 255, 255, 255);//text color-white
//imageline($NewImage,1,1,40,40,$LineColor);//create line 1 on image 
//imageline($NewImage,1,100,60,0,$LineColor);//create line 2 on image 
imagestring($NewImage,5,15,6, $math, $TextColor);// Draw a random string horizontally 
$_SESSION['security_code'] = $captcha_total;// carry the data through session
header("Content-type: image/jpeg");// out out the image 
imagejpeg($NewImage);//Output image to browser 
?>
