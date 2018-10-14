<?php

class Demidov_CustomApi_Model_Log_Error extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/log_error');
    }

    public function logging($errorMessage, $type, $trace = null)
    {
        if (is_array($errorMessage)) {
            $errorMessage = implode('. ', $errorMessage);
        }

        if ($trace !== null) {
            $this->setErrorTrace($trace);
        }

        $this->setErrorMessage($errorMessage)
            ->setErrorType($type)
            ->setCreatedAt(Mage::app()->getLocale()->date());
        $this->save();
    }
}