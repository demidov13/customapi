<?php

class Demidov_CustomApi_Adminhtml_SupportController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('CustomApi');
        $this->_addContent($this->getLayout()->createBlock('CustomApi/adminhtml_support_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            try {
                $metaData = Mage::helper('CustomApi')->getMetaData();
                $support = Mage::getModel('CustomApi/log_support');
                $support->logging($data, $metaData);

                Mage::helper('CustomApi')->sendMail($data['name'], $data['description']);

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Message sent successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/');
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Failed to send message'));
        $this->_redirect('*/*/');
    }
}