<?php

/**
 * 
 */

class RelaxController {

	use traitAuxiliary;

	public function __construct() {
		$this->relax   = new Relax();
	}

	private function check_index_catagory ( $cat ) :bool {
		$cat_list = $this->relax->getRelax();
		foreach ($cat_list as $key => $var) {
			if ( $var['id'] == $cat ) return (bool) true;
		}
		return (bool) false;
	}

	private function check_index_theme_an ( $teman ) :bool {
		$cat_list = $this->relax->getThemeAn();
		foreach ($cat_list as $key => $var) {
			if ( $var['id'] == $teman ) return (bool) true;
		}
		return (bool) false;
	}

	public function actionIndex( $cat, $page = 1) {
		$mt    = new MetaTags();
		$cat   = ($this->check_index_catagory($cat)) ? $cat : 1;

		$relax_t = new classGetData('msgs_relax');
		$total = $relax_t->selectCount( false, array( 'category' => $cat ), true, false );
		//$page  = $this->check_index_page($this->getIntval($page), $total, SHOWRELAX_BY_DEFAULT);
		$table = array(
			'cat'   => $cat,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);
		//$meta       = $mt->getMTagsByUrl('relax');
		$meta       = $this->getMeta();
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		//$relax      = new Relax();
		//$arr        = $relax->getRelax();
		$catag = $cat;
		$siteFile   = 'views/relax/index.php';
		require_once ('views/layouts/siteIndex.php');
/*		foreach ($arr as $a) {
			if ($a['id'] == $cat) {
				$b = $this->rus2translit( $a['name'] );
				$c = new $b();
				$c->draw($json,$total,$pagination,$cat);
				break;
			}
		}*/
		return true;
	}

	public function actionRelaxAll( $page = 1 ) {
		$relax_t = new classGetData('msgs_relax');
		$total = $relax_t->selectCount(false);
		$page  = $this->check_index_page($this->getIntval($page), $total, SHOWRELAX_BY_DEFAULT);
		$table = array(
			'cat'   => 0,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);		
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		$siteFile   = 'views/relax/index.php';
		//$metaTags   = '';
		//$metaTags   = new MetaTags;
		$meta       = $this->getMeta();
		//$meta       = $metaTags->getMTagsByUrl(trim($_SERVER["REQUEST_URI"],'/'));
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionFullAnCat($teman = 1, $page = 1) {
		$teman = ($this->check_index_theme_an($teman)) ? $teman : 1;

		$relax_t = new classGetData('msgs_relax');
		$total = $relax_t->selectCount( false, array( 'teman' => $teman ), true, false );
		$page  = $this->check_index_page($this->getIntval($page), $total, SHOWRELAX_BY_DEFAULT);
		$table = array(
			'cat'   => $teman,
			'page'  => $page,
		'SHOWRELAX' => SHOWRELAX_BY_DEFAULT
		);
		$json       = json_encode($table);
		$pagination = new Pagination($total, $page, SHOWRELAX_BY_DEFAULT, 'page-');
		$siteFile   = 'views/relax/anThema.php';
		$metaTags   = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionRelaxAddAn() {
		$show  = false;
		if(isset($_POST['submit']))
		{
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token']))
			{
				$teman = $this->filterINT('post','teman');
				$msg   = $this->sl147_clean($_POST['msg']);//$this->filterTXT('post','msg');
				$res   = $this->relax->addNewAn($teman, $msg);
				$show  = true;
				$subject = "новий анекдот зі сторінки add an";
				$massage = $msg;
				$mail    = $this->mailing(SLMAIL, $subject, $massage);
				header("Location: /relax/1");		
			}
			else
			{
				$subject = "haks зі сторінки add an";
				$massage = $subject;
				$mail    = $this->mailing(SLMAIL, $subject, $massage);
				header("Location: /ralaxAddAn");
			}
		}
		$token     = $this->getToken();
		$teman     = $this->relax->getAnList();
		$siteFile  = 'views/relax/addAn.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		$show      = !$show;
		return true;		
	}

	public function actionRelaxEdit($page = 1) {
		if(isset($_POST['submit'])) {
			$id      = $this->filterINT('post','id');
			$getData = new classGetData('msgs_relax');
			$comList = $getData->deleteDataFromTable( array( 'id'=>$id ) );
			unset($getData);			
		}
		$relax_t = new classGetData('msgs_relax');
		$total = $relax_t->selectCount(false);
		$page  = $this->check_index_page($this->getIntval($page), $total, SHOWCOMMENT_BY_DEFAULT);		
		$title = "Редагування дозвілля";
		$comms = $this->relax->getRelaxAll($page);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');

		require_once ('views/relax/relaxEdit.php');
		unset($pagination);
		return true;
	}

	public function actionRelaxEditOne($id) {
		$id    = $this->getIntval($id);
		$title = "Редагування 1 дозвілля";
		if(isset($_POST['submit'])) {
			$msg   = $this->filterTXT('post','msg');
			$cat   = $this->filterINT('post','category');
			$res   = $this->relax->updateRelax($id, $msg, $cat);
			header("Location: /relaxEdit");
		}		
		$comms      = $this->relax->getRelaxOne($id);
		$tPos       = $this->relax->getRelax();
		unset($relax);
		require_once ('views/relax/relaxEditOne.php');
		return true;
	}
}