<?php 
include_once("db_connect.php");
$sql = "SELECT * FROM chat_view where main_parent_id in (1) ORDER BY parent_id";
$result = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
// Create an array to conatin a list of items and parents
$menus = array();
// Builds the array lists with data from the SQL result
while ($items = mysqli_fetch_assoc($result)) {
// Create current menus item id into array
$menus[$items['id']] = $items;
}
echo"<pre>";
print_r($menus);
echo "test";
echo $menus[1]['title'];
?>
