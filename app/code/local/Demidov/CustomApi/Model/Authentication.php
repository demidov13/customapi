<?php

class Demidov_CustomApi_Model_Authentication extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/authentication');
    }

    public function check($token)
    {
        $bearers = $this->getCollection();
        foreach ($bearers as $bearer) {
            if($bearer->getToken() == $token) {
                return true;
            }
        }
        return false;
    }
}