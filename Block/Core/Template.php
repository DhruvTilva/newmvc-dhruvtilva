<?php


/**
 * 
 */
class Block_Core_Template extends Model_Core_View
{
	

	protected $children = [];
	protected$layout = null;

	public function __construct()
	{
       parent::__construct();
		
	}

	public function setChildren(array $children)
	{
		$this->children=$children;
		return $this;
	}

	public function getChildren()
	{
		
		return $this->children;
	}
	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
	}

	public function getLayout()
	{
		return $this->layout();
	}

	public function removeChildren($key)
	{
		if (array_key_exists($key,$this->children)) {
		unset($this->children[$key]);
		}
		return false;
	}


	public function addChild($key,$value){
		$this->children[$key]=$value;
		return $this;
	}

	public function getChild($key)
	{
		return $this->children[$key];
	}


	
}


  ?>