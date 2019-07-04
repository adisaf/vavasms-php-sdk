<?php

namespace Adisaf\VavaSms;

use GuzzleHttp\Exception\GuzzleException;

class OTP extends VavaSms
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function send()
    {
        $this->checkSendData("otp_send");

        $payload = array(
            'username' => $this->username,
            'password' => $this->password,
            'sender_id' => $this->sender,
            'otp_expiry' => $this->otpExpiry,
            'otp_length' => $this->otpLength,
            'message' => $this->message,
            'phone' => implode(',', $this->recipients),
            'lang' => $this->lang
        );
        try {
            $result = $this->getClient()->request('POST', "otp/send", array("form_params" => $payload));
        } catch (GuzzleException $e) {
            $result = $e->getResponse();
        }
        return \GuzzleHttp\json_decode($result->getBody()->getContents(), true);
    }

    /**
     * @param $otp
     * @return mixed
     * @throws \Exception
     */
    public function verify($otp)
    {
        $this->checkSendData("otp_verify");

        $payload = array(
            'username' => $this->username,
            'password' => $this->password,
            'otp' => $otp,
            'phone' => implode(',', $this->recipients)
        );
        try {
            $result = $this->getClient()->request(
                'POST',
                "otp/verify",
                array("form_params" => $payload)
            );
        } catch (GuzzleException $e) {
            $result = $e->getResponse();
        }
        return \GuzzleHttp\json_decode($result->getBody()->getContents(), true);
    }

    /**
     * @param $otpExpiry
     * @return $this
     */
    public function setOtpExpiry($otpExpiry)
    {
        $this->otpExpiry = $otpExpiry;
        return $this;
    }

    /**
     * @param $otpLength
     * @return $this
     */
    public function setOtpLength($otpLength)
    {
        $this->otpLength = $otpLength;
        return $this;
    }

    /**
     * @param $lang
     * @return $this
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
