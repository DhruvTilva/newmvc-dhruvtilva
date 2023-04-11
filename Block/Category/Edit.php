<?php 

/**
 * 
 */
class Block_Category_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/edit.phtml');
		$this->getProduct();
	}

	public function getProduct()
	{
		$request=Ccc::getModel('Core_Request');
		$id =$request->getParams('id');
		if ($id) {
			$category = Ccc::getModel('Category_Row')->load($id);
		}
		else{
			$category = Ccc::getModel('Category_Row');
		}
		$this->setData(['category'=>$category]);
	}
}

 ?>