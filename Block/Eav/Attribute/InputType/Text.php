<?php 

/**
 * 
 */
class Block_Eav_Attribute_InputType_Text extends Block_Core_Template
{
	protected $_attribute = Null;
	protected $_row = Null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/inputType/text.phtml');
	}

	public function setAttribute($attribute)
	{
		$this->_attribute = $attribute;
		return $this;
	}

	public function getAttribute()
	{
		return $this->_attribute;
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