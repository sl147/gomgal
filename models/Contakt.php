<?php
/**
* Клас для коментарів
*/
//namespace models;

class Contakt {

	//use models\getPrepareSQL;
	//use models\bindParam;

	private static function isSpam($nik,$ip,$email,$txt) {
		$tab = Auxiliary::getSpam();
		foreach ($tab as $item) {
			if (strpos($nik,   $item["name"]) !== false) return 1;
			if (strpos($txt,   $item["name"]) !== false) return 1;
			if (strpos($email, $item["name"]) !== false) return 1;
			if (strpos($ip,    $item["name"]) !== false) return 1;
		}
		return  0;
	}

	public static function saveComent($nik,$ip,$email,$txt)	{
		if (self::isSpam($nik,$ip,$email,$txt)) return;
		$sql    = "INSERT INTO wishCl (nik_com,ip_com,email_com,txt_com)
		 VALUES(:nik_com,:ip_com,:email_com,:txt_com)";
		$getDB  = new classGetDB();
		$result = $getDB->getPrepareSQL($sql);
		$result -> bindParam(':nik_com',   $nik,   PDO::PARAM_STR);
		$result -> bindParam(':ip_com',    $ip,    PDO::PARAM_STR);
		$result -> bindParam(':email_com', $email, PDO::PARAM_STR);
		$result -> bindParam(':txt_com',   $txt,   PDO::PARAM_STR);
		unset($getDB);
		
		return $result -> execute();		
	}
}
?>