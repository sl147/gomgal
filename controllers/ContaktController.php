<?php

/**

* 

*/

class ContaktController {

	use traitAuxiliary;

	private function getSubmit() {
		$txt_com   = $this->filterTXT('post','txt_com');
		$nik_com   = $this->filterTXT('post','nik_com');
		$email_com = $this->filterTXT('post','email_com');
		$subject = "haks1 зі сторінки Contakt";
			$massage = $subject."\r\n".$txt_com."\r\n".$nik_com."\r\n".$email_com;
		if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {			
			$ip_com = $_SERVER['REMOTE_ADDR'];
			if (!empty($txt_com)) {
				$cont = new Contakt();
				if ($cont->saveComent($nik_com,$ip_com,$email_com,$txt_com)) {
					$this->mailToClient($email_com,'Дякуєм за Ваше повідомлення.');
					$subject = "Нове повідомлення зі сторінки Контакти";
					$massage = $subject."\r\n від: $nik_com\r\n email:$email_com\r\n$txt_com\r\n"." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR'];
					$mail    = $this->sendMail($subject,BanMAIL,$massage);					
				}
			}else {
				$subject = "пусте повідомлення зі сторінки Contakt";
				$massage = $subject."\r\n".$txt_com."\r\n".$nik_com."\r\n".$email_com;				
			}
		}
		else {
			$subject = "haks зі сторінки Contakt";
			$massage = $subject."\r\n".$txt_com."\r\n".$nik_com."\r\n".$email_com;				
		}
		$mail = $this->sendMail($subject,SLMAIL,$massage);
	}


	public function actionIndex() {
		if(isset($_POST['submit'])) $this->getSubmit();

		$token    = $this->getToken();
		$siteFile = 'views/contakt/index.php';
		$metaTags = 'contakt';
		require_once ('views/layouts/siteIndex.php');		
		return true;
	}
}