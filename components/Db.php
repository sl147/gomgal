<?

class Db
{
	
	const DBFILE = 'config/db_params.php';

	private static function getDB($params) {


		$charset = 'utf8';
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8mb4";
		$db =  new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

		//$db->set_charset($charset);	

		return $db;
	}
	public static function getConnection() {
		$params = include (self::DBFILE);
		return self::getDB($params);
	}

	public static function getConnectionVue() {
		$params = include ('../'.self::DBFILE);
		return self::getDB($params);
	}
}
?>