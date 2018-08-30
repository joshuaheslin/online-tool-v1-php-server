<?php
//echo "hi";
include('includes/DbOperationGW.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['u_user_id'])) {

    $dbGW = new DbOperationGW();
    //echo $_GET['u_user_id'];

    $gateways = $dbGW->getActivatedGWsForUserID($_GET['u_user_id']);

    echo json_encode($gateways);

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
