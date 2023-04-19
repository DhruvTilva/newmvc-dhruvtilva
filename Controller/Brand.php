<?php

class Controller_Brand extends Controller_Core_Action
{
	public function render()
	{
		return $this->getView()->render();
	}


	public function gridAction()
	{

        $sql = "SELECT * FROM `brand`";
		$brandRow = Ccc::getModel('Brand'); 
		$brands = $brandRow->fetchAll($sql);
		if(!$brands){
			throw new Exception("Data Not Found.", 1);
		}

		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Brand_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}




	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$brand = Ccc::getModel('Brand');
			if(!$brand){
				throw new Exception("Invalid request.", 1);
			}

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Brand_Edit');
			// $edit->setData(['brand'=>$brand]);
			$edit->setRow($brand);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Brand not Saved.',Model_Core_Message::FAILURE);
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
		$brand = Ccc::getModel('Brand')->load($id);
		if(!$brand){
			throw new Exception("Data Not Found.", 1);
		}
		
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Brand_Edit');
			// $edit->setData(['brand'=>$brand]);
			$edit->setRow($brand);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Brand Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}





	public function saveAction()
	{
		try{ 
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('brand');
			if (!$data) {
				throw new Exception("no data posted");
			}
			$id=$request->getParams('id');

			if ($id) {
				$brand=Ccc::getModel('Brand');
				date_default_timezone_set('Asia/Kolkata');
				$brand->updated_at=date('Y-m-d H:i:s');
				
			}
			else{

				$brand= Ccc::getModel('Brand');
				date_default_timezone_set('Asia/Kolkata');
				$brand->created_at = date("Y-m-d h:i:s");

			}
			// echo"<pre>";
			$brand->setData($data);
			$brand->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Brand saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid',null,null,true);
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Brand not saved.', Model_Core_Message::FAILURE);
			$this->redirect('grid',null,null,true);
		}
	}






	
	public function deleteAction()
	{
		try
		{
		$message=Ccc::getModel('Core_Message');
		$request = $this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}
		$brandModelRow = Ccc::getModel('Brand');
		$brandModelRow->load($id);
		$brandResult = $brandModelRow->delete();

		if(!$brandResult){
			throw new Exception("Data is Not Deleted.", 1);
		}
		$message->addMessage('Brand Deleted Successfully.',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Brand is Not Deleted.',Model_Core_Message::FAILURE);
		}

		$this->redirect('grid',null,null,true);
	}
}


?>