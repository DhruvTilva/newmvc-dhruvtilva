<?php

/**
 * 
 */
class Block_Salesman_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/grid.phtml');
		// $this->getCollection();
	}

	public function getSalesmans()
	{
		$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id;";
		$salesmanRow = Ccc::getModel('Salesman'); 
    $salesmans = $salesmanRow->fetchAll($sql);
        // $this->setData(['salesmans'=>$salesmans]);
    return $salesmans;
	}
}

  ?>