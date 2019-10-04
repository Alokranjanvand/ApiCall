<?php
include("upload_data.php");
$allowedFile = array("jpg","png");
$upload = new Upload($_FILES['file'],"images/".uniqid(),10000000000,$allowedFile);
		// show results
		$result = $upload->GetResult();
		$club_image=$result['path'];
echo $club_image;
?>