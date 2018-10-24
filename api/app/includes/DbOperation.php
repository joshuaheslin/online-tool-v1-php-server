<?php

class DbOperation {
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

    // public function updateKey($factory_name, $key_title) 
    // {
    //     //TODO - UNFINISHED!!!
    //   $stmt = $this->conn->prepare("UPDATE app_activated_locks SET l_lock_title = ? WHERE l_factory_name = ?");
    //   $stmt->bind_param("ss", $lock_title, $factory_name);
    //   if ($stmt->execute()) {
    //       return SQL_SUCCESSFUL;
    //   } else {
    //       return SQL_UNSUCCESSFUL;
    //   }
    // }

    public function insertKeyDataIntoSQL($app_account, $target_mobile, $sharedKey, $passcode)
    {
        $factory_name = $sharedKey->lock_factory_number;
        $room_number = $sharedKey->room_number;
        $key_string = $sharedKey->key_string;
        $start_time = $sharedKey->start_time;
        $end_time = $sharedKey->end_time;

        $stmt = $this->conn->prepare("INSERT INTO app_active_keys (k_app_account, k_factory_name, k_room_number, k_target_mobile, k_key_string, k_start_time, k_end_time, k_passcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $app_account, $factory_name, $room_number, $target_mobile, $key_string, $start_time, $end_time, $passcode);
        if ($stmt->execute()) {
            return SQL_SUCCESSFUL;
        } else {
            return SQL_UNSUCCESSFUL;
        }
    }

    public function passcodeAlreadyExists($passcode)
    {
        $sql = "SELECT * FROM app_active_keys WHERE k_passcode = '".$passcode."'";
        $result = $this->conn->query($sql);
  
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateLock($factory_name, $lock_title)
    {
      $stmt = $this->conn->prepare("UPDATE app_activated_locks SET l_lock_title = ? WHERE l_factory_name = ?");
      $stmt->bind_param("ss", $lock_title, $factory_name);
      if ($stmt->execute()) {
          return SQL_SUCCESSFUL;
      } else {
          return SQL_UNSUCCESSFUL;
      }
    }

    public function getActiveKeysForPasscode($passcode, $passcode_secret)
    {

        if ($passcode_secret == K_PASSCODE_SECRET) {

            //$keys = array();
            $sql = "SELECT k_app_account, k_factory_name, k_room_number, k_target_mobile, k_key_string, k_start_time, k_end_time  FROM app_active_keys WHERE k_passcode = '".$passcode."'";
            $result = $this->conn->query($sql);
    
            if ($result->num_rows > 0) {
    
                while ($row = $result->fetch_assoc()) {
    
                $key = new ActiveKey();
                $key->k_app_account = $row['k_app_account'];
                $key->k_factory_name = $row['k_factory_name'];
                $key->k_room_number = $row['k_room_number'];
                $key->k_target_mobile = $row['k_target_mobile'];
                $key->k_key_string = $row['k_key_string'];
                $key->k_start_time = $row['k_start_time'];
                $key->k_end_time = $row['k_end_time'];
                $keys[] = $key; //appends a 'key' object to 'locks' array
    
                }

                return $keys;

            } else {
                return K_PASSCODE_DOES_NOT_EXIST;
            }

        } else {
            return K_PASSCODE_SECRET_DOES_NOT_MATCH;
        }
    }

    public function getActivatedLocksForUserID($id)
    {

      $sql = "SELECT l_factory_name, l_lock_title, l_lock_admin_key FROM app_activated_locks WHERE u_user_id = '".$id."'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

          $lock = new ActivatedLock();
          $lock->factory_name = $row['l_factory_name'];
          $lock->lock_name = $row['l_lock_title'];
          $lock->admin_key = $row['l_lock_admin_key'];
          $locks[] = $lock; //appends a 'lock' object to 'locks' array

        }
      }
      return $locks;
    }

