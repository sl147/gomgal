<?php
/**
* 
*/
class ContaktController {

	use traitAuxiliary;
	
	public function actionIndex()
	{
		if(isset($_POST['submit']))
		{
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token']))
			{
				$cont    = new Contakt();
		        $nik_com = $this->filterTXT('post','nik_com');
			    $email   = ($_POST['email_com']) ? $this->filterEmail('post','email_com') : "";
		        $txt_com = $this->filterTXT('post','txt_com');
		        $ip_com  = $_SERVER['REMOTE_ADDR'];
		        if (!empty($txt_com)) {
		        	$result  = $cont->saveComent($nik_com,$ip_com,$email,$txt_com);
					$subject = "Нове повідомлення зі сторінки Контакти";
					$to      = "sl147@ukr.net";
					$massage = "Нове повідомлення зі сторінки Контакти\r\n від: $nik_com\r\n email:$email\r\n$txt_com\r\n";
					$mail    = $this->sendMail($subject,$to,$massage);
		        }				
			}
			else
			{
				$subject = "haks зі сторінки Контакти";
				$to      = "sl147@ukr.net";
				$massage = "haks зі сторінки Контакти";
				$mail    = $this->sendMail($subject,$to,$massage);
			}
						        
		}
		$token = $this->getToken();
		$siteFile = 'views/contakt/index.php';
		$metaTags = 'contakt';
		require_once ('views/layouts/siteIndex.php');		
		return true;
	}
}
?>