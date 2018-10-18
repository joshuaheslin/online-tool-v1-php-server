<?php

include('includes/DbOperation.php');
include('includes/Constants.php');
$db = new DbOperation();

$login_token = $_POST['login_token'];
$email = $_POST['email'];
$password = $_POST['password'];
$access_token = $_POST['access_token'];
$refresh_token = $_POST['refresh_token'];
$expires_in = $_POST['expires_in'];

// echo $login_token;
// echo $email;
// echo $password;
// echo $access_token;
// echo "RE:    " . $refresh_token;
// echo $expires_in;

$result = $db->insertAuthorisedUserAndTheirTokens($login_token, $email, $password, $access_token, $refresh_token, $expires_in);

function displayResult($result) {
    if ($result == true) {
        return "<h4>Success! You're all set up.</h4>
                <p>Use the credentials you just entered to log into the Integration Tool on your PC.</p>
                <img src='screenshot.png' alt='Picture Integration Login Form' width='400'> ";
    } else {
        return "Something went wrong. Please contact support@kas.com.au";
    }
}

include('auth-header.html');
echo "
    <div class='row'>
        <div class='twelve columns'>
        ";
echo displayResult($result);
            // <h4>Sorry, something went wrong. </h4>
            // <p>Your Cloudbeds account is not connected. The authorised has been denied or failed.</p>
            // <p>Please go back and try the entire process again.</p>
echo "
        </div>
    </div>
    ";
include('auth-footer.html');


?>