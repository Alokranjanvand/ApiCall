
<?php
	$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rwc="http://oracle.reports/rwclient/">
   <soapenv:Header/>
   <soapenv:Body>
      <rwc:runJob>
         <!--Optional:-->
         <arg0>report=inv0110r.rdf DEFOR=PDF desformat=pdf userid=reports/reports@dsg destype=Cache server=rep_wls_reports_s67frp2 co=39 P_inv_type=I1 inv_series=GS19 inv_from=193682 inv_to_no=193682 print_batch_no=NO form_no=3page </arg0>
         <arg1>true</arg1>
      </rwc:runJob>
   </soapenv:Body>
</soapenv:Envelope>';
 
 
//The URL that you want to send your XML to.
$url = 'http://10.1.25.196:9006/reports/rwwebservice';
 
//Initiate cURL
$curl = curl_init($url);
 
//Set the Content-Type to text/xml.
curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
 
//Set CURLOPT_POST to true to send a POST request.
curl_setopt($curl, CURLOPT_POST, 1);
 
//Attach the XML string to the body of our request.
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
 
//Tell cURL that we want the response to be returned as
//a string instead of being dumped to the output.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
//Execute the POST request and send our XML.
$result = curl_exec($curl);
 
//Do some basic error checking.
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}
 
//Close the cURL handle.
curl_close($curl);
 
//Print out the response output.
$result;
$soap     = simplexml_load_string($result);
$response = $soap->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children('ns0', true)->children();
$soap1    = simplexml_load_string($response);
$job=$soap1->job;
$json=json_encode($job);
$data=json_decode($json,true);
$final_responce=array_shift($data);
print_r($final_responce);
echo"<br/>";
echo $final_responce['id'];


?>
