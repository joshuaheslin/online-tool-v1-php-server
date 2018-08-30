<?php
//echo "hi";
include('includes/DbOperation.php');
//echo "hi-included";
include('includes/Functions.php');
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_user_id']) && isset($_POST['l_factory_name']) && isset($_POST['u_password'])) {

        $db = new DbOperation();

        if ($db->userIdIsValid($_POST['u_user_id'])) {

            if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

              //get admin key token now, then insert newly activated lock
              $fn = new Functions();
              $tokenAuth = $fn->TokenAuth();

              $factory_name = $_POST['l_factory_name'];
              //$factory_name = "UL002870";

              //$url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/' . $lockName . '/status';
              $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/'.$factory_name.'/adminKey';
              $jsonResult = $fn->CallAPIWithToken("GET", $url, $tokenAuth, false);
              $lock_info = json_decode($jsonResult);
              $info = $lock_info->info;
              foreach ($info as $value){
                //echo $value;
                $admin_key = $value;
                //echo "here4";
              }

              $result = $db->insertActivatedLock($_POST['u_user_id'], $_POST['l_factory_name'], $admin_key);

              if ($result == LOCK_ACTIVATE_SUCCESSFUL) {
                  $response['error'] = false;
                  $response['message'] = 'Activated lock bound successfully';
              } elseif ($result == LOCK_ACTIVATE_UNSUCCESSFUL) {
                  $response['error'] = true;
                  $response['message'] = 'Activated lock bound unsuccessful';
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
