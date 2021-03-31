<?php
/**
 * Send e-mail
 * @return nothing
 */
class SendMail
{

	function __construct()
	{
		$this->from    = 'admin@artargus.in.ua';
		$this->headers = "From: ".$this->from."\r\nReplay-To: ".$this->from."\r\nContent-Type: text/plain; charset=utf-8\r\n ";
	}

	public function sendMail($subject,$to,$massage) {
		return mail($to,$subject,$massage,$this->headers);
	}	
}
?>