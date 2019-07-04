<?php

namespace Adisaf\VavaSms;

use GuzzleHttp\Exception\GuzzleException;

class SMS extends VavaSms
{

    /**
     * @return mixed
     * @throws \Exception
     */
    public function send()
    {
        $this->checkSendData("sms_send");
        $payload = array(
            'username' => $this->username,
            'password' => $this->password,
            'sender_id' => $this->sender,
            'phone' => implode(',', $this->recipients),
            'message' => $this->message
        );
        try {
            $result = $this->getClient()->request('POST', "text/single", array("form_params" => $payload));
        } catch (GuzzleException $e) {
            $result = $e->getResponse();
        }
        return \GuzzleHttp\json_decode($result->getBody()->getContents(), true);
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
