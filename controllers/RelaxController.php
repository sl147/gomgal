<?php

class RelaxController
{	
	use traitAuxiliary;

	public function actionIndex($cat, $page = 1)
	{
		$page   = $this->getIntval($page);	
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

	public function actionRelaxAll($page=1)
	{
		$page  = $this->getIntval($page);
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

	public function actionFullAnCat($teman = 1,$page=1)
	{
		$teman = $this->getIntval($teman);
		$page  = $this->getIntval($page);
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

	public function actionRelaxAddAn()
	{
		$show = false;
		$relax = new Relax();
		if(isset($_POST['submit'])) {
			$teman = $this->filterTXT('post','teman');
			$msg   = $this->filterTXT('post','msg');
			$res   = $relax->addNewAn($teman, $msg);
			$show  = true;

			header("Location: /relaxALL");
		}
		$teman     = $relax->getAnList();
		unset($relax);
		$siteFile  = 'views/relax/addAn.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		$show      = !$show;
		return true;		
	}

	public function actionRelaxEdit($page = 1)
	{
		if(isset($_POST['submit'])) {
			$id      = $this->filterTXT('post','id');
			$getData = new classGetData('msgs_relax');
			$comList = $getData->deleteDataFromTable($id);
			unset($getData);			
		}
		$page  = $this->getIntval($page);		
		$title = "Редагування дозвілля";
		$total = Auxiliary::getCount('msgs_relax');
		$relax = new Relax();
		$comms = $relax->getRelaxAll($page);
		unset($relax);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');

		require_once ('views/relax/relaxEdit.php');
		unset($pagination);
		return true;
	}

	public function actionRelaxEditOne($id)
	{
		$id    = $this->getIntval($id);
		$title = "Редагування 1 дозвілля";
		$relax = new Relax();
		if(isset($_POST['submit'])) {
			$msg   = $this->filterTXT('post','msg');
			$cat   = $this->filterINT('post','category');
			$res   = $relax->updateRelax($id, $msg, $cat);
			header("Location: /relaxEdit");
		}
		
		$comms      = $relax->getRelaxOne($id);
		$tPos       = $relax->getRelax();
		unset($relax);
		require_once ('views/relax/relaxEditOne.php');
		return true;
	}

}	
?>