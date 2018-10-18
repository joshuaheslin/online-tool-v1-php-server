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

        $fn = new Functions();
    }

    public function updateTokensForUser($email, $login_token, $new_refresh_token, $new_access_token)
    {
        if ($this->userWillLogin($email, $login_token)){
            //user exists so update info to new user
            $stmt = $this->conn->prepare("UPDATE users SET access_token = ?, refresh_token = ? WHERE login_token = ?");
            $stmt->bind_param("sss", $new_access_token, $new_refresh_token, $login_token);
            if ($stmt->execute()) {

                return $this->getTokensForUser($email, $login_token);

            } else {
                return 0; //false
            }
        } else {
            return 0;
        }
    }

    public function getTokensForUser($email, $login_token)
    {
        if ($this->userWillLogin($email, $login_token)){
            //user exists so update info to new user
            $stmt = $this->conn->prepare("SELECT login_token, email, access_token, refresh_token FROM users WHERE login_token = ?");
            $stmt->bind_param("s", $login_token);
            $stmt->execute();
            $stmt->bind_result($login_token, $email, $access_token, $refresh_token);
            $stmt->fetch();                
            $result = array();
            $result['login_token'] = $login_token;
            $result['email'] = $email;
            $result['access_token'] = $access_token;
            $result['refresh_token'] = $refresh_token;
            return $result;
        } else {
            return 0;
        }

    }

    

    public function insertAuthorisedUserAndTheirTokens($login_token, $email, $password, $access_token, $refresh_token, $expires_in)
    {

      //FIRST CHECK IF login_token AND email ARE VALID
      if ($this->userWillLogin($email, $login_token)){
        //user exists so update info to new user
        $stmt = $this->conn->prepare("UPDATE users SET access_token = ?, refresh_token = ?, expires_in = ?, user_password = ? WHERE login_token = ?");
        $stmt->bind_param("sssss", $access_token, $refresh_token, $expires_in, $password, $login_token);
        if ($stmt->execute()) {
            return 1; //true
        } else {
            return 0; //false
        }
      } else {
        //don't add info because email and login_token are invalid (even though user may have successfully 'authorised' from Cloudbeds, kas does not allow it for that email.)
        return 0;
      }
    }

    // ---------------------------------------
    // ------  LOGIN AND REGISTER LOGIC ------
    // ---------------------------------------

    public function userWillLogin($email, $login_token)
    {
        $password = md5($pass);
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND login_token = ?");
        $stmt->bind_param("ss", $email, $login_token);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    //Function to create a new user
    public function createUser($email, $login_token, $hotelname)
    {
        if (!$this->isUserExist($email)) {
            //$active = 1; //all active by default
            //$password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO users (email, login_token, hotel_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $login_token, $hotelname);
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
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

}

?>


