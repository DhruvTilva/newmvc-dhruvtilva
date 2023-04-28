<?php 

/**
 * 
 */
class Controller_Order extends Controller_Core_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout();
        $grid = $layout->createBlock('Core_Layout')->setTemplate('core/index.phtml');
        $layout->getChild('content')->addChild('grid',$grid);
        echo $layout->toHtml();
    }
	public function gridAction()
    {
        $layout = $this->getLayout();
        $grid = $layout->createBlock('Order_Grid')->toHtml();
        echo json_encode(['html'=> $grid,
            'element' => 'content'
        ]);
        @header("content-Type:application/json");
    }
}