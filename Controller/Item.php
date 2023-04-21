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
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$item = Ccc::getModel('Item');
			if(!$item){
				throw new Exception("Invalid request.", 1);
			}

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Item_Edit');
			$edit->setData(['item'=>$item]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Item not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('grid');

		}
	}

	public function editAction()
	{
		$message = Ccc::getModel('Core_Message');
		try
		{
		$request = $this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}
		$item = Ccc::getModel('Item')->load($id);
		if(!$item){
			throw new Exception("Data Not Found.", 1);
		}
		
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Item_Edit');
			$edit->setData(['item'=>$item]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Item Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}
	public function saveAction()
	{
		try {
			if(!$this->getRequest()->isPost()){
				throw new Exception("Invalid request.", 1);
			}

			$postItem = $this->getRequest()->getPost('item');
			if(!$postItem){
				throw new Exception("Invalid data posted.", 1);
			}

			if($id = $this->getRequest()->getParams('id')){
				$item = Ccc::getModel('Item');
				$item->load($id);
				$item->updated_at = date("Y-m-d h:i:s");
			}
			else{
				$item = Ccc::getModel('Item');
				$item->entity_type_id = Model_Item::ENTITY_TYPE_ID;
				$item->created_at = date("Y-m-d h:i:s");
			}

			$item->setData($postItem);
			if(!$item->save()){
				throw new Exception("Unable to save item.", 1);
			}

			$attributeData = $this->getRequest()->getPost('attribute');
			if($attributeData){
				foreach ($attributeData as $backendType => $value) {
					foreach ($value as $attributeId => $val) {
						if(is_array($val)){
							$val = implode(',', $val);
						}

						$model = Ccc::getModel('Core_Table');
						$model->getResource()->setTableName("item_{$backendType}")->setPrimaryKey('value_id');
						$query = "INSERT INTO `item_{$backendType}` 
						(`entity_id`, `attribute_id`, `value`) 
						VALUES ('{$item->getId()}', '{$attributeId}', '{$val}')  
						ON DUPLICATE KEY UPDATE `value`= '{$val}'";
						if(!$model->getResource()->getAdapter()->query($query)){
							throw new Exception("Unable to save attribute.", 1);
						}
					}
				}
			}
			$this->getMessageObject()->addMessage("Item saved successfully.");
		}
		catch (Exception $e) {
			$this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		$this->redirect('grid',null,null,true);
	}


	public function deleteAction()
	{
		try {
			if(!$id = (int) $this->getRequest()->getParams('id')){
	    		throw new Exception("Invalid ID.", 1);
			}

			$productResult = Ccc::getModel('item')->load($id)->delete();
			if(!$productResult){
				throw new Exception("Unable to delete product.", 1);
			}

			$messageObject = $this->getMessageObject()->addMessage("Item deleted successfully.");
		}
		catch (Exception $e) {
			$messageObject = $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid',null,null,true);
	}
}