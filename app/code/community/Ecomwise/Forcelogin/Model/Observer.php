<?php 
class Ecomwise_Forcelogin_Model_Observer extends Varien_Object{
	
	public function forceLogin($observer){
		
	//echo Mage::helper("core/url")->getCurrentUrl(); return;
	//echo Mage::app()->getRequest()->getActionName(); exit;
	//echo Mage::app()->getRequest()->getRouteName(); exit;
		
	$forceLogin = (bool) Mage::getStoreConfig('forcelogin/forcelogin/disable_ext', Mage::app()->getStore());	
 	if(!$forceLogin){
		if (    ! Mage::getSingleton('customer/session')->isLoggedIn() 
		     && ! Mage::getSingleton('admin/session')->isLoggedIn()
		     &&  Mage::app()->getRequest()->getModuleName() !== 'admin'
		     &&  Mage::app()->getRequest()->getModuleName() !== 'api'
		     &&  Mage::app()->getRequest()->getControllerName() !== 'account') {
		     	 $session = Mage::getSingleton("customer/session");
                 $session->setBeforeAuthUrl(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'home');
		     	 Mage::app()->getResponse()
		     	            ->setRedirect(Mage::helper('adminhtml')
		     	            ->getUrl("customer/account/login",  array('_type' => 'direct_link')));
			
		  }
	
	   }
	}

}

