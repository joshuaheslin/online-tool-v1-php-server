<?php

class Functions
{
    private $token;

    function __construct()
    {
    }

    public function refreshToken($refresh_token) {
        $curl = curl_init();
        $curl_post_data = array(
            'grant_type' => 'refresh_token',
            'client_id' => 'kas',
            'client_secret' => 'EUsmPOwb3peBfQ4vdTpXu38O9NKkHfuK',
            'redirect_uri' => 'http://onlinetool.kas.com.au/api/cloudbeds/auth.php',
            'refresh_token' => $refresh_token,
        );

        curl_setopt($curl, CURLOPT_URL, "https://hotels.cloudbeds.com/api/v1.1/access_token");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $responseJson = curl_exec($curl);
        curl_close($curl);
        return $responseJson;
    }

    public function CallAuthAPI($code)
    {

        $curl = curl_init();
        $curl_post_data = array(
         'grant_type' => 'authorization_code',
         'client_id' => 'kas',
         'client_secret' => 'EUsmPOwb3peBfQ4vdTpXu38O9NKkHfuK',
         'redirect_uri' => 'http://onlinetool.kas.com.au/api/cloudbeds/auth.php',
         'code' => $code,
        );
        
        //echo $code;
        
        curl_setopt($curl, CURLOPT_URL, "https://hotels.cloudbeds.com/api/v1.1/access_token");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $responseJson = curl_exec($curl);
        curl_close($curl);
    
        return $responseJson;
    }


}


?>
