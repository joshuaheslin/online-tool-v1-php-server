<?php

include "sqlconn.php";

//include "functions.php";


class SQLInteface {
    private $tokenAuth;
    private $lockData;
    private $conn;
    private $app_account;
    //private $sql;

    // Constructor
    public function __construct($lockData, $tokenAuth, $app_account){

        //$this->conn = connect('35.189.47.93','user2','','mydb');
        $this->conn = connect('localhost','user','','mydb');
        //$this->conn = connect('http://35.189.47.93/','user2','','mydb');  //don't know how to connect to remote sql server :( JH

        // $host = 'localhost';//'http://35.189.47.93/'; //localhost
        // $user= 'user';//'root'; //user
        // $pass='';//'jDHWjnFwcpbN2r';  // 'empty'
        // $db='mydb';

        //user / 1234!@#$

        $this->lockData = $lockData;
        $this->tokenAuth = $tokenAuth;
        $this->app_account = $app_account;
        //$result = mysqli_query($conn, $sql);

    }

    public function printToken(){
        //echo $this->tokenAuth;
    }

    public function updateLockToSQL($s_lock_name, $s_room_name){ //$device = "UL002058";

        $lockName = $s_lock_name;
        $app_account = $this->app_account;
        $room_number = $s_room_name;

        $url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks/' . $lockName . '/status';


        $lockInfoJson = CallAPIWithToken("GET", $url, $this->tokenAuth, false);
        $lockInfo = json_decode($lockInfoJson);
        $info = $lockInfo->info;

        //print_r($lockInfo);

        // Important to store as empty string here. Below will sql-insert as empty string if no data exists.
        $LockGatewayID_1 = "";
        $LockSignalStrength_1 = "";
        $lockLastScanned_1 = "";

        $LockGatewayID_2 = "";
        $LockSignalStrength_2 = "";
        $lockLastScanned_2 = "";

        $LockGatewayID_3 = "";
        $LockSignalStrength_3 = "";
        $lockLastScanned_3 = "";

        $lockGateways = array();

        $lockGateway = array($LockGatewayID_1, $LockSignalStrength_1, $lockLastScanned_1);

        array_push($lockGateways, $lockGateway);

        $lockGateway = array($LockGatewayID_2, $LockSignalStrength_2, $lockLastScanned_2);

        array_push($lockGateways, $lockGateway);

        $lockGateway = array($LockGatewayID_3, $LockSignalStrength_3, $lockLastScanned_3);

        array_push($lockGateways, $lockGateway);

        $gatewayCount = 0;
        foreach ($info as $value){

           //print_r($value);
           $lockGateways[$gatewayCount][0] = $value->s_gateway_name;
           $lockGateways[$gatewayCount][1] = $value->i_signal;

           // $unixTime = $value->l_last_update_time;
           //
           //
           //
           // //$unixTime = substr($unixTime, 0, 10);
           //
           // $unixTime = $unixTime / 1000;
           //
           // echo "---------";
           // echo $unixTime;
           // echo "---------";
           // echo "</br>";

           //echo date('r', $epoch);
           //echo $lastUpdateDateTime->format('Y-m-d H:i:s');
           //$currentTime = date('Y-m-d H:i:s', (int)$unixTime);
           //print_r($lastUpdateDateTime);


           $epoch = $value->l_last_update_time / 1000;
           //$lastUpdateDateTime = date('r',$value->l_last_update_time / 1000);


           //$timezone = $timezone_login; //TODO

           $dt = new DateTime("@$epoch");
           $tz = new DateTimeZone('Australia/Brisbane'); //$timezone
           $dt->setTimezone($tz);
           //echo $dt->format('Y-m-d H:i:s');

           $date = $dt->format(DATE_RFC2822);
           $lockGateways[$gatewayCount][2] = $date;

            //$lockGate = $value->s_gw_id;


            //array_push($lockGateway, $lockGatewayID, $lockSignalStrength, $lockLastScanned);

            //array_push($lockGateways, $lockGateway);


            //echo $lockGatewayID;
            $gatewayCount++;
            //$lockGateway = array();
        }



        $sql = "SELECT * FROM `lockstatus` WHERE lock_name='$lockName'";


        $result = $this->conn->query($sql);

        //print_r($result->num_rows);

        $sqlGateway_1_ID = $lockGateways[0][0];
        $sqlGateway_1_Signal = $lockGateways[0][1];
        $sqlGateway_1_Date = $lockGateways[0][2];

        $sqlGateway_2_ID = $lockGateways[1][0];
        $sqlGateway_2_Signal = $lockGateways[1][1];
        $sqlGateway_2_Date = $lockGateways[1][2];

        $sqlGateway_3_ID = $lockGateways[3][0];
        $sqlGateway_3_Signal = $lockGateways[3][1];
        $sqlGateway_3_Date = $lockGateways[3][2];

        if ($result->num_rows == 0){
            $sql_insert = "INSERT INTO lockstatus (lock_name, customer_room_number, appaccount, g1_name, g1_date_last_synced,
            g1_signal, g2_name, g2_date_last_synced, g2_signal, g3_name, g3_date_last_synced, g3_signal,
            the_current_timestamp, timestamp_data_inserted)
            VALUES ('$lockName', '$room_number', '$app_account', '$sqlGateway_1_ID', '$sqlGateway_1_Date', '$sqlGateway_1_Signal',
            '$sqlGateway_2_ID', '$sqlGateway_2_Date', '$sqlGateway_2_Signal', '$sqlGateway_3_ID', '$sqlGateway_3_Date', '$sqlGateway_3_Signal', '', '')";

            if ($this->conn->query($sql_insert) === TRUE) {
                echo "<br>New record created successfully";
            } else {
                echo "Error: " . $sql_insert . "<br>" . $this->conn->error;
            }
        }else{
            $sql_update = "UPDATE lockstatus SET customer_room_number='$room_number', appaccount='$app_account', g1_name='$sqlGateway_1_ID',
             g1_date_last_synced='$sqlGateway_1_Date', g1_signal='$sqlGateway_1_Signal', g2_name='$sqlGateway_2_ID',
              g2_date_last_synced='$sqlGateway_2_Date', g2_signal='$sqlGateway_2_Signal', g3_name='$sqlGateway_3_ID',
               g3_date_last_synced='$sqlGateway_3_Date', g3_signal='$sqlGateway_3_Signal' WHERE lock_name='$lockName'";

            if ($this->conn->query($sql_update) === TRUE) {
                //echo "<br>record updated successfully";
            } else {
                echo "Error: " . $sql_update . "<br>" . $this->conn->error;
            }
        }

