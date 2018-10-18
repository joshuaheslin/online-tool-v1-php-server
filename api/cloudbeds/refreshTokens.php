<?php
//echo "hi";
include('includes/DbOperation.php');
include('includes/Functions.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['login_token']) && !empty($_POST['refresh_token']) && !empty($_POST['app_email'])) {

        $db = new DbOperation();
        $fn = new Functions();

        $email = $_POST['app_email'];
        $login_token = $_POST['login_token'];
        $refresh_token = $_POST['refresh_token'];
        // echo $email;
        // echo $login_token;
        // echo $refresh_token;

        if ($db->userWillLogin($email, $login_token)) {

            $cb_responseJson = $fn->refreshToken($refresh_token);
            $cb_response = json_decode($cb_responseJson);
            //echo $cb_responseJson;

            $new_refresh_token = $cb_response->refresh_token;
            $new_access_token = $cb_response->access_token;
            // echo $new_refresh_token;
            // echo $new_access_token;

            if ($cb_response->error == "invalid_request") {
                $response['error'] = true;
                $response['message'] = "The refresh token is invalid.";
                echo json_encode($response);
            } else {
                $result = $db->updateTokensForUser($email, $login_token, $new_refresh_token, $new_access_token);
            
                if ($result == 0){
                    //user doesn't exist, or SQL query fault
                    $response['error'] = true;
                    $response['message'] = "Could not connect to SQL, or invalid user";
                    echo json_encode($response);
                } else {
                    //user exists, tokens are refreshed and stored, now return them
                    $response['error'] = false;
                    $merge = array_merge($response, $result);
                    echo json_encode($merge);
                }

            }
        } else {
            $response['error'] = true;
            $response['message'] = "User is invalid";
            echo json_encode($response);
        }

    } else {
        $response['error'] = true;
        $response['message'] = "Incorrect parameters set";
        echo json_encode($response);
    }

} else {
    $response['error'] = true;
    $response['message'] = "Request not allowed";
    echo json_encode($response);
}

//echo json_encode($response);
?>