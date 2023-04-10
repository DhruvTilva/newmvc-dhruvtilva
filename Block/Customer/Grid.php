<?php 

/**
 * 
 */
class Block_Customer_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/grid.phtml');
		// $this->getCollection();
	}

	public function getCustomers()
	{				
		$sql = "SELECT * FROM customer c INNER JOIN customer_address d ON c.customer_id = d.customer_id;";
		$customerRow = Ccc::getModel('Customer'); 
        $customers = $customerRow->fetchAll($sql);
        // $this->setData(['customers'=>$customers]);
        return $customers;
	}
}


 ?>