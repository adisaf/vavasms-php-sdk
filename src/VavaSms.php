<?php

namespace Adisaf\VavaSms;

use Exception;
use GuzzleHttp\Client;

abstract class VavaSms
{
    public static $baseUrl = "https://vavasms.com/api/v1/";
    protected $username = false;
    protected $password = false;
    protected $client;

    protected $sender = null;
    protected $recipients = null;

    protected $message = null;

    protected $otpLength = 5;
    protected $otpExpiry = 60;
    protected $lang = "en";

    public function authenticate($api_username, $api_password)
    {
        $this->username = $api_username;
        $this->password = $api_password;

        if ($this->username === false) {
            throw new Exception("API Username cannot be empty");
        }

        if ($this->password === false) {
            throw new Exception("API Password cannot be empty");
        }
        return $this;
    }

    /**
     * Sets SMS Sender
     * @param string $sender Sender string can be alphanumeric (up to 11 chars) or numeric (e.g. +393401234567)
     * @return VavaSms
     * @throws Exception
     */
    public function setSender($sender)
    {
        $_sender = filter_var($sender, FILTER_SANITIZE_STRING);

        if (self::isValidNumberFormat($_sender) === false) {
            $sender_length = strlen($_sender);
            if ($sender_length > 11) {
                $this->sender = null;
                throw new Exception("Specified sender '$sender' is not valid");
            }
        }
        $this->sender = $_sender;
        return $this;
    }

    /**
     * Check format of a number
     * @param string $number Number to be checked
     * @return bool
     */
    public static function isValidNumberFormat($number)
    {
        return preg_match('/^\+?[0-9]{4,14}$/', $number) === 1;
    }

    /**
     * Sets SMS Recipients
     * @param string|array $recipients Recipients string or array
     * @return VavaSms
     * @throws Exception
     */
    public function setRecipients($recipients)
    {
        $_recipients = is_array($recipients) ? $recipients : array($recipients);

        foreach ($_recipients as $recipient) {
            if (self::isValidNumberFormat($recipient) === false) {
                $this->recipients = null;
                throw new Exception("Recipient '$recipient' is not valid");
            }
        }

        $this->recipients = $_recipients;
        return $this;
    }

    protected function getClient()
    {
        $this->client = new Client(array(
            'base_uri' => VavaSms::$baseUrl,
            'timeout' => 30,
        ));
        return $this->client;
    }

    protected function checkSendData($sms = true)
    {
        if ($sms == 'sms_send') {
            if (is_string($this->message) === false || empty($this->message)) {
                throw new Exception("SMS message text cannot be empty");
            }
        }
        if (empty($this->recipients)) {
            throw new Exception("At least one recipient is required");
        }

        if (empty($this->username) || empty($this->password)) {
            throw new Exception("Auth required");
        }
        if ($sms != "otp_verify") {
            if (empty($this->sender)) {
                throw new Exception("Sender text cannot be empty");
            }
        }
    }
}
