<?php

abstract class classRelax
{

	abstract protected function viewRelax();

	public function draw($json,$total,$pagination,$cat)
	{
		$metaTags = '';
		$siteFile = 'views/relax/'.$this->viewRelax();
		require_once ('views/layouts/siteIndex.php');
	}
}