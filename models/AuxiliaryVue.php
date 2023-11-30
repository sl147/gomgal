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

	public static function sel2El($tab,$name,$id,$idVal,$isId)
	{
		require_once ('../classes/traitAuxiliary.php');
		require_once ('../classes/classGetDB.php');
		require_once ('../classes/classGetData.php');

		$getData  = new classGetData($tab);
		$NewsList = $getData->getData2ElVue($id,$name,$idVal);
		unset($getData);
		return $NewsList;
	}

	public static function updateVue2El ($id, $name, $tab, $nameEl, $nameId)
	{
		$sql    = "UPDATE ".$tab." SET ".$nameEl."=:name WHERE ".$nameId.' = '.$id;
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function addVue2El($name, $tab, $nameEl)
	{
		$sql    = "INSERT INTO ".$tab." (".$nameEl.") VALUES(:name)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	private static function delFilePoster($id)
	{
		$poster = self::getPosterById($id);
		$res    = self::delFileVue($poster["foto_p1"],"posterFoto");	
	}

	public static function delVue2El($id, $tab, $nameId)
	{
		$sql    = "DELETE FROM ".$tab.' WHERE '.$nameId.' = '.$id;
		$result = self::getSQLAuxVue($sql);
		if ($tab == "poster") {
			$res = self::delFilePoster($id);
		}
	}

	private static function getPathFile($file,$folder,$delim="")
	{
		return "./".$folder."/".$delim.$file;
	}

	public static function delFileVue($file,$folder)
	{
		$fdel  = self::getPathFile($file,$folder);
				$str  = explode( '/', $file );
		$file = '';
		for ($i=0; $i < count($str)-1; $i++) { 
			$file .= $str[$i].'/';
		}
		$file .= 's_'.$str[count($str)-1];
		$fdelS = self::getPathFile($file,$folder);
		if (file_exists($fdel))  unlink($fdel);
		if (file_exists($fdelS)) unlink($fdelS);
	}

	public static function getPosterById($id)
	{
		$result = self::getSQLAuxVue("SELECT * FROM poster WHERE id_poster=".$id);
		return $result->fetch();
	}
}
?>