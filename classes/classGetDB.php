<?php
/**
 * 
 */

//namespace models;

class classGetDB
{

	public function getDB ($sql) {
		return Db::getConnection() -> query($sql);
	}

	public function getDBVue ($sql) {
		require_once ('../components/Db.php');
		$db   = new Db();
		return $db->getConnectionVue() -> query($sql);
	}

	public static function getPrepareSQL($sql)
	{
		$db = Db::getConnection();
		return $db -> prepare($sql);
	}

	public static function getPrepareSQLVue($sql)
	{
		$db  = self::getDBVue();
		return $db -> prepare($sql);
	}
}
?>