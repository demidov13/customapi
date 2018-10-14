<?php

class Demidov_CustomApi_Model_Output_Formator_Flat
    implements Demidov_CustomApi_Model_Output_Formator_FormatInterface
{
    public function toString(array $arrayResponse)
    {
        return implode('. ', $arrayResponse);
    }
}