<?php
global $post;

$merchantRefNumber = get_post_meta($post->ID, 'merchantRefNumber', true);

$merchantCode    = MERCHANT_CODE;
// $merchantRefNumber  = '23124654641';
$merchant_sec_key =  MERCHANT_SEC_KEY; // For the sake of demonstration
$signature = hash('sha256', $merchantCode . $merchantRefNumber . $merchant_sec_key);
$httpClient = new \GuzzleHttp\Client(); // guzzle 6.3
$response = $httpClient->request('GET', 'https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/payments/status/v2', [
    'query' => [
        'merchantCode' => $merchantCode,
        'merchantRefNumber' => $merchantRefNumber,
        'signature' => $signature
    ]
]);
$response = json_decode($response->getBody()->getContents(), true);
// $paymentStatus = $response['payment_status']; 
echo 'red';
echo '<pre>';
var_dump($response);
