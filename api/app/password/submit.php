<?php

include('DbPasswordOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['key'])) {

      $email_token = $_POST['key'];
      //echo $email_token;
      //echo $email_token;

      $password = $_POST['password'];
      //echo $password;

      $password2 = $_POST['confirm_password'];
      //echo $password2;

      if ($password == $password2) {

        $db = new DbPasswordOperation();

        //echo "here";

        if ($db->updatePasswordForEmail($email_token, $password)) {

          include ('success_page.php');
          exit();


        } else {
          $response['error'] = true;
          $response['message'] = 'Password did not update';
        }
      } else {
        $response['error'] = true;
        $response['message'] = 'Password error';
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
