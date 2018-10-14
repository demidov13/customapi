<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($this->getTable('CustomApi/error_log'))
    ->addColumn('error_log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('error_message', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('error_type', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('error_trace', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => true,
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));

$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($this->getTable('CustomApi/successful_request'))
    ->addColumn('request_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('version', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('command', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ))
    ->addColumn('response', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));

$installer->getConnection()->createTable($table);
$installer->endSetup();