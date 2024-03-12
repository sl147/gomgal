<?php

/**
 * 
 */
//namespace classes;

//use classes\classGetDB;

//use classes\traitAuxiliary;

class classGetData extends classGetDB {

	use traitAuxiliary;

	public function __construct($table)	{
		$this->table = $table;
	}

	private function getRow ($result) {
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return $list ?? [];
	}

	private function formSql2El($id,$name,$idVal) {
		$sql = "SELECT * FROM ".$this->table." ORDER BY ".$name;
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
	public function getDataFromTable ($var = 1) {
		return ($var == 1) ? $this->getRow($this->getDB("SELECT * FROM ".$this->table)) :
		                                   $this->getDB("SELECT * FROM ".$this->table) ;
	}


/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return масив даних
 */
	public function getDataFromTableByName ($elValue,$elName) {	
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue)));
	}


/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return масив даних
 */
	public function getDataFromTableByNameWithOutRow ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue));
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameFetch ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue))->fetch();	
	}


/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameFetch2WHERE ($elValue1,$elName1,$elValue2,$elName2) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql2($elName1,$elValue1,$elName2,$elValue2))->fetch();	
	}

/** Отримуєм один запис з таблиці $this->table по id
 *
 *  @return масив даних
 */
/*	public function getDataFromTableById($id) {
		return (intval($id)) ? $this->getDB("SELECT * FROM ".$this->table." WHERE id=".$id)->fetch() : false;
	}*/

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */

	public function getDataFromTableByNameVue ($elValue,$elName) {
		return $this->getDBVue("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue))->fetch();
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */
	public function getDataFromTableByNameAllVue ($elValue,$elName) {
		return $this->getRow($this->getDBVue("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue)));	
	}


/** Отримуєм дані з таблиці $this->table відсортованих по $nameOrder по $desk, LIMIT $SHOW_BY_DEFAULT з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableOrderPageVue($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC') {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) );
	}

	public function getDataFromTableOrderPageVueWithoutGetRow($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC') {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset);
	}


/** Отримуєм всі дані з таблиці $this->table відсортованих по $nameOrder по $desk
 *
 *  @return масив даних
 */

	public function getDataFromTableOrder($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}


	public function getDataFromTableOrderWithOutRow($nameOrder, $limit,$desk = 'DESC') {
		return $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$limit);
	}


/** Отримуєм дані з таблиці $this->table для 2 елементів з Vue
 *
 *  @return масив даних
 */
	public function getData2ElVue($id,$name,$idVal=0) {
		$sql = $this->formSql2El($id,$name,$idVal);
		return $this->getRow2EL( $this->getDBVue($sql),$id,$name);
	}


	public function getMetaTable() {
		$sql = "SHOW COLUMNS FROM ".$this->table;
		$res = $this->getDB($sql);
		while ($row = $res->fetch()) {
			$columns[] = $row['Field'];
		}
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


/** Отримуєм записи з таблиці $this->table по offset
 *
 *  @return масив даних
 */
	public function getDataByOffsetWithOutRow ($id,$show,$offset) {
		return $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$id." DESC LIMIT ".$show." OFFSET $offset");	
	}


/** Видадаєм запис з таблиці $this->table
 *
 *  @return true or false
 */
	public function deleteDataFromTable($id,$nameid='id') {
		return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table.$this->formSql($nameid,$id)) : false;
	}


/** Отримуєм всі дані з таблиці $this->table для запитів з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableVue() {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table) );
	}

	public function activated($id,$act) {
		return (intval($id)) ? $this->getDB("UPDATE ".$this->table." SET active=$act ".$this->formSql("id",$id)) : false;		
	}


/** Обновляєм запис в таблиці $this->table по елементу $elNameUpdate
 *
 *  @return true або false
 */
	public function updateDataFromTableByName ($elValue,$elName, $elValueUpDate,$elNameUpdate) {	
		return $this->getDB("UPDATE ".$this->table." SET ".$elNameUpdate."=".$elValueUpDate .$this->formSql($elName,$elValue)); 
	}


/** Вставляєм нульовий запис в таблицю $this->table по елементу $elName
 *
 *  @return true або false
 */
	public function insertDataToTableByName ($elValue,$elName,$elName0) {	
		return $this->getDB("INSERT INTO ".$this->table." (".$elName.",".$elName0.") VALUES(".$elValue.",1)"); 
	}		
}