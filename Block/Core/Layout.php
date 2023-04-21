<?php

/**
 * 
 */

class Block_Core_Layout extends Block_Core_Template
{
	

      public function __construct()
      {
        parent::__construct();
        $this->setTemplate('Core/layout/3columns.phtml');
        $this->prepareChildren();
      }	

      public function prepareChildren()
        {

          $header = $this->createBlock('Html_Header');
          $this->addChild('header',$header);

          $left = $this->createBlock('Html_Left');
          $this->addChild('left',$left);


          $right = $this->createBlock('Html_Right');
          $this->addChild('right',$right);

          $content = $this->createBlock('Html_Content');
          $this->addChild('content',$content);
          $footer = $this->createBlock('Html_Footer');
          $this->addChild('footer',$footer);

          $message = $this->createBlock('Html_Message');
          $this->addChild('message',$message);
      
     
          
        }	

        public function createBlock($block)
        {
          $blockClassName='Block_'.$block;
          $block= new $blockClassName();
          $block->setLayout($this);
          return $block;
        }


}
?>