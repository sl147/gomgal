<?php
/**
 * 
 */
//namespace classes;

//use classes\classGetDB;
//use classes\traitFormSql;

class classGetData extends classGetDB
{
	use traitFormSql;
	
	public function __construct($table) {
		$this->table = $table;
	}

	private function getRow ($result) {
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return $list ?? [];
	}

	private function formSql2El($id,$name,$idVal)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY ".$name;
		//return ($idVal) ? $sql . " WHERE ".$id."=".$idVal : $sql;
		return ($idVal) ? $sql . $this->formSql($id,$idVal) : $sql;
	}

	private function getRow2El ($result,$id,$name) {
		$i  = 0;
		while ($row = $result->fetch()) {
			$list[$i]['id']   = $row[$id];
			$list[$i]['name'] = $row[$name];
			$i++;
		}
		return $list ?? [];
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
		//return $this->getRow($this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue)));
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameFetch ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue))->fetch();	
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameVue ($elValue,$elName) {
		//require_once ('../classes/classGetDB.php');
		//return $this->getDBVue("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'")->fetch();
		return $this->getDBVue("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue))->fetch();	
	}

/** Отримуєм дані з таблиці $this->table відсортованих по $nameOrder по $desk, LIMIT $SHOW_BY_DEFAULT з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableOrderPageVue($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC')
	{
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) );
	}

/** Отримуєм всі дані з таблиці $this->table відсортованих по $nameOrder по $desk
 *
 *  @return масив даних
 */
	public function getDataFromTableOrder($nameOrder, $desk = 'DESC')
	{
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

/** Отримуєм дані з таблиці $this->table для 2 елементів з Vue
 *
 *  @return масив даних
 */
	public function getData2ElVue($id,$name,$idVal=0) {
		$sql = $this-> formSql2El($id,$name,$idVal);
		return $this->getRow2EL( $this->getDBVue($sql),$id,$name);
	}

	public function getMetaTable() {
		$sql = "SHOW COLUMNS FROM ".$this->table;
		$res = Auxiliary::getSQLAux($sql);
		while ($row = $res->fetch()) {
			$columns[] = $row['Field'];
		}
		echo '<pre>';
		print_r($columns);
		echo '</pre>';
	}
/** Отримуєм дані з таблиці $this->table для 2 елементів 
 *
 *  @return масив даних
 */
	public function getData2El($id,$name,$idVal=0) {
		$sql = $this-> formSql2El($id,$name,$idVal);
		return $this->getRow2EL( $this->getDB($sql),$id,$name);
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
	public function deleteDataFromTable($id,$nameid='id')
	{
		//return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
		return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table.$this->formSql($nameid,$id)) : false;
	}
}
?>