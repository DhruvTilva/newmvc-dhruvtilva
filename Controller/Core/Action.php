<?php


class Controller_Core_Action
{

	public $adapter=null;
	public $request=null;
	protected $view=null;
	protected $layout = Null;
	protected $url = Null;
	protected $messageObj = Null;
	protected $pager = Null;


	public function setPagination(Model_Core_Pagination $pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPagination($totalRecords, $currentPage)
	{
		if($this->pager){
			return $this->pager;
		}

		$pager = new Model_Core_Pagination($totalRecords, $currentPage);
		$this->setPager($pager);
		return $pager;
	}



	protected function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if($this->layout){
			return $this->layout;
		}

		$layout = new Block_Core_Layout();
		$this->setLayout($layout);
		return $layout;
	}
	protected function setMessageObj(Model_Core_Message $message)
	{
		$this->messageObj = $message;
		return $this;
	}

	public function getMessageObj()
	{
		if($this->messageObj){
			return $this->messageObj;
		}

		$message = new Model_Core_Message();
		$this->setMessageObj($message);
		return $message;
	}

	protected function setUrl(Model_Core_Url $url)
	{
		$this->url = $url;
		return $this;
	}

	public function getUrl()
	{
		if($this->url){
			return $this->url;
		}

		$url = new Model_Core_Url();
		$this->setUrl($url);
		return $url;
	}


	public function setView(Model_Core_View $view){
		$this->view=$view;
		return $this;
	}

	public function getView()
	{
		if ($this->view) {
			return $this->view;
		}
		$view=new  Model_Core_View();
		$this->setView($view);
		return $view;
	}
	

	public function render(){
		 $this->getView()->render();
	}




	protected function setRequest(Model_Core_Request $request)
	{
		$this->request=$request;
		return $this;
	}

	public function getRequest()
	{
		if($this->request){
			return $this->request;
		}
		$request=new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}



	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter=$adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter=new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}




	public function getTemplate($templatePath)
	{
		require "view".DS.$templatePath;
	}




	// public function redirect($c,$a,$id=null)
  //  {
  //     if($id){
  //     	header("Location: Index.php?c={$c}&a={$a}&id={$id}");
  //       exit();
  //  	}
  //  	else{
  //  		header("Location: Index.php?c={$c}&a={$a}");
  //  		exit();
  //  	}
   // }

	// public function render()
	// {
	// 	$this->getView()->render();
	// }

	public function redirect($a = Null, $c = Null, $params = [], $resetParams = false)
	{
		$url = $this->getUrl();
		header("Location: {$url->getUrl($a,$c,$params,$resetParams)}");
		exit();
	}

	

}




?>