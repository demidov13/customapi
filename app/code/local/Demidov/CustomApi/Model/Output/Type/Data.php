<?php

class Demidov_CustomApi_Model_Output_Type_Data implements Demidov_CustomApi_Model_Output_Type_TypeInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toArray()
    {
        if (is_object($this->data) || is_resource($this->data) || is_callable($this->data)) {
            throw new Demidov_CustomApi_Model_Exception('Invalid response data format');
        }
        if (!is_array($this->data)) {
            $arr[] = $this->data;
            return $arr;
        }
        return $this->data;
    }
}