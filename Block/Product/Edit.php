<?php 

/**
 * 
 */
class Block_Product_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/edit.phtml');
		// $this->getProduct();
	}

	// public function getProduct()
	// {
	// 	$request=Ccc::getModel('Core_Request');
	// 	$id =$request->getParams('id');
	// 	if ($id) {
	// 		$product = Ccc::getModel('Product_Row')->load($id);
	// 	}
	// 	else{
	// 		$product = Ccc::getModel('Product_Row');
	// 	}
	// 	// $this->setData(['product'=>$product]);
	// }
}

 ?>