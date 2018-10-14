<?php

class Demidov_CustomApi_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{

    public function initControllerRouters($observer)
    {
        $front = $observer->getEvent()->getFront();
        $front->addRouter('CustomApi', $this);
    }

    public function match(Zend_Controller_Request_Http $request)
    {
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }

        $identifier = trim($request->getPathInfo(), '/');
        if (strpos($identifier, 'customapi') !== false) {
            $request->setModuleName('customapi')
                ->setControllerName('api')
                ->setActionName('index');

            $request->setAlias(Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS, $identifier);
            return true;
        }

        return false;
    }
}