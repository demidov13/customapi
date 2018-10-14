<?php

class Demidov_CustomApi_Model_Resource_Log_Support extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/support_log', 'support_log_id');
    }
}