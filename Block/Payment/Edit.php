<?php 

/**
 * 
 */
class Block_Payment_Edit extends Block_Core_Template
{
	protected $_row = Null;

	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment/edit.phtml');
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

 ?>
