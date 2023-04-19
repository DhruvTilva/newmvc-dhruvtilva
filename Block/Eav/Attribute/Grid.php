<?php

/**
 * 
 */

class Block_Eav_Attribute_Grid extends Block_Core_Grid
{
	
	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->setTemplate('eav/attribute/grid.phtml');
	// }


	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Attribute Content');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('attribute_id',[
			'title' => 'Attribute Id'
		]);
		$this->addColumn('code',[
			'title' => 'Name'
		]);
		$this->addColumn('backend_type',[
			'title' => 'Backend Type'
		]);
		$this->addColumn('name',[
			'title' => 'name'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('backend_model',[
			'title' => 'BAckend Model'
		]);
		$this->addColumn('input_type',[
			'title' => 'Input Type'
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
		$this->addButton('attribute_id',[
			'title' => 'Add Attribute',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `eav_attribute`";
		$row = Ccc::getModel('Eav_Attribute');
		$attributes = $row->fetchAll($sql);
		// print_r($attributes); die();
		return $attributes;
		
	}
}



 ?>