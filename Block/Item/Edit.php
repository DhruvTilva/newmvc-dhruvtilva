<?php 

/**
 * 
 */
class Block_Item_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('item/edit.phtml');
	}
}