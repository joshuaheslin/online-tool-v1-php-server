<?php

class DbOperationGW {
    private $conn;

    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/Constants.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        require_once dirname(__FILE__) . '/Functions.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function updateGateway($factory_name, $gateway_title, $gateway_status)
    {
      //FIRST CHECK IF THIS LOCK ALREADY EXISTS IN DB
      $stmt = $this->conn->prepare("SELECT g_factory_name FROM app_activated_gateways WHERE g_factory_name = ?");
      $stmt->bind_param("s", $factory_name);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0){
        //gw already exists so update info
        $stmt = $this->conn->prepare("UPDATE app_activated_gateways SET g_gateway_title = ?, g_gateway_status = ? WHERE g_factory_name = ?");
        $stmt->bind_param("sss", $gateway_title, $gateway_status, $factory_name);
        if ($stmt->execute()) {
            return SQL_SUCCESSFUL;
        } else {
            return SQL_UNSUCCESSFUL;
        }
      } else {
        //gw does not exist in db, so return FALSE
        return FACTORY_NAME_DOES_NOT_EXIST;
      }
    }

    public function getActivatedGWsForUserID($id)
    {

      $sql = "SELECT g_factory_name, g_gateway_title, g_gateway_admin_key FROM app_activated_gateways WHERE u_user_id = '".$id."'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

          $gw = new ActivatedGateway();
          $gw->factory_name = $row['g_factory_name'];
          $gw->gateway_name = $row['g_gateway_title'];
          $gw->admin_key = $row['g_gateway_admin_key'];
          $gateways[] = $gw; //appends a 'lock' object to 'locks' array

        }
      }
      return $gateways;
    }

    public function removeActivatedGateway($factory_name)
    {
      //FIRST CHECK IF THIS LOCK ALREADY EXISTS IN DB
      $stmt = $this->conn->prepare("SELECT g_factory_name FROM app_activated_gateways WHERE g_factory_name = ?");
      $stmt->bind_param("s", $factory_name);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0){
        //lock does exist so now remove it
        $stmt = $this->conn->prepare("DELETE FROM app_activated_gateways WHERE g_factory_name = ?");
        $stmt->bind_param("s", $factory_name);
        if ($stmt->execute()) {
            return LOCK_RESET_SUCCESSFUL;
        } else {
            return LOCK_RESET_UNSUCCESSFUL;
        }
      } else {
        //lock does not exist in db, return false
        return LOCK_RESET_UNSUCCESSFUL;
      }
    }

    public function insertActivatedGateway($id, $factory_name, $admin_key)
    {

      //FIRST CHECK IF THIS LOCK ALREADY EXISTS IN DB
      $stmt = $this->conn->prepare("SELECT g_factory_name FROM app_activated_gateways WHERE g_factory_name = ?");
      $stmt->bind_param("s", $factory_name);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0){
        //lock already exists so update info to new user
        $stmt = $this->conn->prepare("UPDATE app_activated_gateways SET u_user_id = ?, g_gateway_admin_key = ? WHERE g_factory_name = ?");
        $stmt->bind_param("sss", $id, $admin_key, $factory_name);
        if ($stmt->execute()) {
            return LOCK_ACTIVATE_SUCCESSFUL;
        } else {
            return LOCK_ACTIVATE_UNSUCCESSFUL;
        }

      } else {
        //lock does not exist in db yet, so INSERT
        $stmt = $this->conn->prepare("INSERT INTO app_activated_gateways (g_factory_name, u_user_id, g_gateway_admin_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $factory_name, $id, $admin_key);
        if ($stmt->execute()) {
            return LOCK_ACTIVATE_SUCCESSFUL;
        } else {
            return LOCK_ACTIVATE_UNSUCCESSFUL;
        }
      }
    }

}

class ActivatedGateway {
  public $factory_name;
  public $gateway_name;
  public $admin_key;

}

?>
