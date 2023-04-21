<?php

class Model_Eav_Attribute_Resource extends Model_Core_Table_Resource
 {
 	
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE_lBl = 'Active';
    const STATUS_INACTIVE_lBl = 'Inactive';
    const STATUS_DEFAULT = 2;
    
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