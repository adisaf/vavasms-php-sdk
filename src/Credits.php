<?php

namespace Adisaf\VavaSms;

use GuzzleHttp\Exception\GuzzleException;

class Credits extends VavaSms
{

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        $payload = array(
            'username' => $this->username,
            'password' => $this->password
        );
        try {
            $result = $this->getClient()->request('POST', "check/balance", array("form_params" => $payload));
        } catch (GuzzleException $e) {
            $result = $e->getResponse();
        }
        return \GuzzleHttp\json_decode($result->getBody()->getContents(), true);
    }
}
