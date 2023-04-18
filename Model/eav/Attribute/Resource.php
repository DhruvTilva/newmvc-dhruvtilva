<?php

class Model_Eav_Attribute_Resource extends Model_Core_Table_Resource
 {
 	
 
    
    public function __construct()
    {
        $this->setTableName('eav_attribute')->setPrimaryKey('attribute_id');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_lBl,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_lBl
        ];
    }
 }
?>