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
		return $this->vote->SelectWhereOrderBy("category",$id, 'countrl');
	}

	public function getVote() {
		$result = $this->catVote->selectWhereFetch(1, "active");
		return $result['idrl'];
	}

	public function addElVote(string $name, int $cat) {
		return $this->vote->insert2ElementsVue( "msg", "category", $name, $cat);
	}

	public function getAllVote() {
		return $this->catVote->getDataFromTable(2) ?? [];
	}

	public static function showVote() {
		include ('views/layouts/showVote.php');
	}

	public function getVoteVue() {
		return $this->catVote->selectWhereFetch(1, "active", true);
	}

	public function getTxtVoteVue(int $id) {
		return $this->vote->getDataFromTableByNameAllVue($id, "category");
	}

	public function addVote(int $id, int $count) {
		return $this->vote->updateDataVue ($id, 'id', $count,'countrl');
	}

	public function activated(int $id){
		$this->catVote->updateDataFromTableByName (1  , 'active', 0, 'active');
		$this->catVote->updateDataFromTableByName ($id, 'idrl'  , 1, 'active');
	}
}