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
		return (int) $this->catrelax->selectWhereFetch ( array( 'idrl'=>$id) );
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
		return (array) $this->getRowRelax($this->catrelax->selectFromTable(false));
	}

	public function getThemeAn() :array {
		return (array) $this->getRowRelax($this->catan->selectFromTable(false));
	}

	public function getAnList() :array {
		return (array) $this->getRowRelax($this->catan->selectOrderBy('namerl') );
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
		$result = $this->msgs_relax->selectFromTable(false);
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

	public function getRelaxAll( int $page) :array {
		return (array) $this->msgs_relax->selectOrderPage (SHOWRELAX_BY_DEFAULT, $page, 'id','DESC', true);
	}

	public function getRelaxOne( int $id) :array {
		return (array) $this->msgs_relax->selectWhereFetch ( array('id'=>$id ) );
	}

	public function updateRelax( int $id, string $msg, int $cat) {
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
		return (array) $this->msgs_relax->selectWhereOrderPageVue( array('teman'=>$teman),  $SHOWRELAX, $page, 'countrl', 'DESC', true);
	}

	public function getRelaxVue( int $cat, int $page = 1, int $SHOWRELAX = 1) :array {
		if ($cat == 0 ) return $this->msgs_relax->selectOrderPageVue( $SHOWRELAX, $page, 'id', 'DESC', true );  
		return (array) $this->msgs_relax->selectWhereOrderPageVue( array( 'category'=>$cat), $SHOWRELAX, $page, 'countrl', 'DESC', true );
	}
}