<?php
header("Content-Type: application/json");
$PTPCallbackResponse = file_get_contents('php://input');
$logFile = "payBill_To_payBill.json";
$log = fopen($logFile, "a");
fwrite($log, $PTPCallbackResponse);
fclose($log);