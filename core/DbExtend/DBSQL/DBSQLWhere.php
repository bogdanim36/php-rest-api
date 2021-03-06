<?php
require_once get_path("core/DbExtend/DBSQL", "DBSQLWhereOperator.php");

class DBSQLWhere
{
	private $items=[];
	public $and;
	public $or;

	public function __construct()
	{
		$this->and = new DBSQLWhereOperator($this);
		$this->or = new DBSQLWhereOperator($this);
	}

	public function &__get($property)
	{
		if (property_exists($this, $property)) {
			return $this->$property;
		} else throw new \Exception("Property " . $property . " doesn't exist on " . __CLASS__ . " class!");
	}

	public function &__set($property, $value)
	{
		if (property_exists($this, $property)) {
			$this->$property = $value;
		} else throw new \Exception("Property " . $property . " doesn't exist on " . __CLASS__ . " class!");

		return $this;
	}
	public function group($left, $operator, $right): SqlWhere
	{
		$where = new SqlWhere();
		$this->items[] = $where;
		return $where;
	}

}