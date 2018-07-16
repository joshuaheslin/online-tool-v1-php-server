<?php
//echo "/--------------SQL CONNECT---------------/ <br>";

$host = 'localhost'; //localhost
$user= 'user'; //user //root
$pass= '';  // 'empty' //jDHWjnFwcpbN2r
$db= 'mydb';

$conn = mysqli_connect($host, $user, $pass, $db);
//$c = mysqli_connect();
if (!$conn) {
   die('Could not connect: ' . mysqli_error());
}
else
   echo 'Connected successfully';

?>
