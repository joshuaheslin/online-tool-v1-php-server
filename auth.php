<?php
echo "<br>";

echo "/--------------AUTH W SERVER---------------/  <br>";

$url = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/accesstoken';
//'https://121.40.42.36/ilocks/api/apps/v1/servers/accesstoken';

$params = array(
    'password' => '445566',       //ENTER THE SERVER PASSWORD HERE 445566
    'device_mac' => '123443423413241',           
    'username' => 'kas-server'    //ENTER THE SERVER USERNAME HERE kas-server
);

$responseJson = CallAPIAuth("POST", $url, $params);
echo $responseJson;


$response = json_decode($responseJson);
echo "<br>-- <br>access_token: ";
echo $response->access_token;
echo "<br>refresh_token: ";
echo $response->refresh_token;
echo "<br><br><br>";


function CallAPIAuth($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "testserver:123456");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //false //CURLOPT_RETURNTRANSFER tells PHP to store the response in a variable instead of printing it to the page, so $response will contain your response. Here's your most basic working code (I think, didn't test it):
    //enter token from authentication API call
    //$authorization = "Authorization: Bearer " . $token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); //, $authorization));
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}




?>
