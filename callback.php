<?php
header("Content-Type : application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "MPesastkresponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->$ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$UserPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->value;


//CHECK IF THE TRANSACTION WAS SUCCESSFUL
if($ResultCode == 0){
    //UPDATE THE DATABASE WITH THE TRANSACTION DETAILS
    $sql = "UPDATE transactions SET TransactionId = '$TransactionId', ResultCode= '$ResultCode', ResultDesc ='$ResultDesc, Amount = '$Amount', TransactionId= '$TransactionId', UserPhoneNumber= '$UserPhoneNumber'";
    $query = mysqli_query($conn, $sql);
    if($query){
        //SEND A SUCCESS MESSAGE TO THE USER
        echo "Transaction Successful";
    } else{
        //SEND A FAILURE MESSAGE TO THE USER
        echo "Transaction Failed";
    }
}