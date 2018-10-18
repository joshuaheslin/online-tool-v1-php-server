<?php
//echo "hi";
include('includes/DbOperation.php');
include('includes/DbOperationGW.php');
//echo "hi-included";
include('includes/Functions.php');
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_user_id']) && isset($_POST['g_factory_name']) && isset($_POST['u_password'])) {

        $db = new DbOperation();
        $dbGW = new DbOperationGW();

        if ($db->userIdIsValid($_POST['u_user_id'])) {

            if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

              //get admin key token now, then insert newly activated lock
              $fn = new Functions();
              $tokenAuth = $fn->TokenAuth();

              $factory_name = $_POST['g_factory_name'];
              //echo $factory_name;

              //$url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/' . $lockName . '/status';
              $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/'.$factory_name.'/adminKey';
              $jsonResult = $fn->CallAPIWithToken("GET", $url, $tokenAuth, false);
              $lock_info = json_decode($jsonResult);
              $info = $lock_info->info;
              //echo $jsonResult;
              foreach ($info as $value){
                //echo $value;
                $admin_key = $value;
                //echo "here4";
              }
              //echo "hi";
              $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways';
              $jsonResult = $fn->CallAPIWithToken("GET", $url, $tokenAuth, false);
              $lock_info = json_decode($jsonResult);
              $info = $lock_info->info;
              //echo $jsonResult;
              foreach ($info as $value){

                $json_factory_name = $value->s_gateway_name;
                //echo $json_factory_name;

                if ($json_factory_name == $factory_name) {
                  $gateway_mac = $value->s_gateway_mac;
                  //echo $gateway_mac;
                }
              }

              $result = $dbGW->insertActivatedGateway($_POST['u_user_id'], $_POST['g_factory_name'], $admin_key, $gateway_mac);

              if ($result == LOCK_ACTIVATE_SUCCESSFUL) {
                  $response['error'] = false;
                  $response['message'] = 'Activated gateway bound successfully';
              } elseif ($result == LOCK_ACTIVATE_UNSUCCESSFUL) {
                  $response['error'] = true;
                  $response['message'] = 'unsuccessful - Activated gateway bound';
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
