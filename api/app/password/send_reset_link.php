<?php

include('DbPasswordOperation.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'path/to/PHPMailer/src/Exception.php';
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['u_email'])) {

      $db = new DbPasswordOperation();
      //echo "hi";
      //echo $_POST['u_email'];

      if ($db->isValidEmail($_POST['u_email'])) {

          $password_token = $db->getUserPassword($_POST['u_email']);
          //NOTE: password is already hashed md5();
          //echo $password_token;
          $email = $_POST['u_email'];
          $email_token = md5($_POST['u_email']);
          //echo $email_token;

          if ($password_token != NULL) {
            //echo "send reset email";

            $mail = new PHPMailer();

            //echo "hi1";
            try {
              //echo "hi";
              $mail->isSMTP();
              $mail->SMTPAuth = true;
              $mail->SMTPSecure = 'ssl';
              $mail->Host = 'smtp.gmail.com';
              $mail->Port = '465';
              $mail->isHTML();
              $mail->Username = 'kaslockappmail@gmail.com';
              $mail->Password = 'kas12345';

              //Recipients
              $mail->setFrom('noreply@kas.com.au', 'KAS Manager App');
              $mail->addAddress($email);     // Add a recipient           \
              //$mail->addBCC('bcc@example.com');

              //Content
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = 'Password Reset';
              $root_URL = ROOT_URL;
              $url = "".$root_URL."reset.php?key=".$email_token."&reset=".$password_token."";
              $mail->Body    = '<h3>KAS Manager App</h3>
                                <h4>Password Reset</h4>
                                <p>Click the following link to reset your password: </p>
                                <p><a href='.$url.'>RESET PASSWORD HERE</a></p>
                                <h4>Why did you get this email?</h4>
                                <p>You have opted to change your password for the KAS Manager App. If this was not you, we strongly recommend to change your password from the KAS Manager App now.</p>
                                <br>
                                <p>KAS-Keyless Access Security</p>
              ';

              $mail->Send();

              $response['error'] = false;
              $response['message'] = 'Email has been sent';


            } catch (Exception $e) {

              $response['error'] = true;
              $response['message'] = 'Email could not be sent. Mailer Error: $mail->ErrorInfo';

              //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

            }


          } else {
            $response['error'] = true;
            $response['message'] = 'Could not fetch user password';
          }

        } else {
          //echo "fail";
          $response['error'] = true;
          $response['message'] = 'Users email does not exist';
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
