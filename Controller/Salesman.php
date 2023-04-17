<?php


class Controller_Salesman extends Controller_Core_Action
{

    public function render()
	{
		return $this->getView()->render();
	}
	


	public function gridAction(){
		$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id;";
		$salesmanRow = Ccc::getModel('Salesman'); 
        $salesmans = $salesmanRow->fetchAll($sql);
        if(!$salesmans)
		{
			throw new Exception("Data Not Found.", 1);
		}
		
		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Salesman_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();   

	}
	 
	public function addAction(){
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$salesman = Ccc::getModel('Salesman');
			if(!$salesman){
				throw new Exception("Invalid request.", 1);
			}
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Salesman_Edit');
			$edit->setData(['salesman'=>$salesman]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Salesman not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}   

	}

	public function editAction(){
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$id =$this->getRequest()->getParams('id');
			if(!$id){
	    		throw new Exception("Invalid request.", 1);
			}

			$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id WHERE s.salesman_id = $id;";
			$salesmanRow=Ccc::getModel('Salesman');
	        $salesman = $salesmanRow->fetchRow($sql);
			
			if(!$salesman){
				throw new Exception("Invalid Id.", 1);
			}
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Salesman_Edit');
			$edit->setData(['salesman'=>$salesman]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Salesman Not Saved',Model_Core_Message::FAILURE);
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
			$salesman = $request->getPost('salesman');
			// print_r($customer); die;
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

			$salesmanModelRow=Ccc::getModel('Salesman');

			if ($id) {
				$salesmanModelRow->setData($salesman);
				$salesmanModelRow->getData();
				$salesmanResult = $salesmanModelRow->save();


				$salesmanAddressModelRow=Ccc::getModel('SalesmanAddress');
				$salesmanAddressModelRow->setData($address);
				$salesmanAddressModelRow->getPrimaryKey();
				$salesmanResult = $salesmanAddressModelRow->save();
			}
			else{
				// echo 111; die;
				// $salesmanModelRow = new Model_Salesman_Row();
				$salesmanModelRow=Ccc::getModel('Salesman');
				$salesmanModelRow->setData($salesman);
				$salesmanResult = $salesmanModelRow->save();
				$address['salesman_id'] = $salesmanResult;

				// $salesmanAddressModelRow = new Model_SalesmanAddress_Row();
				$salesmanAddressModelRow=Ccc::getModel('SalesmanAddress');
				$salesmanAddressModelRow->setData($address);
				$salesmanResult = $salesmanAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Salesman saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Salesman not saved.', Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}


    public function deleteAction(){
    	try
		{
		$message=Ccc::getModel('Core_Message');
		$request=$this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
			throw new Exception("Invalid ID.", 1);
		}
		$salesmanModelRow = Ccc::getModel('Salesman'); 
		$salesmanModelRow->load($id);
		$salesmanResult = $salesmanModelRow->delete();
		if(!$salesmanResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Salesman Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Salesman is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('grid');
}


}
?>