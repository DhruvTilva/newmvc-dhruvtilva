<?php 
/**
 * 
 */
class Model_Product_Media extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Product_Media_Resource');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Product_Media_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $status = $this->status;
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($status, $statuses)) {
            return $statuses[$status];
        }
        return $statuses[Model_Product_Media_Resource::STATUS_DEFAULT];
    }
}

?>