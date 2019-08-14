<?php 

class Ecomwise_Forcelogin_Helper_Customer extends Mage_Customer_Helper_Data
{
	public function isRegistrationAllowed()
    {    	
    	$forceLoginEnabled = Mage::getStoreConfig('forcelogin/general/enabled');
    	$forceLoginValue = Mage::getStoreConfig('forcelogin/parameters_forcelogin/enabled');
    	
    	if ($forceLoginValue == "0" && $forceLoginEnabled == "1") {
			return false;
    	}
    	else {
        	$result = new Varien_Object(array('is_allowed' => true));
        	Mage::dispatchEvent('customer_registration_is_allowed', array('result' => $result));
        	return $result->getIsAllowed();
    	}
    }
}