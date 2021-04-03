<?php
/**
* Клас для коментарів
*/
class Contakt
{
	use traitAuxiliary;
	public function saveComent($nik,$ip,$email,$txt)
	{
		if ($this->isSpam($nik,$ip,$email,$txt)) 
			{
				$subject = "Спам зі сторінки Контакти";
				$massage = $subject."\r\nвід: $nik\r\nemail:$email\r\n$txt\r\n";
				$mail    = $this->sendMail($subject,SLMAIL,$massage);
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