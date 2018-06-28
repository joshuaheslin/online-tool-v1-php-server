<?php
echo "/--------------SQL CONNECT---------------/ <br>";

$host = 'http://35.189.47.93/'; //localhost
$user='root'; //user
$pass='jDHWjnFwcpbN2r';  // 'empty'
$db='mydb';

$conn = mysqli_connect($host, $user, $pass, $db);
//$c = mysqli_connect();
if (!$conn) {
   die('Could not connect: ' . mysqli_error());
}
else
   echo 'Connected successfully';

?>
