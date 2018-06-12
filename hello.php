<?php
echo "hello <br>";
include "auth.php"; $tokenAuth = $response->access_token;
//include "sqlconn.php";


/*
And, www.ufunnetwork.com is a test server.
 You may try lock.ufunnetwork.com.
*/

/*
2. server.ip is replaced by ufunnetwork.com and 121.40.42.36 is null  -->  license problem.
please visit https://121.40.42.36/, accept the license, and then try again the API.
*/


/*pass token to next calls*/


//$tokenAuth = "c4011a117ce8d51d32a0bc0b55269dbd704705a4054a0a53"; //3hours
$tokenRefresh = $response->refresh_token;


echo "<br><br>---------------------Retrieve all locks------------------ <br>";
$urlLocks = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks';
$result1 = CallAPIWithToken("GET", $urlLocks, $tokenAuth, false); echo $result1;


//API: Retreive all locks FROM 'lock-265-4'

//now input the lock into the tables
// $sql_insert_lock = "INSERT INTO `locks` (`prim-index`, 'lockName','roomNo',`signal-int`, `date`, `gateway-id`) VALUES (NULL, "hi",NULL,NULL, NULL,NULL);";
// $result = mysqli_query($conn, $sql_insert_lock);


echo "<br><br>---------------------Retrieve All Gateways ------------------ <br>";
$urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways';
$result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

echo "<br><br>------------Retrieve Gateway Status GW000028 ------------------ <br>";
$urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000028/status';
$result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

echo "<br><br>------------Retrieve Gateway Status GW000024 ------------------ <br>";
$urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000024/status';
$result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;
//
echo "<br><br>------------Retrieve Gateway Status GW000030 KAS ------------------ <br>";
$urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000030/status';
$result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;


echo "<br><br>---------------------Retrieve Admin key ------------------ <br>";
$urlAdmin = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002006/adminKey';
//$result3 = CallAPIWithToken("GET", $urlAdmin, $tokenAuth, false); echo $result3;


echo "<br><br>---------------------Retrieve lock status FRONT ------------------ <br>";
$urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002923/status';

$result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

$data = json_decode($result3);
$info = $data->info;

echo "<br><br>---------------------Retrieve lock status GARAGE ------------------ <br>";
$urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002832/status';

$result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

$data = json_decode($result3);
$info = $data->info;

echo "<br><br>---------------------Retrieve lock status G LIFT LEFT------------------ <br>";
$urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003027/status';

$result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

$data = json_decode($result3);
$info = $data->info;

echo "<br><br>---------------------Retrieve lock status G LIFT RIGHT ------------------ <br>";
$urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002912/status';

$result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

$data = json_decode($result3);
$info = $data->info;
//
// echo "<br><br>---------------------Retrieve lock status BIKE ------------------ <br>";
// $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002770/status';
//
// $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;
//
// $data = json_decode($result3);
// $info = $data->info;
//
// echo "<br><br>---------------------Retrieve lock status B1 LIFT LEFT ------------------ <br>";
// $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003081/status';
//
// $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;
//
// $data = json_decode($result3);
// $info = $data->info;
//
// echo "<br><br>---------------------Retrieve lock status B1 LIFT RIGHT ------------------ <br>";
// $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002914/status';
//
// $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;
//
// $data = json_decode($result3);
// $info = $data->info;

echo "<br><br>";
echo "<br><br>";
echo "<br><br>---------------------Retrieve lock status KAS READER TEST UL002870------------------ <br>";
$urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002870/status';

$result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

$data = json_decode($result3);
$info = $data->info;

//$count = gatewayCount($info);


