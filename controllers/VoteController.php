<?php
/**
 * 
 */
class VoteController
{

	public function actionVote() {
		$vote    = Vote::getVote();
		$txtVote = Vote::getTxtVote($vote['id']);

		require_once ('views/vote/showVote.php');
		return true;
	}
}
?>