<?php

class AdminController {

	public function actionIndex($page = 1) {

		require_once ('views/admin/main.php');
		return true;
	}

	public function actionVote() {
		$vote    = Auxiliary::getVote();
		$txtVote = Auxiliary::getTxtVote($vote['id']);

		require_once ('views/vote/showVote.php');
		return true;
	}

	public function actionVoteActive() {
		if(isset($_POST['submit'])) {
			$id  = Auxiliary::filterTXT('post','id');
			$res = Auxiliary::activated($id);
		}
		$allVotes = Auxiliary::getAllVote();
		require_once ('views/vote/voteActive.php');
		return true;
	}

	public function actionVoteEdit() {
		$title = 'Редагування голосування';
		$arr   = array(
			'table' => 'catVote',
			'id'    => 'idrl',
			'name'  => 'namerl',
			'isId'  => 0,
			'idVal'  => 0,
			);			
		$json    = json_encode($arr);
		$countEl = 3;
		$isId    = false;
		require_once ('views/vote/editVote.php');
		return true;
	}

	public function actionVoteOne($id) {
		$title = 'Редагування голосування';
		$arr   = array(
			'table' => 'vote',
			'id'    => 'id',
			'name'  => 'msg',
			'idVal' => $id,
			'isId'  => 1,
			);
			
		$json  = json_encode($arr);
		require_once ('views/vote/editVoteOne.php');
		return true;
	}

	public function actionVoteShow() {
		$title = 'Результати голосування';
		$arr   = array(
			'table' => 'catVote',
			'id'    => 'idrl',
			'name'  => 'namerl',
			'isId'  => 0,
			'idVal' => 0,
			);			
		$json  = json_encode($arr);
		require_once ('views/vote/voteShow.php');
		return true;
	}

	public function actionVoteShowOne($id) {
		$title = 'Редагування голосування';
		$arr   = array(
			'table' => 'vote',
			'id'    => 'id',
			'name'  => 'msg',
			'idVal' => $id,
			'isId'  => 1,
			);
			
		$json  = json_encode($arr);
		require_once ('views/vote/editVoteOne.php');
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

	public function actionSpam() {
		$title = "Редагування spam";
		$t     = self::json('spamTab',$title,"name","id");

		return true;
	}
}	
?>