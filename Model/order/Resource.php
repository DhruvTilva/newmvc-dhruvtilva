<?php

class Model_Order_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setTableName('order')->setPrimaryKey('order_id');
	}
}