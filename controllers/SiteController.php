<?php

class SiteController
{	
	use traitAuxiliary;

	public function actionIndex($page = 1)	{
		$mt      = new MetaTags();
		$news    = new News();
		$page    = $this->getIntval($page);	
		$month   = date('n');
		$year    = date('Y');
		$topNews = $news->getNewsTop();
		$total   = $news->getTotalNews($month, $year);
		$allNews = $news->getLatestNews($month, $year, $page);
		if (count($allNews) == 0) {
			$month--;
			$month = ($month == 0) ? 12 : $month;
			$allNews = $news->getLatestNews($month, $year, $page);			 
		}
		unset($news);
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$siteFile   = 'views/site/index.php';
		$siteSmall  = 'views/layouts/leftSide.php';
		$meta       = $mt->getMTagsByUrl('main');
		require_once ('views/layouts/siteMain.php');
		unset($pagination);
		return true;
	}
}	
?>