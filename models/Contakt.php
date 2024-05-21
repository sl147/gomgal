<?php

/**

* Клас для коментарів

*/

class Contakt {

	use traitAuxiliary;

	public function __construct() {
		$this->wishcl = new classGetData('wishCl');
	}

	public function saveComent($nik,$ip,$email,$txt) {

		if ($this->isSpam($nik,$ip,$email,$txt)) {
				$subject = "Спам зі сторінки Контакти";
				$massage = $subject."\r\nвід: $nik\r\nemail:$email\r\n$txt\r\n";
				return $this->sendMail($subject,SLMAIL,$massage);
		}
		$names  = ['nik_com', 'ip_com', 'email_com', 'txt_com'];
		$values = [$nik, $ip, $email, $txt];
		$this->wishcl->insertDataToTable( $values, $names);
		return true;

/*		$sql    = "INSERT INTO wishCl (nik_com,ip_com,email_com,txt_com)
		           VALUES(:nik_com,:ip_com,:email_com,:txt_com)";
		$getDB  = new classGetDB();
		$result = $getDB->getPrepareSQL($sql);
		$result -> bindParam(':nik_com',   $nik,   PDO::PARAM_STR);
		$result -> bindParam(':ip_com',    $ip,    PDO::PARAM_STR);
		$result -> bindParam(':email_com', $email, PDO::PARAM_STR);
		$result -> bindParam(':txt_com',   $txt,   PDO::PARAM_STR);
		unset($getDB);		
		return $result -> execute();*/		
	}
}