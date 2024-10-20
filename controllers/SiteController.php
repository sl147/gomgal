<?php

class SiteController {	

	use traitAuxiliary;

	public function actionIndex($page = 1)	{
		
		$news    = new News();
		$page    = $this->getIntval($page);	
		$month   = date('n');
		$year    = date('Y');
		$topNews = $news->getNewsTop();		
		$allNews = $news->getLatestNews($month, $year, $page);
		if (count($allNews) == 0) {
			$month--;
			$month = ($month == 0) ? 12 : $month;
			$allNews = $news->getLatestNews($month, $year, $page);			 
		}
		$total   = $news->getTotalNews($month, $year);
		unset($news);
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$siteFile   = 'views/site/index.php';
		$siteSmall  = 'views/layouts/leftSide.php';
		$meta       = $this->getMeta();
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionPolityka() {
		$siteFile   = 'views/site/polityka.php';
		require_once ('views/layouts/siteIndex.php');
		return true;	
	}

	public function actionArchive() {
		$siteFile   = 'views/site/archive.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}
}