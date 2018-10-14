<?php

class Demidov_CustomApi_Model_Output_Formator_Json
    implements Demidov_CustomApi_Model_Output_Formator_FormatInterface
{
    public function toString(array $arrayResponse)
    {
        return Mage::helper('core')->jsonEncode($arrayResponse);
    }
}