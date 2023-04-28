<?php 

class Block_Order_Grid extends Block_Core_Grid
{
	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Orders');
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `order` ORDER BY `order_id` DESC";
		return Ccc::getModel('Order')->fetchAll($sql);
	}

	protected function _prepareColumns()
	{
		$this->addColumn('order_id',[
			'title' => 'Order Id'
		]);
		$this->addColumn('name',[
			'title' => 'Customer'
		]);
		$this->addColumn('email',[
			'title' => 'Email'
		]);
		$this->addColumn('mobile',[
			'title' => 'Mobile'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('shipping_amount',[
			'title' => 'Amount'
		]);
		$this->addColumn('total',[
			'title' => 'Total'
		]);
		$this->addColumn('created_at',[
			'title' => 'Created At'
		]);
		$this->addColumn('updated_at',[
			'title' => 'Updated At'
		]);

		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('delete',[
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);
		return parent::_prepareActions() ;
	}

	protected function _prepareButtons()
	{
		$this->addButton('order_id',[
			'title' => 'New Order',
			'url' => $this->getUrl('new','cart')
		]);
		return parent::_prepareButtons();
	}
}