<?php

// $plaintext = 'My secret message 1234';
// $password = '3sc3RLrpd17';
// $method = 'aes-256-cbc';

// $key = password_hash($password, 12345678, ['cost' => 12]);
// echo "Key:" . $key . "\n"; echo "<br>";

// // IV must be exact 16 chars (128 bit)
// $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
// $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));

// // My secret message 1234
// $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);

// echo 'plaintext=' . $plaintext . "\n"; echo "<br>";
// echo 'cipher=' . $method . "\n"; echo "<br>";
// echo 'encrypted to: ' . $encrypted . "\n"; echo "<br>";
// echo 'decrypted to: ' . $decrypted . "\n\n"; echo "<br>";

// echo "passcode";
// // $fn = new Functions();
// // $passcode = $fn->createRandomPasscode(6);


// Get the PHP helper library from twilio.com/docs/php/install
require_once 'twilio-php-master/Twilio/autoload.php'; // Loads the library
use Twilio\Rest\Client;

$sid = 'ACef4f533e120249f8e0e5e75f33c17f2b';
$token = '043ed086f4665ac2d04223e62f61eef4';
$client = new Client($sid, $token);

$client->messages->create(
  '+61431473207',
  array(
    'from' => '+61428475906',
    'body' => 'You have received a mobile key! 

Download the KAS Mobile Access app and enter this passcode to retreive your key. 
      
App Download: kas.com.au 

Enter this Passcode: 123456 

Thanks, Hotel Name 
- on behalf of KAS Keyless Access Security',
  )
);






?>