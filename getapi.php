<?php
function sendsms($mobile,$otp){
$otp_key="242066ATtBOPMCxdfdf5bbdadfdfasdfdf34d";
$url = "http://control.msg91.com/api/sendotp.php";
$data = array(
        "authkey" => $otp_key,
        "mobile" => $mobile,
		"otp" => $otp
        );
$query_url = sprintf("%s?%s", $url, http_build_query($data));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $query_url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$http_code = curl_getinfo($curl , CURLINFO_HTTP_CODE);
$result = curl_exec($curl);
header('Content-type: application/json');
curl_close($curl);
return $result;
}
$mobile='8285248951';
$otp='8285';
$call=sendsms($mobile,$otp);
print_r($call);
$array=json_decode($call,true);
echo $array['message'];
?>