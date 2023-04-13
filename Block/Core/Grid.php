<?php
/**
 * 
 */
class Block_Core_Grid extends Block_Core_Template
{

	protected $title=null;
	protected $columns=[];
	protected $actions=[];
	protected $buttons=[];

	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/grid.phtml');
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('MAnage Grid');

	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function setColumns(array $columns)
	{				
		$this->columns=$columns;
		return $this;
	}
	protected function _prepareColumns(){
		return $this;
	}

	public function addColumn($key,$value)
	{
		$this->columns[$key]=$value;
		return $this;
	}

	public function removeColumn($key)
	{
		unset($this->columns[$key]);
		return $this;
	} 
	public function addAction($key,$value)
	{
		$this->actions[$key]=$value;
		return $this;
	}
	public function getAction($key)
	{
		if (array_key_exists($key,$this->actions)) {
			return $this->actions[$key];
		}
		return null;
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
	}

	public function getEditUrl($row,$key)
	{				
		return $this->getUrl($key,null,['id'=>$row->getId()],true);
	}

	public function getDeleteUrl($row,$key)
	{				
		return $this->getUrl($key,null,['id'=>$row->getId()],true);
	}

	public function getColumnValue($row,$key)
	{
		if ($key=='status') {
			return $row->getStatusText();
		}
		return $row->$key;
	}

	public function getButtons()
	{
		return $this->buttons;
	}
	public function setButtons(array $buttons)
	{
		$this->buttons=$buttons;
	}

	public function addButton($key,$value)
	{
		$this->buttons[$key]=$value;
		return $this;
	}
	public function removeButton()
	{		
		unset($this->buttons[$key]);
		return $this;
	}
	public function getButton($key)
	{
		if (array_key_exists($key,$this->buttons)) {
			return $this->buttons[$key];
		}
		return null;
	}

	public function _prepareButtons()
	{
		$this->addButton();
	}
	public function setTitle($title)
	{
		$this->title=$title;
		return $this;
	}

	public function getTitle()
	{		
		return $this->title;
	}



}



 ?>