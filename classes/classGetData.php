<?php
/**
 * 
 */
class classGetData
{
	
	function __construct($table) {
		$this->table = $table;
	}

	private  function dbVue() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	private function getDB ($sql) {
		return Db::getConnection() -> query($sql);
	}

	private function getDBVue ($sql) {
		return $this->dbVue() -> query($sql);
	}

	private function getRow ($result) {
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return (isset($list)) ? $list : [];
	}

	private function getRow2El ($result,$id,$name) {
		$i      = 0;
		while ($row = $result->fetch()) {
			$list[$i]['id']   = $row[$id];
			$list[$i]['name'] = $row[$name];
			$i++;
		}
		return (isset($list)) ? $list : [];
	}

/** Отримуєм всі записи з таблиці $this->table
 *
 *  @return масив даних
 */
	public function getDataFromTable () {
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table));	
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return масив даних
 */
	public function getDataFromTableByName ($elValue,$elName) {
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameFetch ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'")->fetch();	
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameVue ($elValue,$elName) {
		return $this->getDBVue("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'")->fetch();	
	}

/** Отримуєм дані з таблиці $this->table відсортованих по $nameOrder по $desk, LIMIT $SHOW_BY_DEFAULT з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableOrderPageVue($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC') {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) );
	}

/** Отримуєм всі дані з таблиці $this->table відсортованих по $nameOrder по $desk
 *
 *  @return масив даних
 */
	public function getDataFromTableOrder($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

/** Отримуєм дані з таблиці $this->table для 2 елементів з Vue
 *
 *  @return масив даних
 */
	public function getData2ElVue($id,$name,$idVal) {
		$sql = "SELECT * FROM ".$this->table." ORDER BY ".$name;
		if ($idVal) {
			$sql .= " WHERE ".$id."=".$idVal;
		}
		return $this->getRow2EL( $this->getDBVue($sql),$id,$name);
	}

/** Отримуєм записи з таблиці $this->table по offset для Vue
 *
 *  @return масив даних
 */
	public function getDataByOffsetVue ($id,$show,$offset) {
		return $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$id." DESC LIMIT ".$show." OFFSET $offset");	
	}

/** Отримуєм записи з таблиці $this->table по offset
 *
 *  @return масив даних
 */
	public function getDataByOffset ($id,$show,$offset) {
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$id." DESC LIMIT ".$show." OFFSET $offset"));	
	}

/** Видадаєм запис з таблиці $this->table
 *
 *  @return true or false
 */
	public function deleteDataFromTable($id,$nameid='id') {
			return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
		}
}
?>