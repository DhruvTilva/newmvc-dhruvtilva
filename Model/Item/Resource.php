<?php 

/**
 * 
 */
class Model_Item_Resource extends Model_Core_Table_Resource
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_lBl = 'Active';
	const STATUS_INACTIVE_lBl = 'Inactive';
	const STATUS_DEFAULT = 2;

	public function __construct()
	{
		parent::__construct();
		$this->setTableName('item')->setPrimaryKey('entity_id');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_lBl,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_lBl
		];
	}
}