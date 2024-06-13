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

//-------------------SELECT-------------------------------------------------------------
/** Отримуєм записи з таблиці $this->table по елементу $elName->fetch()
 *
 *  @return елемент даних
 */
	private function setWhereLike( array $args) :string {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= " (" . $key . " LIKE '%" . $value."%') AND";
		}

		return (string) substr($set, 0, -4);
	}

	public function selectCountFind ( array $args, bool $vue = true) {
		$sql = "SELECT count(*) as count FROM ".$this->table.$this->setWhereLike($args);
		return ($vue) ? $this->getDBVue($sql)->fetch()['count']
					  : $this->getDB($sql)->fetch()['count'];
	}

	public function selectCount( bool $vue = true ) {
		$sql = "SELECT count(*) as count FROM ".$this->table;
		return ($vue) ? $this->getDBVue($sql)->fetch()['count']
					  : $this->getDB($sql)->fetch()['count'];
	}

	public function selectFromTable ( bool $var = true) {
		return ($var) ? $this->getRow($this->getDB("SELECT * FROM ".$this->table))
					  :               $this->getDB("SELECT * FROM ".$this->table) ;
	}

	public function selectFromTableVue ( bool $var = true) {
		return ($var) ? $this->getRow($this->getDBVue("SELECT * FROM ".$this->table))
					  :               $this->getDBVue("SELECT * FROM ".$this->table) ;
	}

	private function setWhere( array $args) :string {
		$set = " WHERE";
		foreach ($args as $key => $value) {
			$set .= " (" . $key . "='" . $value."') AND";
		}
		return (string) substr($set, 0, -4);
	}

	public function selectDataFromTableWHERE (array $args, bool $row = true) {
		$sql = "SELECT * FROM ".$this->table.$this->setWhere($args);
		return ( $row ) ? $this->getDB( $sql)
						: $this->getRow($this->getDB($sql));	
	}

	public function selectDataFromTableWHEREFetch (array $args) {
		return $this->getDB("SELECT * FROM ".$this->table.$this->setWhere($args))->fetch();	
	}

	public function selectWhereLimitRow ( string $nameOrder, array $args, string $desc = 'DESC', int $SHOW_BY_DEFAULT, bool $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->setWhere( $args ). " ORDER BY " . $nameOrder . " "  . $desc . " LIMIT " . $SHOW_BY_DEFAULT;
		return ($vue) ? $this->getRow($this->getDBVue( $sql ))
					  : $this->getRow($this->getDB($sql));
	}

	private function getOffset ( int $page, int $SHOW_BY_DEFAULT) {
		return ($page - 1) * $SHOW_BY_DEFAULT;
	}

	public function selectOrderBy(string $nameOrder, string $desk = 'DESC', bool $row = false) {
		return ( $row )  ? $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) ) 
						: $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk);
	}

	public function selectOrderLimit( string $nameOrder, int $limit, string $desk = 'DESC') {
		return $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$limit);
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return елемент даних
 */
	public function selectWhere ( string $elValue, string $elName, bool $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->formSql($elName,$elValue);
		return ($vue) ? $this->getDBVue($sql)
					  : $this->getDB($sql);
	}

	public function selectWhereFetch ( string $elValue, string $elName, bool $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->formSql( $elName, $elValue );
		return ($vue) ? $this->getDBVue($sql)->fetch()
					  : $this->getDB($sql)->fetch();
	}

	public function selectWhereOrderBy(string $nameid, int $id, string $nameOrder, string $desk = 'DESC') {
		return $this->getDB("SELECT * FROM ".$this->table.$this->formSql($nameid,$id)." ORDER BY ".$nameOrder." ".$desk);
	}

	public function selectWhereLimitFetch ( int $SHOW_BY_DEFAULT, string $nameOrder, string $elValue, string $elName, string $desc = 'DESC', bool $vue=false){
		$sql = "SELECT * FROM ".$this->table.$this->formSql( $elName, $elValue ). " ORDER BY " . $nameOrder . " "  . $desc . " LIMIT " . $SHOW_BY_DEFAULT;
		return ($vue) ? $this->getDBVue($sql)->fetch()
					  : $this->getDB($sql)->fetch();
	}

	public function selectWhereGetRow ( string $elValue, string $elName, bool $vue = false) {
		$sql = "SELECT * FROM ".$this->table.$this->formSql($elName,$elValue);
		return ( $vue ) ? $this->getRow($this->getDBVue( $sql ))
						: $this->getRow($this->getDB($sql));	
	}

	public function selectOrderPage (int $SHOW_BY_DEFAULT, int $page, string $nameOrder, string $desc = 'DESC', $row = false ) {
		$sql    = "SELECT * FROM " . $this->table . " ORDER BY " . $nameOrder . " " . $desc . " LIMIT " . $SHOW_BY_DEFAULT . " OFFSET " . $this->getOffset( $page, $SHOW_BY_DEFAULT );
		return ($row) ? $this->getRow($this->getDB( $sql ))
					  : $this->getDB( $sql );	
	}

	public function selectOrderPageVue( int $SHOW_BY_DEFAULT, int $page, string $nameOrder, string $desk = 'DESC', bool $row = false) {
		$sql    = "SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET " . $this->getOffset( $page, $SHOW_BY_DEFAULT );
		return ($row) 	? $this->getRow( $this->getDBVue($sql) )
						: $this->getDBVue( $sql );
	}

	public function selectWhereOrderPageVue( string $elValue, string $atr, int $SHOW_BY_DEFAULT, int $page, string $nameOrder, string $desk = 'DESC', bool $row = false) {
		$sql    = "SELECT * FROM ".$this->table.$this->formSql( $atr, $elValue ) . " ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET " . $this->getOffset( $page, $SHOW_BY_DEFAULT );
		return ($row) ? $this->getRow( $this->getDBVue( $sql ) )
					  : $this->getDBVue( $sql );
	}

	public function selectWhereOrderPage( array $args, string $nameOrder, string $desk = 'DESC', int $SHOW_BY_DEFAULT, int $page, bool $row = false) {
		$sql    = "SELECT * FROM ".$this->table.$this->setWhere( $args ) . " ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET " . $this->getOffset( $page, $SHOW_BY_DEFAULT );
		return ($row) ? $this->getRow( $this->getDB( $sql ) )
					  : $this->getDB( $sql );
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

/** Отримуєм дані з таблиці $this->table для 2 елементів 
 *
 *  @return масив даних
 */
	public function getData2El($id,$name,$idVal=0) {
		$sql = $this-> formSql2El($id,$name,$idVal);
		return $this->getRow2EL( $this->getDB($sql),$id,$name);
	}
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
	/**
     * Видадаєм запис з таблиці $this->table
     * @param $nameid string назва реквізиту по якому видаляєм
	 * @param $id int значення реквізиту
	 * @param $vue bool true для vue; false ні
     * @return void
     * 
     */ 
	public function deleteDataFromTable( int $id, string $nameid='id', bool $vue = false) {
		$sql = "DELETE FROM " . $this->table . $this->formSql($nameid,$id);
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