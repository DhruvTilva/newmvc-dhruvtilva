<?php
/**
 * 
 */

class Controller_Eav_Attribute extends Controller_Core_Action
{
	
	public function gridAction()
	{

		$attribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute`";

		$collection = $attribute->fetchAll($sql);
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Eav_Attribute_Grid');
		$layout->getChild('content')
			->addChild('grid',$grid);
		$layout->render();

		// echo "<pre>";
		// print_r($collection);
		
	}


	public function addAction()	
	{
		$message = Ccc::getModel('Core_Message');
		
	try{
		$attribute = Ccc::getModel('Eav_Attribute');
		if(!$attribute){
				throw new Exception("Invalid Id.", 1);
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Eav_Attribute_Edit');
			$edit->setData(['attribute'=>$attribute]);
			$layout->getChild('content')
				->addChild('edit',$edit);
			$layout->render();
	}	
	catch (Exception $e) {
			$message->addMessage('Attribute not Saved',Model_Core_Message::FAILURE);
			$this->redirect('eav_attribute','grid');	
		
	}
	}



	public function editAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$id =$this->getRequest()->getParams('id');
			if(!$id){
	    		throw new Exception("Invalid request.", 1);
			}
			$attribute = Ccc::getModel('Eav_Attribute')->load($id);
			if(!$attribute){
				throw new Exception("Invalid Id.", 1);
			}
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Eav_Attribute_Edit');
			$edit->setData(['attribute'=>$attribute]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Attribute Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('eav_attribute','grid');
		}
	}




	public function deleteAction()
	{
		try
		{
		$message=Ccc::getModel('Core_Message');
		$request=$this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
			throw new Exception("Invalid ID.", 1);
		}
		$attributeModel = Ccc::getModel('Eav_Attribute'); 
		$attributeModel->load($id);
		$attributeResult = $attributeModel->delete();
		if(!$attributeResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Attribute Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Attribute is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('eav_attribute','grid');
	}


	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('attribute');
			if (!$data) {
				throw new Exception("no data posted");
			}
			$id=$request->getParams('id');
			if ($id) {
				$attribute=Ccc::getModel('Eav_Attribute');
				date_default_timezone_set('Asia/Kolkata');
				
			}
			else{
				$attribute= Ccc::getModel('Eav_Attribute');
				date_default_timezone_set('Asia/Kolkata');
				$attribute->created_at = date("Y-m-d h:i:s");

			}
			// echo"<pre>";
			$attribute->setData($data);
			$attribute->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Attribute saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('eav_attribute','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Attribute not saved.', Model_Core_Message::FAILURE);
			$this->redirect('eav_attribute','grid');
		}
	}
}
?>