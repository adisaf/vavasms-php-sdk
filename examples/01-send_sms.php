<?php
require_once __DIR__ . '/../vendor/autoload.php';

$vavasms_username = 'your_username'; // Please register on https://vavasms.com
$vavasms_password = 'your_password';
$sender = 'your_sender_id';
$recipients = '+22507070707';
$text = 'Hello World!';

$sms = new Adisaf\VavaSms\SMS();

try {
    $sms->setMessage($text)
        ->setSender($sender)
        ->setRecipients($recipients)
        ->authenticate($vavasms_username, $vavasms_password);
    $smsResult = $sms->send();
    if ($smsResult["message"] == "OPERATION_SUCCES") {
        $lotId = $smsResult["data"]["lot_id"];
        foreach ($smsResult["data"]["message_id"] as $i => $messageId) {
            echo "Message to {$recipients[$i]} has id {$messageId} <br>";
        }
    } else {
        echo "error : {$smsResult["message"]}";
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
}
