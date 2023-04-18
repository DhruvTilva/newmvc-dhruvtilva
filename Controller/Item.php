<?php 

/**
 * 
 */
class Controller_Item extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Item_Grid');
		$layout->getChild('content')
			->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Item_Edit');
		$item = Ccc::getModel('Item');
		$edit->setData(['item'=>$item]);
		$layout->getChild('content')
			->addChild('edit',$edit);
		$layout->render();
	}
}