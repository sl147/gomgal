<?php
/**
 * 
 */
class VoteController
{
	use traitAuxiliary;

	public function actionVote() {
		$vote    = Vote::getVote();
		$txtVote = Vote::getTxtVote($vote['id']);

		require_once ('views/vote/showVote.php');
		return true;
	}

	public function actionVoteActive() {
		if(isset($_POST['submit'])) {
			$id  = $this->filterTXT('post','id');
			$res = Vote::activated($id);
		}
		$allVotes = Vote::getAllVote();
		require_once ('views/vote/voteActive.php');
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
}
?>