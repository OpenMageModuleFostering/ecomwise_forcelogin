<?php 
class Ecomwise_Forcelogin_Block_System_Config_Version extends Mage_Adminhtml_Block_System_Config_Form_Field{

	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){
		 return (string) "v".Mage::getConfig()->getNode()->modules->Ecomwise_Forcelogin->version; 
    }
}