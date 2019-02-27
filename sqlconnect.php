<?php
$user = 'root';
$password = 'root';
$db = 'mydb';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
//print_r($link);
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);
print_r($success);

if (!$success) {
    echo "not connect";
} else {
    echo "connect";
}

