<?php

$curl = curl_init();

$access_token = 'oVMrd9drHEqVuUsEgtV9BfMdHOGZe0NW1lyK4zue';


$subject = array(
    'en' => 'test',
);
$body = array(
    'en' => 'body',
);
//print_r($subject);

$curl_post_data = array (
    'name' => 'MobileKey',
    'from' => 'josh@kas.com.au',
    'subject' => $subject,
    'body' => $body,
    'emailType' => 'nonMarketing',
);

print_r($curl_post_data);

curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token ));
curl_setopt($curl, CURLOPT_URL, "https://hotels.cloudbeds.com/api/v1.1/postEmailTemplate");

curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);

$responseJson = curl_exec($curl);
curl_close($curl);

echo $responseJson;

// include('includes/Functions.php');
// $fn = new Functions();


// $refresh_token = 'JX80ibf8Bb3bc3DMLo6wSrK0vxYq6I0SG8WF42Gr';
// // $result = $fn->refreshToken($refresh_token);
// // echo $result;

// $curl = curl_init();
// $curl_post_data = array(
//     'grant_type' => 'refresh_token',
//     'client_id' => 'kas',
//     'client_secret' => 'EUsmPOwb3peBfQ4vdTpXu38O9NKkHfuK',
//     'redirect_uri' => 'http://onlinetool.kas.com.au/api/cloudbeds/auth.php',
//     'refresh_token' => $refresh_token,
// );

// curl_setopt($curl, CURLOPT_URL, "https://hotels.cloudbeds.com/api/v1.1/access_token");
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $responseJson = curl_exec($curl);
// curl_close($curl);
// echo $responseJson;


?>