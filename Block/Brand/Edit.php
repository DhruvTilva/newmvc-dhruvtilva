<?php 

/**
 * 
 */
class Block_Brand_Edit extends Block_Core_Template
{
	protected $_row = null;

	function __construct()
	{
		parent::__construct();
		$this->setTemplate('brand/edit.phtml');
	}

	public function setRow($row)
	{
		$this->_row=$row;
		return $this;
	}

	public function getRow()
	{
		return $this->_row;
	}
}

 ?>
