<?php

/**
 * 
 */
//namespace classes;

//use classes\classGetDB;

//use classes\traitAuxiliary;

class classGetData extends classGetDB {

	use traitAuxiliary;

	public function __construct( string $table)	{
		$this->table = $table;
	}

	private function getRow (object $result) :array {
		$list = [];
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return (array) $list;
	}

//-------------------SELECT COUNT----------------------------------------------------------

	private function setWhereLike( array $args) :string {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= " (" . $key . " LIKE '%" . $value."%') AND";
		}
		return (string) substr($set, 0, -4);
	}

	private function getCountFetch( string $sql, bool $vue ) {
		return ($vue) ? $this->getDBVue($sql)->fetch()['count']
					  : $this->getDB($sql)->fetch()['count'];
	}

	public function selectCount( bool $vue = true ) {
		$sql = "SELECT count(*) as count FROM ".$this->table;
		return $this->getCountFetch( $sql, $vue );
	}

	public function selectCountWhere ( array $args, bool $vue = true) {
		$sql = "SELECT count(*) as count FROM ".$this->table.$this->setWhere($args);
		return $this->getCountFetch( $sql, $vue );
	}
	
	public function selectCountFind ( array $args, bool $vue = true) {
		$sql = "SELECT count(*) as count FROM ".$this->table.$this->setWhereLike($args);
		return $this->getCountFetch( $sql, $vue );
	}
//-------------------SELECT COUNT----------------------------------------------------------

//-------------------SELECT ---------------------------------------------------------------

	private function getRowVueFetch( string $sql, bool $row , bool $vue, bool $fetch) {
		$request = ($row) ? ( ($vue) ? $this->getRow($this->getDBVue($sql))
								 	 : $this->getRow($this->getDB($sql)) )
			 		  	  : ( ($vue) ? $this->getDBVue($sql)
			 		  			 	 : $this->getDB($sql));

		return ( $fetch ) ? $request->fetch() : $request;
	}

	private function setWhere( array $args) :string {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= " (" . $key . "='" . $value."') AND";
		}
		return (string) substr($set, 0, -4);
	}

	private function getOffset( int $page, int $SHOW_BY_DEFAULT) {
		return ($page - 1) * $SHOW_BY_DEFAULT;
	}

	public function selectDataFromTable( array $args, string $nameOrder = "", int $limit = 0, string $desc = 'DESC', bool $row = true, bool $vue = false, bool $fetch = false, bool $offset = false, int $page = 1) {
		$sql = "SELECT * FROM " . $this->table;
		if ( !empty($args)) $sql .= $this->setWhere($args);
		if ( $nameOrder )   $sql .= " ORDER BY " . $nameOrder ." " . $desc;
		if ( $limit )       $sql .= " LIMIT " . $limit;
		if ( $offset )      $sql .= " OFFSET ". $this->getOffset( $page, $limit );

 		return $this->getRowVueFetch( $sql, $row, $vue, $fetch);
	}

/*	public function selectFromTableWHERE( array $args, bool $row = true, bool $vue = false, bool $fetch = false) {
		$sql = "SELECT * FROM ".$this->table.$this->setWhere($args);
		return $this->getRowVueFetch( $sql, $row, $vue, $fetch);
	}*/

//-----------------SELECT NEWS-------------------------------
	public function selectRelaxMsg(int $cat) :array {
		return (array) $this->getRow($this->getDB("SELECT * FROM " . $this->table . " WHERE category=$cat and CHAR_LENGTH(msg)<400"));
	}

	public function selectFindNews ( string $txt) {
		return $this->getDB("SELECT * FROM $this->table WHERE ( LOWER(msg) LIKE '%" . $txt . "%') OR ( LOWER(title) LIKE '%" . $txt . "%') OR ( LOWER(prew) LIKE '%" . $txt . "%')");
	}

	public function selectNews( int $month, int $year, int $page, int $SHOWNEWS_BY_DEFAULT){
		return $this->getDB("SELECT * FROM $this->table WHERE (month(datetime) = '$month') and (year(datetime) = '$year') ORDER BY countmsgs DESC LIMIT $SHOWNEWS_BY_DEFAULT OFFSET " . $this->getOffset( $page, $SHOWNEWS_BY_DEFAULT ) );
	}

	public function selectNewsOther( int $id, int $cat1, int $cat2) {
		return $this->getRow( $this->getDB( "SELECT * FROM " . $this->table . "  WHERE cat2='$cat2' && category='$cat1' && id<'$id' ORDER BY id  DESC LIMIT 10" ) );
	}

	public function selectLatestNewsCat( int $cat, int $month, int $year, int $page = 1, int $SHOWNEWS_BY_DEFAULT) {
		return $this->getDB("SELECT * FROM " . $this->table ." WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '$month') and (year(datetime) = '$year') ORDER BY countmsgs DESC LIMIT $SHOWNEWS_BY_DEFAULT OFFSET " . $this->getOffset( $page, $SHOWNEWS_BY_DEFAULT ));
	}

	private function addCategory (int $month, int $year, int $cat) {
		return sprintf("SELECT count(*) as count FROM %s WHERE %s (month(datetime) = '%d') and (year(datetime) = '%d')",
						$this->table,
						($cat) ? "((category=$cat) or (cat2=$cat)) and " : " ",
						$month,
						$year
				);
	}

	public function selectTotalNews(int $month, int $year, int $cat = 0) {
		return $this->getDB( $this->addCategory( $month, $year, $cat ))->fetch()['count'];
	}


//-----------------SELECT NEWS---------------------------------------------
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

	public function updateDataInTable( array $args, array $args_where, bool $vue = false) {	
		$sql = "UPDATE ".$this->table." SET ".$this->set_update_names_values($args).$this->setWhere($args_where);
		return  ($vue)  ? $this->getDBVue($sql)
						: $this->getDB($sql);
	}

	public function updateCountPlusOne( array $args ) {
		return $this->getDB("UPDATE " . $this->table . " SET count_p = count_p+1".$this->setWhere($args));
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
	/**
     * Видадаєм запис з таблиці $this->table
     * @param $nameid string назва реквізиту по якому видаляєм
	 * @param $id int значення реквізиту
	 * @param $vue bool true для vue; false ні
     * @return void
     * 
     */ 
	public function deleteDataFromTable( $args, bool $vue = false) {
		$sql = "DELETE FROM " . $this->table . $this->setWhere( $args );
		return ($vue) ? $this->getDBVue($sql)
					  : $this->getDB($sql); 
	}

//--------------------------DELETE-------------------------------------------------

	public function getMetaTable() {
		$sql = "SHOW COLUMNS FROM ".$this->table;
		$res = $this->getDB($sql);
		while ($row = $res->fetch()) {
			$columns[] = $row['Field'];
		}
	}
}