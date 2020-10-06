<?php

class NewsController
{	
	const SHOWPOSTER_BY_DEFAULT = 25;
	
	public function actionIndex($cat, $page = 1) {
		$page       = Auxiliary::getIntval($page);
		$month      = date('n');
		$year       = date('Y');
		$allNewscat = [];
		$topNews    = News::getNewsTop();
		$total      = News::getTotalNewsCat($cat, $month, $year);
		$allNewscat = News::getLatestNewsCat($cat, $month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionArchive($month, $year, $page = 1)	{
		$page       = Auxiliary::getIntval($page);
		$topNews    = News::getNewsTop();
		$total      = News::getTotalNewsArchive($month, $year);
		$allNewscat = News::getLatestNewsArchive($month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$siteFile  = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionFullnew($id)	{
		$id = Auxiliary::getIntval($id);
		if(isset($_POST['submit']))	{
			$id_cl     = $id;
			$txt_com   = Auxiliary::filterTXT('post','txt_com');
			$nik_com   = Auxiliary::filterTXT('post','nik_com');
			$email_com = Auxiliary::filterTXT('post','email_com');
			$ip_com    = $_SERVER['REMOTE_ADDR'];
			$res       = Comment::insComment($id_cl,$txt_com,$nik_com,$email_com,$ip_com);
			if ($email_com) {
				$subject = 'Дякуєм за Ваш коментар';
				$massage = "Дякуєм за Ваш коментар. Завжди раді зустрічі з Вами на нашому сайті www.gomgal.lviv.ua";
				$mail    = Auxiliary::sendMail($subject,$email_com,$massage);
			}
			$subject = "Новий коментар до id=".$id." ip=".$ip_com;"Новий коментар  www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id;
			$to      = "sl147@ukr.net";
			$massage = "Новий коментар www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id."  до id=".$id." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR'];
			$mail  = Auxiliary::sendMail($subject,$to,$massage);
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
		$news      = News::getNewsById($id);
		$newsCount = News::updateCountById($id,$news['countmsgs']);	
		$newsOther = News::newsOther($id,$news['category'],$news['cat2']);
		$comm      = Comment::getCommentsById($id);
		$metaTags  = 'newsOne';
		$siteFile  = 'views/news/fullNew.php';
		$siteSmall  = 'views/news/fullNew.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionnewsPrint($id) {
		$id   = Auxiliary::getIntval($id);
		$news = News::getNewsById($id);

		require_once ('views/news/newsPrint.php');
		return true;
	}

	public function actionNewsAdd() {
		$tPos    = News::getCatNews();
		if(isset($_POST['submit'])) {
			$title   = Auxiliary::filterTXT('post', 'title');
			$prew    = Auxiliary::filterTXT('post', 'prew');
			$top     = isset($_POST['top']) ? 1 : 0;
			$cat     = Auxiliary::filterTXT('post', 'category');
			$cat2    = Auxiliary::filterTXT('post', 'category2');
			$msg     = Auxiliary::filterTXT('post', 'msg');
			$sourse  = Auxiliary::filterTXT('post', 'sourse');
			$videoYT = Auxiliary::filterTXT('post', 'videoYT');
			$foto    = "";
			if (!empty($_FILES['file']['tmp_name'])) {
				$foto = Auxiliary::rus2translit($_FILES['file']['name']);
				$pathdir = ROOT."/NewsFoto";				
	            $res  = Auxiliary::savePhoto($foto, $pathdir);
			}
			$res = News::createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT);
		}

		require_once ('views/news/add.php');
		return true;
	}

	public function actionNewsCommentEdit($page = 1) {
		$page   = Auxiliary::getIntval($page);
		$table  = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "перегляд коментарів клієнтів";
		$total = Auxiliary::getCount('Comment');
		$comms = Comment::getComments($page);
		$pagination = new Pagination($total, $page, self::SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/news/newsCommentEdit.php');
		return true;
	}

/*	public function actionNewsEditComOne($id, $page = 1) {
		$id      = Auxiliary::getIntval($id);
		$page    = Auxiliary::getIntval($page);
		$title   = "редагування коментарів";
		$allNews = News::getComsByIdVue($id,$page);
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

	public function actionNewsEdit($page = 1) {
		$page   = Auxiliary::getIntval($page);
		$table  = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування новин";
		$total = Auxiliary::getCount('msgs');
		$pagination = new Pagination($total, $page, self::SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/news/newsEdit.php');
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
		$id    = Auxiliary::getIntval($id);
		$page  = Auxiliary::getIntval($page);
		$title = "редагування новин";
		if (Auxiliary::getCountAtr('msgs', 'id', $id)) {
			$isId    = true;
			$allNews = News::getNewsById($id,$page);
			$tPos    = News::getCatNews();
			$tPos2   = $tPos;
			
			$type1   = $allNews['category'];
			$type2   = $allNews['cat2'];			
			$cat1['id'] = $type1;
			$pos = self::objArraySearch($tPos,'id',$type1);
			$cat1['name'] = $pos['name'];
			array_unshift($tPos, $cat1);

			$pos = self::objArraySearch($tPos,'id',$type2);
			$cat2['name'] = $pos['name'];
			array_unshift($tPos2, $cat2);

			if(isset($_POST['submit'])) {
				$title   = Auxiliary::filterTXT('post', 'title');
				$prew    = Auxiliary::filterTXT('post', 'prew');
				$top     = isset($_POST['top']) ? 1 : 0;
				$cat     = Auxiliary::filterTXT('post', 'category');
				$cat2    = Auxiliary::filterTXT('post', 'category2');
				$msg     = Auxiliary::filterTXT('post', 'msg');
				$sourse  = Auxiliary::filterTXT('post', 'sourse');
				$videoYT = Auxiliary::filterTXT('post', 'videoYT');
				$FotoDel = Auxiliary::filterTXT('post', 'FotoDel');
		        $cat     = ($cat   == 0) ? $type1 : $cat;
		        $cat2    = ($cat2  == 0) ? $type2 : $cat2;
		        if (!empty($_FILES['file']['tmp_name'])) {
		            $fotoL    = Auxiliary::rus2translit($_FILES['file']['name']);
		            $pathdir  = ROOT."/NewsFoto";
		            $res      = Auxiliary::savePhoto($fotoL,$pathdir);
		            $res      = News::updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,$fotoL,$top,$videoYT);
		        }
		        else {
		            if ($FotoDel) {
		                    $res = News::updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,"",$top,$videoYT);
		                    $res = Auxiliary::delFile($allNews['foto'],"NewsFoto");
		            }
		            else {
		                    $res = News::updateNewsWithoutPhoto($id,$title,$prew,$cat,$cat2,$sourse,$msg,$top,$videoYT);
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

	public function actionNewsEditID() {
		if(isset($_POST['submit'])) {
			$id = Auxiliary::filterINT('post', 'id');
			header("Location: /newsEditOne/".$id);
		}
		require_once ('views/news/newsEditID.php');
		return true;
	}
}	
?>