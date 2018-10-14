<?php

class Demidov_CustomApi_Model_Command_Validator_Result_ResultFactory
{
    public function create($className)
    {
        return new $className;
    }
}