<?php

class Demidov_CustomApi_Model_Command_Validator_Result
{
    protected $errors = [];

    public function addError($error)
    {
        $this->errors = array_merge($this->errors, $error);
    }

    public function hasError()
    {
        $entityError = Mage::getModel('CustomApi/Command_Validator_Result_Error');
        return $entityError->checkErrors($this->errors);
    }

    public function getError()
    {
        return $this->errors;
    }
}