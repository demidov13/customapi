<?php

class Demidov_CustomApi_Model_Input_HttpRequest_Result_ResultFactory
{
    public function create($className)
    {
        return new $className;
    }
}