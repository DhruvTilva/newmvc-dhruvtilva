<?php




class Controller_Vendor extends Controller_Core_Action
{
	


	public function gridAction()
	{
        $sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id;";
		$vendorRow = Ccc::getModel('Vendor'); 
        $vendors = $vendorRow->fetchAll($sql);
        if (!$vendors) {
        	throw new Exception("Error Processing Request", 1);
        }
        $layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Vendor_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		// $layout->render(); 
		echo $layout->toHtml();

	}




	public function addAction()
	{
        $message = Ccc::getModel('Core_Message');
		try 
		{
			$vendor = Ccc::getModel('Vendor');
			if(!$vendor){
				throw new Exception("Invalid request.", 1);
			}
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Vendor_Edit');
			$edit->setData(['vendor'=>$vendor]);
			$layout->getChild('content')->addChild('edit',$edit);
			// $layout->render();
			echo $layout->toHtml();

		} 
		catch (Exception $e) 
		{
			$message->addMessage('Vendor not Saved.',Model_Core_Message::FAILURE);
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
			$sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id WHERE v.vendor_id = $id;";

			$vendorRow=Ccc::getModel('Vendor');
	        $vendor = $vendorRow->fetchRow($sql);
			if(!$vendor){
				throw new Exception("Invalid Id.", 1);
			}
			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Vendor_Edit');
			$edit->setData(['vendor'=>$vendor]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			// $layout->render();	
			echo $layout->toHtml();

		} 
		catch (Exception $e) 
		{
			$message->addMessage('Vendor Not Saved',Model_Core_Message::FAILURE);
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
			$vendor = $request->getPost('vendor');
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

			$vendorModelRow=Ccc::getModel('Vendor');

			if ($id) {
				$vendorModelRow->setData($vendor);
				$vendorModelRow->getData();
				$vendorResult = $vendorModelRow->save();

			
				$vendorAddressModelRow=Ccc::getModel('VendorAddress');
				$vendorAddressModelRow->setData($address);
				$vendorAddressModelRow->getPrimaryKey();
				$vendorResult = $vendorAddressModelRow->save();
			}
			else{
				// echo 111; die;
				$vendorModelRow=Ccc::getModel('Customer');
				$vendorModelRow->setData($vendor);
				$vendorResult = $vendorModelRow->save();
				$address['vendor_id'] = $vendorResult;
				// $vendorAddressModelRow = new Model_VendorAddress_Row();
				$vendorAddressModelRow=Ccc::getModel('VendorAddress');
				$vendorAddressModelRow->setData($address);
				
				$vendorResult = $vendorAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Vendor saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Vendor not saved.', Model_Core_Message::FAILURE);
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
		$vendorModelRow = Ccc::getModel('Vendor'); 
		$vendorModelRow->load($id);
		$vendorResult = $vendorModelRow->delete();
		if(!$vendorResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Vendor Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Vendor is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('grid');
	}

}


 ?>