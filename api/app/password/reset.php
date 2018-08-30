<?php

include('DbPasswordOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['key']) && isset($_GET['reset'])) {

      $db = new DbPasswordOperation();
      //echo "hi";

      $email_token = $_GET['key'];
      //echo $email_token;

      $password_token = $_GET['reset'];
      //echo $password_token;

      //echo "hi";

        if ($db->checkUserExists($email_token, $password_token)) {

          echo 'Password Reset Token is Valid';

          //header('Location: reset_page.html');
          include ('reset_page.php');
          exit();

          // $password_token = $db->getUserPassword($_POST['u_email']);
          // //NOTE: password is already hashed md5();
          // //echo $password_token;
          // $email_token = md5($_POST['u_email']);
          //echo $email_token;


        } else {
          echo "Invalid Token";
          return;
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
