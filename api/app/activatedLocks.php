<?php
//echo "hi";
include('includes/DbOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['u_user_id'])) {

    $db = new DbOperation();
    //echo $_GET['u_user_id'];

    $locks = $db->getActivatedLocksForUserID($_GET['u_user_id']);

    echo json_encode($locks);

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
