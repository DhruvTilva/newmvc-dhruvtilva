 <?php

 class Controller_Category extends Controller_Core_Action
 {
    public function render()
    {
        return $this->getView()->render();
    }



    public function gridAction()
    {

        // echo "<pre>";
        // echo 111; die();
        $sql = "SELECT * FROM `category`";
        $categoryR = Ccc::getModel('Category'); 
        $categorys = $categoryR->fetchAll($sql);
        if(!$categorys)
        {
            throw new Exception("Data Not Found.", 1);
        }
        $layout = new Block_Core_Layout();
        $grid = $layout->createBlock('Category_Grid');
        $layout->getChild('content')->addChild('grid',$grid);
        $layout->render();

    } 


    public function addAction()
    {
        $message = Ccc::getModel('Core_Message');
        try 
        {
            $category = Ccc::getModel('Category');
            if(!$category){
                throw new Exception("Invalid request.", 1);
            }

            $layout = new Block_Core_Layout();
            $edit = $layout->createBlock('Category_Edit');
            $edit->setData(['category'=>$category]);
            $layout->getChild('content')->addChild('edit',$edit);
            $layout->render();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
            $this->redirect('category','grid');
        }

    }

    public function editAction()
    {   $message=Ccc::getModel('Core_Message');

        try 
        {
            $id =$this->getRequest()->getParams('id');
            if(!$id){
                throw new Exception("Invalid request.", 1);
            }
            $category = Ccc::getModel('Category')->load($id);
            if(!$category){
                throw new Exception("Invalid Id.", 1);
            }

            // $this->getView()
            //     ->setData(['category'=>$category])
            //     ->setTemplate('category/edit.phtml');
            // $this->render();
            // --------------------------------------------------------------------------
            $layout = new Block_Core_Layout();
            $edit = $layout->createBlock('Category_Edit');
            $edit->setData(['category'=>$category]);
            $layout->getChild('content')
                    ->addChild('edit',$edit);
            $layout->render();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
            $this->redirect('category','grid');
        }
	}





    public function saveAction()
    {
        try{
            $request = Ccc::getModel('Core_Request');
            if(!$request->isPost()){
                throw new Exception("Error Request");
            }
            $data = $request->getPost('category');
            // print_r($data);die();
            if (!$data) {
                throw new Exception("no data posted");
            }
             date_default_timezone_set('Asia/Kolkata');

            if($id = (int) $this->getRequest()->getParams('id')){
                $category = Ccc::getModel('Category')->load($id);
                if(!$category){
                    throw new Exception("Invalid Id.", 1);
                }
                $category->updated_at = date("Y-m-d h:i:s");
            }
            else
            {
                $category = Ccc::getModel('Category');
                $category->created_at = date("Y-m-d h:i:s");
            }
            $category->setData($data);
            if (!$category->Save()) {
                throw new Exception("Error Processing Request", 1);
            }
            $category->updatePath();
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Category saved successfully.', Model_Core_Message::SUCCESS);
            $this->redirect('category','grid');
        }
        catch(Exception $e){
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Category not saved.', Model_Core_Message::FAILURE);
            $this->redirect('category','grid');
        }
    }


  


    public function deleteAction()
    {
        $message=new Model_Core_Message();
        try
        {
        $request = $this->getRequest();
        $id = $request->getParams('id');
        if(!$id){
            throw new Exception("Invalid ID.", 1);
        }
        $categoryModel = Ccc::getModel('Category'); 
        $categoryModel->load($id);
        $categoryResult = $categoryModel->delete();
            $message->addMessage('Category Deleted Successfully.',Model_Core_Message::SUCCESS);
        }
        catch(Exception $e)
        {
            $message->addMessage('Category is Not Deleted Properly.',Model_Core_Message::FAILURE);
        } 
        $this->redirect('category','grid');

    }
 }

?>
 