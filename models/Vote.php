<?php

/**
 * 
 */

class Vote {
	public function __construct() {
		$this->catVote = new classGetData('catVote');
		$this->vote    = new classGetData('vote');
	}

	public function getTxtVote(int $id) {
		return $this->vote->selectDataFromTable( array("category"=>$id), 'countrl', 0, 'DESC', false);
	}

	public function getVote() {
		return $this->catVote->selectDataFromTable( array( "active"=>1), "", 0, 'DESC', false, false, true)['idrl'];
	}

	public function addElVote(string $name, int $cat) {
		return $this->vote->insertDataToTable( array($name, $cat), array('msg', 'category'), true);
	}

	public function getAllVote() {
		return $this->catVote->selectDataFromTable( array(), "", 0, 'DESC', false) ?? [];
	}

	public static function showVote() {
		include ('views/layouts/showVote.php');
	}

	public function getVoteVue() {
		return $this->catVote->selectDataFromTable( array( "active" => 1 ), "", 0, 'DESC', false, true, true);
	}

	public function getTxtVoteVue(int $id) {
		return $this->vote->selectDataFromTable( array( "category" => $id ), "", 0, 'DESC', true, true);
	}

	public function addVote(int $id, int $count) {
		return $this->vote->updateDataInTable( array( 'countrl' => $count ), array( 'id'=>$id),  true);
	}

	public function activated(int $id){
		$this->catVote->updateDataInTable( array( 'active' => 0	), array('active'=>1));
		$this->catVote->updateDataInTable( array( 'active' => 1	), array('idrl'=>$id));
	}
}