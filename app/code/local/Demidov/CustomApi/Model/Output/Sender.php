<?php

class Demidov_CustomApi_Model_Output_Sender
{
    protected $typeInstance;
    protected $formatInstance;

    public function __construct($typeInstance, $formatInstance)
    {
        if($typeInstance instanceof Demidov_CustomApi_Model_Output_Type_TypeInterface) {
            $this->typeInstance = $typeInstance;
        } else {
            throw new Demidov_CustomApi_Model_Exception('Error while generating the response. Invalid instance OutputType');
        }

        if ($formatInstance instanceof Demidov_CustomApi_Model_Output_Formator_FormatInterface) {
            $this->formatInstance = $formatInstance;
        } else {
            throw new Demidov_CustomApi_Model_Exception('Error while generating the response. Invalid instance OutputFormat');
        }
    }

    public function send()
    {
        $response = $this->formatInstance->toString($this->typeInstance->toArray());
        return $response;
    }
}