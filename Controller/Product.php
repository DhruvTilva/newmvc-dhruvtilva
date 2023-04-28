<?php

class Controller_Product extends Controller_Core_Action
{	




	public function indexAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Core_Layout')->setTemplate('core/index.phtml');
		$layout->getChild('content')->addChild('grid', $grid);
		echo $layout->toHtml();
		
	}

	public function gridAction()
	{
		
		$sql = "SELECT * FROM `product` ORDER BY `product_id` DESC";
		$productR = Ccc::getModel('Product'); 
		$products = $productR->fetchAll($sql);
		$layout = new Block_Core_Layout();
		$grid = $layout->createBlock('Product_Grid')->toHtml();
		echo json_encode(['html'=> $grid,
			'element' => 'content'
		]);
		@header("content-Type:application/json");
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
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Product_Edit');
		$edit->setRow($product);
		// $layout->getChild('content')->addChild('edit',$edit);
		// echo $layout->toHtml();
		$edit = $edit->toHtml();
		echo json_encode(['html'=> $edit,
		'element' => 'content'
		]);
		@header("content-Type:application/json");
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

			$layout = new Block_Core_Layout();
			$edit = $layout->createBlock('Product_Edit');
			$edit->setRow($product);
			$edit = $edit->toHtml();
			echo json_encode(['html'=> $edit,
			'element' => 'content'
			]);
			@header("content-Type:application/json");

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
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Product_Grid')->toHtml();
		echo json_encode(['html'=> $grid,
			'element' => 'content'
		]);
		@header("content-Type:application/json");
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
			// $this->redirect('grid');
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid')->toHtml();
			echo json_encode(['html'=> $grid,'element' => 'content']);
			@header("content-Type:application/json");
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Product not saved.', Model_Core_Message::FAILURE);
		}
		
	}


}

?>