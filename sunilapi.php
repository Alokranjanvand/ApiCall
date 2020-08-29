<?php

$curl = curl_init();
//$a=$_GET['a'];
//$b=$_GET['b'];
$a="54e";
$b="200310";

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
$abc=array();
$arr=json_decode($response,true);
$abc=$arr[0];
$data=array_keys($abc);
$query = "DROP TABLE IF EXISTS `$b`; CREATE TABLE `$b` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, ";
foreach($data as $key)
{
  $query .= "$key" . " " ."VARCHAR (255)," ;
}
$query.="PRIMARY KEY (`id`)";
$query .= " ); ";
$final_query=rtrim($query,',');
echo $final_query;//output and check your query
$data=implode(",",$data);
//echo $data;
$arr2=json_decode($response,true);
echo"<pre>";
//print_r($arr2);
foreach($arr2 as $value)
{
	$key=array_keys($value);
  $col=implode(",",$key);
	$val=implode("','",$value);
	 echo $sql="INSERT INTO `$b` ($col) VALUES ($val)";
echo"<br><br><br><br><br>";
}
?>
