<?php


require_once ('traitAuxiliary.php');
abstract class classRelax {

	use traitAuxiliary;

	abstract protected function viewRelax();

	public function draw($json,$total,$pagination,$cat) {

		$meta     = $this->getMeta();
		$siteFile = 'views/relax/'.$this->viewRelax();
		require_once ('views/layouts/siteIndex.php');
	}
}