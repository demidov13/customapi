<?php

class Demidov_CustomApi_Model_Output_Formator_Xml
    implements Demidov_CustomApi_Model_Output_Formator_FormatInterface
{
    public function toString(array $arrayResponse, $rootElement = null, $xml = null)
    {
        $_xml = $xml;

        if ($_xml === null) {
            $_xml = new SimpleXMLElement
            ($rootElement !== null ? $rootElement : "<root/>");
        }

        foreach ($arrayResponse as $key => $value) {
            if (is_array($value)) {
                $this->toString($value, $key, $_xml->addChild($key));
            } else {
                $_xml->addChild($key, $value);
            }
        }

        return $_xml->asXML();
    }
}