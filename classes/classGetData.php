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

	public function getDataFromTableByNameActive ($elValue,$elName) {	
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue)." AND active=1"));
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

	public function SelectWhereOrderBy(string $nameid, int $id, string $nameOrder, string $desk = 'DESC') {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql($nameid,$id)." ORDER BY ".$nameOrder." ".$desk);
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


/** Отримуєм всі дані з таблиці $this->table для запитів з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableVue() {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table) );
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	private function setWhere($args) {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= " (" . $key . "='" . $value."') AND";
		}
		return substr($set, 0, -4);
	}

	public function selectDataFromTableWHERE (array $args) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->setWhere($args));	
	}

	public function selectDataFromTableWHEREFetch (array $args) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->setWhere($args))->fetch();	
	}

	public function getDataFromTableByNameFetch2WHERE ($elValue1,$elName1,$elValue2,$elName2) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql2($elName1,$elValue1,$elName2,$elValue2))->fetch();	
	}
//-------------------SELECT-------------------------------------------------------------


	public function selectFromTable ($var = true) {
		return ($var) ? $this->getRow($this->getDB("SELECT * FROM ".$this->table)) :
		                              $this->getDB("SELECT * FROM ".$this->table) ;
	}

	public function selectOrderBy(string $nameOrder, string $desk = 'DESC') {
		return $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk);
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */
	public function selectWhere ($elValue, $elName, $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->formSql($elName,$elValue);
		return ($vue) ? $this->getDBVue($sql)
					  : $this->getDB($sql);
	}

	public function selectWhereFetch ($elValue, $elName, $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->formSql($elName,$elValue);
		return ($vue) ? $this->getDBVue($sql)->fetch()
					  : $this->getDB($sql)->fetch();
	}

	public function selectWhereGetRow ($elValue,$elName) {
		return $this->getRow($this->getDBVue("SELECT * FROM ".$this->table.$this->formSql($elName,$elValue)));	
	}

	public function selectOrderPage (int $SHOW_BY_DEFAULT, int $page, string $nameOrder, string $desc = 'DESC' ) {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getDB("SELECT * FROM " . $this->table . " ORDER BY " . $nameOrder . " " . $desc . " LIMIT " . $SHOW_BY_DEFAULT . " OFFSET " . $offset);	
	}

	public function selectOrderPageVue( int $SHOW_BY_DEFAULT, int $page, string $nameOrder, string $desk = 'DESC', bool $getRow = false) {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return ($getRow) 
						? $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) )
						: $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset);
	}

	private function formSql2El( $id, $name, $idVal) {
		$sql = "SELECT * FROM ".$this->table." ORDER BY ".$name;
		return ($idVal) ? $sql . $this->formSql($id,$idVal) : $sql;
	}

	private function getRow2El ( $result, $id, $name) {
		$i  = 0;
		while ($row = $result->fetch()) {
			$list[$i]['id']   = $row[$id];
			$list[$i]['name'] = $row[$name];
			$i++;
		}
		return $list ?? [];
	}
/** Отримуєм дані з таблиці $this->table для 2 елементів з Vue
 *
 *  @return масив даних
 */
	public function getData2ElVue( $id, $name, $idVal=0) {
		$sql = $this->formSql2El($id,$name,$idVal);
		return $this->getRow2EL( $this->getDBVue($sql),$id,$name);
	}
//---------------------SELECT-----------------------------------------------

//---------------------UPDATE ------------------------------------------------
/** Обновляєм запис в таблиці $this->table по елементу $elNameUpdate
 *
 *  @return true або false
 */
	private function set_update_names_values( array $args) {
		$update = "";
		foreach ($args as $key => $value) {
			$update .= $key . "='" . $this->sl147_clean($value)."',";
		}
		return substr($update, 0, -1);
	}

	public function updateDataInTable( array $args, string $valueUpDate, string $nameUpdate, bool $vue = false) {	
		$sql = "UPDATE ".$this->table." SET ".$this->set_update_names_values($args).$this->formSql($nameUpdate,$valueUpDate);
		return  ($vue)  ? $this->getDBVue($sql)
						: $this->getDB($sql);
	}


//--------------------------UPDATE-----------------------------------

//--------------------------INSERT-----------------------------------
	private function set_insert_values( array $values, bool $var) {
		$value = "";
		$start = ($var) ? ''  : "'";
		$end   = ($var) ? "," : "',";
		for ($i=0; $i < count($values); $i++) { 
			$value .= $start;
			$value .= ($var) ? $values[$i] : $this->sl147_clean($values[$i]);
			$value .= $end;
		}
		return substr($value, 0, -1);
	}

	public function insertDataToTable( array $values, array $names, bool $vue = false) {
		$sql = "INSERT INTO " . $this->table . " (" . $this->set_insert_values($names, true) . ") VALUES(" . $this->set_insert_values($values, false) . ")";
		return ($vue) ? $this->getDBVue($sql)
					  : $this->getDB($sql); 
	}
//--------------------------INSERT-------------------------------------------------

//--------------------------DELETE-------------------------------------------------
/** Видадаєм запис з таблиці $this->table
 *
 *  @return true or false
 */
	public function deleteDataFromTable( int $id, string $nameid='id', bool $vue = false) {
		$sql = "DELETE FROM " . $this->table . $this->formSql($nameid,$id);
		return ($vue) ? $this->getDBVue($sql)
					  : $this->getDB($sql); 
	}
}