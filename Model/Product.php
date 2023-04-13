<?php
// require_once 'Model/Core/Table/Row.php';


class Model_Product extends Model_Core_Table
{
	// protected $tableName = 'product';
	// protected $primaryKey = 'product_id';
	protected $resourceClass = 'Model_Product_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';



	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Product_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Product_Resource::STATUS_DEFAULT;
    }




    public function getThumb()
    {
        $medias = $this->getMedias();
        if($medias->thumb == 1){
            echo "checked";
        }
        else{
        return false;
        }
    }




    public function getSmall()
    {
        $medias = $this->getMedias();
        if($medias->small == 1){
            echo "checked";
        }
        else{
            return false;
        }
    }



    public function getBase()
    {
        $medias = $this->getMedias();
        if($medias->base == 1){
             echo "checked";
        }
        else{

            return false;
        }
        
    }

    



}


?>