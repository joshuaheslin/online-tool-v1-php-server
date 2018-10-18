<?php

include('includes/Functions.php');
$fn = new Functions();

$code = $_GET['code'];
$responseJson = $fn->CallAuthAPI($code);

$response = json_decode($responseJson);
$access_token = $response->access_token;
$refresh_token = $response->refresh_token;
$expires_in = $response->expires_in;

// echo "<br>access_token: ";
// echo $response->access_token;
// echo " refresh_token: ";
// echo $response->refresh_token;
// echo " expires_in: ";
// echo $response->expires_in;
// echo "<br>";

//auth.php?error=access_denied&message=The+resource+owner+or+authorization+server+denied+the+request.

function authSuccessful($access_token){
    if(isset($access_token) && !empty($access_token)) {
        return include("auth-success.html");
    } else {
        return include("auth-fail.html");
    }
}

?>


<?php 
include('auth-header.html'); 
    include("auth-success.php"); //authSuccessful($access_token); 
include('auth-footer.html');
?>


