<?php


/**
 * 
 */
class Block_Brand_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Brand Methods');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('brand_id',[
			'title' => 'Brand Id'
		]);
		$this->addColumn('name',[
			'title' => 'Name'
		]);
		$this->addColumn('description',[
			'title' => 'Description'
		]);
		$this->addColumn('image',[
			'title' => 'Image'
		]);
		$this->addColumn('created_at',[
			'title' => 'Created at'
		]);
		$this->addColumn('updated_at',[
			'title' => 'Updated at'
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
		$this->addButton('brand_id',[
			'title' => 'Add Brand',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `brand` ORDER BY `brand_id` DESC";
        $brands = Ccc::getModel('Brand')->fetchAll($sql);
        return $brands;
	}
}