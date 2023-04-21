<?php

/**
 * 
 */
class Model_Eav_Attribute_Option_Source extends Model_Eav_Attribute_Option
{
	
	public function getOption()
	{
		$sql="SELECT *
		FROM `eav_attribute_option`
		WHERE `attribute_id`='{$this->getAttribute()->getId()}'
		ORDER BY `position` ASC";
		return $this->fetch($sql);
	}
}


 ?>