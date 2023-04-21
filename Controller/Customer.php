<?php

class Controller_Customer extends Controller_Core_Action
{


    public function render()
	{
		return $this->getView()->render();
	}



	public function testAction()
    {
        
    }
	

	public function gridAction()
	{
		$sql = "SELECT * FROM customer c INNER JOIN customer_address d ON c.customer_id = d.customer_id;";
		$customerR = Ccc::getModel('Customer'); 
        $customers = $customerR->fetchAll($sql);
        if (!$customers) {
        	throw new Exception("Data Not Found.", 1);
        	
        }
		
		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Customer_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}


	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$customer = Ccc::getModel('Customer');
			if(!$customer){
				throw new Exception("Invalid request.", 1);
			}
			// $this->getView()
			// 	->setTemplate('customer/edit.phtml')
			// 	->setData(['customer'=>$customer]);
			// $this->render();	

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Customer_Edit');
			$edit->setData(['customer'=>$customer]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Customer not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('grid');
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
			$sql = "SELECT * FROM customer c INNER JOIN customer_address d ON c.customer_id = d.customer_id WHERE c.customer_id = $id;";

			$customerRow=Ccc::getModel('Customer');
	        $customer = $customerRow->fetchRow($sql);
			if(!$customer){
				throw new Exception("Invalid Id.", 1);
			}

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Customer_Edit');
			$edit->setData(['customer'=>$customer]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Customer Not Saved',Model_Core_Message::FAILURE);
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
			$customer = $request->getPost('customer');
			// print_r($customer); die;
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

			$customerModelRow=Ccc::getModel('Customer');
			
			if ($id) {
				// $customer=Ccc::getModel('Customer_Row');
				$customerModelRow->setData($customer);
				$customerModelRow->getData();
				
				$customerResult = $customerModelRow->save();

			
				// $customerAddressModelRow = new Model_CustomerAddress_Row();
				$customerAddressModelRow=Ccc::getModel('CustomerAddress');
				$customerAddressModelRow->setData($address);
				$customerAddressModelRow->getPrimaryKey();
				$customerResult = $customerAddressModelRow->save();
			}
			else{
				// echo 111; die;
				$customerModelRow=Ccc::getModel('Customer');
				$customerModelRow->setData($customer);
				$customerResult = $customerModelRow->save();
				$address['customer_id'] = $customerResult;
				// $customerAddressModelRow = new Model_CustomerAddress_Row();
				$customerAddressModelRow=Ccc::getModel('CustomerAddress');
				$customerAddressModelRow->setData($address);
				$customerResult = $customerAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Customer saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Customer not saved.', Model_Core_Message::FAILURE);
			$this->redirect('grid');
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
		$customerModelRow = Ccc::getModel('Customer'); 
		$customerModelRow->load($id);
		$customerResult = $customerModelRow->delete();
		if(!$customerResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Customer Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Customer is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('grid');
}
}

?>