<?php

class Demidov_CustomApi_Model_Output_Sender_SenderFactory
{
    public function create($className, $typeInstance, $format)
    {
        switch ($format) {
            case 'flat':
                $formatInstance = new Demidov_CustomApi_Model_Output_Formator_Flat();
                break;
            case 'json':
                $formatInstance = new Demidov_CustomApi_Model_Output_Formator_Json();
                break;
            case 'xml':
                $formatInstance = new Demidov_CustomApi_Model_Output_Formator_Xml();
                break;
            default:
                throw new Demidov_CustomApi_Model_Exception('Error while generating the response. Unknown response format');
        }
        return new $className($typeInstance, $formatInstance);
    }
}