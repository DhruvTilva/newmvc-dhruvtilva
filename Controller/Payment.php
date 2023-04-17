<?php

class Controller_Payment extends Controller_Core_Action
{
	public function render()
	{
		return $this->getView()->render();
	}


	public function gridAction()
	{

        $sql = "SELECT * FROM `payment`";
		$paymentRow = Ccc::getModel('Payment'); 
		$payments = $paymentRow->fetchAll($sql);
		if(!$payments){
			throw new Exception("Data Not Found.", 1);
		}

		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Payment_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}




	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$payment = Ccc::getModel('Payment');
			if(!$payment){
				throw new Exception("Invalid request.", 1);
			}

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Payment_Edit');
			$edit->setData(['payment'=>$payment]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Payment not Saved.',Model_Core_Message::FAILURE);
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
		$payment = Ccc::getModel('Payment')->load($id);
		if(!$payment){
			throw new Exception("Data Not Found.", 1);
		}
		
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Payment_Edit');
			$edit->setData(['payment'=>$payment]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Payment Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}





	public function saveAction()
	{
		try{
			$request = Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('payment');
			if (!$data) {
				throw new Exception("no data posted");
			}
			

			if ($id=$request->getParams('id')) {
				// echo 111; die();
				$payment = Ccc::getModel('Payment')->load($id);
				date_default_timezone_set('Asia/Kolkata');
				$payment->updated_at = date('Y-m-d H:i:s');
			}
			else{
				// echo 111; die();
				$payment = Ccc::getModel('Payment');
				date_default_timezone_set('Asia/Kolkata');
				$payment->created_at = date("Y-m-d h:i:s");
			}
			$payment->setData($data);
			$payment->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Payment saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Payment not saved.', Model_Core_Message::FAILURE);
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
		$paymentModelRow = Ccc::getModel('Payment');
		$paymentModelRow->load($id);
		$paymentResult = $paymentModelRow->delete();

		if(!$paymentResult){
			throw new Exception("Data is Not Deleted.", 1);
		}
		$message->addMessage('Payment Deleted Successfully.',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Payment is Not Deleted.',Model_Core_Message::FAILURE);
		}

		$this->redirect('grid',null,null,true);
	}
}


?>