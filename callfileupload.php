<?php
echo"hello";
$target_url = 'upload.php';
$File= 'test.wav';
$file_name_with_full_path = realpath($File);

$post = array();

$post['Name'] = 'test12233';
//$cfile = new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
$cfile = new CURLFILE($file_name_with_full_path);
             
$post['file_contents'] =$cfile;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
if($errno = curl_errno($ch)) {
        echo 'Curl error: ' . curl_errno($ch)." ==> ".curl_error($ch);
}
else{
        $result = curl_exec($ch);
        echo $result;
}
curl_close ($ch);

?>
