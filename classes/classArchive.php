<?php

class classArchive {

	private function showMonth($year,$month) {
		$year2 = $year - 2000;
		$this->arhiveButton($year,$year2);
		include ('views/layouts/rowMonthArchive.php');
	}

	public function arhiveButton($year,$year2) {
		$arxYear = "арх".$year2;
		include ('views/layouts/buttonArchive.php');
	}

	public function showArchive($year) {
		$this->showMonth($year,12);	
	}

	public function showArchiveCurrent($year) {
		$this->showMonth($year,date("n")-1);	
	}
}