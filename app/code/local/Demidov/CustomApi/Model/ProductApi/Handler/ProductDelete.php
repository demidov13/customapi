<?php

class Demidov_CustomApi_Model_ProductApi_Handler_ProductDelete
    implements Demidov_CustomApi_Model_ProductApi_Handler_BaseInterface
{
    protected $id;
    protected $result = [];
    protected $dataOutput;

    public function __construct(array $params)
    {
        $this->id = $params['id'];
    }

    public function process()
    {
        $currentStoreId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $product = Mage::getModel('catalog/product');
        $product->load($this->id);
        $product->delete();
        $this->result[$this->id] = 'Removed';

        Mage::app()->setCurrentStore($currentStoreId);
        $this->dataOutput = Mage::getModel('CustomApi/Output_Type_Data_DataFactory')
            ->create('Demidov_CustomApi_Model_Output_Type_Data', $this->result);
        return $this->dataOutput;
    }
}