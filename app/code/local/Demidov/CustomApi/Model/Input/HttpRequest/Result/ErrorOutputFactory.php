<?php

class Demidov_CustomApi_Model_Input_HttpRequest_Result_ErrorOutputFactory
{
    public function create($className, Demidov_CustomApi_Model_Input_HttpRequest_Result $result)
    {
        if (!$result->hasError()) {
            throw new Exception('Unknown error in HTTP Request');
        }
        return new $className($result->getError());
    }
}