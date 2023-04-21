<?php

class Block_ProductMedia_Media extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Product_Media/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$medias = Ccc::getRegistry('medias');
		$this->setData([
			'medias' => $medias,
		]);
		return $this;
	}
}