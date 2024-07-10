<?php

/**
* 
*/

class ContaktController {

	use traitAuxiliary;

	private function getMassage( string $subject, string $txt_com, string $nik_com, string $email_com) {
		return (string) $subject."\r\n".$txt_com."\r\n".$nik_com."\r\n".$email_com;
	}

	private function getSubmit() {
		$txt_com   = $this->sl147_clean($_POST['txt_com']);
		$nik_com   = $this->sl147_clean($_POST['nik_com']);
		$email_com = $this->filterEmail('post','email_com');
		
		if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {			
			$ip_com = $_SERVER['REMOTE_ADDR'];
			if (!empty($txt_com)) {
				$cont = new Contakt();
				if ($cont->saveComent($nik_com,$ip_com,$email_com,$txt_com)) {
					$this->mailToClient($email_com,'Дякуєм за Ваше повідомлення.');
					$subject = "Нове повідомлення зі сторінки Контакти";
					$massage = $subject."\r\n від: $nik_com\r\n email:$email_com\r\n$txt_com\r\n"." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR'];
					$this->mailing(BanMAIL, $subject, $massage);					
				}else{
					$subject = "Нове не зрозуміле повідомлення";
					$massage = $this->getMassage( $subject, $txt_com, $nik_com, $email_com);
				}
			}else {
				$subject = "пусте повідомлення зі сторінки Contakt";
				$massage = $this->getMassage( $subject, $txt_com, $nik_com, $email_com);	
			}
		}
		else {
			$subject = "haks зі сторінки Contakt";
			$massage = $this->getMassage( $subject, $txt_com, $nik_com, $email_com);		
		}
		$this->mailing(SLMAIL, $subject, $massage);
	}


	public function actionIndex() {
		if(isset($_POST['submit'])) $this->getSubmit();

		$token    = $this->getToken();
		$siteFile = 'views/contakt/index.php';
		$meta     = $this->getMeta();
		require_once ('views/layouts/siteIndex.php');		
		return true;
	}
}