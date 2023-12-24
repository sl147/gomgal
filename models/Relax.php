<?php

/**
* 
*/

class Relax extends classGetDB {	

	use traitAuxiliary;

	public function getRelaxId( int $id) :int {
		$getData = new classGetData('catrelax');
		$cat     = $getData->getDataFromTableByNameFetch ($this->getIntval($id),'idrl');
		unset($getData);
		return (int) $cat;
	}

	public function getRelax() :array {
		$getData = new classGetData('catrelax');
		$result  = $getData->getDataFromTable(2);
		unset($getData);
		$i       = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return (array) $relaxList ?? [];
	}

	public function getThemeAn() :array {
		$getData = new classGetData('catan');
		$result  = $getData->getDataFromTable(2);
		unset($getData);
		$i       = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return (array) $relaxList ?? [];
	}

	public function getAnList() :array {
		$result = $this->getDB("SELECT * FROM catan ORDER BY namerl");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return (array) $relaxList ?? [];
	}


	private function getRelaxMsg( int $cat) :array {
		$cat    = $this->getIntval($cat);
		$result = $this->getDB("SELECT * FROM msgs_relax WHERE category=$cat and CHAR_LENGTH(msg)<400 and countrl>10");
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return (array) $list ?? [];
	}

	public function getRelaxRandom( int $cat) :string{
		$arr = self::getRelaxMsg($cat);
		if (count($arr) > 0) {
			$j   = rand (0,count($arr)-1);
			return (string) $arr[$j]['msg'];
		}
		return (string) ""; 
	}

	private function getCountRl() :int {
		$result = $this->getDB("SELECT countrl FROM msgs_relax");
		while ($row = $result->fetch()) {			
			$list[] = $row['countrl'];
		}
		return (int) max($list);
	}

	public function addNewAn( int $teman, string $msg) :bool{
		$teman   = $this->getIntval($teman);
		$countrl = $this->getCountRl() + 1;
        $sql     = "INSERT INTO msgs_relax (teman, msg, countrl) VALUES(:teman, :msg, :countrl )";
        $result  = $this->getPrepareSQL($sql);
        $result -> bindParam(':teman',   $teman,   PDO::PARAM_INT);
        $result -> bindParam(':msg',     $msg,     PDO::PARAM_STR);
        $result -> bindParam(':countrl', $countrl, PDO::PARAM_INT);

        return $result -> execute();		
	}

	public function getRelaxAll( int $page) :array {
		$getData = new classGetData('msgs_relax');
		$offset  = ($this->getIntval($page) - 1) * SHOWRELAX_BY_DEFAULT;
		$comList = $getData->getDataByOffset ('id',SHOWRELAX_BY_DEFAULT,$offset);
		unset($getData);
		return (array) $comList;
	}

	public function getRelaxOne( int $id) :array {
		$getData = new classGetData('msgs_relax');
		$comList = $getData->getDataFromTableByNameFetch ($this->getIntval($id),'id');
		unset($getData);
		return (array) $comList;
	}

	public function updateRelax( int $id, string $msg, int $cat) :bool {
		$cat    = $this->getIntval($cat);
		$result = $this->getPrepareSQL("UPDATE msgs_relax SET msg = :msg, category = :cat".$this->formSql( "id", $this->getIntval($id)));
		$result -> bindParam(':msg',   $msg, PDO::PARAM_STR);
		$result -> bindParam(':cat',   $cat, PDO::PARAM_INT);
		return $result -> execute();			
	}

	public function updateCountRelax( int $id, int $count) :bool {
		$result = $this->getPrepareSQL("UPDATE msgs_relax SET countrl = :count".$this->formSql( "id", $this->getIntval($id)));
		$result -> bindParam(':count',   $count, PDO::PARAM_INT);
		return $result -> execute();			
	}
}