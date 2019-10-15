<?php
//phpinfo(); 
/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt($string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'alok@123';
    $secret_iv = '128459633';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($output);
    return $output;
}
function decrypt($string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'alok@123';
    $secret_iv = '128459633';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

$plain_txt = "Alok@123";
$alok=encrypt($plain_txt);
echo "Plain Text =" .$alok. "\n";
$atul=decrypt($alok);
echo "Plain Text =" .$atul. "\n";

?>
