# Vavasms PHP SMS API SDK

PHP client library to send SMS messages using Vavasms SMS Gateway.

To use this library, you must have a valid account on https://www.vavasms.com.

**Please note** SMS messages sent with this library will be deducted by your Vavasms account credits.

For any questions, please contact us at tech@vavasms.com

# How to send a message
 
```php
<?php
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
```


# Installation

## Composer (recommended)

Install it via composer (https://getcomposer.org/).

* Run `composer require adisaf/vavasms-php-sdk`
* See script example https://github.com/wazcodes/vavasms/blob/master/examples/


## Other autoloaders

This package is PSR-4 compliant, so you can clone the repository in your project and a use PSR-4 compatible autoloader (e.g. Symfony or Laravel)

## Manual installation

You can simply clone the repository into your project and use the classes contained in src/ directory.

Please check the examples directory here: https://github.com/adisaf/vavasms-php-sdk/blob/master/examples/

# More info

You can check out our website https://vavasms.com or contact us.

# Contributing

If you wish to contribute to this project, please feel free to send us pull request. We'll be happy to check them out!
