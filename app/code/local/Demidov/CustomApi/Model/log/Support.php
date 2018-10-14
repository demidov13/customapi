<?php

class Demidov_CustomApi_Model_Log_Support extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/log_support');
    }

    public function logging($data, $metaData)
    {
        $data['name'] = htmlspecialchars($data['name']);
        $data['description'] = htmlspecialchars($data['description']);
        $this->setData($data)
            ->setMetadata($metaData)
            ->setCreated(Mage::app()->getLocale()->date());
        $this->save();
    }
}