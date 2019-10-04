<?php



    $RealTitleID = $_FILES['file']['name'];
    $ch = curl_init("http://localhost/Api_call/upload.php"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $args['file'] = new CurlFile($_FILES['file']['tmp_name'],'file/exgpd',$RealTitleID);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args); 
    $result = curl_exec($ch);
	echo $result;	

?>
