<?php

class Demidov_CustomApi_Model_Command_Validator_Result_Error
{
    protected $entities = [
        'count_of_params' => 'Invalid number of parameters for this command',
        'param_not_exist' => 'The passed parameter is not found in the command properties',
        'type_of_param' => 'Parameter type does not match property type',
        'property_missing' => 'Missing required parameter',
        'min_values' => 'The parameter value is lower than the minimum value',
        'max_values' => 'The parameter value is higher than the maximum allowed value',
        'invalid_values' => 'Invalid parameter value',
        'product_not_found' => 'The requested product is not found'
    ];

    public function checkErrors($errors)
    {
        foreach ($this->entities as $key => $value) {
            if (in_array($key, $errors)) {
                return true;
            }
        }
        return false;
    }
}