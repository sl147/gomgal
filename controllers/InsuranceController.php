<?php

/**
 * 
 */

class InsuranceController {
	use traitAuxiliary;

	public function __construct() {
		$this->insurance = new Insurance();
	}

	private function viewIns($metaTags, $type, $nameFile, $text) {
		//meta    = Auxiliary:: getMeta($metaTags);
		$meta    = [];
		$comment = $this->insurance->getComment($type);
		require_once ('views/insurance/'.$nameFile.'.php');
		$res     = $this->smail($type, $text);
	}

	private function smail($type, $mass) {
		if (!isset($_SERVER['HTTP_REFERER'])) return;
		$send    = $this->formMail($mass);
		if(isset($_POST['submit'])) {
			$nik  = $this->filterTXT('post', 'nik_com');
			$text = $this->filterTXT('post', 'txt_com');
			$send = $this->formMailComment($type,$nik,$text);
	    }
	}

	public function actionIndex() {
		$res = $this->viewIns("insurance", 1, 'insurance', "калькулятор автоцивілки");
		return true;
	}

	public function actionAutosign () {
		$res = $this->viewIns("autoNumber", 2, 'autosign', "автономера");
		return true;
	}

	public function actionInsuranceCommentEdit($page = 1) {
		$page = intval($page);
		if(isset($_POST['submit'])) {
			$id       = $this->filterINT('post','id');
			$act      = $this->filterINT('post','active');
			$getComCl = new classGetData('CommentCalculators');
			$res      = $getComCl->updateDataInTable( array( 'active' => $act ), $id, 'id');
			unset($getComCl);
		}
		$title      = "перегляд коментарів клієнтів";
		$comments   = Insurance::getAllComment($page);
        $total      = $this->getCount('CommentCalculators');
        $pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');	
		require_once ('views/insurance/insuranceCommentEdit.php');
		return true;
	}
}