<?php


class Model_Cart extends Model_Core_Table
{
	
    protected $resourceClass = 'Model_Cart_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';

	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Cart_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Cart_Resource::STATUS_DEFAULT;
    }


}


?>