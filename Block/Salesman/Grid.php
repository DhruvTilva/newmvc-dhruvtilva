<?php

/**
 * 
 */
class Block_Salesman_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Salesman Content');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('salesman_id',[
			'title' => 'Salesman Id'
		]);
		$this->addColumn('firstname',[
			'title' => 'First Name'
		]);
		$this->addColumn('lastname',[
			'title' => 'Last Name'
		]);
		$this->addColumn('email',[
			'title' => 'Email'
		]);
		$this->addColumn('gender',[
			'title' => 'Gender'
		]);
		$this->addColumn('mobile',[
			'title' => 'Mobile'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('company',[
			'title' => 'Company'
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
		$this->addAction('price',[
			'title' => 'Salesman Price',
			'method' => 'getSalesmanPrice'
		]);
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
		$this->addButton('salesman_id',[
			'title' => 'Add Salesman',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id;";
		$salesmanRow = Ccc::getModel('Salesman'); 
    $salesmans = $salesmanRow->fetchAll($sql);
        // $this->setData(['salesmans'=>$salesmans]);
    return $salesmans;
	}
}

  ?>