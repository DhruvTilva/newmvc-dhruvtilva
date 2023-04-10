<?php


/**
 * 
 */
class Block_Vendor_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
		// $this->getCollection();
	}

	public function getVendors()
	{
		$sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id;";
		$vendorRow = Ccc::getModel('Vendor'); 
        $vendors = $vendorRow->fetchAll($sql);
        // $this->setData(['vendors'=>$vendors]);
        return $vendors;
	}
}