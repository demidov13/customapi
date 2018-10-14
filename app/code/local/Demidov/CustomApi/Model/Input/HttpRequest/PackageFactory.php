<?php

class Demidov_CustomApi_Model_Input_HttpRequest_PackageFactory
{
    public function create($className, Demidov_CustomApi_Model_Input_HttpRequest $request, $format)
    {
        $arrUri = explode('/', $request->getUri());
        $version = $arrUri[1];
        $command = $arrUri[2] . ucfirst($arrUri[3]);
        $headers = $request->getHeaders();
        $token = $headers['token_bearer'];

        if ($format == 'json') {
            $params = Mage::helper('core')->jsonDecode($request->getBody());
        } else {
            $params = json_decode(json_encode(simplexml_load_string($request->getBody(),"SimpleXMLElement", LIBXML_NOCDATA), JSON_NUMERIC_CHECK),true);
        }

        return new $className($version, $command, $params, $token);
    }
}