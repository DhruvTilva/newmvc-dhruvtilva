<?php



class Controller_Shipping extends Controller_Core_Action
{

     public function render()
    {
        return $this->getView()->render();
    }

  

    public function gridAction()
    {
        $sql = "SELECT * FROM `shipping`";
        $shippingRow = Ccc::getModel('Shipping'); 
        $shippings = $shippingRow->fetchAll($sql);
        if(!$shippings){
            throw new Exception("Data Not Found.", 1);
        }
        $layout = new Block_Core_Layout();
        $grid = $layout->createBlock('Shipping_Grid');
        $layout->getChild('content')->addChild('grid',$grid);
        $layout->render();
    }

    public function addAction()
    {
        $message = Ccc::getModel('Core_Message');
        try 
        {
            $shipping = Ccc::getModel('Shipping');
            if(!$shipping){
                throw new Exception("Invalid request.", 1);
            }

        $layout = new Block_Core_Layout();
        $edit = $layout->createBlock('Shipping_Edit');
        $edit->setData(['shipping'=>$shipping]);
        $layout->getChild('content')->addChild('edit',$edit);
        $layout->render();    
        } 
        catch (Exception $e) 
        {
            $message->addMessage('Shipping not Saved.',Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
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
            $shipping = Ccc::getModel('Shipping')->load($id);
            // print_r($product);
            // die();
            if(!$shipping){
                throw new Exception("Invalid Id.", 1);
            }
            $layout = new Block_Core_Layout();
            $edit = $layout->createBlock('Shipping_Edit');
            $edit->setData(['shipping'=>$shipping]);
            $layout->getChild('content')
                    ->addChild('edit',$edit);
            $layout->render();    
        } 
        catch (Exception $e) 
        {
            $message->addMessage('Shipping Not Saved',Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
        }
    }


    public function saveAction()
    {
        try{
            $request=Ccc::getModel('Core_Request');
            if(!$request->isPost()){
                throw new Exception("Error Request");
            }
            $data = $request->getPost('shipping');
            if (!$data) {
                throw new Exception("no data posted");
            }
            $id=$request->getParams('id');
            if ($id) {
                $shipping=Ccc::getModel('Shipping');
                date_default_timezone_set('Asia/Kolkata');
                $shipping->updated_at=date('Y-m-d H:i:s');
                // echo"<pre>";
                // print_r($product); die();
            }
            else{
                $shipping= Ccc::getModel('Shipping');
                date_default_timezone_set('Asia/Kolkata');
                $shipping->created_at = date("Y-m-d h:i:s");

            }
            // echo"<pre>";
            $shipping->setData($data);
            $shipping->save();
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Shipping saved successfully.', Model_Core_Message::SUCCESS);
            $this->redirect('shipping','grid');
        }
        catch(Exception $e){
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Shipping not saved.', Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
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
        $shippingModelRow = Ccc::getModel('Shipping'); 
        $shippingModelRow->load($id);
        $shippingResult = $shippingModelRow->delete();
        if(!$shippingResult)
        {
            throw new Exception("Error Data is Not Deleted", 1);
        }
        $message->addMessage('Shipping Deleted Successfully',Model_Core_Message::SUCCESS);
        }
        catch(Exception $e)
        {
            $message->addMessage('Shipping is Not Deleted',Model_Core_Message::FAILURE);
        }
        $this->redirect('shipping','grid');

    }
}

?>
