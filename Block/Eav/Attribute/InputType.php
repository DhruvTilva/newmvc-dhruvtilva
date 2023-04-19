<?php 

/**
 * 
 */
class Block_Eav_Attribute_InputType extends Block_Core_Template
{
	protected $_attribute = Null;
	protected $_row = Null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/inputType.phtml');
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

	public function getInputTypeField()
	{
		$inputType = $this->getAttribute();
		// print_r($inputType); die;
		die;
		// ->input_type;
		// printf($inputType); die;
		if($inputType == 'text'){
			return $this->getLayout()
				->createBlock('Eav_Attribute_InputType_Text')
				->setAttribute($this->getAttribute())
				->setRow($this->getRow());
		}
		elseif($inputType == 'textarea'){
			return $this->getLayout()
				->createBlock('Eav_Attribute_InputType_TextArea')
				->setAttribute($this->getAttribute())
				->setRow($this->getRow());
		}
		elseif($inputType == 'select'){
			return $this->getLayout()
				->createBlock('Eav_Attribute_InputType_Select')
				->setAttribute($this->getAttribute())
				->setRow($this->getRow());
		}
		elseif($inputType == 'multiselect'){
			return $this->getLayout()
				->createBlock('Eav_Attribute_InputType_MultiSelect')
				->setAttribute($this->getAttribute())
				->setRow($this->getRow());
		}
		else{
			echo "Invalid input type.";
		}
	}
}