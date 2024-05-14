<?php



class Db

{

	

	const DBFILE = 'config/db_params.php';

<<<<<<< HEAD


	private static function getDB($params) {

=======
	private static function getDB($params)
	{
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

		return new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);	

	}
<<<<<<< HEAD

=======
	
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
	public static function getConnection() {

		$params = include (self::DBFILE);

		return self::getDB($params);

	}



	public static function getConnectionVue() {

	    //$params = include (self::DBFILE);

		$params = include ('../'.self::DBFILE);

		return self::getDB($params);

	}
<<<<<<< HEAD

}

?>
=======
}
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
