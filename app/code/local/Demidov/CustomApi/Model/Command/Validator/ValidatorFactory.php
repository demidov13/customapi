<?php

class Demidov_CustomApi_Model_Command_Validator_ValidatorFactory
{
    public function create($className, Demidov_CustomApi_Model_Command_Definition $definition, $params)
    {
        $validators = $definition->getValidators();
        $properties = $definition->getProperties();
        return new $className($validators, $properties, $params);
    }
}