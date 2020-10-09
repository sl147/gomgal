<?php
/**
* 
*/
class Relax {	

	private function getDBVue(){
		require_once ('../models/Auxiliary.php');
		$aux = new Auxiliary();
		return $aux->getDBVue();
	}

	private static function getMsgs($cat,$sql) {
		$cat    = Auxiliary::getIntval($cat);
		$db     = Db::getConnection();
		$result = $db -> query($sql);
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		if (!count($list)) {
			$list[0]['id']  = '';
			$list[0]['msg'] = '';
		}
		return $list ?? [];
	}

	public static function getRelaxRandom($cat) {
		$arr = self::getRelaxMsg($cat);
		if (count($arr) > 0) {
			$j   = rand (0,count($arr)-1);
			return $arr[$j]['msg'];
		}
	}

	public static function getRelaxId($id) {
		$getData = new classGetData('catrelax');
		$cat = $getData->getDataFromTableByNameFetch ($id,'idrl');
		unset($getData);
		return $cat;
	}

	public static function getRelax() {
		$result = Auxiliary::getSQLAux("SELECT * FROM catrelax");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $relaxList ?? [];
	}

	public static function getAnList() {
		$result = Auxiliary::getSQLAux("SELECT * FROM catan ORDER BY namerl");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $relaxList ?? [];
	}

	public static function getRelaxMsg($cat) {
		$sql = "SELECT * FROM msgs_relax WHERE category=$cat and CHAR_LENGTH(msg)<400 and countrl>10";
		return self::getMsgs($cat,$sql);
	}

	public static function getLikeVue($id,$count) {
		$db     = self::getDBVue();	
		$result = $db -> query("UPDATE msgs_relax SET countrl='".$count."' WHERE id='".$id."'");

		return true;
	}

	public static function getRelaxVue($cat = 1, $page = 1, $SHOWRELAX = 1) {
		$offset  = ($page - 1) * $SHOWRELAX;
		$db      = self::getDBVue();
		if ($cat == 0)	{
			$sql = "SELECT * FROM msgs_relax ORDER BY id DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		}
		else {
			$sql = "SELECT * FROM msgs_relax WHERE category=$cat ORDER BY countrl DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		}
		$result = $db -> query($sql);
		$i= 0;
		while ($row = $result->fetch()) {
			$relaxList[$i]['id']  = $row['id'];
			$relaxList[$i]['msg'] = $row['msg'];
		$relaxList[$i]['countrl'] = $row['countrl'];
		    $relaxList[$i]['sql'] = $sql;		
			$i++;
		}
		return $relaxList ?? [];
	}

	public static function getAnThemaVue($teman = 1,$page = 1, $SHOWRELAX = 1) {
		$relaxList = [];
		$offset    = ($page - 1) * $SHOWRELAX;
		$db        = self::getDBVue();
		$sql = "SELECT * FROM msgs_relax WHERE teman=$teman ORDER BY countrl DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		$result = $db -> query($sql);
		while ($row = $result->fetch()) {
			$relaxList[]=$row;
		}
		return $relaxList ?? [];
	}

	public static function addNewAn($teman, $msg) {
		$teman  = Auxiliary::getIntval($teman);
		$sql    = "INSERT INTO msgs_relax (teman,msg) VALUES(:teman, :msg)";
		$result = Auxiliary::getPrepareSQL($sql);
		$result -> bindParam(':teman', $teman, PDO::PARAM_STR);
		$result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function getRelaxAll($page) {
		$getData = new classGetData('msgs_relax');
		$offset  = ($page - 1) * SHOWPOSTER_BY_DEFAULT;
		$comList = $getData->getDataByOffset ('id',SHOWPOSTER_BY_DEFAULT,$offset);
		unset($getData);
		return $comList;
	}

	public static function getRelaxOne($id) {
		$getData = new classGetData('msgs_relax');
		$comList = $getData->getDataFromTableByNameFetch ($id,'id');
		unset($getData);
		return $comList;
	}

	public static function updateRelax($id, $msg, $cat) {
		$result = Auxiliary::getPrepareSQL("UPDATE msgs_relax SET msg = :msg, category = :cat".Auxiliary::formSqlAux("id",$id));
		Auxiliary::bindParam($result,':msg', $msg);
		Auxiliary::bindParam($result,':cat', $cat);
		return $result -> execute();			
	}

		public static function updateCountRelax($id, $count) {
		$result = Auxiliary::getPrepareSQL("UPDATE msgs_relax SET countrl = :count".Auxiliary::formSqlAux("id",$id));
		Auxiliary::bindParam($result,':count', $count);
		return $result -> execute();			
	}
}
?>