<?php

class DbPasswordOperation {
    private $conn;

    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '../../includes/Constants.php';
        require_once dirname(__FILE__) . '../../includes/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function updatePasswordForEmail($email_token, $password)
    {
      $stmt = $this->conn->prepare("UPDATE app_users SET u_password = ? WHERE md5(u_email) = '".$email_token."'");
      $stmt->bind_param("s", md5($password));
      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function checkUserExists($email_token, $password_token)
    {
      $sql = "SELECT u_email, u_password FROM app_users WHERE md5(u_email) = '".$email_token."' AND u_password = '".$password_token."'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {
        return true;

      } else {
        return false;
      }

    }

    public function getUserPassword($email)
    {
      $sql = "SELECT u_password FROM app_users WHERE u_email = '".$email."'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          //echo "returning pw result";
          //echo $row['u_password'];
          return $row['u_password'];
        }
      }
    }


    public function isValidEmail($email)
    {
      $sql = "SELECT * FROM app_users WHERE u_email = '".$email."'";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {

        return true;

      } else {
        return false;
      }

    }

}

?>
