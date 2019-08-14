<?php 

class Ecomwise_Forcelogin_Model_Config_Source_YesNo
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'1', 'label'=>Mage::helper('adminhtml')->__('Via Login and Register')),
            array('value'=>'0', 'label'=>Mage::helper('adminhtml')->__('Via Login'))
        );
    }
}