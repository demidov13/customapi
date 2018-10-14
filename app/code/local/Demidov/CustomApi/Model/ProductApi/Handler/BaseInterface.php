<?php

interface Demidov_CustomApi_Model_ProductApi_Handler_BaseInterface
{
    public function __construct(array $params);

    public function process();
}