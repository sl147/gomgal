<?php

class RelaxController
{	
	public function actionIndex($cat, $page = 1) {
		$page   = Auxiliary::getIntval($page);	
		$table  = array(
			'cat'   => $cat,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);
		$total      = Auxiliary::getCountAtr('msgs_relax', 'category',$cat);
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		$siteFile   = 'views/relax/index.php';
		$metaTags   = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionRelaxAll($page=1)	{
		$page  = Auxiliary::getIntval($page);
		$table = array(
			'cat'   => 0,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);
		$total      = Auxiliary::getCount('msgs_relax');
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		$siteFile   = 'views/relax/index.php';
		$metaTags   = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionFullAnCat($teman = 1,$page=1)	{
		$teman = Auxiliary::getIntval($teman);
		$page  = Auxiliary::getIntval($page);
		$table = array(
			'cat'   => $teman,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);
		$total      = Auxiliary::getCountAtr('msgs_relax', 'teman',$teman);
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		$siteFile   = 'views/relax/anThema.php';
		$metaTags   = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionRelaxAddAn() {
		$show = false;
		if(isset($_POST['submit'])) {
			$teman = Auxiliary::filterTXT('post','teman');
			$msg   = Auxiliary::filterTXT('post','msg');
			$res   = Relax::addNewAn($teman, $msg);
			$show  = true;

			header("Location: /relaxALL");
		}
		$teman     = Relax::getAnList();
		$siteFile  = 'views/relax/addAn.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		$show      = !$show;
		return true;		
	}

	public function actionRelaxEdit($page = 1) {
		if(isset($_POST['submit'])) {
			$id      = Auxiliary::filterTXT('post','id');
			$getData = new classGetData('msgs_relax');
			$comList = $getData->deleteDataFromTable($id);
			unset($getData);			
		}
		$page       = Auxiliary::getIntval($page);		
		$title      = "Редагування дозвілля";
		$total      = Auxiliary::getCount('msgs_relax');
		$comms      = Relax::getRelaxAll($page);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');

		require_once ('views/relax/relaxEdit.php');
		return true;
	}

	public function actionRelaxEditOne($id) {
		$id       = Auxiliary::getIntval($id);
		$title      = "Редагування 1 дозвілля";
		if(isset($_POST['submit'])) {
			$msg   = Auxiliary::filterTXT('post','msg');
			$cat   = Auxiliary::filterINT('post','category');
			$res   = Relax::updateRelax($id, $msg, $cat);
			//echo "cat=$cat";
			header("Location: /relaxEdit");
		}
		
		$comms      = Relax::getRelaxOne($id);
		$tPos       = Relax::getRelax();

		require_once ('views/relax/relaxEditOne.php');
		return true;
	}

}	
?>