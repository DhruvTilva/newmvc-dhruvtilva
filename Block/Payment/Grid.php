<?php


/**
 * 
 */
class Block_Payment_Grid extends Block_Core_Grid
{
	protected $_pager = Null;
	protected $_count = Null;

	function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Payment Methods');
		$this->setTemplate('payment/grid.phtml');
		
	}
	public function setPagination(Model_Core_Pagination $pager)
	{
		$this->_pager = $pager;
		return $this;
	}

	public function getPagination()
	{
		if($this->_pager){
			return $this->_pager;
		}

		$request = Ccc::getModel('Core_Request');
        $currentPage = ($request->getParams('p')) ? $request->getParams('p') : 1;
		$pager = new Model_Core_Pagination($this->getCount(), $currentPage);
		$this->setPagination($pager);
		return $pager;
	}



	public function getCount()
    {
        return $this->_count;
    }

    public function setCount($count)
    {
        $this->_count = $count;
        return $this;
    }

	protected function _prepareColumns()
	{
		$this->addColumn('payment_id',[
			'title' => 'Payment Id'
		]);
		$this->addColumn('name',[
			'title' => 'Name'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
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
		$this->addButton('payment_id',[
			'title' => 'Add Payment',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();
	}

	public function getCollection()
	{
		$request = Ccc::getModel('Core_Request');
		$sql = "SELECT COUNT(`payment_id`) FROM `payment`";
        $totalRecords = Ccc::getModel('Payment_Resource')->getAdapter()->fetchOne($sql);
        $this->setCount($totalRecords);
        $currentPage = ($request->getParams('p')) ? $request->getParams('p') : 1;
        $pager = $this->getPagination()->setCurrentPage($currentPage);
        $pager->calculate();


	    $sql = "SELECT * FROM `payment` LIMIT {$pager->getStartLimit()},{$pager->getRecordPerPage()}";
        return Ccc::getModel('Payment')->fetchAll($sql);
        
	}

}