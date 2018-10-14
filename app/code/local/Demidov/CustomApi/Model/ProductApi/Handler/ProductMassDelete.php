<?php

class Demidov_CustomApi_Model_ProductApi_Handler_ProductMassDelete
    implements Demidov_CustomApi_Model_ProductApi_Handler_BaseInterface
{
    protected $ids;
    protected $result = [];
    protected $dataOutput;

    public function __construct(array $params)
    {
        $this->ids = $params['ids'];
    }

    public function process()
    {
        $currentStoreId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter('entity_id', array('in' => $this->ids));

        $difference = count($this->ids) - $products->count();
        if ($difference > 0) {
            $this->result['Removed products'] = $products->count();
            $this->result['Not found'] = $difference;
        } else {
            $this->result['Removed products'] = $products->count();
        }

        foreach ($products as $product) {
            $product->delete();
        }

        Mage::app()->setCurrentStore($currentStoreId);
        $this->dataOutput = Mage::getModel('CustomApi/Output_Type_Data_DataFactory')
            ->create('Demidov_CustomApi_Model_Output_Type_Data', $this->result);
        return $this->dataOutput;
    }
}