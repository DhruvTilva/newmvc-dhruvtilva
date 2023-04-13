<?php


/**
 * 
 */
class Block_Payment_Grid extends Block_Core_Grid
{
	

	
	function __construct()
	{
		parent::__construct();
		// $this->setTemplate('payment/grid.phtml');
		
		$this->setTitle('MAnage  Payment Grid');

	}

	
	
	protected function _prepareColumns()
	{
		$this->addColumn('payment_id',[
			'title'=>'Payment ID'
		]);
		$this->addColumn('name',[
			'title'=>'Name'
		]);
		$this->addColumn('status',[
			'title'=>'Status'
		]);
		$this->addColumn('created_at',[
			'title'=>'Created_At'
		]);

		return parent::_prepareColumns();
	}

	

	
	public function _prepareActions()
	{
		$this->addAction('edit', [
			'title'=>'Edit',
			'method'=>'getEditUrl'
		]);

		$this->addAction('delete', [
			'title'=>'Delete',
			'method'=>'getDeleteUrl'
		]);
		return parent::_prepareActions();

	}
	

	

	public function _prepareButtons()
	{	
		$url=Ccc::getModel('Core_Url');
		$this->addButton('payment_id',[
			'title'=>'ADD New',
			'url'=> $url->getUrl(null,'add')
		]);
		return parent::_prepareButtons();

	}

	public function getPayments()
	{
		$sql = "SELECT * FROM `payment` ORDER BY `payment_id` ";
		$row = Ccc::getModel('Payment');
		$payments = $row->fetchAll($sql);
		return $payments;
		
	}





}
 
