<?php
class Oliver_Arbetsprov_Model_Observer
{
	
	private $order;
	private $org_amount;
	private $calc_amount;
	private $order_id;
	private $isModuleActive;
	private $decimalValueToUse;
	
	///Function to caputure order when order is paid ///
    public function logAmount(Varien_Event_Observer $observer)
    {
        
		//Get active value from custom admin menu
		$this->isModuleActive = Mage::getStoreConfig('oliver/oliver_group/oliver_arbetsprov_active');
		
		//Check that module is active
		if($this->isModuleActive){
			$invoice = $observer->getEvent()->getInvoice();
			$this->order = $invoice->getOrder();
			$this->getAndMultiply();
			$this->putInDatabase();
		}
		
    }	
	
	///Function to set value to put in DB///
	protected function getAndMultiply($amount){
		
		//If no value is set -> fallback to 1
		$decimalValueFromConfig = Mage::getStoreConfig('oliver/oliver_group/oliver_arbetsprov_decimal');
		$this->decimalValueToUse = $decimalValueFromConfig ? $decimalValueFromConfig : 1;
		$this->org_amount = $this->order->getGrandTotal();
		$this->calc_amount = $this->org_amount * $this->decimalValueToUse; 
		$this->order_id = $this->order->getRealOrderId();	
		
	}	
	
	///Function to store Order_ID and Amount in Database///
	protected function putInDatabase(){		
				
		$data = array( 	'order_ref' => $this->order_id, 
						'org_amount' => $this->org_amount, 
						'calc_amount' => $this->calc_amount);
						
		$model = Mage::getModel("oliver_arbetsprov/invoicedata")->setData($data);		
		
		try {			
			$model->save();
			
		} catch (Exception $e) {
			//Not yet implemented
		}  
 		
	}
}