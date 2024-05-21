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
	}
}