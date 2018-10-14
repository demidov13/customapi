<?php

class Demidov_CustomApi_Model_ProductApi_Handler_FixedPriceIncrease
    implements Demidov_CustomApi_Model_ProductApi_Handler_BaseInterface
{
    protected $amount;
    protected $result = [];
    protected $dataOutput;

    public function __construct(array $params)
    {
        $this->amount = $params['amount'];
    }

    public function process()
    {
        $currentStoreId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $collectionSimple = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToFilter('type_id', array('eq' => 'simple'))
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('price');

        if (!$collectionSimple->count()) {
            $this->dataOutput = Mage::getModel('CustomApi/Output_Type_Errors_ErrorsFactory')
                ->create('Demidov_CustomApi_Model_Output_Type_Errors', 'Simple products not found');
            Mage::app()->setCurrentStore($currentStoreId);
            return $this->dataOutput;
        }

        foreach ($collectionSimple as $product) {
            $price = $product->getData('price');
            $price += $this->amount;
            $product->setData('price', $price);
            $info['id'] = $product->getData('entity_id');
            $info['sku'] = $product->getData('sku');
            $info['name'] = $product->getData('name');
            $info['price'] = round($product->getData('price'), 2);
            $this->result[] = $info;
        }

        $collectionSimple->save();
        Mage::app()->setCurrentStore($currentStoreId);

        $this->dataOutput = Mage::getModel('CustomApi/Output_Type_Data_DataFactory')
            ->create('Demidov_CustomApi_Model_Output_Type_Data', $this->result);

        return $this->dataOutput;
    }
}