<?php

class Demidov_CustomApi_Model_Output_Type_Errors_Entity
{
    protected $entities = [
        'version_format' => 'Wrong format version of the API',
        'command_format' => 'Wrong format of the API command',
        'token_bearer' => 'Token-bearer not found',
        'post' => 'HTTP request method is not POST',
        'data_format' => 'The data in the HTTP-request body should be in XML or JSON format',
        'count_of_params' => 'Invalid number of parameters for this command',
        'param_not_exist' => 'The passed parameter is not found in the command properties',
        'type_of_param' => 'Parameter type does not match property type',
        'property_missing' => 'Missing required parameter',
        'min_values' => 'The parameter value is lower than the minimum value',
        'max_values' => 'The parameter value is higher than the maximum allowed value',
        'invalid_values' => 'Invalid parameter value',
        'product_not_found' => 'The requested product is not found',
        'auth' => 'Authentication failed'
    ];

    public function getMessage($errors)
    {
        $message = '';
        foreach ($this->entities as $key => $value) {
            foreach ($errors as $error) {
                if ($key == $error) {
                    $message .= $value.'.';
                }
            }
        }
        return trim($message,'.');
    }
}