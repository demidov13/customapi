<?php

class Demidov_CustomApi_Model_Input_HttpRequest_Result_Error
{
    protected $entities = [
        'version_format' => 'Wrong format version of the API',
        'command_format' => 'Wrong format of the API command',
        'token_bearer' => 'Token-bearer not found',
        'post' => 'HTTP request method is not POST',
        'data_format' => 'The data in the HTTP-request body should be in XML or JSON format'
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