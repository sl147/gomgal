<?php
/**
* Клас для коментарів
*/
class Comment {

	const SHOWCOMMENTS_BY_DEFAULT = 25;
	public static function getComments($page) {
		$getData = new classGetData('Comment');
		$offset  = ($page - 1) * self::SHOWCOMMENTS_BY_DEFAULT;
		$comList = $getData->getDataByOffset ('id_com',self::SHOWCOMMENTS_BY_DEFAULT,$offset);
		unset($getData);
		return $comList ?? [];
	}

	public static function getCommentsById($id) {
		$id      = Auxiliary::getIntval($id);
		$getData = new classGetData('Comment');
		$comList = $getData->getDataFromTableByName($id,'id_cl');
		unset($getData);
		return $comList ?? [];
	}	

	public static function insComment($id_cl,$txt_com,$nik_com,$email_com,$ip_com) {
		$sql    = "INSERT INTO Comment (id_cl,txt_com,nik_com,email_com,ip_com)
		 VALUES(:id_cl,:txt_com,:nik_com,:email_com,:ip_com)";
		$result = Auxiliary::getPrepareSQL($sql);
		$result -> bindParam(':id_cl',     $id_cl,     PDO::PARAM_STR);
		$result -> bindParam(':txt_com',   $txt_com,   PDO::PARAM_STR);
		$result -> bindParam(':nik_com',   $nik_com,   PDO::PARAM_STR);
		$result -> bindParam(':email_com', $email_com, PDO::PARAM_STR);
		$result -> bindParam(':ip_com',    $ip_com,    PDO::PARAM_STR);		
		return $result -> execute();		
	}
}
?>