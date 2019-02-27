<?php

//MARK: HEADERS

include('includes/DbOperation.php');
//echo "hi-included";
include('includes/Functions.php');
$response = array();

$fn = new Functions();
$db = new DbOperation();

require 'twilio-php-master/Twilio/autoload.php'; // Loads the library
use Twilio\Rest\Client;


//MARK: RECEIVE JSON


//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT') != 0){
    throw new Exception('Request method must be PUT!');
}
//echo "hi";
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}
//echo "hi";
//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));
// echo $content;

//Attempt to decode the incoming RAW post data from JSON.
$result = json_decode($content, true);
//echo "decoded: \n";
// print_r($result);

$i = 0;


//MARK: GENERATE RANDOM PASSCODE


do {
    //--------Uncomment below to debug the passcode generation--------//
    /*
    echo "i:" . $i ."\n";
    if ($i == 0){
        $passcode = "123456";
        echo "passcode exsits"; echo "\n";
    } else {
        $passcode = $fn->createRandomPasscode(6);
    }
    echo $passcode;
    $i++;
    */
    $passcode = $fn->createRandomPasscode(6);
} while ($db->passcodeAlreadyExists($passcode));
echo $passcode; echo "\n";


// //MARK: INSERT DATA INTO SQL

echo "Server: $_SERVER \n";


$app_account = $result['owner_id'];
$target_mobile = $result['receiver_phone'];
foreach ($result['keys'] as $qty => $keyArray) {
    // echo "Key: $key; Value: $value\n";
    // foreach ($keyArray as $key => $value) {
    //     echo "Key: $key; Value: $value\n";
    // }
    //echo "next row \n";
    $sharedKey = new SharedKey();
    $sharedKey->lock_factory_number = $keyArray['s_lock_name'];
    $sharedKey->room_number = $keyArray['s_room_name'];
    $sharedKey->key_string = $keyArray['s_key_code'];
    $sharedKey->start_time = $keyArray['l_start_time'];
    $sharedKey->end_time = $keyArray['l_end_time'];

    print_r($sharedKey);
    
    $result = $db->insertKeyDataIntoSQL($app_account, $target_mobile, $sharedKey, $passcode);

}


//MARK: NOW HANDLE THE SQL RESULT + SMS USER


if ($result == 0) {

    $sid = 'ACef4f533e120249f8e0e5e75f33c17f2b';
    $token = '043ed086f4665ac2d04223e62f61eef4';
    $client = new Client($sid, $token);

    $client->messages->create(
    $target_mobile,
    array(
        'from' => '+61428475906',
        'body' => 'You have received a mobile key! 

Download the KAS Mobile Access app and enter this passcode to retreive your key. 
      
App Download: kas.com.au 

Enter this Passcode: '.$passcode.'

Thanks, Hotel Name 
- on behalf of KAS Keyless Access Security',)
    );

    $response['error'] = false;
    $response['message'] = "Key sent successfully";

} else {
    $response['error'] = true;
    $response['message'] = "Something went wrong with SQL insert data";
}


//MARK: RETURN FINAL RESULT


echo json_encode($response);


//MARK: CLASSES


class SharedKey { //used for Key Sharing Callback. 
    public $lock_factory_number;
    public $room_number;
    public $key_string;
    public $start_time;
    public $end_time;
}


//If json_decode failed, the JSON is invalid.
// if(!is_array($decoded)) {
//     throw new Exception('Received content contained invalid JSON!');
// }
 
// Process the JSON.

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//     echo json_decode($_POST);

//     if (isset($_POST['target']) && isset($_POST['locks'])) {

//         $db = new DbOperation();

//         echo $_POST['target']; echo "\n";
//         echo $_POST['locks'];


//         // if ($db->userIdIsValid($_POST['u_user_id'])) {

//         //     if ($db->userIdMatchUserPassword($_POST['u_user_id'], $_POST['u_password'])) {

//         //       //get admin key token now, then insert newly activated lock
//         //       $fn = new Functions();
//         //       $tokenAuth = $fn->TokenAuth();

//         //       $factory_name = $_POST['l_factory_name'];
//         //       //$factory_name = "UL002870";

//         //       //$url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/' . $lockName . '/status';
//         //       $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/'.$factory_name.'/adminKey';
//         //       $jsonResult = $fn->CallAPIWithToken("GET", $url, $tokenAuth, false);
//         //       $lock_info = json_decode($jsonResult);
//         //       $info = $lock_info->info;
//         //       foreach ($info as $value){
//         //         //echo $value;
//         //         $admin_key = $value;
//         //         //echo "here4";
//         //       }

//         //       $result = $db->insertActivatedLock($_POST['u_user_id'], $_POST['l_factory_name'], $admin_key);

//         //       if ($result == LOCK_ACTIVATE_SUCCESSFUL) {
//         //           $response['error'] = false;
//         //           $response['message'] = 'Activated lock bound successfully';
//         //       } elseif ($result == LOCK_ACTIVATE_UNSUCCESSFUL) {
//         //           $response['error'] = true;
//         //           $response['message'] = 'Activated lock bound unsuccessful';
//         //       } else {
//         //         $response['error'] = true;
//         //         $response['message'] = 'Unknown Error';
//         //       }

//         //     } else {
//         //       $response['error'] = true;
//         //       $response['message'] = 'Invalid password';
//         //     }

//         // } else {
//         //     $response['error'] = true;
//         //     $response['message'] = 'Invalid user id';
//         // }

//     } else {
//         $response['error'] = true;
//         $response['message'] = 'Parameters are missing';
//     }

// } else {
//     $response['error'] = true;
//     $response['message'] = "Request not allowed";
// }

// echo json_encode($response);
// 
