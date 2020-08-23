<?php

$curl = curl_init();
$a=$_GET['a'];
$b=$_GET['b'];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://singapore.decipherinc.com/api/v1/surveys/selfserve/".$a."/".$b."/data?format=json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "x-apikey: dcd6b2y1fxra54gs3qc5x4j52eaa93w1d1d014sccvzw9b9zykfbpyd5f8qcuspc"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
