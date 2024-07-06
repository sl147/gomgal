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

	private function setWhere( array $args, bool $like = false) :string {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= ( $like ) ? " (" . strtoupper($key) . " LIKE '%" . strtoupper($value)."%') AND"
							  : " (" . $key . "='" . $value."') AND";
		}
		return (string) substr($set, 0, -4);
	}

//-------------------SELECT COUNT----------------------------------------------------------

	private function getCountFetch( string $sql, bool $vue ) {
		return ($vue) ? $this->getDBVue($sql)->fetch()['count']
					  : $this->getDB($sql)->fetch()['count'];
	}

	public function selectCount( bool $vue = true, array $args=[], bool $where = false, bool $like = false ) {
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->setWhere( $args, $like );
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

	private function getOffset( int $page, int $limit) {
		return ( $page - 1 ) * $limit;
	}

	public function selectDataFromTable( array $args, string $nameOrder = "", int $limit = 0, string $desc = 'DESC', bool $row = true, bool $vue = false, bool $fetch = false, bool $offset = false, int $page = 1) {
		$sql = sprintf("SELECT * FROM %s %s %s %s %s",
					$this->table,
					(!empty($args)) ? $this->setWhere($args) : "",
					( $nameOrder )  ? sprintf(" ORDER BY %s %s", $nameOrder, $desc) : "",
					( $limit)       ? sprintf(" LIMIT %s",$limit) : "",
					( $offset )     ? sprintf(" OFFSET %s", $this->getOffset( $page, $limit )) : ""
				);

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
		$sql = sprintf("UPDATE %s SET %s %s ",
						$this->table,
						$this->set_update_names_values($args),
						$this->setWhere($args_where)
				);
		return  ($vue)  ? $this->getDBVue($sql)
						: $this->getDB($sql);
	}

	public function updateCountPlusOne( array $args ) {
		return $this->getDB(sprintf("UPDATE %s SET count_p = count_p+1 %s",
									$this->table,
									$this->setWhere($args)
								));
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
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
						$this->table,
						$this->set_insert_values($names, true),
						$this->set_insert_values($values, false)
					);
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
		$sql = sprintf("DELETE FROM %s %s",
						$this->table,
						$this->setWhere( $args )
					);
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