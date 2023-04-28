<?php 

class Model_Order extends Model_Core_Table
{
	public function __construct()
	{
		$this->setResourceClass('Model_Order_Resource')
			->setCollectionClass('Model_Order_Collection');
	}
	
	public function getStatus()
	{
		if($this->status){
			return $this->status;
		}
		return self::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if(array_key_exists($this->status, $statuses)){
			return $statuses[$this->status];
		}
		return $statuses[self::STATUS_DEFAULT];
	}
}