<?php

class Demidov_CustomApi_Model_Command_Definition_DefinitionFactory
{
    public function create($className, $version, $command)
    {
        $validators = Mage::getConfig()
            ->getNode("global/customapi_config/$version/$command/validators")
            ->asArray();
        $handlerNode = Mage::getConfig()
            ->getNode("global/customapi_config/$version/$command/handler")
            ->asArray();
        $handler = $handlerNode['className'];
        $properties = $handlerNode['properties'];

        return new $className($version, $command, $validators, $handler, $properties);
    }
}