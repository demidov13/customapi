<?php
class Demidov_CustomApi_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getMetaData()
    {
        $metaData = [];
        $metaData['browser'] = Mage::app()->getRequest()->getHeader('User-Agent');
        $metaData['host'] = Mage::app()->getRequest()->getHeader('host');

        $result = serialize($metaData);

        return $result;
    }

    public function sendMail($name, $description)
    {
        $toEmail = Mage::getStoreConfig('custom_api_general/support/support_email');
        $mail = new Zend_Mail('UTF-8');
        $mail->addTo($toEmail)
            ->setFrom('testwebstore@ukr.net', $name)
            ->setSubject('Support message')
            ->setBodyText($description);

        try {
            $mail->send();
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')
                ->addError('Unable to send message. ' . $e->getMessage());
        }
    }
}


// #############################################################################################

/*
$subject = 'To Custom API Support - From: '.$name;
$headers = 'From: testwebstore@ukr.net' . "\r\n" .
    'Reply-To: testwebstore@ukr.net' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$res = mail($toEmail, $subject, $description, $headers);
*/

/*
 $mail = Mage::getModel('core/email')
            ->setToName('Dear support')
            ->setToEmail($toEmail)
            ->setBody($description)
            ->setSubject('Support message')
            ->setFromEmail('testwebstore@ukr.net')
            ->setFromName($name)
            ->setType('text');
        try {
            $mail->send();
        }
        catch (Demidov_CustomApi_Model_Exception $e) {
            Mage::getSingleton('core/session')
                ->addError('Unable to send message. ' . $e->getMessage());
        }

 */