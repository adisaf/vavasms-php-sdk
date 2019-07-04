<?php
require_once __DIR__ . '/../vendor/autoload.php';

$vavasms_username = 'your_username_here'; // Please register on https://vavasms.com
$vavasms_password = 'your_password_here';
$sender = 'your_sender_id';
$recipients = "+22507070707";
$message = "Hello, this is your OTP ##OTP##. Thank you";

$otp = new Adisaf\VavaSms\OTP();

try {
    $otp->setLang("en")
        ->setOtpExpiry("10")
        ->setOtpLength($message)
        ->setMessage(5)
        ->setSender($sender)
        ->setRecipients($recipients)
        ->authenticate($vavasms_username, $vavasms_password);
    $otpResult = $otp->send();
    if ($otpResult["message"] == "OPERATION_SUCCES") {
        $messageId = $otpResult["data"]["message_id"];
        echo "OTP to {$recipients} has id {$messageId}";
    } else {
        echo "error : {$otpResult["message"]}";
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
}
