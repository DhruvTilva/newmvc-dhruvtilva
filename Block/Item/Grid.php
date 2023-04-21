<?php 

/**
 * 
 */
class Block_Item_Grid extends Block_Core_Grid
{
	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->setTemplate('item/grid.phtml');
	// }

	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Item Content');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('entity_id',[
			'title' => 'Entity Id'
		]);
		$this->addColumn('sku',[
			'title' => 'SKU'
		]);
		$this->addColumn('entity_type_id',[
			'title' => 'EntityTypeID'
		]);
		$this->addColumn('status',[
			'title' => 'STATUS'
		]);
		$this->addColumn('created_at',[
			'title' => 'CREATEDAT'
		]);
		$this->addColumn('updated_at',[
			'title' => 'UDATEDAT'
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
		]);

		return parent::_prepareActions();
	}

	protected function _prepareButtons()
	{
		$this->addButton('entity_id',[
			'title' => 'Add Item',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `item`";
		$row = Ccc::getModel('ITEM');
		$items = $row->fetchAll($sql);
		// print_r($attributes); die();
		return $items;
		
	}
}