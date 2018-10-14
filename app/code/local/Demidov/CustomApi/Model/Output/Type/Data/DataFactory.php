<?php

class Demidov_CustomApi_Model_Output_Type_Data_DataFactory
{
    public function create($className, $response)
    {
        if (!isset($response)) {
            throw new Demidov_CustomApi_Model_Exception('Response data is empty');
        }
        return new $className($response);
    }
}