<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'path/to/PHPMailer/src/Exception.php';
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

echo "hi";

$mail = new PHPMailer();

echo "hi1";
try {
  echo "hi";
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = '465';
  $mail->isHTML();
  $mail->Username = 'kaslockappmail@gmail.com'; //limited to 99 messages per day - maybe investigate google business account
  $mail->Password = 'kas12345';

  //Recipients
  $mail->setFrom('noreply@example.com', 'KAS Manager App');
  $mail->addAddress('jbmh@me.com');     // Add a recipient           \
  //$mail->addBCC('bcc@example.com');

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Password Reset-test';
  $mail->Body    = 'Reset passwprd here-test';

  $mail->Send();
  echo 'Message has been sent';


} catch (Exception $e) {

  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

}
