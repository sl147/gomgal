<?php
/**
* 
*/

class Relax {	

	use traitAuxiliary;

	public function __construct() {
		$this->msgs_relax = new classGetData('msgs_relax');
		$this->catan      = new classGetData('catan');
		$this->catrelax   = new classGetData('catrelax');
	}

	public function getRelaxId( int $id) :int {
		return (int) $this->catrelax->selectDataFromTable( array( 'idrl'=>$id), "", 0, 'DESC', false, false, true);
	}

	private function getRowRelax($result) {
		$i = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return (array) $relaxList ?? [];
	}

	public function getRelax() :array {
		return (array) $this->getRowRelax($this->catrelax->selectDataFromTable( array(), '', 0, 'DESC', false));
	}

	public function getThemeAn() :array {
		return (array) $this->getRowRelax($this->catan->selectDataFromTable( array(), '', 0, 'DESC', false));
	}

	public function getAnList() :array {
		return (array) $this->getRowRelax($this->catan->selectDataFromTable( array(), 'namerl', 0, 'ASC', false) );
	}

	public function getRelaxRandom( int $cat) :string{
		$tmp_array = $this->msgs_relax->selectRelaxMsg($cat);
		if (count($tmp_array) > 0) {
			$j = rand (0,count($tmp_array)-1);
			return (string) $tmp_array[$j]['msg'];
		}
		return (string) ""; 
	}

	private function getCountRl() :int {
		$result = $this->msgs_relax->selectDataFromTable( array(), '', 0, 'DESC',false);
		while ($row = $result->fetch()) {			
			$list[] = $row['countrl'];
		}
		return (int) max($list);
	}

	public function addNewAn( int $teman, string $msg) :object {
		return $this->msgs_relax->insertDataToTable(
				array( $teman, $this->sl147_clean($msg), $this->getCountRl() + 1),
				array( 'teman','msg','countrl')							
			);	
	}

	public function getAllRelax( ) :array {
		//return (array) $this->msgs_relax->selectDataFromTable( array(), '', 0, 'DESC', false);
		return (array) $this->msgs_relax->selectDataFromTable( array(), '', 0, 'DESC', true);
	}

	public function getRelaxAll( int $page ) :array {
		return (array) $this->msgs_relax->selectDataFromTable( array(), 'id', SHOWRELAX_BY_DEFAULT, 'DESC', true, false, false, true, $page );
	}

	public function getRelaxOne( int $id ) :array {
		return (array) $this->msgs_relax->selectDataFromTable( array('id'=>$id ), '', 0, 'DESC', false, false, true);
	}

	public function updateRelax( int $id, string $msg, int $cat ) {
		$args = array(
					'msg' => $this->sl147_clean($msg),
					'category' => $cat
		 		);
		return $this->msgs_relax->updateDataInTable( $args, array( 'id'=>$id ), false);	
	}

	public function updateCountRelax( int $id, int $count) :bool {
		return $this->msgs_relax->updateDataInTable( array( 'countrl' => $count ), array( 'id'=>$id ), false);			
	}

	public  function getLike( int $id, int $count) :bool {
		return (bool) $this->msgs_relax->updateDataInTable( array( 'countrl' => $count ), array( 'id'=>$id), true);
	}

	public function getAnThemaVue( int $teman = 1, int $page = 1, int $SHOWRELAX = 1)	:array {
		return (array) $this->msgs_relax->selectDataFromTable( array('teman'=>$teman), 'countrl', $SHOWRELAX, 'DESC', true, true, false, true, $page);
	}

	private function getSelect( array $args, string $nameOrder, int $page, int $SHOWRELAX) {
		return (array) $this->msgs_relax->selectDataFromTable( $args, $nameOrder, $SHOWRELAX, 'DESC', true, true, false, true, $page);
	}

	public function getRelaxVue( int $cat, int $page = 1, int $SHOWRELAX = 1) :array {
		if ( $cat == 0 ) return $this->getSelect( array(), 'id', $page, $SHOWRELAX);
		return $this->getSelect( array( 'category' => $cat), 'countrl', $page, $SHOWRELAX);
	}
}