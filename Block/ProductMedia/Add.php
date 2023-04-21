<?php
		
class Block_ProductMedia_Add extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Product_Media/add.phtml');
	}

	public function getCollection()
	{
		$media = Ccc::getRegistry('media');
		return $media;
	}
}