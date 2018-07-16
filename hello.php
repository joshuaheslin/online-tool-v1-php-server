<?php
echo "hello <br>";
include "auth.php"; $tokenAuth = $response->access_token;
//include "sqlconn.php";

//$tokenAuth = "c4011a117ce8d51d32a0bc0b55269dbd704705a4054a0a53"; //3hours
$tokenRefresh = $response->refresh_token;

/*
And, www.ufunnetwork.com is a test server.
 You may try lock.ufunnetwork.com.
*/

/*
2. server.ip is replaced by ufunnetwork.com and 121.40.42.36 is null  -->  license problem.
please visit https://121.40.42.36/, accept the license, and then try again the API.
*/

/*
-------------------------------------------------------------------------------
------------------------------SELECT SITE START--------------------------------
-------------------------------------------------------------------------------
*/
$atira_id = 3;  //0 = none, 1 = WAYMOUTH, 2 = GLEN ROAD, 3 = Demo Testing


if ($atira_id == 1 ){

  //---------------------------- ATIRA WAYMOUTH --------------------------//
  //---------------------------- ATIRA WAYMOUTH --------------------------//
  //---------------------------- ATIRA WAYMOUTH --------------------------//

  $subAccount = "lock-264-17";

  echo "<br><br>---------------------Retrieve all locks FROM . $subAccount . ------------------ <br>";
  $urlLocks = "https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/" . $subAccount . "/locks";
  $result1 = CallAPIWithToken("GET", $urlLocks, $tokenAuth, false); echo $result1;

  /*[{"s_lock_name":"UL002960","s_room_name":"012"},
  {"s_lock_name":"UL002035","s_room_name":"5002"},
  {"s_lock_name":"UL001901","s_room_name":"5001"},
  {"s_lock_name":"UL002942","s_room_name":"001"},
  {"s_lock_name":"UL003146","s_room_name":"009"},
  {"s_lock_name":"UL003008","s_room_name":"005"},
  {"s_lock_name":"UL003114","s_room_name":"007"},
  {"s_lock_name":"UL003099","s_room_name":"008"},
  {"s_lock_name":"UL003012","s_room_name":"003"},
  {"s_lock_name":"UL002978","s_room_name":"011"},
  {"s_lock_name":"UL002889","s_room_name":"004"},
  {"s_lock_name":"UL002857","s_room_name":"002"}]*/

  echo "<br><br>---------------------Retrieve lock status Front Right 001 UL002942 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002942/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Front Left 012 UL002960------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002960/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Lift Left 002 UL002857 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002857/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Lift Right 003 UL003012 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003012/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Office 5002 UL002035 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002035/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Office 5001 UL001901 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL001901/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Courtyard Near 004 UL002889 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002889/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Courtyard Far 005 UL003008 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003008/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Laundry 011 UL002978 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002978/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Gym 009 UL003146 outside ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003146/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Gate West 007 UL003114 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003114/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Bike lockup 008 UL003099 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003099/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status Gate West - not installed ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003114/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  //WIFI: Atira Resident Access Waymouth WIFI Access code: A-129-8270

  echo "<br><br>---------------------Retrieve All Gateways ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status Reception Desk GW000178 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000178/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status Laundry/bathrooms GW000168 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000168/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status West GW000170 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000170/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status Study Desks GW000175 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000175/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status Gym GW000156 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000156/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;


} else if ($atira_id == 2) {

  //---------------------------- ATIRA GLEN ROAD --------------------------//
  //---------------------------- ATIRA GLEN ROAD --------------------------//
  //---------------------------- ATIRA GLEN ROAD --------------------------//

  $subAccount = "lock-264-5";

  echo "<br><br>---------------------Retrieve all locks FROM . $subAccount . ------------------ <br>";
  $urlLocks = "https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/" . $subAccount . "/locks";
  $result1 = CallAPIWithToken("GET", $urlLocks, $tokenAuth, false); echo $result1;


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

  echo "<br><br>---------------------Retrieve lock status BIKE ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002770/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status B1 LIFT LEFT ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL003081/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status B1 LIFT RIGHT ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002914/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve All Gateways ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status GW000028 DESK/FRONT/LIFT ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000028/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  echo "<br><br>------------Retrieve Gateway Status GW000024 OFFICE/CARPARk------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000024/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;


} else if ($atira_id = 3) {

  echo "<br><br>============================DEMO TESTING==========================<br>";

  echo "<br><br>------------Retrieve Gateway Status GW000006 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000006/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  $subAccount = "lock-264-7";

  echo "<br><br>------------Retrieve Gateway Status GWS00014 ------------------ <br>";
  $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GWS00014/status';
  $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;

  $subAccount = "lock-264-7";

  echo "<br><br>---------------------Retrieve all locks FROM . $subAccount . ------------------ <br>";
  $urlLocks = "https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/" . $subAccount . "/locks";
  $result1 = CallAPIWithToken("GET", $urlLocks, $tokenAuth, false); echo $result1;


  echo "<br><br>---------------------Retrieve lock status BLE ACR 001 UL002870 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002870/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status 0101 ONYX UL002333 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002333/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status 0102 Platinum UL002077 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002077/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;

  echo "<br><br>---------------------Retrieve lock status 0103 SUB1-PLAT SS000009 ------------------ <br>";
  $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/SS000009/status';

  $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;

  $data = json_decode($result3);
  $info = $data->info;


}

//---------------------------- PLAYGROUND HERE --------------------------//


//API: Retreive all locks FROM 'lock-265-4'

//now input the lock into the tables
// $sql_insert_lock = "INSERT INTO `locks` (`prim-index`, 'lockName','roomNo',`signal-int`, `date`, `gateway-id`) VALUES (NULL, "hi",NULL,NULL, NULL,NULL);";
// $result = mysqli_query($conn, $sql_insert_lock);


// echo "<br><br>---------------------Retrieve All Gateways ------------------ <br>";
// $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways';
// $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;
//
// //


// echo "<br><br>------------Retrieve Gateway Status GW000168 KAS ------------------ <br>";
// $urlGateway = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/gateways/GW000168/status';
// $result3 = CallAPIWithToken("GET", $urlGateway, $tokenAuth, false); echo $result3;
//
// echo '<br><br><br><br><br>------------Retrieve lock status UL002333 V11.1 test ------------------<br><br>';
// $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002333/status';
//
// $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;
//
// $data = json_decode($result3);
// $info = $data->info;
//
// echo '<br><br><br><br>';



//
// echo "<br><br>---------------------Retrieve Admin key ------------------ <br>";
// $urlAdmin = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002006/adminKey';
// //$result3 = CallAPIWithToken("GET", $urlAdmin, $tokenAuth, false); echo $result3;
//
//

//
// echo "<br><br>";
// echo "<br><br>";
// echo "<br><br>---------------------Retrieve lock status KAS READER TEST UL002870------------------ <br>";
// $urlStatus = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/UL002870/status';
//
// $result3 = CallAPIWithToken("GET", $urlStatus, $tokenAuth, false); echo $result3;
//
// $data = json_decode($result3);
// $info = $data->info;

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



// TODO: Delete this
//
// function gatewayCount($info)
// {
//   if (count($info) == 1) {
//     //There is only one gateway attached to the lock, insert 1 row in table
//     echo "There is one gateway attached to this lock.";
//     return 1;
//   } else {
//     //return the number of gateways attached to the lock, (maybe some are past gateways)
//     return count($info);
//   }
// }
//



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
