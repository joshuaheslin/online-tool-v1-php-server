<?php
echo "/--------------SQL CONNECT---------------/ <br>";

$host = 'http://35.189.47.93/';
$user='root';
$pass='kas123';
$db='mydb';

$conn = mysqli_connect($host, $user, $pass, $db);
//$c = mysqli_connect();
if (!$conn) {
   die('Could not connect: ' . mysqli_error());
}
else
   echo 'Connected successfully';

?>
