<?php


require_once 'Model/Core/Adapter.php';


class Model_Core_Table_Resource 
{
	public $tableName = Null;
	public $primaryKey = Null;
	public $adapter = Null;

	//setter getter for adapter obj
	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}


	public function getAdapter()
	{

		if($this->adapter){
			return $this->adapter;
		}

		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;

	}

	// setter getter for table name
	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}


	public function getTableName()
	{
		return $this->tableName;
		
	}

	//setter getter for primary key
	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}


	public function getPrimaryKey()
	{
		return $this->primaryKey;

	}


	public function fetchAll($query)
	{
		$adapter = $this->getAdapter();
		return $adapter->fetchAll($query);
	}


	public function fetchRow($query)
	{
		$adapter = $this->getAdapter();
		return $adapter->fetchRow($query);
	}



	public function insert($data)
	{   
		$keys=array_keys($data);
		$values=array_values($data);

		$keyString='`'.implode('`,`', $keys).'`';
		$valueString="'".implode("','", $values)."'";

		$sql="INSERT INTO `{$this->getTableName()}` ({$keyString}) VALUES ({$valueString})";
	
		return $this->getAdapter()->insert($sql);

	}


	public function delete($id)
	{
		$tableName = $this->getTableName();
		$primaryKey = $this->getPrimaryKey();
		$sql = "DELETE FROM `{$tableName}` WHERE `{$primaryKey}`='{$id}'";
		$adapter = $this->getAdapter();
		return $adapter->delete($sql);
	}


    public function update($arrayData, $condition)
	{
		$data = [];
		foreach ($arrayData as $key => $value) {
			$data[] = "`{$key}` = '{$value}'";
		}

		$dataString = implode(',', $data);
		if(is_array($condition))
		{
			$where = [];
			foreach ($condition as $key => $value) {
				$where[] = "`{$key}` = '{$value}'";
			}

			$whereString = implode(" AND ", $where);
		}
		else
		{
			$whereString = "`{$this->getPrimaryKey()}` = '{$condition}'";
		}

		$sql = "UPDATE `{$this->getTableName()}` SET {$dataString} WHERE {$whereString}";
		$result = $this->getAdapter()->update($sql);
		if(!$result){
			return false;
		}
		return true;
	}

}

?>