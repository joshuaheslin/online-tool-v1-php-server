<?php

include('includes/DbOperation.php');

//$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {
         //echo "hi";
        $db = new DbOperation();
        //echo "hi2";
        if ($db->userWillLogin($_POST['email'], $_POST['password'])) {

            $logins = $db->incrementLoginEvent($_POST['email']);

            if ($logins) {
                $response['success'] = true;
                $response['message'] = "User is verified.";
                $merge = array_merge($response, $logins);
                $response = $merge;
            } else {
                $response['success'] = false;
                $response['message'] = 'Increment login event failed';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Invalid username or password';
        }

    } else {
        $response['success'] = false;
        $response['message'] = 'Parameters are missing';
    }

} else {
    $response['success'] = false;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);
?>
