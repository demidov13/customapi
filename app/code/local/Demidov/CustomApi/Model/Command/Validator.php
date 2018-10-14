<?php

class Demidov_CustomApi_Model_Command_Validator
{
    protected $validators, $properties, $params;

    public function __construct($validators, $properties, $params)
    {
        $this->validators = $validators;
        $this->properties = $properties;
        $this->params = $params;
    }

    public function validate()
    {
        $result = Mage::getModel('CustomApi/Command_Validator_Result_ResultFactory')
            ->create('Demidov_CustomApi_Model_Command_Validator_Result');

        foreach ($this->validators as $validatorName) {
            $validator = Mage::getModel('CustomApi/ProductApi_Validator_Factory_ValidatorFactory')
                ->create($validatorName, $this->properties, $this->params);

            if ($validator instanceof Demidov_CustomApi_Model_ProductApi_Validator_BaseInterface) {
                if (!$validator->validate()) {
                    $result->addError($validator->getErrorMessages());
                }
            } else {
                throw new Demidov_CustomApi_Model_Exception('The validator does not match the base interface.');
            }
        }
        return $result;
    }
}