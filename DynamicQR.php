<?php
include 'accessToken.php';
$DynamicQRUrl = 'https://sandbox.safaricom.co.ke/mpesa/qrcode/v1/generate';
$MerchantName = "Chepterit Softwares";
$BusinessShortCode = "600997";
$AccountNumber = "Edwin123";
$payload = array(
    'MerchantName' => $MerchantName,
    'RefNo' => $AccountNumber,
    'Amount' => '1',
    'TrxCode' => 'PB',
    'CPI' => $BusinessShortCode,
    'Size' => '300',
);
$data_string =json_encode($payload);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $DynamicQRUrl);
curl_setopt($curl, CURLINFO_HEADER_OUT, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($curl);
$resp = json_decode($response);
$resp->QRCode;
if (isset($resp->QRCode)) {
    $data = $resp->QRCode;
    $qrImage = "data:image/jpeg;base64, {$resp->QRCode}";
} else {
    echo "An Error has Occured. Please try again later.";
}


?>
<img class="qrcode" src="<?= $qrImage?>" alt="QR Code">