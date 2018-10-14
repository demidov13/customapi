<?php

class Demidov_CustomApi_Model_ProductApi_Validator_ValueExist
    implements Demidov_CustomApi_Model_ProductApi_Validator_BaseInterface
{
    protected $properties;
    protected $params;
    protected $errorMessages = [];
    protected $isValid = true;

    public function __construct(array $properties, array $params)
    {
        $this->properties = $properties;
        $this->params = $params;
    }

    public function validate()
    {
        if ($this->properties['min_values']) {
            foreach ($this->params as $key => $value) {
                if (isset($this->properties['min_values'][$key]) && $this->properties['min_values'][$key] > $value
                && is_integer($value)) {
                    $this->addErrorMessage('min_values');
                    $this->isValid = false;
                    break;
                }
            }
        }

        if ($this->properties['max_values']) {
            foreach ($this->params as $key => $value) {
                if (isset($this->properties['max_values'][$key]) && $this->properties['max_values'][$key] < $value
                    && is_integer($value)) {
                    $this->addErrorMessage('max_values');
                    $this->isValid = false;
                    break;
                }
            }
        }

        if ($this->properties['valid_values']) {
            foreach ($this->params as $key => $value) {
                if ($this->properties['valid_values'][$key] &&
                    !in_array($value, $this->properties['valid_values'][$key])) {
                    $this->addErrorMessage('invalid_values');
                    $this->isValid = false;
                    break;
                }
            }
        }

        return $this->isValid;
    }

    public function addErrorMessage($error)
    {
        $this->errorMessages[] = $error;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}