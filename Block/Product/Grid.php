<?php

/**
 * 
 */

class Block_Product_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/grid.phtml');
		// $this->getProducts();
	}

	public function getProducts()
	{
		$sql = "SELECT * FROM `product` ORDER BY `product_id` DESC";
		$row = Ccc::getModel('Product');
		$products = $row->fetchAll($sql);
		// print_r($products); die();
		// $this->setData(['products'=>$products]);
		return $products;
		
	}
}



 ?>