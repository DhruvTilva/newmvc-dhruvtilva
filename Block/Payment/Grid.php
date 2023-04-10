<?php


/**
 * 
 */
class Block_Payment_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment/grid.phtml');
		// $this->getCollection();
	}

	public function getPayments()
	{
		 $sql = "SELECT * FROM `payment`";
		$paymentRow = Ccc::getModel('Payment'); 
		$payments = $paymentRow->fetchAll($sql);
        // $this->setData(['vendors'=>$vendors]);
        return $payments;
	}
}