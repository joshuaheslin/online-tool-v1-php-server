<?php
//echo "hi";
include('includes/DbOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['k_passcode']) && !empty($_GET['k_passcode_secret'])) {

    $db = new DbOperation();
    // echo $_GET['k_passcode'];
    // echo $_GET['k_passcode_secret'];

    $result = $db->getActiveKeysForPasscode($_GET['k_passcode'], $_GET['k_passcode_secret']);

    if ($result == K_PASSCODE_SECRET_DOES_NOT_MATCH) {
        $response['error'] = true;
        $response['message'] = "K_PASSCODE_SECRET_DOES_NOT_MATCH";
        echo json_encode($response);

    } else if ($result == K_PASSCODE_DOES_NOT_EXIST) {
        $response['error'] = true;
        $response['message'] = "K_PASSCODE_DOES_NOT_EXIST";
        echo json_encode($response);
    } else {

        $response['error'] = false;
        $response['message'] = "Success";
        $response['keys'] = $result;
        echo json_encode($response); //$keys
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