<?php
require_once __DIR__ . '/../vendor/autoload.php';

$vavasms_username = 'your_username_here'; // Please register on https://vavasms.com
$vavasms_password = 'your_password_here';
$recipients = "+22507070707";
$otpValue = "12345"; //OTP Value
$otp = new Adisaf\VavaSms\OTP();

try {
    $otp->setRecipients($recipients)
        ->authenticate($vavasms_username, $vavasms_password);
    $otpResult = $otp->verify($otpValue);
    if ($otpResult["message"] == "OPERATION_SUCCES") {
        echo "OTP is correct";
    } elseif ($otpResult["message"] == "EXPIRED_OTP") {
        echo "OTP is correct but has expired";
    } elseif ($otpResult["message"] == "INVALID_OTP") {
        echo "OTP is incorrect";
    } elseif ($otpResult["message"] == "OTP_NOT_FOUND") {
        echo "OTP is not found";
    } else {
        echo "error : {$otpResult["message"]}";
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
}
