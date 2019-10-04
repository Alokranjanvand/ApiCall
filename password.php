<?php
$string_to_encrypt="qJB0rGtIn5UB1xG03efyCq";
$password="alok@123";
$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
echo $encrypted_string;
?>