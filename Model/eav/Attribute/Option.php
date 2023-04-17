<?php

/**
 * 
 */
class Model_Eav_Attribute_Option extends Model_Core_Table
{
	public function __construct()
	{
		$this->setResourceClass('Model_Eav_Attribute_Option_Resource')
			->setCollectionClass('Model_Eav_Attribute_Option_Collection');
	}
}