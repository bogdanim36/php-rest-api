<?php

require_once get_path("core/DbExtend/DBSQL", "DBSQLSelect.php");

class DBSQL
{
	private $tableName;
	private $tableKey;
	private $tableAlias;
	protected $tablesStructure;
	private $service;
	public $select;

	public function __construct($service)
	{
		$this->service = $service;
		$this->tableName = $service->tableName;
		$this->tableAlias = $service->tableAlias;
		$this->tableKey = $service->tableKey;
		$this->select = new DBSQLSelect();
	}

	public function &__get($property)
	{
		if (property_exists($this, $property)) {
			return $this->$property;
		} else throw new \Exception("Property " . $property . " doesn't exist on DBSQL class!");
	}

	public function &__set($property, $value)
	{
		if (property_exists($this, $property)) {
			$this->$property = $value;
		} else throw new \Exception("Property " . $property . " doesn't exist on DBSQL class!");

		return $this;
	}

	public function text()
	{
		try {
			$sql = "SELECT";
			$sql .= $this->getDistinct();
			$sql .= "\n " . $this->getColumns();
			$sql .= "\n " . $this->getFrom();
			$sql .= "\n " . $this->getJoin();
			$sql .= "\n " . $this->getWhere();
			$sql .= "\n " . $this->getOrder();
			return $sql;
		} catch (Exception $err) {
			throw $err;
		}
	}

	public function exec()
	{
		$cmd = $this->text();
		$queryResult = $this->service->db->query($cmd);
		return $queryResult;
	}


}





