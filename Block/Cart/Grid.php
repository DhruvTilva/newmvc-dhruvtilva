<?php


/**
 * 
 */
class Block_Cart_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Cart Methods');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('cart_id',[
			'title' => 'Cart Id'
		]);
		$this->addColumn('customer_id',[
			'title' => 'Customer Id'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('created_at',[
			'title' => 'Created at'
		]);
		$this->addColumn('payment_id',[
			'title' => 'Payment id'
		]);
		$this->addColumn('shipping_id',[
			'title' => 'Shipping id'
		]);
		$this->addColumn('amount',[
			'title' => 'Shipping Amount'
		]);

		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('edit',[
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);
		$this->addAction('delete',[
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);$this->addAction('address',[
			'title' => 'Address',
			'method' => 'getAddressUrl'
		]);

		return parent::_prepareActions();
	}

	protected function _prepareButtons()
	{
		$this->addButton('cart_id',[
			'title' => 'Add Cart',
			'url' => $this->getUrl('add')
		]);
		$this->paymentRedirect();
		$this->addButton('Order_id',[
					'title' => 'Order',
					'url' => header("")
				]);
		$this->addButton('shipping_id',[
					'title' => 'Shipping',
					'url' => header("")
				]);
		$this->addButton('address_id',[
					'title' => 'Address',
					'url' => header("")
				]);

		

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `cart` ORDER BY `cart_id` DESC";
        $carts = Ccc::getModel('Cart')->fetchAll($sql);
        return $carts;
	}
}