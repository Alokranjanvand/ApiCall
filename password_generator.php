<?php
$length = 10;
$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
shuffle($chars);
$password = implode(array_slice($chars, 0, $length));
echo $password;
?>


