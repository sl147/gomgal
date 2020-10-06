<?php

class SiteController
{	
	public function actionIndex($page = 1)	{
		$page    = Auxiliary::getIntval($page);	
		$month   = date('n');
		$year    = date('Y');
		$topNews = News::getNewsTop();
		$total   = News::getTotalNews($month, $year);
		$allNews = News::getLatestNews($month, $year, $page);
		if (count($allNews) == 0) {
			$month--;
			$month = ($month == 0) ? 12 : $month;
			$allNews = News::getLatestNews($month, $page);			 
		}
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$siteFile   = 'views/site/index.php';
		$siteSmall  = 'views/layouts/leftSide.php';
		$metaTags   = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionViewnews($id,$page = 1) {
		$id       = Auxiliary::getIntval($id);
		$page     = Auxiliary::getIntval($page);
		$relaxCat = Relax::getRelax();
		$relaxAf  = Relax::getRelaxMsg(1);
		$relaxAn  = Relax::getRelaxMsg(2);
		$msg      = News::getCatNews();
		$user     = User::isGuest ();
		$newsLeft = News::getNews();

		$j  = rand (1,count($relaxAf));
		$af = $relaxAf[$j]['msg'];
		$j  = rand (1,count($relaxAn));
		$an = $relaxAn[$j]['msg'];
	
		$topNews = News::getNewsTop();
		$allNews = News::getLatestNews();
		
		$pagination   = new Pagination(News::getTotalNews(), $page, SHOWNEWS_BY_DEFAULT, 'page-');
		require_once ('views/site/index.php');
		return true;
	}
}	
?>