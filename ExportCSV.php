<?php
include_once("../include/config.php");
include_once("../include/session.php");

$uid=$_SESSION['user_id'];
$u_id=$_SESSION['id'];
$csv_header = "Conference Name ,Start Date, End date \n";
//$csv_header .= "\n";

$csv_row ='';
$current_datetime=date('Y-m-d');                                                   
if($uid=='admin'){
	$query="select conf_name,start_date,end_date from conference_config order by id DESC limit 3";
}
else{
	$query="select conf_name,start_date,end_date from conference_config where user_id='".$u_id."' order by id DESC limit 3";                                                        
}
$result=mysql_query($query);
$num_column=mysql_num_rows($result);
while($row=mysql_fetch_array($result)) {
	for($i=0;$i<$num_column;$i++) {
		$csv_row .= '"' . $row[$i] . '",';
	}
	$csv_row .= "\n";
}	
/* Download as CSV File */

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=report-'.time().'.csv');
echo $csv_header . $csv_row;
exit;
?>

