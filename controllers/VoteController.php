<?php

/**
 * 
 */
class VoteController {

	use traitAuxiliary;

	public function actionVote() {
		$vote    = Vote::getVote();
		$txtVote = Vote::getTxtVote($vote['id']);
		require_once ('views/vote/showVote.php');
		return true;
	}

	public function actionVoteActive() {
		$vote  = new Vote();
		if(isset($_POST['submit'])) {
			$id  = $this->filterTXT('post','id');
			$res = $vote->activated($id);
		}
		$allVotes = Vote::getAllVote();
		require_once ('views/vote/voteActive.php');
		return true;
	}

	private function set_arr($table, $id_name, $name_name, $isId, $idVal) {		
		return json_encode(
			array(
				'table' => $table,
				'id'    => $id_name,
				'name'  => $name_name,
				'isId'  => $isId,
				'idVal' => $idVal,
			)
		);
	}

	public function actionVoteShow() {
		$title = 'Результати голосування';
		$json  = $this->set_arr('catVote', 'idrl', 'namerl', 0, 0);
		require_once ('views/vote/voteShow.php');
		return true;
	}

	public function actionVoteEdit() {
		$title = 'Редагування голосування';
		$json  = $this->set_arr('catVote', 'idrl', 'namerl', 0, 0);
		$countEl = 3;
		$isId    = false;
		require_once ('views/vote/editVote.php');
		return true;
	}

	public function actionVoteOne($id) {
		$title = 'Редагування голосування';
		$json  = $this->set_arr('vote', 'id', 'msg', 1, $id);
		require_once ('views/vote/editVoteOne.php');
		return true;
	}

	public function actionVoteShowOne($id) {
		$title = 'Редагування голосування';
		$json  = $this->set_arr('vote', 'id', 'msg', 1, $id);
		require_once ('views/vote/editVoteOne.php');
		return true;
	}
}