// $d_scanned_at = $info[0]->d_scanned_at;
// $signal_strength = $info[0]->a_devices[0]->int_signal_strength;
// $gw_id = $info[0]->s_gw_id;
// /*SQL INSERT*/
// echo "<br>SQL-INSERT<br>";
// $sql = "INSERT INTO `locks` (`prim-index`, `lockName`, `roomNo`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, 'UL002912', 'GROUND LIFT RIGHT','$signal_strength','$d_scanned_at','$gw_id');";
// $result = mysqli_query($conn, $sql);
//
//
//
//
// $d_scanned_at = $info[1]->d_scanned_at;
// $signal_strength = $info[1]->a_devices[0]->int_signal_strength;
// $gw_id = $info[1]->s_gw_id;
// /*SQL INSERT*/
// echo "<br>SQL-INSERT<br>";
// $sql = "INSERT INTO `locks` (`prim-index`, `lockName`, `roomNo`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, 'UL002912', 'GROUND LIFT RIGHT','$signal_strength','$d_scanned_at','$gw_id');";
// $result = mysqli_query($conn, $sql);



//
//
//
//
// for ($i = 0; $i <= $count-1; $i++) {
//
//   $d_scanned_at = $info[$i]->d_scanned_at;
//   $signal_strength = $info[$i]->a_devices[0]->int_signal_strength;
//   $gw_id = $info[$i]->s_gw_id;
//
//   /*SQL INSERT*/
//   echo "<br>SQL-INSERT<br>";
//   $sql = "INSERT INTO `locks` (`prim-index`, `lockName`, `roomNo`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, 'UL002912', 'GROUND LIFT RIGHT','$signal_strength','$d_scanned_at','$gw_id');";
//
//   $result = mysqli_query($conn, $sql);
//   /*SQL INSERT*/
// }





echo "<br><br><br><br><br>";
$count = gatewayCount($info);

// $count is the number of gateway's attached to the lock,
// let's make sure each gateway get's updated
for ($i = 0; $i <= $count-1; $i++) {

  //Get API json Variables
  $d_scanned_at = $info[$i]->d_scanned_at;
  $signal_strength = $info[$i]->a_devices[0]->int_signal_strength;
  $gw_id = $info[$i]->s_gw_id;

  // echo "<br>Date scanned: ";
  // echo $d_scanned_at;
  // echo "<br>Signal strength: ";
  // echo $signal_strength;
  // echo "<br>Gateway id: ";
  // echo $gw_id;
  // echo "<br>";

  //Insert into table
  //firstly, check for gw_id duplicate
  // $sql = "SELECT * FROM `locks`";
  // $sql = "INSERT INTO `locks` (`prim-index`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, '30', '12-20-4940404','asdf');";
  // $sql = "INSERT INTO `locks` (`prim-index`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, '$signal_strength', '$d_scanned_at','$gw_id');";


  //TODO: try this
  /*
   $sql = "SELECT `gateway-id` FROM `locks` WHERE 'gateway-id'= $gw_id";
   if $result is null {
   INSERT
  } else {
        UPDATE
  }
  */

//   $sql = "SELECT `gateway-id` FROM `locks`";
//   $result = mysqli_query($conn, $sql);
//   if (mysqli_num_rows($result) > 0) {
//       // output data of each row
//       while($row = mysqli_fetch_assoc($result)) {
//
//           if ($row["gateway-id"] == null)
//           {
//             //INSERT it because nothing exists yet
//             echo "insert";
//           }
//
//           if ($row["gateway-id"] == $gw_id)
//           {
//             //if finds gw_id same as id in table, UPDATE
//             //already exists, so UPDATE row then return;
//             echo "<br>SQL-UPDATE<br>";
//             // $result = mysqli_query($conn, $sql);
//             // if (mysqli_num_rows($result) > 0) {
//             //     // output data of each row
//             //     while($row = mysqli_fetch_assoc($result)) {
//             //         echo "id: " . $row["prim-index"]. " signal: " . $row["signal-int"]. " date: " . $row["date"]. "<br>";
//             //     }
//             // } else {
//             //     echo "0 results";
//             // }
//             return;
//           } else {
//             //does not exist already, so INSERT new row;
//             //else INSERT with gw_id
//             /* NOW INSERT IT ----------*/
//             echo "<br>SQL-INSERT<br>";
//             $sql = "INSERT INTO `locks` (`prim-index`, `signal-int`, `date`, `gateway-id`) VALUES (NULL, '$signal_strength', '$d_scanned_at','$gw_id');";
//
//             $result = mysqli_query($conn, $sql);
//             // if (mysqli_num_rows($result) > 0) {
//             //     // output data of each row
//             //     while($row = mysqli_fetch_assoc($result)) {
//             //         echo "id: " . $row["prim-index"]. " signal: " . $row["signal-int"]. " date: " . $row["date"]. "<br>";
//             //     }
//             // } else {
//             //     echo "0 results";
//             // }
//             return;
//           }
//
//           //echo "id: " . $row["prim-index"]. " signal: " . $row["signal-int"]. " date: " . $row["date"]. " gateway-id: " . $row["gateway-id"] . "<br>";
//       }
//   } else {
//       //echo "0 results";
//   }
//
}


