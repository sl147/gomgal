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

	public function getPrepareSQL($sql)
	{
		$db   = new Db();
		return $db->getConnection() ->  prepare($sql);
	}

	public static function getPrepareSQLVue($sql)
	{
		require_once ('../components/Db.php');
		$db   = new Db();
		return $db -> prepare($sql);
	}
}
?>