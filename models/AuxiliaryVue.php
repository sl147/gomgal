<?php
/**
 * 
 */
class AuxiliaryVue
{
	

	public function getDBVue()
	{
		require_once ('../components/Db.php');
		$db   = new Db();
		return $db ->getConnectionVue();
	}

	public static function getSQLAuxVue($sql)
	{
		$db  = self::getDBVue();
		return $db -> query($sql);
	}

	public static function getPrepareSQLVue($sql)
	{
		$db  = self::getDBVue();
		return $db -> prepare($sql);
	}

	public static function sel2El($tab,$name,$id,$idVal,$isId) {
		require_once ('../classes/traitAuxiliary.php');
		require_once ('../classes/classGetDB.php');
		require_once ('../classes/classGetData.php');

		$getData  = new classGetData($tab);
		$NewsList = $getData->getData2ElVue($id,$name,$idVal);
		unset($getData);
		return $NewsList;
	}

	public static function formSqlAux($atr,$value)
	{
		return " WHERE ".$atr." = ".$value;
	}

	public static function updateVue2El ($id, $name, $tab, $nameEl, $nameId)
	{
		$sql    = "UPDATE ".$tab." SET ".$nameEl."=:name".self::formSqlAux($nameId,$id);
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function addVue2El($name, $tab, $nameEl) {
		$sql    = "INSERT INTO ".$tab." (".$nameEl.") VALUES(:name)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}
	
	public static function addElVote($name,$cat) {
		//$cat    = self::getIntval($cat);
		$sql    = "INSERT INTO vote (msg,category) VALUES(:name, :cat)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':cat',  $cat,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	private static function delFilePoster($id) {
		$poster = Auxiliary::getPosterById($id);
		$res    = Auxiliary::delFileVue($poster["foto_p1"],"posterFoto");	
	}

	public static function delVue2El($id, $tab, $nameId)
	{
		$sql    = "DELETE FROM ".$tab.self::formSqlAux($nameId,$id);
		$result = self::getSQLAuxVue($sql);
		if ($tab == "poster") {
			$res = self::delFilePoster($id);
		}
		//видалення файлу фото
	}
}
?>