<?php

class Demidov_CustomApi_Model_Resource_Log_Error extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/error_log', 'error_log_id');
    }
}