<?php

class Demidov_CustomApi_Model_Command_Processor_ProcessorFactory
{
    public function create($className, $handlerName, $params)
    {
        return new $className($handlerName, $params);
    }
}