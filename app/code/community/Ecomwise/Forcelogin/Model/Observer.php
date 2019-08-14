<?php 
class Ecomwise_Forcelogin_Model_Observer extends Varien_Object{
	
	public function forceLogin($observer){
		
		if (Mage::getStoreConfig('forcelogin/general/enabled') == "1") {
			
		$adminPath = Mage::getStoreConfig('admin/url/custom_path');
		
		$url = Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName');
		$adminUrl = $url->asArray();
	
		$forceLogin =  Mage::getStoreConfig('forcelogin/parameters_forcelogin/enabled', Mage::app()->getStore());
				
		if(Mage::getSingleton('customer/session')->isLoggedIn()){
			return $this;
		}
		
		if(Mage::getSingleton('admin/session')->isLoggedIn()){
			return $this;
		}
		
		if(Mage::app()->getRequest()->getModuleName() === $adminUrl){
			return $this;
		}
		
		if(Mage::app()->getRequest()->getModuleName() === $adminPath){
			return $this;
		}
		
		if(Mage::app()->getRequest()->getModuleName() === 'api'){
			return $this;
		}
		
		if(Mage::app()->getRequest()->getControllerName() === 'account' && $forceLogin === "1"){
			return $this;
		}
		
		if($forceLogin === "0" 
				&& Mage::app()->getRequest()->getControllerName() === 'account'
				&& (Mage::app()->getRequest()->getActionName() === 'login'|| Mage::app()->getRequest()->getActionName() === 'loginPost')
			){
			return $this;
		}
		
		$session = Mage::getSingleton("customer/session");		     	
	    $session->setBeforeAuthUrl(Mage::helper('customer')->getLoginUrl());
	    Mage::app()->getResponse()->setRedirect(Mage::getUrl('', array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure())). "customer/account/login");
		
		return $this;
		
		}
	}
}

