<?php

class NewsController
{	
	use traitAuxiliary;
	
	const SHOWPOSTER_BY_DEFAULT = 25;
	public $newsClass;

	public function __construct()
	{
		$this->newsClass = new News();
	}

	public function actionIndex($cat, $page = 1) {
		$mt         = new MetaTags();
		$page       = $this->getIntval($page);
		$month      = date('n');
		$year       = date('Y');
		$topNews    = $this->newsClass->getNewsTop();
		$total      = $this->newsClass->getTotalNewsCat($cat, $month, $year);
		$allNewscat = $this->newsClass->getLatestNewsCat($cat, $month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$meta       = $mt->getMTagsByUrl('main');
		$meta['title'] .= '|'.$this->newsClass->getCatEl($cat)['namecm'];
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionArchive($month, $year, $page = 1)	{
		$page       = $this->getIntval($page);
		$topNews    = $this->newsClass->getNewsTop();
		$total      = $this->newsClass->getTotalNewsArchive($month, $year);
		$allNewscat = $this->newsClass->getLatestNewsArchive($month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionFullnew($id)	{
		$mt   = new MetaTags();
		$com  = new Comment();
		$id   = $this->getIntval($id);

		if(isset($_POST['submit']))
		{
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token']))
			{
				$id_cl     = $id;
				$txt_com   = $this->filterTXT('post','txt_com');
				$nik_com   = $this->filterTXT('post','nik_com');
				$email_com = $this->filterTXT('post','email_com');
				$ip_com    = $_SERVER['REMOTE_ADDR'];
				if ($com->insComment($id_cl,$txt_com,$nik_com,$email_com,$ip_com))
				{
					if ($email_com) {
						$subject = 'Дякуєм за Ваш коментар';
						$massage = "Дякуєм за Ваш коментар. Завжди раді зустрічі з Вами на нашому сайті https://www.gomgal.lviv.ua/";
						$mail    = $this->sendMailToClient($subject,$email_com,$massage);
					}
					$subject = "Новий коментар до id=".$id." ip=".$ip_com;"Новий коментар  https://www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id;
					$to      = "sl147@ukr.net";
					$massage = "Новий коментар https://www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id."  до id=".$id." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR'];
					$mail  = $this->sendMail($subject,$to,$massage);					
				}
			}
			else
			{
				$subject = "haks зі сторінки fullnew";
				$to      = "sl147@ukr.net";
				$massage = "haks зі сторінки fullnew";
				$mail    = $this->sendMail($subject,$to,$massage);
			}

		} 
/*session_start();
if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
    echo '_SESSION resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
    $_SESSION['screen_width'] = $_REQUEST['width'];
    $_SESSION['screen_height'] = $_REQUEST['height'];
    echo '_REQUEST resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
    //header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    echo 'script  <script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}*/
		$token     = $this->getToken();
		$news      = $this->newsClass->getNewsById($id);
		$newsCount = $this->newsClass->updateCountById($id,$news['countmsgs']);	
		$newsOther = $this->newsClass->newsOther($id,$news['category'],$news['cat2']);
		$comm      = $com->getCommentsById($id);
		$meta      = $mt->getMTagsByUrl('fullnew');
		$meta['title'] .= $news['title'];
		$fb = 'https://www.gomgal.lviv.ua/Fullnew/'.$id;
		$siteFile  = 'views/news/fullNew.php';
		$siteSmall = 'views/news/fullNew.php';
		unset($com);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionnewsPrint($id)
	{
		$id   = $this->getIntval($id);
		$news = $this->newsClass->getNewsById($id);
		require_once ('views/news/newsPrint.php');
		return true;
	}

	public function actionNewsAdd()
	{
		$tPos = $this->newsClass->getCatNews();
		if(isset($_POST['submit'])) {
			$title   = $this->filterTXT('post', 'title');
			$prew    = $this->filterTXT('post', 'prew');
			$top     = isset($_POST['top']) ? 1 : 0;
			$cat     = $this->filterINT('post', 'category');
			$cat2    = $this->filterINT('post', 'category2');
			$msg     = $_POST['msg'];
			$sourse  = $this->filterTXT('post', 'sourse');
			$videoYT = $this->filterTXT('post', 'videoYT');
			$foto    = "";
			if (!empty($_FILES['file']['tmp_name'])) {
				$foto    = $this->rus2translit($_FILES['file']['name']);				
	            $foto    = $this->savePhoto($foto, ROOT."/NewsFoto",date('y'),date('m'));
			}
			$res = $this->newsClass->createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT);
		}

		require_once ('views/news/add.php');
		return true;
	}

	public function actionNewsCommentEdit($page = 1)
	{
		$com   = new Comment();
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);
		if(isset($_POST['submit'])) {
			$res = $com->delComment($this->filterTXT('post', 'id'));
		}		
		$title = "перегляд коментарів клієнтів";
		$total = $this->getCount('Comment');
		$comms = $com->getComments($page);
		$pagination = new Pagination($total, $page, self::SHOWPOSTER_BY_DEFAULT, 'page-');
		unset($com);
		require_once ('views/news/newsCommentEdit.php');
		unset($pagination);
		return true;
	}

/*	public function actionNewsEditComOne($id, $page = 1) {
		$id      = $this->getIntval($id);
		$page    = $this->getIntval($page);
		$title   = "редагування коментарів";
		$allNews = NewsVue::getComsByIdVue($id,$page);
		if(isset($_POST['submit'])) {
			$nik   = Auxiliary::filterTXT('post', 'nik');
			$txt   = Auxiliary::filterTXT('post', 'txt');
			$email = Auxiliary::filterEmail('post', 'email');
			$res   = News::updateComm($id,$nik,$txt,$email); 
			$loc   = "Location: /newsCommentEdit/page-".$page;
			header($loc);
		}

		require_once ('views/news/newsCommentEditOne.php');
		return true;
	}*/

	public function actionNewsEdit($page = 1)
	{
		$page  = $this->getIntval($page);
		$total = $this->getCount('msgs');
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування новин";		
		$pagination = new Pagination($total, $page, self::SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/news/newsEdit.php');
		unset($pagination);
		return true;
	}

	 private static function objArraySearch($array, $index, $value)
	    {
	        foreach($array as $arrayInf) {
	        	if ($arrayInf[$index] == $value) {
	                return $arrayInf;
	            }
	        }
	        return null;
	    }

	public function actionNewsEditOne($id, $page = 1)
	{
		$page  = $this->getIntval($page);
		$id    = $this->getIntval($id);
		$title = "редагування новин";
		if ($this->getCountAtr('msgs', 'id', $id)>0) {
			$isId    = true;
			$allNews = $this->newsClass->getNewsById($id,$page);
			$tPos    = $this->newsClass->getCatNews();
			$tPos2   = $tPos;
			$photo   = $allNews['foto'];
			$type1   = $allNews['category'];
			$type2   = $allNews['cat2'];			
			$cat1['id'] = $type1;
			$pos = $this->objArraySearch($tPos,'id',$type1);
			$cat1['name'] = $pos['name'];
			array_unshift($tPos, $cat1);

			$pos = $this->objArraySearch($tPos,'id',$type2);
			$cat2['name'] = $pos['name'];
			array_unshift($tPos2, $cat2);

			if(isset($_POST['submit'])) {
				$title   = $this->filterTXT('post', 'title');
				$prew    = $this->filterTXT('post', 'prew');
				$top     = isset($_POST['top']) ? 1 : 0;
				$cat     = $this->filterINT('post', 'category');
				$cat2    = $this->filterINT('post', 'category2');
				//$msg     = $this->filterTXT('post', 'msg');
				$msg     = $_POST['msg'];//$this->filterTXT('post', 'msg');
				$sourse  = $this->filterTXT('post', 'sourse');
				$videoYT = $this->filterTXT('post', 'videoYT');
				$FotoDel = $this->filterTXT('post', 'FotoDel');
		        $cat     = ($cat   == 0) ? $type1 : $cat;
		        $cat2    = ($cat2  == 0) ? $type2 : $cat2;
		        if (!empty($_FILES['file']['tmp_name'])) {
		            $fotoL = $this->rus2translit($_FILES['file']['name']);
		            $fotoL = $this->savePhoto($fotoL,ROOT."/NewsFoto",date("y",strtotime($allNews['datetime'])), date("m",strtotime($allNews['datetime'])));
		            $res   = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,$fotoL,$top,$videoYT);
		        }
		        else {
		            if ($FotoDel) {
		                    $res = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,"",$top,$videoYT);
		                    $res = $this->delFile($photo,"NewsFoto");
		            }
		            else {
		                    $res = $this->newsClass->updateNewsWithoutPhoto($id,$title,$prew,$cat,$cat2,$sourse,$msg,$top,$videoYT);
		            }
		        }
				header("Location: /newsEdit");
			}			
		}
		else {
			$isId    = false;
		}
		require_once ('views/news/newsEditOne.php');
		return true;
	}

	public function actionNewsEditID()
	{
		if(isset($_POST['submit'])) {
			header("Location: /newsEditOne/".$this->filterINT('post', 'id'));
		}
		
		require_once ('views/news/newsEditID.php');
		return true;
	}
}	
?>