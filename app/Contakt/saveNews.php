<?php
//require_once ('../classes/traitAuxiliary.php');
$response = [];
if (isset($_POST['name'])) {
	$nik_com = $_POST['name'];
    $email   = $_POST['email'];
    $txt_com = $_POST['feedback'];
    $ip_com  = $_SERVER['REMOTE_ADDR'];
	$result  = Contakt::saveComent($nik_com,$ip_com,$email,$txt_com);
	$subject = "Нове повідомлення зі сторінки Контакти";
	$massage = $subject;
	$mailClass = new Insurance();
	$mail    = Auxiliary::sendMail($subject,SLMAIL,$massage);
	//$mail    = $this->sendMail($subject,$to,$massage);
	$response["success"] = 1;
	$response["message"] = "Is ok";
}
else {
	$response["success"] = 0;
	$response["message"] = "No saving";
}
echo json_encode($response);
?>