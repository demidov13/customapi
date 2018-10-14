<?php

class Demidov_CustomApi_Block_Adminhtml_Support_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_support';
        $this->_blockGroup = 'CustomApi';
        $this->_headerText = Mage::helper('CustomApi')->__('Send mail in Support');
        parent::__construct();
        $this->_updateButton('save', 'label', Mage::helper('CustomApi')->__('Send a message'));
        $this->_removeButton('delete');
        $this->_removeButton('back');
    }
}