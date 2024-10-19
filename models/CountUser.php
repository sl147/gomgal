<?php

/**
 * 
 */
class CountUser {
	
	function __construct()
	{
		// code...
	}

	public function getVisits() {
		$visits = new classGetData('visits');
		return $visits->selectDataFromTable( array());
	}
}