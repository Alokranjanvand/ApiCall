<?php
error_reporting(0);
$url = '192.168.1.183/rest_api/login';
$data = array("action" => "login","email" => "alokranjan97@gmail.com","password" => "alok@123");
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
$response=json_decode($result,true);

foreach($response as $key=>$value):
if($key!='data'):
echo $key."=".$value;
echo "<br/>";
else:
foreach($value as $abkey=>$abvalue):
echo $abkey."=".$abvalue;
echo "<br/>";
endforeach;
endif;
endforeach;
?>