// /*----------ECHO SQL TABLE TO PAGE----------*/
// $sql = "SELECT * FROM `locks`";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     // output data of each row
//     echo "<table border='4' class='stats' cellspacing='10'>
//
//         <tr>
//         <td class='hed' colspan='8'>LOCK STATUS TABLE</td>
//           </tr>
//         <tr>
//         <th>ID</th>
//         <th>LOCK NO</th>
//         <th>SIGNAL</th>
//         <th>DATE</th>
//         <th>GATEWAY-ID</th>
//
//         </tr>";
//
//     echo "<tr>";
//     while($row = mysqli_fetch_assoc($result)) {
//         //echo "id: " . $row["prim-index"]. " signal: " . $row["signal-int"]. " date: " . $row["date"]. " gateway-id: " . $row["gateway-id"] . "<br>";
//         echo "<tr>";
//               echo "<td>" . $row["prim-index"] . "</td>";
//               echo "<td>" . "lockNo" . "</td>";
//               echo "<td>" . $row["signal-int"] . "</td>";
//               echo "<td>" . $row["date"] . "</td>";
//               echo "<td>" . $row["gateway-id"] . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// } else {
//     echo "0 results";
// }
//
// mysqli_close($conn);





function gatewayCount($info)
{
  if (count($info) == 1) {
    //There is only one gateway attached to the lock, insert 1 row in table
    echo "There is one gateway attached to this lock.";
    return 1;
  } else {
    //return the number of gateways attached to the lock, (maybe some are past gateways)
    return count($info);
  }
}



/*

{
  "ack":0,
  "msg":"成功",
  "info":[
      {
        "_id":"5afa517708c6e72561c5405f",
        "s_gw_id":"5afa515096abd49d54b0503c",
        "a_devices":[
              {
                "s_device_id":"5afba2fa96abd49d54b058af",
                "int_device_type":1,
                "int_signal_strength":-79
              }
            ],
        "d_scanned_at":"2018-05-16T04:09:31.000Z"
      },
      {
        "_id":"5afbaf8508c6e72561c54060",
        "s_gw_id":"5afbaf7096abd49d54b0598c",
        "a_devices":
          [
            {
              "s_device_id":"5afba2fa96abd49d54b058af",
              "int_device_type":1,
              "int_signal_strength":-79
            }
          ],
        "d_scanned_at":"2018-05-20T02:36:44.000Z"
      }
  ]
}
*/

function CallAPIWithToken($method, $url, $token, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
                //curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "testserver:123456");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //enter token from authentication API call
    $authorization = "Authorization: Bearer " . $token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $authorization));
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function CallAPIWithTokenWithData($method, $url, $token, $data)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));

    }

    // // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "testserver:123456");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //enter token from authentication API call
    $authorization = "Authorization: Bearer " . $token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $authorization));
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}




// echo "<br><br>";
// echo "---------------------Create LockKeeper account------------------ <br>";
//
// $urlAccount = 'https://www.ufunnetwork.com/ilocks/api/apps/v1/users';
//
// $newAccountData = array(
//     'user_name' => 'test1234',
//     'user_password' => '123456'
// );
//
// //And, you'll use  iPMS to create lock keeper account,
// //so API - create lock keeper account is suggested not to use it.
//
//
// $result2 = CallAPIWithTokenWithData("POST", $urlAccount, $tokenAuth, $newAccountData);
// echo $result2;


?>
