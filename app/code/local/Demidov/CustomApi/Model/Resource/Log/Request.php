<?php

class Demidov_CustomApi_Model_Resource_Log_Request extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/successful_request', 'request_id');
    }
}