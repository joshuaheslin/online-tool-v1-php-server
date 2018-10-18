<?php
//echo "hi";
include('includes/DbOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!empty($_GET['login_token']) && !empty($_GET['email'])) {

        $db = new DbOperation();

        $email = $_GET['email'];
        $login_token = $_GET['login_token'];

        // echo $email;
        // echo $login_token;

        $result = $db->getTokensForUser($email, $login_token);
        if ($result == 0) {
            $response['error'] = true;
            $response['message'] = "Incorrect values";
            echo json_encode($response);
        } else {
            $response['error'] = false;
            $merge = array_merge($response, $result);
            echo json_encode($merge);
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