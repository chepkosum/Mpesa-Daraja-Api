<?php
include 'accessToken.php';
include 'securitycridential.php';
$TaxRemittanceUrl = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/remittax';
$InitiatorName = 'TaxPayer';
$BusinessShortCode = "600426";
$KRA_SHORT_CODE = "572572";
$KRA_PIN = "EDWIN12443";
$request_data = array(
    'Initiator' => $InitiatorName,
    'SecurityCredential' => $securityCredential,
    'CommandID' => 'PayTaxToKRA',
    'Amount' => '1',
    'RecieverIdentifierType' => '4',
    'SenderIdentifierType' => '4',
    'PartyA' => $BusinessShortCode,
    'PartyB' => $KRA_SHORT_CODE,
    'AccountReference' => $KRA_PIN,
    'Remarks' => 'OK',
    'ResultURL' => 'https://ce96-196-216-86-73.ngrok-free.app/darajaapi/ResultURL.php',
    'QueueTimeOutURL' => 'https://ce96-196-216-86-73.ngrok-free.app/darajaapi/QueueTimeOutURL.php',
);
$data_string =json_encode($request_data);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $TaxRemittanceUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response;