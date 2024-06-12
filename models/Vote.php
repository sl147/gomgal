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
		return $this->vote->selectWhereOrderBy("category",$id, 'countrl');
	}

	public function getVote() {
		$result = $this->catVote->selectWhereFetch(1, "active");
		return $result['idrl'];
	}

	public function addElVote(string $name, int $cat) {
		return $this->vote->insertDataToTable( array($name, $cat), array('msg', 'category'), true);
	}

	public function getAllVote() {
		return $this->catVote->selectFromTable(false) ?? [];
	}

	public static function showVote() {
		include ('views/layouts/showVote.php');
	}

	public function getVoteVue() {
		return $this->catVote->selectWhereFetch(1, "active", true);
	}

	public function getTxtVoteVue(int $id) {
		return $this->vote->selectWhereGetRow($id, "category", true);
	}

	public function addVote(int $id, int $count) {
		return $this->vote->updateDataInTable( array( 'countrl' => $count ), $id, 'id', true);
	}

	public function activated(int $id){
		$this->catVote->updateDataInTable( array( 'active' => 0	), 1, 'active');
		$this->catVote->updateDataInTable( array( 'active' => 1	), $id, 'idrl');
	}
}