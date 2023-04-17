<?php
/**
 * 
 * 
 */
class Controller_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		$message=Ccc::getModel('Core_Message');
		
		try {
			$productId = $this->getRequest()->getParams('id');
			
			$sql = "SELECT * FROM `media` WHERE `product_id`={$productId}";
			$medias = Ccc::getModel('Product_Media')->fetchAll($sql);

			Ccc::register('medias', $medias);

			$layout = $this->getLayout();
			$grid = $layout->createBlock('ProductMedia_Media');
			
			$layout->getChild('content')->addChild('grid', $grid)->getChildren();
			$layout->render();
		} 
		catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		$message=Ccc::getModel('Core_Message');

		try {
			$media = Ccc::getModel('Product_Media');
			if (!$media) {
				throw new Exception("Invalid Request.", 1);
			}

			Ccc::register('media', $media);

			$layout = $this->getLayout();
			$add = $layout->createBlock('ProductMedia_Add');
			
			$layout->getChild('content')->addChild('add', $add)->getChildren();
			$layout->render();
			// $this->getView()
			// 	->setTemplate('Product_Media/add.phtml')
			// 	->setData([
			// 		'media' => $media
			// 	]);
			// $this->render();
		} 
		catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function insertAction()
	{
		$message=Ccc::getModel('Core_Message');
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request.", 1);
			}

			$postData = $this->getRequest()->getPost('media');
			if (!$postData) {
				throw new Exception("No data posted.", 1);
			}

			$productId = (int) $this->getRequest()->getParams('id');
			if (!$productId) {
				throw new Exception("Id not found.", 1);
			}

			$postData['product_id'] = $productId;

			$row = Ccc::getModel('Product_Media');
			$row->setData($postData);

			if (!$row->save()) {
				throw new Exception("Unable to save data.", 1);
			}
			$mediaId = $row->media_id;

			$imgName = explode('.',$_FILES['image']['name']);
			$extension = $imgName[1];
			$fileName = $mediaId.'.'.$extension;

			$destination = './View/Product_Media/images/'.$fileName;
			$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

			$image['image'] = $fileName;
			$row->load($mediaId)->setData($image)->save();

			$message->addMessage('Media saved Sucessfully.',Model_Core_Message::SUCCESS);
		}

		catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		
		$url = new Model_Core_Url();
		$this->redirect($url->getUrl('grid','product_media'));
	}

	public function updateAction()
	{
		$message=Ccc::getModel('Core_Message');

		try {
			$id = $this->getRequest()->getParams('id');
			if (!$id) {
				throw new Exception("Id not found.", 1);
			}

			$baseId = $this->getRequest()->getPost('base');
			$smallId = $this->getRequest()->getPost('small');
			$thumbId = $this->getRequest()->getPost('thumb');
			$galleryId = $this->getRequest()->getPost('gallery');

			// $gallery = implode(', ', $galleryId);

			$row = Ccc::getModel('Product_Media');
			$row->setData([
				'base' => 0,
				'small' => 0,
				'thumb' => 0,
				'gallery' => 0,
				'product_id' => $id
			]);

			$row->getResource()->setPrimaryKey('product_id');
			$row->save();
			$row->removeData();


			$row->getResource()->setPrimaryKey('media_id');
			$row->setData([
				'base' => 1,
				'media_id' => $baseId
			]);
			$row->save();
			$row->removeData();

			$row->setData([
				'small' => 1,
				'media_id' => $smallId
			]);
			$row->save();
			$row->removeData();

			$row->setData([
				'thumb' => 1,
				'media_id' => $thumbId
			]);
			$row->save();
			$row->removeData();

			$row->setData([
				'gallery' => 1,
				'media_id' => $galleryId
			]);
			$row->save();

			$message->addMessage('Media updated Sucessfully.',Model_Core_Message::SUCCESS);

		} 
		catch (Exception $e) {
			$message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$url = new Model_Core_Url();
		$this->redirect($url->getUrl('grid','product_media',['id'=>$id]));
	}

	public function deleteAction()
	{
		$message=Ccc::getModel('Core_Message');

		try {
			$mediaId = $this->getRequest()->getParams('media_id');
			$id = $this->getRequest()->getParams('id');
			$row = Ccc::getModel('Product_Media');
			$row->setData([
				'media_id' => $mediaId
			]);
			$row->delete();	

			$message->addMessage('Media deleted Sucessfully.',Model_Core_Message::SUCCESS);	
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}	

		$url = new Model_Core_Url();
		$this->redirect($url->getUrl('grid','product_media',['id'=>$id],true));	
	}
}


?>