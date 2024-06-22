<?php

/**
 * 
 */
class Insurance {

	public function __construct() {
		$this->CommentCalculators = new classGetData('CommentCalculators');
	}

	public function getComment(int $type = 1) {
		$args = array(
			'type'    => $type,
			'active' => 1
		);
		return $this->CommentCalculators->selectDataFromTable( $args, "",  0, 'DESC', false);
	}

	public function saveComment (int $type, string $nik, string $comment, string $ip, string $email="") {
		$this->CommentCalculators->insertDataToTable( array( $type, $nik, $comment, $ip, $email ),
													  array( 'type', 'nik', 'text', 'ip', 'email' )
													);		
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
}