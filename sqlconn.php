<?php
//echo "/--------------SQL CONNECT---------------/ <br>";

//$host = 'localhost';
//$user='kas';
//$pass='kas123';
//$db='mydb';


//$c = mysqli_connect();



function  connect($host,$user,$pass,$db){

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
        print_r(mysqli_error());
    }
    else
        //echo 'Connected successfully';
        return $conn;
}

?>
