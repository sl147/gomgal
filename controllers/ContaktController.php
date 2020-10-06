<?php
/**
* 
*/
class ContaktController {
	
	public function actionIndex() {

		if(isset($_POST['submit'])) {
	        $nik_com = Auxiliary::filterTXT('post','nik_com');
		    $email   = ($_POST['email_com']) ? Auxiliary::filterEmail('post','email_com') : "";
	        $txt_com = Auxiliary::filterTXT('post','txt_com');
	        $ip_com  = $_SERVER['REMOTE_ADDR'];
			$result  = Contakt::saveComent($nik_com,$ip_com,$email,$txt_com);
			$subject = "Нове повідомлення зі сторінки Контакти";
			$to      = "sl147@ukr.net";
			$massage = "Нове повідомлення зі сторінки Контакти";
			$mail    = Auxiliary::sendMail($subject,$to,$massage);			        
		}
		
		$siteFile = 'views/contakt/index.php';
		$metaTags = 'contakt';
		require_once ('views/layouts/siteIndex.php');		
		return true;
	}
}
?>