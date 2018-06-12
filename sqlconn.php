<?php
//echo "/--------------SQL CONNECT---------------/ <br>";

$host = 'localhost';
$user='user';
$pass='';
$db='mydb';

$conn = mysqli_connect($host, $user, $pass, $db);
//$c = mysqli_connect();
if (!$conn) {
   die('Could not connect: ' . mysqli_error());
}
else
   //echo 'Connected successfully';

?>
