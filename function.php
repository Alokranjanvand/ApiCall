<?php
	function EncryptPassword($string) {
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'parahit@#Technology';
	    $secret_iv = '128459633';
	    $key = hash('sha256', $secret_key);
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	    return $output;
	}
    function DecryptPassword($string) {
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'parahit@#Technology';
	    $secret_iv = '128459633';
	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    return $output;
	}
	//Base64 Encode and Decode String in PHP
	function base64url_encode($plainText) {
		$base64 = base64_encode($plainText);
		$base64url = strtr($base64, '+/=', '-_,');
		return $base64url;
	}

	function base64url_decode($plainText) {
		$base64url = strtr($plainText, '-_,', '+/=');
		$base64 = base64_decode($base64url);
		return $base64;
	}
	//Get Remote IP Address in PHP
	function getRemoteIPAddress() {
		$ip = $_SERVER['REMOTE_ADDR'];
		return $ip;
	}
	function getRealIPAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function secsToStr($secs) 
	{
		if($secs>=86400)
		{
			$days=floor($secs/86400);$secs=$secs%86400;$r=$days.' day';
			if($days<>1)
			{
				$r.='s';
			}
			if($secs>0)
			{
				$r.=', ';
			}
		}
		if($secs>=3600)
		{
			$hours=floor($secs/3600);$secs=$secs%3600;$r.=$hours.' hour';
			if($hours<>1)
			{
				$r.='s';
			}
			if($secs>0)
			{
				$r.=', ';
			}
		}
		if($secs>=60)
		{
			$minutes=floor($secs/60);$secs=$secs%60;$r.=$minutes.' minute';
			if($minutes<>1)
			{
				$r.='s';
			}
			if($secs>0)
			{
				$r.=', ';
			}
		}
		$r.=$secs.' second';
		if($secs<>1)
			{
				$r.='s';
			}
		return $r;
	}
	function url_fetch($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	function dateformat($date)
	{
	
		$date_format=date('d-m-Y h:i A',strtotime($date));
		return $date_format;
	}
	function current_date()
	{
		$date = date('Y-m-d H:i:s');
		return $date;
	}
	function Current_page_url()
	{
		if (isset($_SERVER["HTTPS"]) && !empty($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != 'on')) {
			$url = 'https://' . $_SERVER["SERVER_NAME"];
		} else {
			$url = 'http://' . $_SERVER["SERVER_NAME"];
		}
		if (($_SERVER["SERVER_PORT"] != 80)) {
			$url .= $_SERVER["SERVER_PORT"];
		}
		$url .= $_SERVER["REQUEST_URI"];
		return $url;
	}
	function baseurl()
	{
		$url = 'http://' . $_SERVER['HTTP_HOST'];
		return $url;
	}
	function mailfunction($to,$subject,$body)
	{
		$to = "viralpatel.net@gmail.com";
		$subject = "VIRALPATEL.net";
		$body = "Body of your message here you can use HTML too. e.g. <br> <b> Bold </b>";
		$headers = "From: Peter\r\n";
		$headers .= "Reply-To: info@yoursite.com\r\n";
		$headers .= "Return-Path: info@yoursite.com\r\n";
		$headers .= "X-Mailer: PHP5\n";
		$headers .= 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$mail_result=mail($to,$subject,$body,$headers);
		return $mail_result;
	}
	function whois_query($domain) 
	{
 
		// fix the domain name:
		$domain = strtolower(trim($domain));
		$domain = preg_replace('/^http:\/\//i', '', $domain);
		$domain = preg_replace('/^www\./i', '', $domain);
		$domain = explode('/', $domain);
		$domain = trim($domain[0]);
	 
		// split the TLD from domain name
		$_domain = explode('.', $domain);
		$lst = count($_domain)-1;
		$ext = $_domain[$lst];
	 
		// You find resources and lists 
		// like these on wikipedia: 
		//
		// http://de.wikipedia.org/wiki/Whois
		//
		$servers = array(
			"biz" => "whois.neulevel.biz",
			"com" => "whois.internic.net",
			"us" => "whois.nic.us",
			"coop" => "whois.nic.coop",
			"info" => "whois.nic.info",
			"name" => "whois.nic.name",
			"net" => "whois.internic.net",
			"gov" => "whois.nic.gov",
			"edu" => "whois.internic.net",
			"mil" => "rs.internic.net",
			"int" => "whois.iana.org",
			"ac" => "whois.nic.ac",
			"ae" => "whois.uaenic.ae",
			"at" => "whois.ripe.net",
			"au" => "whois.aunic.net",
			"be" => "whois.dns.be",
			"bg" => "whois.ripe.net",
			"br" => "whois.registro.br",
			"bz" => "whois.belizenic.bz",
			"ca" => "whois.cira.ca",
			"cc" => "whois.nic.cc",
			"ch" => "whois.nic.ch",
			"cl" => "whois.nic.cl",
			"cn" => "whois.cnnic.net.cn",
			"cz" => "whois.nic.cz",
			"de" => "whois.nic.de",
			"fr" => "whois.nic.fr",
			"hu" => "whois.nic.hu",
			"ie" => "whois.domainregistry.ie",
			"il" => "whois.isoc.org.il",
			"in" => "whois.ncst.ernet.in",
			"ir" => "whois.nic.ir",
			"mc" => "whois.ripe.net",
			"to" => "whois.tonic.to",
			"tv" => "whois.tv",
			"ru" => "whois.ripn.net",
			"org" => "whois.pir.org",
			"aero" => "whois.information.aero",
			"nl" => "whois.domain-registry.nl"
		);
	 
		if (!isset($servers[$ext])){
			die('Error: No matching nic server found!');
		}
	 
		$nic_server = $servers[$ext];
		$output = '';
		// connect to whois server:
		if ($conn = fsockopen ($nic_server, 43)) {
			fputs($conn, $domain."\r\n");
			while(!feof($conn)) {
				$output .= fgets($conn,128)."<br/>";
			}
			fclose($conn);
		}
		else { die('Error: Could not connect to ' . $nic_server . '!'); }
		return $output;
		//call Function echo whois_query('cubesquaretech.com');
	}
	function CPU_usage()
	{
		echo "Initial: ".memory_get_usage()." bytes \n";
		/* prints
		Initial: 361400 bytes
		*/
		 
		// let's use up some memory
		for ($i = 0; $i < 100000; $i++) {
			$array []= md5($i);
		}
		 
		// let's remove half of the array
		for ($i = 0; $i < 100000; $i++) {
			unset($array[$i]);
		}
		 
		echo "Final: ".memory_get_usage()." bytes \n";
		/* prints
		Final: 885912 bytes
		*/
		 
		echo "Peak: ".memory_get_peak_usage()." bytes \n";
	}
	function Shource_code_display($url)
	{	
		//$url="http://google.com/";
		$lines = file($url);
		foreach ($lines as $line_num => $line) { 
		// loop thru each line and prepend line numbers
		echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";
		}
		//call Shource_code_display('http://google.com/');
	}
	function fb_fan_count($facebook_name)
	{
		// Example: https://graph.facebook.com/digimantra
		$data = json_decode(file_get_contents("https://graph.facebook.com/".$facebook_name));
		echo $data->likes;
	}
	function sanitize_input_data($input_data){
		$input_data = trim(htmlentities(strip_tags($input_data,“,”)));
		if (get_magic_quotes_gpc())
		$input_data = stripslashes($input_data);
		$input_data = mysql_real_escape_string($input_data);
		return $input_data;
	}
	//Unzip files using PHP
	function unzip_file($file, $destination) 
	{
		// create object
		$zip = new ZipArchive() ;
		// open archive
		if ($zip->open($file) !== TRUE) {
			die ('Could not open archive');
		}
		// extract contents to destination directory
		$zip->extractTo($destination);
		// close archive
		$zip->close();
		echo 'Archive extracted to directory';
	}
	//Extract keywords from a webpage
	function extract_keyword($url)
	{
		//$url="http://www.emoticode.net/";
		$meta = get_meta_tags($url);
		$keywords = $meta['keywords'];
		// Split keywords
		$keywords = explode(',', $keywords );
		// Trim them
		$keywords = array_map( 'trim', $keywords );
		// Remove empty values
		$keywords = array_filter( $keywords );

		print_r( $keywords );
	}
	function check_https()
	{
		if ($_SERVER['HTTPS'] != "on") { 
			echo "This is not HTTPS";
		}else{
			echo "This is HTTPS";
		}
	}
	function data_uri($file, $mime) 
	{
		$contents=file_get_contents($file);
		$base64=base64_encode($contents);
		echo "data:$mime;base64,$base64";
	}
	function website_link($url)
	{
		//Call website_link('http://www.a1webservice.com');
		//$url="http://www.example.com";
		$html = file_get_contents($url);

		$dom = new DOMDocument();
		@$dom->loadHTML($html);

		// grab all the on the page
		$xpath = new DOMXPath($dom);
		$hrefs = $xpath->evaluate("/html/body//a");

		for ($i = 0; $i < $hrefs->length; $i++) {
			$href = $hrefs->item($i);
			$url = $href->getAttribute('href');
			echo $url.'<br/>';
		}
	}
	function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) 
	{
		$theta = $longitude1 - $longitude2;
		$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		$miles = acos($miles);
		$miles = rad2deg($miles);
		$miles = $miles * 60 * 1.1515;
		$feet = $miles * 5280;
		$yards = $feet / 3;
		$kilometers = $miles * 1.609344;
		$meters = $kilometers * 1000;
		return compact('miles','feet','yards','kilometers','meters'); 
		/*
		Show Example
			$point1 = array('lat' => 40.770623, 'long' => -73.964367);
			$point2 = array('lat' => 40.758224, 'long' => -73.917404);
			$distance = getDistanceBetweenPointsNew($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
			foreach ($distance as $unit => $value) {
			echo $unit.': '.number_format($value,4).'<br />';
			}
		*/
	}
		/************** 
	*@length - length of random string (must be a multiple of 2) 
	**************/  
	function readable_random_string($length = 6)
	{  
		$conso=array("b","c","d","f","g","h","j","k","l",  
		"m","n","p","r","s","t","v","w","x","y","z");  
		$vocal=array("a","e","i","o","u");  
		$password="";  
		srand ((double)microtime()*1000000);  
		$max = $length/2;  
		for($i=1; $i<=$max; $i++)  
		{  
		$password.=$conso[rand(0,19)];  
		$password.=$vocal[rand(0,4)];  
		}  
		return $password;  
	}
	function calculate_date($start_date,$end_date)
	{
		$start_date = strtotime('2016-01-01');
		$end_date = strtotime('2016-01-21');
		$s_date = strtotime($start_date);
		$e_date = strtotime($end_date);
		$days_difference = ceil(abs($e_date - $s_date) / (60 * 60 * 24));
		return $days_difference;
	}
	function convertNumberToWord($num = false)
	{
		$num = str_replace(array(',', ' '), '' , trim($num));
		if(! $num) {
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
			'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
		);
		$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
		$list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
			'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
			'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
		);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) {
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) {
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			} else {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
		$commas = count($words);
		if ($commas > 1) {
			$commas = $commas - 1;
		}
		return implode(' ', $words);
	}
		 
?>

