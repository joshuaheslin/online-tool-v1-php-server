<?php
//echo "hi";
include('includes/DbOperationGW.php');
include('includes/Functions.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['g_gateway_name'])) {

    $dbGW = new DbOperationGW();
    echo $_GET['g_gateway_name'];

    $factory_name = $_GET['g_gateway_name'];

    $fn = new Functions();
    $tokenAuth = $fn->TokenAuth();

    //$url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/' . $lockName . '/status';
    $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/'.$factory_name.'/status';
    $jsonResult = $fn->CallAPIWithToken("GET", $url, $tokenAuth, false);
    $lock_info = json_decode($jsonResult);
    $info = $lock_info->info;
    echo $jsonResult;
    foreach ($info as $value){
      //echo $value;
      $last_heart_beat = $value;
      echo $last_heart_beat;
      //echo "here4";
    }

    $result = $dbGW->storeLastHeartBeatInDatabase($last_heart_beat, $_GET['g_gateway_name']);

    if ($result == SQL_SUCCESSFUL) {
      $response['error'] = false;
      $response['message'] = "Successful status input";
      $response['last_heart_beat'] = $last_heart_beat;

    } else if ($result == SQL_UNSUCCESSFUL) {
      $response['error'] = true;
      $response['message'] = "SQL Insert error";

    } else if ($result == FACTORY_NAME_DOES_NOT_EXIST) {
      $response['error'] = true;
      $response['message'] = "Factory name does not exist";

    } else {
      $response['error'] = true;
      $response['message'] = "Unknown Error";
    }
  } else {
    $response['error'] = true;
    $response['message'] = "Incorrect parameters set";
  }
} else {
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);
?>
