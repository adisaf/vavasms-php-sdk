<?php
require_once __DIR__ . '/../vendor/autoload.php';

$vavasms_username = 'your_username'; // Please register on https://vavasms.com
$vavasms_password = 'your_password';

$credit = new Adisaf\VavaSms\Credits();

try {
    $credit->authenticate($vavasms_username, $vavasms_password);
    $smsResult = $credit->get();
    if ($smsResult["message"] == "OPERATION_SUCCES") {
        $amount = $smsResult["data"]["amount"];
        echo "Credit is {$amount}";
    } else {
        echo "Api error : {$smsResult["message"]}";
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
}
