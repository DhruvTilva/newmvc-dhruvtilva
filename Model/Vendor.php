<?php


class Model_Vendor extends Model_Core_Table
{
	// protected $tableName = 'vendor';
	// protected $primaryKey = 'vendor_id';
	// protected $tableClass = 'Model_Vendor';
    protected $resourceClass = 'Model_Vendor_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';

	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Vendor_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Vendor_Resource::STATUS_DEFAULT;
    }

}


?>