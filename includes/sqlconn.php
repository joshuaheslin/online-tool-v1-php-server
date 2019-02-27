<?php
//echo "/--------------SQL CONNECT---------------/ <br>";

include "Constants.php";

function connect(){

    $link = mysqli_init();
    $conn = mysqli_real_connect($link, DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    //print_r($conn);

    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
        print_r(mysqli_error());
    }
    else
        //echo 'Connected successfully';
        return $link;
}

?>
