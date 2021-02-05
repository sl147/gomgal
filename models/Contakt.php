<?php
/**
* Клас для коментарів
*/
//namespace models;

class Contakt {

	//use models\getPrepareSQL;
	//use models\bindParam;
	use traitAuxiliary;

	private function isSpam($nik,$ip,$email,$txt) {
		$spams = $this->getSpam();
		foreach ($spams as $spam) {
			if (strpos($nik,   $spam["name"]) !== false) return true;
			if (strpos($txt,   $spam["name"]) !== false) return true;
			if (strpos($email, $spam["name"]) !== false) return true;
			if (strpos($ip,    $spam["name"]) !== false) return true;
		}
		return  false;
	}

	public function saveComent($nik,$ip,$email,$txt)	{
		if ($this->isSpam($nik,$ip,$email,$txt)) 
			{
				$subject = "Спам зі сторінки Контакти";
				$to      = "sl147@ukr.net";
				$massage = "Спам зі сторінки Контакти\r\n від: $nik\r\n email:$email\r\n$txt\r\n";
				$mail    = $this->sendMail($subject,$to,$massage);
				return;
			}
			
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