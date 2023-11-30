<?

class Db
{
	
	const DBFILE = 'config/db_params.php';

	private static function getDB($params) {
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		return new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);	
	}
	public static function getConnection() {
		$params = include (self::DBFILE);
		return self::getDB($params);
	}

	public static function getConnectionVue() {
	    //$params = include (self::DBFILE);
		$params = include ('../'.self::DBFILE);
		return self::getDB($params);
	}
}
?>