<?php

class Demidov_CustomApi_Model_Resource_Authentication extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/token_bearer', 'bearer_id');
    }
}