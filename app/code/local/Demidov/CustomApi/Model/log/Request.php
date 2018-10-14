<?php

class Demidov_CustomApi_Model_Log_Request extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/log_request');
    }

    public function logging($version, $command, $response)
    {
        $version = ltrim($version, "v");
        $this->setVersion($version)
            ->setCommand($command)
            ->setResponse($response)
            ->setCreatedAt(Mage::app()->getLocale()->date());
        $this->save();
    }
}