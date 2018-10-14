<?php

class Demidov_CustomApi_ApiController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        try {
            // Get $request and HTTP Validation
            //---------------------------------
            $request = Mage::getModel('CustomApi/Input_HttpRequest_HttpRequestFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequest');
            $httpValidator = Mage::getModel('CustomApi/Input_HttpRequestValidator_HttpRequestValidatorFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequestValidator', $request);
            $httpResult = $httpValidator->validate();
            $format = $httpResult->getFormat();

            if ($httpResult->hasError()) {
                $typeInstance = Mage::getModel('CustomApi/Input_HttpRequest_Result_ErrorOutputFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', $httpResult);
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $format);

                ob_get_clean();

                if ($format != 'flat') $this->getResponse()
                    ->setHeader("Content-type", "application/$format");

                return $this->getResponse()
                    ->setHeader('HTTP/1.1','400 Bad Request')
                    ->setBody($sender->send());
            }

            // Get $package
            //-------------
            $package = Mage::getModel('CustomApi/Input_HttpRequest_PackageFactory')
                ->create('Demidov_CustomApi_Model_Package', $request, $format);

            // Authentication
            //---------------
            if (!Mage::getSingleton('CustomApi/authentication')->check($package->getToken())) {

                $typeInstance = Mage::getModel('CustomApi/Output_Type_Errors_ErrorsFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', array('auth'));

                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $format);

                ob_get_clean();
                return $this->getResponse()
                    ->setHeader('HTTP/1.1','401 Unauthorized')
                    ->setHeader("Content-type", "application/$format")
                    ->setBody($sender->send());
            }

            // Get $set and version validation
            //--------------------------------
            $set = Mage::getModel('CustomApi/Command_Set_SetFactory')
                ->create('Demidov_CustomApi_Model_Command_Set', $package->getVersion());

            if ($set instanceof Demidov_CustomApi_Model_Output_Type_TypeInterface) {
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $set, $format);

                ob_get_clean();
                return $this->getResponse()
                    ->setHeader("Content-type", "application/$format")
                    ->setBody($sender->send());
            }

            // Get $definition and command validation
            //---------------------------------------
            $definition = $set->searchCommand($package->getCommand());

            if ($definition instanceof Demidov_CustomApi_Model_Output_Type_TypeInterface) {
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $definition, $format);

                ob_get_clean();
                return $this->getResponse()
                    ->setHeader("Content-type", "application/$format")
                    ->setBody($sender->send());
            }

            // Data validation
            //----------------
            $validator = Mage::getModel('CustomApi/Command_Validator_ValidatorFactory')
                ->create('Demidov_CustomApi_Model_Command_Validator', $definition, $package->getParams());
            $validationResult = $validator->validate();

            if ($validationResult->hasError()) {
                $typeInstance = Mage::getModel('CustomApi/Command_Validator_Result_ErrorOutputFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', $validationResult);
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $format);

                ob_get_clean();
                return $this->getResponse()
                    ->setHeader("Content-type", "application/$format")
                    ->setBody($sender->send());
            }

            // Data processing
            //----------------
            $processor = Mage::getModel('CustomApi/Command_Processor_ProcessorFactory')
                ->create('Demidov_CustomApi_Model_Command_Processor', $definition->getHandler(), $package->getParams());
            $responseData = $processor->run();

            // Send Response
            //--------------
            $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                ->create('Demidov_CustomApi_Model_Output_Sender', $responseData, $format);
            $response = $sender->send();

            if (Mage::getStoreConfig('custom_api_general/log/request')) {
                Mage::getSingleton('CustomApi/log_request')
                    ->logging($package->getVersion(), $package->getCommand(), $response);
            }

            ob_get_clean();
            return $this->getResponse()
                ->setHeader("Content-type", "application/$format")
                ->setBody($response);

        } catch (Demidov_CustomApi_Model_Exception $e) {

            if (Mage::getStoreConfig('custom_api_general/log/error')) {
                Mage::getSingleton('CustomApi/log_error')
                    ->logging($e->getMessage(), 2, $e->getTraceAsString());
            }

            ob_get_clean();
            return $this->getResponse()->setBody("Internal Error To The application: " . $e->getMessage());
        }
    }

    public function dispatch($action)
    {
        try {
            parent::dispatch($action);

        } catch (Exception $exception) {

            if (Mage::getStoreConfig('custom_api_general/log/error')) {
                Mage::getSingleton('CustomApi/log_error')
                    ->logging($exception->getMessage(), 3, $exception->getTraceAsString());
            }

            ob_get_clean();
            return $this->getResponse()->setBody($exception->getMessage());
        }
    }
}