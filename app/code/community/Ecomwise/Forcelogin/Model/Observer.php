<?php 
class Ecomwise_Forcelogin_Model_Observer extends Varien_Object{
	
	public function forceLogin($observer){
		
		$adminPath = Mage::getStoreConfig('admin/url/custom_path');
		
		$url = Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName');
		$adminUrl = $url->asArray();
	
		
		$forceLogin = (bool) Mage::getStoreConfig('forcelogin/parameters/enabled', Mage::app()->getStore());	
	 	if(!$forceLogin){
			if (    ! Mage::getSingleton('customer/session')->isLoggedIn() 
			     && ! Mage::getSingleton('admin/session')->isLoggedIn()
			     &&  Mage::app()->getRequest()->getModuleName() !== $adminUrl
				 &&  Mage::app()->getRequest()->getModuleName() !== $adminPath
			     &&  Mage::app()->getRequest()->getModuleName() !== 'api'
			     &&  Mage::app()->getRequest()->getControllerName() !== 'account') {
			     	 $session = Mage::getSingleton("customer/session");		     	
	                 	     	 
			     	 $session->setBeforeAuthUrl(Mage::helper('customer')->getLoginUrl());
	                 
			     	 Mage::app()->getResponse()
			     	            ->setRedirect(Mage::helper('adminhtml')
			     	            ->getUrl("customer/account/login",  array('_type' => 'direct_link')));
				
			  }		
		}
	}

}

