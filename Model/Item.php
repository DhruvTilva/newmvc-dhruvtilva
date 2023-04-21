<?php 

/**
 * 
 */
class Model_Item extends Model_Core_Table
{
	public function __construct()
	{
		$this->setResourceClass('Model_Item_Resource')->setCollectionClass('Model_Item_Collection');
	}
	
	public function getStatus()
	{
		if($this->status){
			return $this->status;
		}
		return Model_Item_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if(array_key_exists($this->status, $statuses)){
			return $statuses[$this->status];
		}
		return $statuses[Model_Item_Resource::STATUS_DEFAULT];
	}

	public function getAttributes()
	{
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 8 AND `status` = 1";
		return Ccc::getModel('Eav_Attribute')->fetchAll($sql);
	}
	public function getAttributeValue($attribute)
	{
		$sql = "SELECT `value` FROM `item_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}
}