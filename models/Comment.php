<?php

/**
* Клас для коментарів
*/

class Comment {

	use traitAuxiliary;

	public function __construct() {
		$this->comment = new classGetData('Comment');
	}

	public function getComments(int $page) :array {
		return (array) $this->comment->selectOrderPage( SHOWCOMMENT_BY_DEFAULT, $page, 'id_com', 'DESC', true );
	}

	public function getCommentsById(int $id) :array {
		$args = array(
			'id_cl'  => $id,
			'active' => 1
		);
		return $this->comment->selectDataFromTableWHERE( $args, false );
	}	

	public function insComment(int $id_cl, string $txt_com, string $nik_com, string $email_com, string $ip_com)	{
		if ( empty(trim($txt_com))) return false;

		if ($this->isEmailSpam($email_com)) {
			$subject = "email в Спамі зі сторінки новини коментар";
			$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
			$mail    = $this->sendMail($subject,SLMAIL,$massage);
			return false;
		}

		if ($this->isSpam($nik_com,$ip_com,$email_com,$txt_com)) {
			$subject = "Спам зі сторінки новини коментар";
			$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
			$mail    = $this->sendMail($subject,SLMAIL,$massage);
			return false;
		}
		
		$subject = "Новий коментар для затвердження";
		$massage = $subject."\r\nвід: $nik_com\r\nemail:$email_com\r\ntxt_com:$txt_com\r\n";
		$mail    = $this->sendMail($subject,SLMAIL,$massage);

		return $this->comment->insertDataToTable( 
									array($id_cl, $txt_com, $nik_com, $email_com, $ip_com),
									array('id_cl', 'txt_com', 'nik_com', 'email_com', 'ip_com')
								);
	}

	public function delComment(int $id) :void {
		$this->comment->deleteDataFromTable( array( 'id_com'=>$id));
	}

	public function changeActiveComment(bool $active, int $id) {
		return $this->comment->updateDataInTable( array( 'active' => ($active) ? 0 : 1 ), array( 'id_com'=>$id) );
	}
}