    public function removeActivatedLock($factory_name)
    {
      //FIRST CHECK IF THIS LOCK ALREADY EXISTS IN DB
      $stmt = $this->conn->prepare("SELECT l_factory_name FROM app_activated_locks WHERE l_factory_name = ?");
      $stmt->bind_param("s", $factory_name);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0){
        //lock does exist so now remove it
        $stmt = $this->conn->prepare("DELETE FROM app_activated_locks WHERE l_factory_name = ?");
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

    public function userIdMatchUserPassword($id, $pass)
    {
      $password = md5($pass);
      $stmt = $this->conn->prepare("SELECT u_user_id FROM app_users WHERE u_user_id = ? AND u_password = ?");
      $stmt->bind_param("ss", $id, $password);
      $stmt->execute();
      $stmt->store_result();
      return $stmt->num_rows > 0;
    }

    public function insertActivatedLock($id, $factory_name, $admin_key)
    {
      //$tokenAuth = $this->token;

      //FIRST CHECK IF THIS LOCK ALREADY EXISTS IN DB
      $stmt = $this->conn->prepare("SELECT l_factory_name FROM app_activated_locks WHERE l_factory_name = ?");
      $stmt->bind_param("s", $factory_name);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0){
        //lock already exists so update info to new user
        $stmt = $this->conn->prepare("UPDATE app_activated_locks SET u_user_id = ?, l_lock_admin_key = ? WHERE l_factory_name = ?");
        $stmt->bind_param("sss", $id, $admin_key, $factory_name);
        if ($stmt->execute()) {
            return LOCK_ACTIVATE_SUCCESSFUL;
        } else {
            return LOCK_ACTIVATED_UNSUCCESSFUL;
        }

      } else {
        //lock does not exist in db yet, so INSERT
        $stmt = $this->conn->prepare("INSERT INTO app_activated_locks (l_factory_name, u_user_id, l_lock_admin_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $factory_name, $id, $admin_key);
        if ($stmt->execute()) {
            return LOCK_ACTIVATE_SUCCESSFUL;
        } else {
            return LOCK_ACTIVATE_UNSUCCESSFUL;
        }
      }
    }

    public function userIdIsValid($id)
    {
      $stmt = $this->conn->prepare("SELECT u_user_id FROM app_users WHERE u_user_id = ?");
      $stmt->bind_param("s", $id);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        return true;
      } else {
        return false;
      }
    }

    public function userLogin($email, $pass)
    {
        $password = md5($pass);
        $stmt = $this->conn->prepare("SELECT u_user_id FROM app_users WHERE u_email = ? AND u_password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    /*
     * After the successful login we will call this method
     * this method will return the user data in an array
     * */

    public function getUserIdByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT u_user_id, u_email, u_first_name, u_property_name FROM app_users WHERE u_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $email, $fname, $pname);
        $stmt->fetch();
        $user = array();
        $user['u_user_id'] = $id;
        $user['u_email'] = $email;
        $user['u_first_name'] = $fname;
        $user['u_property_name'] = $pname;
        return $user;
    }

    //Function to create a new user
    public function createUser($email, $pass, $fname, $pname)
    {
        if (!$this->isUserExist($email)) {
            $active = 1; //all active by default
            $password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO app_users (u_email, u_password, u_first_name,  u_property_name, u_active) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $email, $password, $fname, $pname, $active);
            if ($stmt->execute()) {
                return USER_CREATED;
            } else {
                return USER_NOT_CREATED;
            }
        } else {
            return USER_ALREADY_EXIST;
        }
    }


    private function isUserExist($email)
    {
        $stmt = $this->conn->prepare("SELECT u_user_id FROM app_users WHERE u_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}

class ActivatedLock {
  public $factory_name;
  public $lock_name;
  public $admin_key;

}

class ActiveKey {

    public $k_app_account;
    public $k_factory_name;
    public $k_room_number;
    public $k_target_mobile;
    public $k_key_string;
    public $k_start_time;
    public $k_end_time;

}


?>
