<?php


/**
 * 
 */
class Block_Vendor_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Vendor Content');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('vendor_id',[
			'title' => 'Vendor Id'
		]);
		$this->addColumn('firstname',[
			'title' => 'First Name'
		]);
		$this->addColumn('lastname',[
			'title' => 'Last Name'
		]);
		$this->addColumn('mail',[
			'title' => 'Email'
		]);
		$this->addColumn('gender',[
			'title' => 'Gender'
		]);
		$this->addColumn('no',[
			'title' => 'Mobile'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('company',[
			'title' => 'Company'
		]);
		$this->addColumn('inserted_at',[
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
		$this->addButton('vendor_id',[
			'title' => 'Add Vendor',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id;";
		$vendorRow = Ccc::getModel('Vendor'); 
        $vendors = $vendorRow->fetchAll($sql);
        // $this->setData(['vendors'=>$vendors]);
        return $vendors;
	}
}