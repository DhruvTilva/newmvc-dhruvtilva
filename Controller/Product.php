<?php

//create product conroller class
class Controller_Product extends Controller_Core_Action
{	
	public function render()
	{
		return $this->getView()->render();
	}




	public function testAction()
	{	
		// $product = Ccc::getModel('Product_Row');
		// $sql = "SELECT * FROM `product`";
		// $collection = $product->fetchAll($sql);

		// echo "<pre>";
		// print_r($collection);
		


	}



	public function gridAction()
	{
		
		// $sql = "SELECT * FROM `product`";
		// $productR = Ccc::getModel('Product'); 
		// $products = $productR->fetchAll($sql);
		// if(!$products)
		// {
		// 	throw new Exception("Data Not Found.", 1);
		// }
		// echo "<pre>";
		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Product_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
		// $grid = new Block_Product_Grid();
		// $grid->setData(['products'=>$products]);
		// $this->getLayout()->getChild('content')->addChild('grid',$grid); 
		// $this->getLayout()->render();
		// // print_r($p);

		// die();


// -----------------------------------------------------------------------------------------------------------------
		// $sql = "SELECT * FROM `product`";
		// $productRow = Ccc::getModel('Product_Row'); 
		// $products = $productRow->fetchAll($sql);
		// if(!$products)
		// {
		// 	throw new Exception("Data Not Found.", 1);
		// }
		// // $layout= new Block_Core_Layout();
		// // $layout->addChildren('content',$content);
		// // $layout->render();

		// $view= Ccc::getModel('Core_View');
		// $view->setTemplate('product/grid.phtml')->setData(['products'=>$products]);
		// $view->render();


	}



	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$product = Ccc::getModel('Product');
			if(!$product){
				throw new Exception("Invalid request.", 1);
			}

			// $this->getView()
			// 	->setTemplate('product/edit.phtml')
			// 	->setData(['product'=>$product]);
			// $this->render();	
			// -------------------------------------------------------------
		$layout = new Block_Core_Layout();
		$edit = $layout->createBlock('Product_Edit');
		$edit->setData(['product'=>$product]);
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Product not Saved.',Model_Core_Message::FAILURE);
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
			$product = Ccc::getModel('Product')->load($id);
			if(!$product){
				throw new Exception("Invalid Id.", 1);
			}
			// $this->getView()
			// 	->setTemplate('product/edit.phtml')
			// 	->setData(['product'=>$product]);
			// $this->render();
			// -------------------------------------------------------------------------
			// $edit = new Block_Product_Edit();
			// $this->getLayout()
			// 	->getChild('content')
			// 	->addChild('edit',$edit);
			// $this->getLayout()->render();

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Product_Edit');
			$edit->setData(['product'=>$product]);
			$layout->getChild('content')
					->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Product Not Saved',Model_Core_Message::FAILURE);
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
		$productModel = Ccc::getModel('Product'); 
		$productModel->load($id);
		$productResult = $productModel->delete();
		if(!$productResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Product Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Product is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('grid');
	}






//save action combine insert + update actions combine.......


	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('product');
			// print_r($data); die;
			if (!$data) {
				throw new Exception("no data posted");
			}
			$id=$request->getParams('id');
			if ($id) {
				$product=Ccc::getModel('Product');
				date_default_timezone_set('Asia/Kolkata');
				$product->updated_at=date('Y-m-d H:i:s');
				// echo"<pre>";
				// print_r($product); die();
			}
			else{
				$product= Ccc::getModel('Product');
				date_default_timezone_set('Asia/Kolkata');
				$product->created_at = date("Y-m-d h:i:s");

			}
			// echo"<pre>";
			$product->setData($data);
			$product->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Product saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Product not saved.', Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}


}

?>