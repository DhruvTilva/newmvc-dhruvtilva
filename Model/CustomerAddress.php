<?php


class Model_CustomerAddress extends Model_Core_Table
{
	// protected $tableName = 'customer_address';
	// protected $tableClass = 'Model_CustomerAddress';
	protected $resourceClass = 'Model_CustomerAddress_Resource';

	// protected $primaryKey = 'address_id';



	// public function getBillingAddress()		
	// {
	// 	if ($this->address_id) {
	// 		$billingAdd= Ccc::getModel('Customer_Address');
	// 		$billingAdd->load($this->address_id)
	// 		return $billingAdd;
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }

	// public function getShippingAddress()
	// {
	// 	if($this->address_id){
	// 		$shippingAdd= Ccc::getModel('Customer_Address');
	// 		$shippingAdd->load($this->address_id)
	// 		return $shippingAdd;
	// 	}
	// 	else{
	// 		return false;
	// 	}
		
	// }
}


?>