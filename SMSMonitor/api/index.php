<?php
$postRequest = array(
    'site' => 'news',
    'mobileno' => '12121212'
);

$cURLConnection = curl_init('https://webtoall.in/smslog/api/addlog');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

echo json_decode($apiResponse)->success;



// $apiResponse - available data from the API request

// $jsonArrayResponse = json_decode($apiResponse);
// echo $jsonArrayResponse['success'];
?>