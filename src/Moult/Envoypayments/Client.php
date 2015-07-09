<?php

namespace Moult\Envoypayments;

class Client
{
    private $api_key;
    private $client;

    public function __construct($api_key, $is_sandbox = TRUE)
    {
        $this->api_key = $api_key;

        if ($is_sandbox)
        {
            $base_uri = 'https://api-sandbox.envoyrecharge.com/v1/';
        }
        else
        {
            $base_uri = 'https://api.envoyrecharge.com/v1/';
        }

        $this->client = new \GuzzleHttp\Client(['base_uri' => $base_uri]);
    }

    public function request($method, $resource, array $body = array())
    {
        $body = array(
            'headers' => array(
                'x-user-token' => $this->api_key,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ),
            'body' => json_encode($body)
        );

        return $this->client->$method($resource, $body);
    }
}
