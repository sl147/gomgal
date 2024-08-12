<?php

class AdminController {

	use traitAuxiliary;

	public function actionIndex($page = 1) {
		require_once ('views/admin/main.php');
		return true;
	}

	private function runForm( $txt, $title, $name, $id) {
		$table  = array(
			'table' => $txt,
			'name'  => $name,
			'id'	=> $id,
			'isId'	=> false,
			'idVal'	=> 0,
			);
		$json    = json_encode($table);
		$countEl = 2;
		require_once ('views/auxiliary/list2El.php');
		return true;
	}

	public function actionRelaxCatAn() {
		$this->runForm('catan', "категорій анекдотів", "namerl", "idrl");
		return true;
	}

	public function actionRelaxCatAf() {
		$this->runForm('catrelax', "категорій дозвілля", "namerl", "idrl");
		return true;
	}

	public function actionNewsCatEdit() {
		$this->runForm('catmsgs', "категорій новин", "namecm", "idcm");
		return true;
	}

	public function actionPosterGr() {
		$this->runForm('grPoster', "груп оголошень", "name_grp", "id_g");
		return true;
	}

	public function actionPosterCatEd() {
		$this->runForm('catagory', "категорій оголошень", "cat_cat", "id_cat");
		return true;
	}

	public function actionTypeButton() {
		$this->runForm('typeButton', "типів кнопок", "name", "id");
		return true;
	}

	public function actionSpam() {
		$this->runForm('spamTab', "spam", "name", "id");
		return true;
	}

	public function actionSpamEMail() {
		$this->runForm('spam_email', "spam email", "email", "id");
		return true;
	}

	public function actionCountUser() {
		$visit = new CountUser();
		$visitList = $visit->getVisits();
		require_once ('views/admin/countUser.php');
		return true;
	}
}