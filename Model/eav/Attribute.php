<?php

class Model_Eav_Attribute extends Model_Core_Table
 {
 	
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE_lBl = 'Active';
    const STATUS_INACTIVE_lBl = 'Inactive';
    const STATUS_DEFAULT = 2;

 	function __construct()
 	{
        	$this->setResourceClass('Model_Eav_Attribute_Resource');
            $this->setCollectionClass('Model_Eav_Attribute_Collection');
 	}
    public function getStatus()
    {
        if($this->status){
            return $this->status;
        }
        return Model_Eav_Attribute_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status, $statuses)){
            return $statuses[$this->status];
        }
        return $statuses[Model_Eav_Attribute_Resource::STATUS_DEFAULT];
    }

    public function getEntityType()
    {
        $sql = "SELECT `entity_type_id`,`name` FROM `entity_type` ORDER BY `entity_type_id` ASC";
        return $this->getResource()->getAdapter()->fetchPairs($sql); 
    }

    // public function getOptions()
    // {
    //     $sourceModel=$this->source_model;
    //     if(!$sourceModel){
    //         $sourceModel='Model_Eav_Attribute_Option_Source';
    //     }
    // }
 }
?>