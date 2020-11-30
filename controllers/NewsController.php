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
		$page       = $this->getIntval($page);
		$month      = date('n');
		$year       = date('Y');
		$topNews    = $this->newsClass->getNewsTop();
		$total      = $this->newsClass->getTotalNewsCat($cat, $month, $year);
		$allNewscat = $this->newsClass->getLatestNewsCat($cat, $month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionArchive($month, $year, $page = 1)	{
		$news       = new News();
		$page       = $this->getIntval($page);
		$topNews    = $news->getNewsTop();
		$total      = $news->getTotalNewsArchive($month, $year);
		$allNewscat = $news->getLatestNewsArchive($month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$siteFile   = 'views/news/index.php';
		unset($news);
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionFullnew($id)	{
		$com  = new Comment();
		$id   = $this->getIntval($id);
		if(isset($_POST['submit']))	{
			$id_cl     = $id;
			$txt_com   = $this->filterTXT('post','txt_com');
			$nik_com   = $this->filterTXT('post','nik_com');
			$email_com = $this->filterTXT('post','email_com');
			$ip_com    = $_SERVER['REMOTE_ADDR'];
			$res       = $com->insComment($id_cl,$txt_com,$nik_com,$email_com,$ip_com);
			if ($email_com) {
				$subject = 'Дякуєм за Ваш коментар';
				$massage = "Дякуєм за Ваш коментар. Завжди раді зустрічі з Вами на нашому сайті www.gomgal.lviv.ua";
				$mail    = $this->sendMail($subject,$email_com,$massage);
			}
			$subject = "Новий коментар до id=".$id." ip=".$ip_com;"Новий коментар  www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id;
			$to      = "sl147@ukr.net";
			$massage = "Новий коментар www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id."  до id=".$id." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR'];
			$mail  = $this->sendMail($subject,$to,$massage);
		} 
		//newt_init();
 //newt_get_screen_size ($cols, $rows);
 //newt_finished();

 //echo "Размер вашего терминала: {$cols}x{$rows}\n";
		//echo "width=".$_SESSION['screen_width']."  height=".$_SESSION['screen_height'];
		$screenWidth='<script type="text/javascript">document.write(" screenclientWidth="+screen.width);</script>';
		//$screenWidth='<script type="text/javascript">document.write("screenclientWidth="+document.body.clientWidth);</script>';
		//echo $screenWidth;
/*echo '<windowslocation = "' . $_SERVER['PHP_SELF'];
session_start();
if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
    echo 'User resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
    $_SESSION['screen_width'] = $_REQUEST['width'];
    $_SESSION['screen_height'] = $_REQUEST['height'];
    header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}*/
		$news      = $this->newsClass->getNewsById($id);
		$newsCount = $this->newsClass->updateCountById($id,$news['countmsgs']);	
		$newsOther = $this->newsClass->newsOther($id,$news['category'],$news['cat2']);
		$comm      = $com->getCommentsById($id);
		$metaTags  = 'newsOne';
		$siteFile  = 'views/news/fullNew.php';
		$siteSmall  = 'views/news/fullNew.php';
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
		$aux  = new Auxiliary();
		$tPos = $this->newsClass->getCatNews();
		if(isset($_POST['submit'])) {
			$title   = $this->filterTXT('post', 'title');
			$prew    = $this->filterTXT('post', 'prew');
			$top     = isset($_POST['top']) ? 1 : 0;
			$cat     = $this->filterTXT('post', 'category');
			$cat2    = $this->filterTXT('post', 'category2');
			$msg     = $this->filterTXT('post', 'msg');
			$sourse  = $this->filterTXT('post', 'sourse');
			$videoYT = $this->filterTXT('post', 'videoYT');
			$foto    = "";
			if (!empty($_FILES['file']['tmp_name'])) {
				$foto = $this->rus2translit($_FILES['file']['name']);
				$pathdir = ROOT."/NewsFoto";				
	            $res  = $aux->savePhoto($foto, $pathdir);
			}
			$res = $this->newsClass->createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT);
		}
		unset($aux);
		require_once ('views/news/add.php');
		return true;
	}

	public function actionNewsCommentEdit($page = 1)
	{
		$com   = new Comment();
		$aux   = new Auxiliary();
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);
		if(isset($_POST['submit'])) {
			$res = $com->delComment($this->filterTXT('post', 'id'));
		}		
		$title = "перегляд коментарів клієнтів";
		$total = $aux->getCount('Comment');
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
		$aux   = new Auxiliary();
		$page  = $this->getIntval($page);
		$total = $aux->getCount('msgs');
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування новин";		
		$pagination = new Pagination($total, $page, self::SHOWPOSTER_BY_DEFAULT, 'page-');
		unset($aux);
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

	public function actionNewsEditOne($id, $page = 1) {
		$aux   = new Auxiliary();
		$page  = $this->getIntval($page);
		$id    = $this->getIntval($id);
		$title = "редагування новин";
		if ($aux->getCountAtr('msgs', 'id', $id)) {
			$isId    = true;
			$allNews = $this->newsClass->getNewsById($id,$page);
			$tPos    = $this->newsClass->getCatNews();
			$tPos2   = $tPos;
			
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
				$cat     = $this->filterTXT('post', 'category');
				$cat2    = $this->filterTXT('post', 'category2');
				$msg     = $this->filterTXT('post', 'msg');
				$sourse  = $this->filterTXT('post', 'sourse');
				$videoYT = $this->filterTXT('post', 'videoYT');
				$FotoDel = $this->filterTXT('post', 'FotoDel');
		        $cat     = ($cat   == 0) ? $type1 : $cat;
		        $cat2    = ($cat2  == 0) ? $type2 : $cat2;
		        if (!empty($_FILES['file']['tmp_name'])) {
		            $fotoL    = $this->rus2translit($_FILES['file']['name']);
		            $pathdir  = ROOT."/NewsFoto";
		            $res      = $aux->savePhoto($fotoL,$pathdir);
		            $res      = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,$fotoL,$top,$videoYT);
		        }
		        else {
		            if ($FotoDel) {
		                    $res = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,"",$top,$videoYT);
		                    $res = $aux->delFile($allNews['foto'],"NewsFoto");
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
		unset($aux);
		require_once ('views/news/newsEditOne.php');
		return true;
	}

	public function actionNewsEditID() {
		if(isset($_POST['submit'])) {
			header("Location: /newsEditOne/".$this->filterINT('post', 'id'));
		}
		
		require_once ('views/news/newsEditID.php');
		return true;
	}
}	
?>