<?php 

/**
 * 
 */
class Controller_Quote extends Controller_Core_Action
{
	public function newAction()
	{
		$layout = $this->getLayout();
		$quote = Ccc::getModel('cart');
		$edit = $layout->createBlock('cart_Edit');
		$edit->setRow($quote);
		$edit = $edit->toHtml();
		echo json_encode(['html'=> $edit,
            'element' => 'content'
        ]);
        @header("content-Type:application/json");
	}

	public function setIdAction()
	{
		$id = $this->getRequest()->getParams('customer_id');
		Ccc::getModel('Core_Session')->set('customer_id', $id);
		$this->redirect('new',null,null,true);
	}

	public function saveBillingAddress()
	{
		$postData = $this->getRequest()->getPost();
		$postAddress = $postData['billing'];
		print_r($postData);
		
	}

	public function saveShippingAddress()
	{
		$postData = $this->getRequest()->getPost();
		$postAddress = $postData['shipping'];
		print_r($postAddress);
	}

	public function saveAddressAction()
	{
		echo "<pre>";
		$postData = $this->getRequest()->getPost();
		if($postData['saveBilling']){
			$this->saveBillingAddress();
		}
		elseif($postData['saveShipping']){
			$this->saveShippingAddress();
		}
	}
}