<?php

class Demidov_CustomApi_Model_Input_HttpRequest_HttpRequestFactory
{
    public function create($className)
    {
        $uri = trim(Mage::app()->getRequest()->getRequestUri(), '/');
        $body = file_get_contents('php://input');
        $headers = [];
        $token = Mage::app()->getRequest()->getHeader('token-bearer');
        $headers['token_bearer'] = $token;
        $accept = Mage::app()->getRequest()->getHeader('Accept');
        $headers['accept'] = $accept;
        $content_type = Mage::app()->getRequest()->getHeader('Content-Type');
        $headers['content_type'] = $content_type;

        return new $className($uri, $body, $headers);
    }
}