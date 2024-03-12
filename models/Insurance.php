<?php

/**
 * 
 */
class Insurance {

	use traitAuxiliary;

	public function getComment($type = 1) {
		$type   = $this->getIntval($type);	
		$sql    = "SELECT * FROM CommentCalculators WHERE (type=$type) && (active=1)";
		$result = Db::getConnection() -> query($sql);
		while ($row = $result->fetch()) {
			$comItem[]   = $row;
		}
		return (isset($comItem)) ? $comItem : false;
	}

	public static function getAllComment($page = 1) {
		$page   = intval($page);	
		$offset = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$sql    = "SELECT Comment.id, Comment.type, Comment.text, Comment.nik, Comment.ip, Comment.active, type.name FROM CommentCalculators AS Comment LEFT JOIN typeCalculator AS type ON Comment.type = type.id ORDER BY Comment.id DESC LIMIT ".SHOWCOMMENT_BY_DEFAULT." OFFSET $offset";
		$result = Db::getConnection() -> query($sql);
		while ($row = $result->fetch()) {
			$comments[]   = $row;
		}
		return (count($comments)) ? $comments : [];
	}

	public function saveComment (int $type, string $nik, string $comment, string $ip, string $email="") {
		$db     = Db::getConnection();
		$sql    = "INSERT INTO CommentCalculators (type,nik,text,ip,email)
		           VALUES(:type ,:nik, :comment, :ip, :email)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':type',    $type,    PDO::PARAM_STR);
		$result -> bindParam(':nik' ,    $nik,     PDO::PARAM_STR);
		$result -> bindParam(':email',   $email,   PDO::PARAM_STR);
		$result -> bindParam(':comment', $comment, PDO::PARAM_STR);
		$result -> bindParam(':ip',      $ip,      PDO::PARAM_STR);

		return $result -> execute();			
	}
}