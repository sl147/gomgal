<?php
/**
 * Кількість записів в таблиці
 * @return int к-ть записів
 */
class Count
{
	private $table, $id, $detail;

	function __construct($table, $id = 1, $detail = 'id', $idName = 'id')
	{
		 $this->table  = $table;
		 $this->id     = $id;
		 $this->detail = $detail;
		 $this->idName = $idName;
	}

	private function select($sql) {
		$result = Db::getConnection() -> query($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		$row    = $result->fetch();
		return $row['count'];
	}

	public function get() {		
		return $this->select( "SELECT count($this->idName) as count FROM $this->table" );	
	}
	
	public function getNewOrder() {		
		return $this->select( "SELECT count($this->idName) as count FROM $this->table WHERE job = 1" );	
	}

	public function getId() {
		return $this->select( "SELECT count($this->idName) as count FROM $this->table WHERE ".$this->idName."=".$this->id ); 	
	}
}
?>