<?php

class Demidov_CustomApi_Model_Input_HttpRequestValidator_HttpRequestValidatorFactory
{
    public function create($className, Demidov_CustomApi_Model_Input_HttpRequest $request)
    {
        return new $className($request);
    }
}