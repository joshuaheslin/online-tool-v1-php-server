<?php
//echo "hi";
include('includes/DbOperation.php');
//echo "hi-included";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_user_id']) && isset($_POST['l_factory_name']) && isset($_POST['l_lock_title'])) {
        //echo "hi";
        $db = new DbOperation();
        //echo "hi2";

        if ($db->userIdIsValid($_POST['u_user_id'])) {

            //if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

              $result = $db->updateLock($_POST['l_factory_name'], $_POST['l_lock_title']);

              if ($result == LOCK_RESET_SUCCESSFUL) {
                  $response['error'] = false;
                  $response['message'] = 'Update lock successfully';

              } else if ($result == LOCK_RESET_UNSUCCESSFUL) {
                  $response['error'] = true;
                  $response['message'] = 'Update lock unsuccessful';
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
