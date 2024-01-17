<?php
include 'accessToken.php';
include 'securitycridential.php';
$ReversalUrl = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
$InitiatorName = 'testapi';
$pass = "Safaricom999!*!";
$BusinessShortCode = "600988";
$request_data = array(
    'Initiator' => $InitiatorName,
    'SecurityCredential' => $securityCredential,
    'CommandID' => 'TransactionReversal',
    'TransactionID' => 'OEI2AK4Q16',
    'Amount' => '1',
    'ReceiverParty' => $BusinessShortCode,
    'RecieverIdentifierType' => '11',
    'Remarks' => 'Test',
    'Occasion' => 'work',
    'ResultURL' => 'https://ce96-196-216-86-73.ngrok-free.app/darajaapi/ResultURL.php',
    'QueueTimeOutURL' => 'https://ce96-196-216-86-73.ngrok-free.app/darajaapi/QueueTimeOutURL.php',
);
$data_string =json_encode($request_data);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $ReversalUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response;