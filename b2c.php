<?php
include 'accessToken.php';
include 'securitycridential.php';

$b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v3/paymentrequest';

$initiatorName = 'testapi';
// $securityCredential = 'fyiA2Hbb/OocnyuK3b9IoK0YtH0OnEwlhMmxk6BeSkxjnBnwNFtRG626dn9Pk42zppcVCsns7sM1f+VeX5yylzLirUMQrtUZL7rRbck1GVFQ5dD4aEgVYzYvtBOdy2ZATWP1EIyW7287hM6qhExEPmLliZr7sqbbpWSCc6ffSXsvUHTv3CH8q5xwCgKWzl2OuJD1+dh5grg6wSOEiJUGrvYnK+0wecMUqrcCIZ1/Lxt6zx0vqYlIcB7BXtx9J8Yt5EO5+Sn8I93EpkvdbQ7bZdHKHOzOI71ddH/ucCcH+hWW2BOXabD0/9tSjiIDXdq8B54yocwD/bmNanSyPWl/Wg==';
$commandID = 'SalaryPayment'; // SalaryPayment, BusinessPayment, PromotionPayment
$amount = '10';
$businessShortCode = '600983';
$phone = '254708374149';
$partyA = $businessShortCode;
$partyB = $phone;
$remarks = 'CHEPTERIT EDWIN WITHDRAWAL';
$queueTimeOutURL = 'https://c793-196-216-86-82.ngrok-free.app/darajaapi/b2cCallback.php';
$resultURL = 'https://c793-196-216-86-82.ngrok-free.app/darajaapi/dataMaxcallback.php';
$occasion = 'Online Payment';

// Generate a unique OriginatorConversationID
$originatorConversationID = uniqid();

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $b2c_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);

$curl_post_data = [
    'InitiatorName' => $initiatorName,
    'SecurityCredential' => $securityCredential,
    'CommandID' => $commandID,
    'Amount' => $amount,
    'PartyA' => $partyA,
    'PartyB' => $partyB,
    'Remarks' => $remarks,
    'QueueTimeOutURL' => $queueTimeOutURL,
    'ResultURL' => $resultURL,
    'Occasion' => $occasion,
    'OriginatorConversationID' => $originatorConversationID,
];

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'Curl error: ' . curl_error($curl);
}

// Check the HTTP status code
$http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo 'HTTP Status Code: ' . $http_status_code . PHP_EOL;

// Print the cURL response
echo 'Response: ' . $curl_response;

curl_close($curl);
?>


// include 'accessToken.php';
//include 'securitycridential.php';
// $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v3/paymentrequest';
// $InitiatorName = 'testapi';
// $pass = "Safaricom999!*!";
// $BusinessShortCode = "600983";
// $phone = "254708374149";
// $amountsend = '1';
<!-- // $SecurityCredential = 'kWX6HJmBjLnqO77cPuWnZ6e0Y9Uo0z'; -->
// $CommandID = 'SalaryPayment'; //SalaryPayment, BusinessPayment, PromotionPayment
// $Amount = $amountsend;
// $PartyA = $BusinessShortCode;
// $PartyB = $phone;
// $Remarks = 'CHEPTERIT EDWIN WITHDRAWAL';
// $QueueTimeOutURL = 'https://c793-196-216-86-82.ngrok-free.app/darajaapi/b2cCallback.php';
// $ResultURL = 'https://c793-196-216-86-82.ngrok-free.app/darajaapi/dataMaxcallback.php';
// $Occasion = 'Online Payment';
// /*Main B2C Request to the API */
// $curl = curl_init();
// curl_setopt($curl, CURLOPT_URL, $b2c_url);
// curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token]);
// $curl_post_data = array(
//     'InitiatorName' => $InitiatorName,
//     'SecurityCredential' => $SecurityCredential,
//     'CommandID' => $CommandID,
//     'Amount' => $Amount,
//     'PartyA' => $PartyA,
//     'PartyB' => $PartyB,
//     'Remarks' => $Remarks,
//     'QueueTimeOutURL' => $QueueTimeOutURL,
//     'ResultURL' => $ResultURL,
//     'Occasion' => $Occasion
// );
// $data_string = json_encode($curl_post_data);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
// $curl_response = curl_exec($curl);
// echo $curl_response;

