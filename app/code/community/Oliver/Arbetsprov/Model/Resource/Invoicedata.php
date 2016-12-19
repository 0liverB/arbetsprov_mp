<?php
class Oliver_Arbetsprov_Model_Resource_Invoicedata extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
		$this->_init('oliver_arbetsprov/invoicedata', 'id');
    }
}