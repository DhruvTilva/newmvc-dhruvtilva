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
		$this->children = $children;
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
		return $this->layout;
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
		if (!array_key_exists($key,$this->children)) {
				return false;
		}
		return $this->children[$key];
	}

	
	public function getChildHtml($key)
	{
		if(!$key){
			return false;
		}

		$child = $this->getChild($key);
		if($child){
			return $child->toHtml();
		}
		return false;
	}

	//to catch the template of html without direct rendering
	public function toHtml()
	{
		ob_start();
		$this->render();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	
}


  ?>