<?php

class Demidov_CustomApi_Model_Source_Status
{
    const ENABLED = 1;
    const DISABLED = 0;

    public function toOptionArray()
    {
        return array(
            array('value' => self::ENABLED, 'label'=>Mage::helper('CustomApi')->__('Enabled')),
            array('value' => self::DISABLED, 'label'=>Mage::helper('CustomApi')->__('Disabled')),
        );
    }

    public function toArray()
    {
        return array(
            self::DISABLED => Mage::helper('CustomApi')->__('Disabled'),
            self::ENABLED => Mage::helper('CustomApi')->__('Enabled'),
        );
    }

}