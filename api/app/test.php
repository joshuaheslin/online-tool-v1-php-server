<?php


// Get the PHP helper library from twilio.com/docs/php/install
require_once 'twilio-php-master/Twilio/autoload.php'; // Loads the library
use Twilio\Rest\Client;

$sid = '';
$token = '';
$client = new Client($sid, $token);

$client->messages->create(
  '+61431473207',
  array(
    'from' => '+',
    'body' => 'You have received a mobile key! 

Download the KAS Mobile Access app and enter this passcode to retreive your key. 
      
App Download: kas.com.au 

Enter this Passcode: 123456 

Thanks, Hotel Name 
- on behalf of KAS Keyless Access Security',
  )
);






?>