<?php
/**
 * 
 */
class Calculator
{

	const SHOWMEASURES = 4;

	private static function db() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	public static function updateVueReestrTab ($id, $name, $k, $type, $subtype, $quantity, $active) {
		$db     = self::db();
		$sql    = "UPDATE calculator SET name=:name, k=:k, type=:type, subtype=:subtype, quantity=:quantity, active=:active WHERE id=$id";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name',    $name,    PDO::PARAM_STR);
		$result -> bindParam(':k',       $k,       PDO::PARAM_STR);
		$result -> bindParam(':type',    $type,    PDO::PARAM_STR);
		$result -> bindParam(':subtype', $subtype, PDO::PARAM_STR);
		$result -> bindParam(':quantity',$quantity,PDO::PARAM_STR);
		$result -> bindParam(':active',  $active,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function updateVueQuantity ($id, $q) {
		$db     = self::db();
		$sql    = "UPDATE calculator SET quantity=:quantity WHERE id=$id";
		$result = $db -> prepare($sql);
		$result -> bindParam(':quantity',   $q, PDO::PARAM_INT);
		
		return $result -> execute();		
	}

	public static function updateVueSub ($id, $name, $idCalculator) {
		$db     = self::db();
		$sql    = "UPDATE typeSubCalculator SET name=:name, idCalculator=:idCalculator WHERE id=$id";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name',           $name,         PDO::PARAM_STR);
		$result -> bindParam(':idCalculator',   $idCalculator, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function addVueReestrTab ($name, $k, $type) {
		$db     = self::db();
		$sql    = "INSERT INTO calculator (name,k,type) VALUES(:name,:k,:type)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':k',    $k,    PDO::PARAM_STR);
		$result -> bindParam(':type', $type, PDO::PARAM_STR);
		
		return $result -> execute();;			
	}

	public static function addVueSubTypes ($name, $type) {
		$db     = self::db();
		$sql    = "INSERT INTO typeSubCalculator (name,idCalculator) VALUES(:name,:type)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':type', $type, PDO::PARAM_STR);
		
		return $result -> execute();;			
	}

	public static function selectCalcActive($type) {
		$db  = self::db();
		$list = [];
		//$sql = "SELECT * FROM calculator WHERE active=1 && type=".intval($type);
		$sql = "SELECT * FROM calculator WHERE quantity>0 && type=".intval($type)." LIMIT ".self::SHOWMEASURES;
		$res = $db -> query($sql);
		while ($row = $res->fetch()) {			
			$list[] = $row;
		}
		//return (isset($list)) ? $list : [];
		return $list;
	}

	public static function selectCalc($type) {
		$db  = self::db();
		$list = [];
		$sql = "SELECT * FROM calculator WHERE type=".intval($type);
		$res = $db -> query($sql);
		while ($row = $res->fetch()) {			
			$list[] = $row;
		}
		//return (isset($list)) ? $list : [];
		return $list;
	}

	public static function selectSub($type) {
		$db  = self::db();
		$sql = "SELECT * FROM typeSubCalculator WHERE idCalculator=".intval($type);
		$res = $db -> query($sql);
		while ($row = $res->fetch()) {			
			$list[] = $row;
		}
		return (isset($list)) ? $list : [];
	}
}
?>