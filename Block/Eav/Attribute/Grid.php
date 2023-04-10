<?php

/**
 * 
 */

class Block_Eav_Attribute_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/grid.phtml');
		// $this->getCollection();
	}

	public function getAttributes()
	{
		$sql = "SELECT * FROM `eav_attribute`";
		$row = Ccc::getModel('Eav_Attribute');
		$attributes = $row->fetchAll($sql);
		return $attributes;
		
	}
}



 ?>