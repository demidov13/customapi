<?php

class Demidov_CustomApi_Model_Command_Validator_Result_ErrorOutputFactory
{
    public function create($className, $result)
    {
        if (!$result->hasError()) {
            throw new Demidov_CustomApi_Model_Exception('Unknown validation error');
        }
        return new $className($result->getError());
    }
}