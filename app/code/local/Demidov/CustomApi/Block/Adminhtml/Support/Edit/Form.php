<?php

class Demidov_CustomApi_Block_Adminhtml_Support_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('support_form');
        $this->setTitle(Mage::helper('CustomApi')->__('Send a mail in support'));
    }

    protected function _prepareForm()
    {
        $helper = Mage::helper('CustomApi');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            'method' => 'post'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('support_form', array('legend' => $helper->__('Write a message')));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));
        $fieldset->addField('description', 'textarea', array(
            'label' => $helper->__('Description'),
            'required' => true,
            'name' => 'description',
        ));

        $form->setUseContainer(true);

        return parent::_prepareForm();
    }
}