<?php


/**
 * 
 */
class Block_Shipping_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('shipping/grid.phtml');
	}

	public function getShippings()
	{
		$sql = "SELECT * FROM `shipping`";
		$shippingRow = Ccc::getModel('Shipping'); 
        $shippings = $shippingRow->fetchAll($sql);
        return $shippings;
	}
}