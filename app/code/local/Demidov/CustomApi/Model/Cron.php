<?php

class Demidov_CustomApi_Model_Cron
{
    public function api_support_clear_log()
    {
        $logs = Mage::getModel('CustomApi/log_support')->getCollection();
        foreach ($logs as $log) {
            $log->delete();
        }
    }

    public function api_error_clear_log()
    {
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $table = $resource->getTableName('CustomApi/error_log');
        $query = "DELETE FROM {$table}";
        $writeConnection->query($query);
    }

    public function api_request_clear_log()
    {
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $table = $resource->getTableName('CustomApi/successful_request');
        $query = "DELETE FROM {$table}";
        $writeConnection->query($query);
    }
}