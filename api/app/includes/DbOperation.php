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

    public function updateLock($factory_name, $lock_title)
    {
      //lock does not exist in db yet, so INSERT
      $stmt = $this->conn->prepare("UPDATE app_activated_locks SET l_lock_title = ? WHERE l_factory_name = ?");
      $stmt->bind_param("ss", $lock_title, $factory_name);
      if ($stmt->execute()) {
          return SQL_SUCCESSFUL;
      } else {
          return SQL_UNSUCCESSFUL;
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

?>
