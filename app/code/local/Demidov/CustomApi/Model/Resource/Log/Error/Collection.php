<?php

class Demidov_CustomApi_Model_Resource_Log_Error_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/log_error');
    }
}