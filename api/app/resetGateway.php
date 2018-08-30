<?php
//echo "hi";
include('includes/DbOperation.php');
include('includes/DbOperationGW.php');
//echo "hi-included";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_user_id']) && isset($_POST['g_factory_name']) && isset($_POST['u_password'])) {
        //echo "hi";
        $db = new DbOperation();
        //echo "hi2";
        $dbGW = new DbOperationGW();

        if ($db->userIdIsValid($_POST['u_user_id'])) {

            if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

              $result = $dbGW->removeActivatedGateway($_POST['g_factory_name']);

              if ($result == LOCK_RESET_SUCCESSFUL) {
                  $response['error'] = false;
                  $response['message'] = 'Reset gateway successfully';

              } else if ($result == LOCK_RESET_UNSUCCESSFUL) {
                  $response['error'] = true;
                  $response['message'] = 'Reset gateway unsuccessful';
              } else {
                $response['error'] = true;
                $response['message'] = 'Unknown Error';
              }

            } else {
              $response['error'] = true;
              $response['message'] = 'Invalid password';
            }

        } else {
            $response['error'] = true;
            $response['message'] = 'Invalid user id';
        }

    } else {
        $response['error'] = true;
        $response['message'] = 'Parameters are missing';
    }

} else {
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);
?>
