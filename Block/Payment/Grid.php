<?php


/**
 * 
 */
class Block_Payment_Grid extends Block_Core_Grid
{
	

	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment/grid.phtml');
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
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
		
		$this->addButton('payment_id',[
			'title'=>'ADD New',
			'url'=> $this->getUrl('add')
		]);
		return parent::_prepareButtons();

	}

	public function getCollection()
	{			
		$sql= "SELECT * FORM `payment_method` ORDER BY `name` DESC;";
		$payments=Ccc::getModel('Payment')->fetchAll($sql);
		return $payments->getData();
	}





}
 
