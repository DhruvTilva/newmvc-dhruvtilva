<?php 

// require_once 'Model/Core/Table.php';

class Model_Brand_Resource extends Model_Core_Table_Resource
{
	public $tableName = 'brand';
	public $primaryKey = 'brand_id';

	const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    public function getStatusOptions()
    {
        return [
                    self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
                    self::STATUS_INACTIVE=>self::STATUS_INACTIVE_LBL
        ];
    }
}

?>