<?php
//echo "/--------------SQL CONNECT---------------/ <br>";

include "Constants.php";

function connect(){

    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
        print_r(mysqli_error());
    }
    else
        //echo 'Connected successfully';
        return $conn;
}

?>
