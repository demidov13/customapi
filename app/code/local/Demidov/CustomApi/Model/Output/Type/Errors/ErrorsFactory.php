<?php

class Demidov_CustomApi_Model_Output_Type_Errors_ErrorsFactory
{
    public function create($className, $error)
    {
        return new $className($error);
    }
}