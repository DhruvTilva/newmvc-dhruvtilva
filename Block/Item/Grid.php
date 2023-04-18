<?php 

/**
 * 
 */
class Block_Item_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('item/grid.phtml');
	}
}