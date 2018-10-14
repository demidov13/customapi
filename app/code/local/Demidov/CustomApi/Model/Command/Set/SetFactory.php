<?php

class Demidov_CustomApi_Model_Command_Set_SetFactory
{
    public function create($className, $version)
    {
        if (Mage::getConfig()->getNode("global/customapi_config/$version")) {
            return new $className($version);
        }

        $dataOutput = Mage::getModel('CustomApi/Output_Type_Errors_ErrorsFactory')
            ->create('Demidov_CustomApi_Model_Output_Type_Errors', 'API version '.$version.' not found');
        return $dataOutput;
    }
}