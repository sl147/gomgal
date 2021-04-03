<?php
/**
 * 
 */
class InsuranceController
{
	use traitAuxiliary;

	public function __construct()
	{
		$this->InsuranceClass = new Insurance();
	}

	private function viewIns($metaTags, $type, $nameFile, $text)
	{
		
		//meta    = Auxiliary:: getMeta($metaTags);
		$meta    = [];
		$comment = $this->InsuranceClass->getComment($type);
		require_once ('views/insurance/'.$nameFile.'.php');
		$res     = self::smail($type, $text);
	}

	private function smail($type, $mass)
	{
		if (!isset($_SERVER['HTTP_REFERER'])) return;
		$send    = $this->formMail($mass);

		if(isset($_POST['submit'])) {		
			$nik  = $this->filterTXT('post', 'nik_com');
			$text = $this->filterTXT('post', 'txt_com');
			$send = $this->formMailComment($type,$nik,$text);
	    }
	}

	public function actionIndex()
	{
		$res = self::viewIns("insurance", 1, 'insurance', "калькулятор автоцивілки");
		return true;
	}

	public function actionAutosign ()
	{
		$res = self::viewIns("autoNumber", 2, 'autosign', "автономера");

		return true;
	}

	public function actionInsuranceCommentEdit($page = 1)
	{
		$page = intval($page);
		if(isset($_POST['submit'])) {
			$id       = $this->filterINT('post','id');
			$act      = $this->filterINT('post','active');
			$getComCl = new classGetData('CommentCalculators');
			$res      = $getComCl->activated($id,$act);
			unset($getComCl);
		}
		$title      = "перегляд коментарів клієнтів";
		$comments   = Insurance::getAllComment($page);
        $total      = $this->getCount('CommentCalculators');
        $pagination = new Pagination($total, $page, Insurance::SHOWCOMMENT_BY_DEFAULT, 'page-');	
		require_once ('views/insurance/insuranceCommentEdit.php');
		unset($getTotal);
		return true;
	}
}
?>