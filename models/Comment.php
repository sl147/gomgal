<?php

/**
* Клас для коментарів
*/

class Comment {

	use traitAuxiliary;

	public static function getComments($page) {
		$getData = new classGetData('Comment');
		$offset  = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$comList = $getData->getDataByOffset ('id_com',SHOWCOMMENT_BY_DEFAULT,$offset);
		unset($getData);
		return $comList ?? [];
	}

	public function getCommentsById($id) {
		$getData = new classGetData('Comment');
		$comList = $getData->getDataFromTableByName($this->getIntval($id),'id_cl');
		unset($getData);
		return $comList ?? [];
	}	

	public function insComment($id_cl,$txt_com,$nik_com,$email_com,$ip_com)	{
		if ($this->isSpam($nik_com,$ip_com,$email_com,$txt_com)) {
			$subject = "Спам зі сторінки новини коментар";
			$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
			$mail    = $this->sendMail($subject,SLMAIL,$massage);
			return false;
		}
	
		$sql    = "INSERT INTO Comment (id_cl,txt_com,nik_com,email_com,ip_com)
		 VALUES(:id_cl,:txt,:nik,:email,:ip)";
		$getDB  = new classGetDB();
		$result = $getDB->getPrepareSQL($sql);
		$result -> bindParam(':id_cl',     $id_cl, PDO::PARAM_STR);
		$result -> bindParam(':txt',   $txt_com,   PDO::PARAM_STR);
		$result -> bindParam(':nik',   $nik_com,   PDO::PARAM_STR);
		$result -> bindParam(':email', $email_com, PDO::PARAM_STR);
		$result -> bindParam(':ip',    $ip_com,    PDO::PARAM_STR);
		unset($getDB);		
		return $result -> execute();		
	}

	public function delComment(int $id) :void	{
		$getData = new classGetData('Comment');
		$getData->deleteDataFromTable($id,$nameid='id_com');
	}

	public function changeActiveComment(bool $active, int $id) : void {
		$getData = new classGetData('Comment');
		$getData->activated($id, ($active) ? 0 : 1 , 'id_com');
	}
}