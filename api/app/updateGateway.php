<?php
//echo "hi";
include('includes/DbOperation.php');
//echo "hi-included";
include('includes/DbOperationGW.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_user_id']) && isset($_POST['g_factory_name']) && isset($_POST['g_gateway_title'])) {
        //echo "hi";
        $db = new DbOperation();
        //echo "hi2";
        $dbGW = new DbOperationGW();

        if ($db->userIdIsValid($_POST['u_user_id'])) {

            //if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

              $status_text = $_POST['g_gateway_status'];

              $result = $dbGW->updateGateway($_POST['g_factory_name'], $_POST['g_gateway_title'], $status_text);

              if ($result == SQL_SUCCESSFUL) {
                  $response['error'] = false;
                  $response['message'] = 'Update gateway successfully';

              } else if ($result == SQL_UNSUCCESSFUL) {
                  $response['error'] = true;
                  $response['message'] = 'Unsuccessful Update gateway';

              } else if ($result == FACTORY_NAME_DOES_NOT_EXIST){
                  $response['error'] = true;
                  $response['message'] = 'Device does not exist in database';
                  
              } else {
                  $response['error'] = true;
                  $response['message'] = 'Unknown Error';
              }

            //} else {
            //  $response['error'] = true;
            //  $response['message'] = 'Invalid password';
            //}

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
