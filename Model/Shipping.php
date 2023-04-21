<?php


class Model_Shipping extends Model_Core_Table
{
	// protected $tableName = 'shipping';
	// protected $primaryKey = 'shipping_id';
	// protected $tableClass = 'Model_Shipping';
    protected $resourceClass = 'Model_Shipping_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';



	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Shipping_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Shipping_Resource::STATUS_DEFAULT;
    }

}


?>