<?php

class Demidov_CustomApi_Model_Input_HttpRequest
{
    protected $uri, $body, $headers;

    public function __construct($uri, $body, $headers)
    {
        $this->uri = $uri;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}