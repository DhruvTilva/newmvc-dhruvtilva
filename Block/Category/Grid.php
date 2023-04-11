<?php


/**
 * 
 */
class Block_Category_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/grid.phtml');
		// $this->getCategorys();
	}

	public function getCategorys()
	{
		$sql = "SELECT * FROM `category` WHERE `category_id` ORDER BY `path` ASC";

		$row = Ccc::getModel('Category');
		$categorys = $row->fetchAll($sql);
		// $this->setData(['categorys'=>$categorys]);
		// print_r($categorys); die;
		return $categorys;
	}
}


  ?>