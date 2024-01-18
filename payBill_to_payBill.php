<?php
include 'accessToken.php';
include 'securitycridential.php';
$apiUrl = "https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest";
$initiator = "testapi";
$amount = "1";
$partyA = "600991"; // Business short code
$partyB = "000000"; // Merchant's short code or till number
$accountReference = "353353"; // A unique reference number for the transaction
$requester = "254700000000"; // Phone number of the person making the request
$remarks = "OK"; // Optional remarks for the transaction
$queueTimeOutURL = "https://37c9-196-216-86-84.ngrok-free.app/darajaapi/payBill_to_PayBill_Callback.php";
$resultURL = "https://37c9-196-216-86-84.ngrok-free.app/darajaapi/payBill_to_PayBill_Callback.php";
// Prepare the request body as an array
$requestBody = array(
    'Initiator' => $initiator,
    'SecurityCredential' => $securityCredential,
    'CommandID' => 'BusinessPayBill',
    'SenderIdentifierType' => '4',
    'RecieverIdentifierType' => '4',
    'Amount' => $amount,
    'PartyA' => $partyA,
    'PartyB' => $partyB,
    'AccountReference' => $accountReference,
    'Requester' => $requester,
    'Remarks' => $remarks,
    'QueueTimeOutURL' => $queueTimeOutURL,
    'ResultURL' => $resultURL,
);
$requestJson = json_encode($requestBody);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization:Bearer ' . $access_token // Replace with your actual access token
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo $response;