        // print "<br>Lockname "  . $lockName;
        // print "<br/>";
        //
        // print "Room No: "  . $room_number;
        // print "<br/>";
        //
        //
        // print "Gateway ID 1 " .  $lockGateways[0][0]  . " Gateway Signal Strength 1 " . $lockGateways[0][1] .
        // " Gateway Last Scanned 1 " . $lockGateways[0][2];
        // print "<br/>";
        //
        // print "Gateway ID 2 " .  $lockGateways[1][0]  . " Gateway Signal Strength 2 " . $lockGateways[1][1] .
        // " Gateway Last Scanned 2 " . $lockGateways[1][2];
        // print "<br/>";
        //
        // print "Gateway ID 3 " .  $lockGateways[2][0]  . " Gateway Signal Strength 3 " . $lockGateways[2][1] .
        // " Gateway Last Scanned 3 " . $lockGateways[2][2];
        // print "<br/>";

    }

    public function lock_is_in_SQL($lockName){

      $sql = "SELECT * FROM `lockstatus` WHERE lock_name='$lockName'";
      $result = $this->conn->query($sql);

      if ($result->num_rows == 1){ //match found!
        return true;
      } else {
        return false;
      }

    }

    public function deleteLockFromSQL($lockName){

      echo "will delete lock $lockName.";

    }

    public function updateLockDataToSQL(){

        $this->tokenAuth = TokenAuth();

        foreach ($this->lockData as $value){

            $s_lock_name = $value->s_lock_name;
            $s_room_name = $value->s_room_name;

            //TODO
            if ($this->lock_is_in_SQL($s_lock_name)){

                $this->updateLockToSQL($s_lock_name, $s_room_name);

            } else {

              $this->deleteLockFromSQL($s_lock_name);

            }

        }

    }

    public function getLockData($app_account){

        // $lockName = "Test";
        //
        // $LockGatewayID_1 = "GW_1_no Data";
        // $LockSignalStrength_1 = "GW_1_no Data";
        // $lockLastScanned_1 = "GW_1_No Data";
        //
        //
        // $LockGatewayID_2 = "GW_2_no Data";
        // $LockSignalStrength_2 = "GW_2_no Data";
        // $lockLastScanned_2 = "GW_2_No Data";
        //
        // $LockGatewayID_3 = "GW_3_no Data";
        // $LockSignalStrength_3 = "GW_3_no Data";
        // $lockLastScanned_3 = "GW_3_No Data";
        //
        // $lockData = array();
        //
        // $locks = array();
        //
        // $lockGateways = array();
        //
        // $lockGateway = array($LockGatewayID_1, $LockSignalStrength_1, $lockLastScanned_1);
        //
        // array_push($lockGateways, $lockGateway);
        //
        // $lockGateway = array($LockGatewayID_2, $LockSignalStrength_2, $lockLastScanned_2);
        //
        // array_push($lockGateways, $lockGateway);
        //
        // $lockGateway = array($LockGatewayID_3, $LockSignalStrength_3, $lockLastScanned_3);
        //
        // array_push($lockGateways, $lockGateway);
        //
        // array_push($lockData, $lockName);
        // array_push($lockData, $lockGateways);
        //
        // array_push($locks, $lockData);





        //jh
        $locks = array();


        /*
        $sql = "SELECT * FROM 'lockstatus'";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

        //$result = $this->conn->query($sql);  */

        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM lockstatus WHERE appaccount='$app_account'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //echo "lock name: " . $row["lock_name"]. " - gateway 1 name: " . $row["g1_name"]. "<br>";
                $lock = new Lock();
                $lock->name = $row["lock_name"];
                $lock->room_number = $row["customer_room_number"];
                $lock->local_door_name = $row["local_door_name"];
                $lock->gateway_1_id = $row["g1_name"];
                $lock->gateway_1_signal = $row["g1_signal"];
                $lock->gateway_1_date = $row["g1_date_last_synced"];
                $lock->gateway_2_id = $row["g2_name"];
                $lock->gateway_2_signal = $row["g2_signal"];
                $lock->gateway_2_date = $row["g2_date_last_synced"];
                $lock->gateway_3_id = $row["g3_name"];
                $lock->gateway_3_signal = $row["g3_signal"];
                $lock->gateway_3_date = $row["g3_date_last_synced"];
                $locks[] = $lock; //appends a 'lock' object to 'locks' array
            }
        } else {
            echo "0 results";
        }

        $this->conn->close();

        return $locks;
    }
}

class Lock {
  public $name;
  public $room_number;
  public $local_door_name;
  public $gateway_1_id;
  public $gateway_1_signal;
  public $gateway_1_date;
  public $gateway_2_id;
  public $gateway_2_signal;
  public $gateway_2_date;
  public $gateway_3_id;
  public $gateway_3_signal;
  public $gateway_3_date;


}


?>
