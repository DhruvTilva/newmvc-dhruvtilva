<?php 

/**
 * 
 */
class Block_Cart_Edit extends Block_Core_Template
{
	protected $_row = null;
	
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('cart/edit.phtml');
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
