<?php 

/**
 * 
 */
class Block_Item_Edit extends Block_Core_Template
{
	protected $_row = Null;
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('item/edit.phtml');
	}
	public function setRow($row)
	{
		$this->_row = $row;
		return $this;
	}

	public function getRow()
	{
		return $this->_row;
	}
}