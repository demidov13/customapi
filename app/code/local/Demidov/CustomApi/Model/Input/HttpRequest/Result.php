<?php

class Demidov_CustomApi_Model_Input_HttpRequest_Result
{
    protected $errors = [];
    protected $format = 'flat';

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function hasError()
    {
        $entityError = Mage::getModel('CustomApi/Input_HttpRequest_Result_Error');
        return $entityError->checkErrors($this->errors);
    }

    public function getError()
    {
        return $this->errors;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getFormat()
    {
        return $this->format;
    }
}