<?php
/**
* Клас для коментарів
*/
namespace models;

class Contakt {

	//use models\getPrepareSQL;
	//use models\bindParam;

	private static function isSpam($nik,$ip,$email,$txt) {
		$tab = Auxiliary::getSpam();
		foreach ($tab as $item) {
			if (strpos($nik,  $item["name"])) return 1;
			if (strpos($txt,  $item["name"])) return 1;
			if (strpos($email,$item["name"])) return 1;
			if (strpos($ip,   $item["name"])) return 1;
		}
		return  0;
	}

	public static function saveComent($nik,$ip,$email,$txt)	{
		if (self::isSpam($nik,$ip,$email,$txt)) return;
		$sql    = "INSERT INTO wishCl (nik_com,ip_com,email_com,txt_com)
		 VALUES(:nik,:ip,:email,:txt)";
		$result = \Auxiliary::getPrepareSQL($sql);
		\Auxiliary::bindParam($result,':nik',   $nik);
		\Auxiliary::bindParam($result,':ip',   $ip);
		\Auxiliary::bindParam($result,':email',   $email);
		\Auxiliary::bindParam($result,':txt',   $txt);
		
		return $result -> execute();		
	}
}
?>