<?php

/**
* Клас для коментарів
*/

class Comment {

	use traitAuxiliary;

	public function __construct() {
		$this->getData = new classGetData('Comment');
	}

	public function getComments(int $page) {
		$offset  = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$comList = $this->getData->getDataByOffset ('id_com',SHOWCOMMENT_BY_DEFAULT,$offset);
		return $comList ?? [];
	}

	public function getCommentsById(int $id) {
		$comList = $this->getData->getDataFromTableByNameActive($this->getIntval($id),'id_cl');
		return $comList ?? [];
	}	

	public function insComment(int $id_cl, string $txt_com, string $nik_com, string $email_com, string $ip_com)	{
		if ($this->isSpam($nik_com,$ip_com,$email_com,$txt_com)) {
			$subject = "Спам зі сторінки новини коментар";
			$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
			$mail    = $this->sendMail($subject,SLMAIL,$massage);
			return false;
		}
		
		$subject = "Новий коментар для затвердження";
		$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
		$mail    = $this->sendMail($subject,SLMAIL,$massage);

		$sql    = "INSERT INTO Comment (id_cl,txt_com,nik_com,email_com,ip_com)
		 VALUES(:id_cl,:txt,:nik,:email,:ip)";
		$getDB  = new classGetDB();
		$result = $getDB->getPrepareSQL($sql);
		$result -> bindParam(':id_cl', $id_cl,     PDO::PARAM_STR);
		$result -> bindParam(':txt',   $txt_com,   PDO::PARAM_STR);
		$result -> bindParam(':nik',   $nik_com,   PDO::PARAM_STR);
		$result -> bindParam(':email', $email_com, PDO::PARAM_STR);
		$result -> bindParam(':ip',    $ip_com,    PDO::PARAM_STR);
		unset($getDB);		
		return $result -> execute();		
	}

	public function delComment(int $id) :void {
		$this->getData->deleteDataFromTable($id,$nameid='id_com');
	}

	public function changeActiveComment(bool $active, int $id) : void {
		$this->getData->activated($id, ($active) ? 0 : 1 , 'id_com');
	}
}