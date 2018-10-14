<?php

interface Demidov_CustomApi_Model_ProductApi_Validator_BaseInterface
{
    public function __construct(array $properties, array $params);

    public function validate();

    public function addErrorMessage($error);

    public function getErrorMessages();
}