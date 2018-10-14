<?php

class Demidov_CustomApi_Model_Command_Processor
{
    protected $handlerName;
    protected $params;
    protected $result;

    public function __construct($handlerName, $params)
    {
        $this->handlerName = $handlerName;
        $this->params = $params;
    }

    public function run()
    {
        $handler = Mage::getModel('CustomApi/ProductApi_Handler_Factory_HandlerFactory')
            ->create($this->handlerName, $this->params);

        if ($handler instanceof Demidov_CustomApi_Model_ProductApi_Handler_BaseInterface) {
            $this->result = $handler->process();
        } else {
            throw new Demidov_CustomApi_Model_Exception('Handler does not match the base interface');
        }

        return $this->result;
    }
}