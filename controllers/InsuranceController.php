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

		$width  = (isset($_COOKIE['sw'])) ? $_COOKIE['sw'] : 1000;
		$getIPData = $this->getIPData($_SERVER['REMOTE_ADDR']);
        $massage = "перехід на ".$mass."\r\n";
        $subject = $massage;
        $subject .= ($width < 993) ? " із мобільного" : '';
        $massage .= "з країни ".$getIPData['country_code']." з міста ".$getIPData['city']."\r\n";
        $massage .= 'ширина екрану: '.$width."\r\n";
        $massage .= 'перехід з сайту: '.$_SERVER['HTTP_REFERER']."\r\n";
		$send     = $this->sendMail($subject,"sl147@ukr.net",$massage);

		if(isset($_POST['submit'])) {
			$typeC   = new classGetData('typeCalculator');			
			$nik     = $this->filterTXT('post', 'nik_com');
			$text    = $this->filterTXT('post', 'txt_com');
	        $ip      = $_SERVER['REMOTE_ADDR'];
	        $result  = Insurance::saveComment($type,$nik,$text,$ip);
			$subject = "Новий коментар ".$typeC->getDataFromTableByNameFetch($type, "id")['name']." ip=".$ip;
			$to      = "sl147@ukr.net";
			$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";
			$send    = $this->sendMail($subject,"sl147@ukr.net",$massage);
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
        $getTotal   = new Count('CommentCalculators');
        $total      = $getTotal->get();
        $pagination = new Pagination($total, $page, Insurance::SHOWCOMMENT_BY_DEFAULT, 'page-');	
		require_once ('views/insurance/insuranceCommentEdit.php');
		unset($getTotal);
		return true;
	}
}
?>