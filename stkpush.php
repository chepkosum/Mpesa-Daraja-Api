<?php
//INCLUDE THE ACCESS TOKEN FILE

include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = 'https://37c9-196-216-86-84.ngrok-free.app/darajaapi/callback.php';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');
//ENCRYPT DATA TO GET PASSWORD
$password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
$phone = '254726620050';
$money = '1';
$PartyA = $phone;
$partyB = '254708374149';
$AccountReference = 'EDWIN SOFTWARES';
$TransactionDesc = 'stkpush test';
$Amount = $money;
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
//INITIATING CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

//ECHO THE RESPONSE
// echo $curl_response;
$data = json_decode($curl_response);
$CheckoutRequestID = $data->CheckoutRequestID;
$ResponseCode = $data->ResponseCode;
if($ResponseCode =="0"){
echo "The CheckoutRequestID for this transaction is: ".$CheckoutRequestID;
}
// if (isset($data->ResponseCode)) {
//     $ResponseCode = $data->ResponseCode;
//     if($ResponseCode == '0'){
//         $message = "The transaction is successfully";
//     }elseif($ResponseCode == '1'){
//         $message = "The balance is insufficient for the transaction";
//     }elseif($ResponseCode == '1032'){
//         $message = "The transaction has been cancelled by user";
//     }elseif($ResponseCode == '1037'){
//         $message = "Timeout in completing the transaction";
//     }
// }