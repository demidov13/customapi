<?php

class Demidov_CustomApi_Model_ProductApi_Validator_Factory_ValidatorFactory
{
    public function create($className, $properties, $params)
    {
        return new $className($properties, $params);
    }
}