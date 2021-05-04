<?php

class AdminController {

	use traitAuxiliary;

	public function actionIndex($page = 1) {

		require_once ('views/admin/main.php');
		return true;
	}

	private function json($txt,$title,$name,$id) {
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
		$title = "Редагування категорій анекдотів";
		$t     = self::json('catan',$title,"namerl","idrl");

		return true;
	}

	public function actionRelaxCatAf() {
		$title = "Редагування категорій дозвілля";
		$t     = self::json('catrelax',$title,"namerl","idrl");

		return true;
	}

	public function actionRelaxEdit() {
		$title = "Редагування дозвілля";
		$t     = self::json('msgs_relax',$title,"msg","id");

		return true;
	}

	public function actionNewsCatEdit() {
		$title = "редагування категорій новин";
		$t     = self::json('catmsgs',$title,"namecm","idcm");

		return true;
	}

	public function actionPosterGr() {
		$title = "редагування груп оголошень";
		$t     = self::json('grPoster',$title,"name_grp","id_g");

		return true;
	}

	public function actionPosterCatEd() {
		$title = "Редагування категорій оголошень";
		$t     = self::json('catagory',$title,"cat_cat","id_cat");

		return true;
	}

	public function actionTypeButton() {
		$title = "Редагування типів кнопок";
		$t     = self::json('typeButton',$title,"name","id");

		return true;
	}

	public function actionSpam() {
		$title = "Редагування spam";
		$t     = self::json('spamTab',$title,"name","id");

		return true;
	}
}	
?>