<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($this->getTable('CustomApi/support_log'))
    ->addColumn('support_log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, '255', array(
        'nullable'  => false,
    ))
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('metadata', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));

$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($this->getTable('CustomApi/token_bearer'))
    ->addColumn('bearer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('bearer_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, '255', array(
        'nullable'  => false,
    ))
    ->addColumn('token', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ));

$installer->getConnection()->createTable($table);

$installer->endSetup();