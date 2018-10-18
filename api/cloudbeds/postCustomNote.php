<?php

$curl = curl_init();

$access_token = 'KtrTTnxPaIxQkYpKlfQNVRrysB8Bzr2O5IsYYgML';

$curl_post_data = array(
    'reservationID' => '5162194486',
);

curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token ));
curl_setopt($curl, CURLOPT_URL, "https://hotels.cloudbeds.com/api/v1.1/putReservationDetails");
//curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);

$responseJson = curl_exec($curl);
curl_close($curl);

//echo $responseJson;


?>