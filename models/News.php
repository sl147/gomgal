<?php
/**
* Клас для новин
*/
class News
{

	const SHOWNEWS_BY_DEFAULT = 25;

	private function getDBVue(){
		require_once ('../models/Auxiliary.php');
		$aux = new Auxiliary();
		return $aux->getDBVue();
	}

	private static function makePhotoSize($foto) {
		$fotoSize = [];
		$fotoSize['width'] = 0;
		$fotoSize['height']= 0;
		if ($foto!=NULL) {
			$fotoFile = "NewsFoto/".$foto;
			if (file_exists($fotoFile)) {
				$size = getimagesize ($fotoFile);
				$w=$size[0];
				$h=$size[1];
				if ($size[0]>60) {
					$w=100;
					$koef=$w/$size[0];
					$h=$size[1]*$koef;
				}
				if ($size[1]>60) {
					$h=100;
					$koef=$h/$size[1];
					$w=$size[0]*$koef;
				}
				$fotoSize['width'] = $w;
				$fotoSize['height']= $h;
			}
		}
		return $fotoSize;
	}

	public static function getCatNews() {
		$result = Auxiliary::getSQL("SELECT * FROM catmsgs");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$catList[$i]['id']   = $row['idcm'];
			$catList[$i]['name'] = $row['namecm'];
			$i++;
		}
		return $catList;
	}

	public static function getNews() {
		$result = Auxiliary::getSQL("SELECT * FROM msgs ORDER BY id  DESC LIMIT 25");
		$i      = 1;
		while ($row = $result->fetch()) {
			$NewsList[$i]['id']        = $row['id'];
			$NewsList[$i]['top']       = $row['top'];
			$NewsList[$i]['title']     = ucfirst (mb_strtolower ($row['title'], 'UTF-8'));
			$NewsList[$i]['titleengl'] = $row['titleengl'];
			$NewsList[$i]['datetime']  = $row['datetime'];
			$NewsList[$i]['fotoF']     = $row['foto'];
			$NewsList[$i]['foto']      = "NewsFoto/".$row['foto'];
			$i++;
		}
		return $NewsList;
	}

	public static function getNewsTop() {
		$sql     = "SELECT * FROM msgs WHERE top=1 ORDER BY id  DESC LIMIT 1";
		$result  = Auxiliary::getSQL($sql);
		$topNews = $result->fetch();
		$topNews['width']  = 0;
		$topNews['height'] = 0;
		$size    = self::makePhotoSize($topNews['foto']);
		$topNews['width']  = $size['width'];
		$topNews['height'] = $size['height'];
		$topNews['foto']  = "NewsFoto/".$topNews['foto'];

		return $topNews;
	}

	public static function getTotalNewsCat($cat, $month, $year) {
		$cat    = Auxiliary::getIntval($cat);
		$month  = Auxiliary::getIntval($month);
		$year   = Auxiliary::getIntval($year);
		$sql    = "SELECT count(*) as count FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = Auxiliary::getSQL($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function getTotalNewsArchive($month, $year) {
		$month  = Auxiliary::getIntval($month);
		$year   = Auxiliary::getIntval($year);
		$sql    = "SELECT count(*) as count FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."'";
		$result = Auxiliary::getSQL($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}
	private  function dbVue1() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}
/*
	private function getDBVue ($sql) {
		return $this->dbVue() -> query($sql);
	}*/
		private static function db()
	{
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	public static function getAllCommentsVue($page = 1) {
		//$offset   = ($page - 1) * self::SHOWNEWS_BY_DEFAULT;
/*		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('Comment');
		$result = $getData->getDataByOffsetVue('id_com',self::SHOWNEWS_BY_DEFAULT,$offset);
		unset($getData);*/
/*
		$sql = "SELECT * FROM Comment ORDER BY id_com DESC LIMIT ".self::SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = self::dbVue1() -> query($sql);
		$CommList = [];*/

			$CommList = [];
			$offset   = ($page - 1) * self::SHOWNEWS_BY_DEFAULT;
			$db       = self::getDBVue();
			$sql      = "SELECT * FROM Comment ORDER BY id_com DESC LIMIT ".self::SHOWNEWS_BY_DEFAULT." OFFSET ".$offset;
			$result   = $db -> query($sql);
		$i        = 0;
		while ($row = $result->fetch()) {
			$CommList[$i]['id']        = $row['id_com'];
			$CommList[$i]['id_cl']     = $row['id_cl'];
			$CommList[$i]['txt_com']   = $row['txt_com'];
			$CommList[$i]['nik_com']   = $row['nik_com'];
			$CommList[$i]['email_com'] = $row['email_com'];
			$CommList[$i]['ip_com']    = $row['ip_com'];			
			$i++;
		}
		return $CommList;
	}

	public static function getComsByIdVue($id, $page) {
		$getData = new classGetData('Comment');
		$list = $getData->getDataFromTableByNameVue($id,'id_com');
		/*$db     = self::getDBVue();
		$sql    = "SELECT * FROM Comment WHERE id_com=".$id;
		$result = $db -> query($sql);
		return $result->fetch();*/

		unset($getData);
		return $list;
	}

	public static function getTotalNews($month, $year, $id=1) {
		$month = Auxiliary::getIntval($month);
		$year  = Auxiliary::getIntval($year);
		$id    = Auxiliary::getIntval($id);
		$sql   = "SELECT count(*) as count FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = Auxiliary::getSQL($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function getLatestNewsArchive($month, $year, $page = 1) {
		$month    = Auxiliary::getIntval($month);
		$year     = Auxiliary::getIntval($year);
		$page     = Auxiliary::getIntval($page);
		$NewsList = [];
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."' ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQL($sql);
		$i= 0;
		while ($row = $result->fetch()) {
			$NewsList[$i]['id']        = $row['id'];
			$NewsList[$i]['top']       = $row['top'];
			$NewsList[$i]['title']     = $row['title'];
			$NewsList[$i]['prew']      = $row['prew'];
			$NewsList[$i]['sourse']    = $row['sourse'];
			$NewsList[$i]['datetime']  = $row['datetime'];
			$NewsList[$i]['countmsgs'] = $row['countmsgs'];
			$NewsList[$i]['fotoF']     = $row['foto'];
			$size = self::makePhotoSize($row['foto']);
			$NewsList[$i]['width']  = $size['width'];
			$NewsList[$i]['height'] = $size['height'];
			$NewsList[$i]['foto']   = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return $NewsList;
	}

	public static function getLatestNewsCat($cat, $month, $year, $page = 1) {
		$month  = Auxiliary::getIntval($month);
		$year   = Auxiliary::getIntval($year);
		$cat    = Auxiliary::getIntval($cat);
		$page   = Auxiliary::getIntval($page);
		$NewsList = [];
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQL($sql);
		$i = 0;
		while ($row = $result->fetch()) {
			$NewsList[]             = $row;
			$size = self::makePhotoSize($row['foto']);
			$NewsList[$i]['width']  = $size['width'];
			$NewsList[$i]['height'] = $size['height'];
			$NewsList[$i]['foto']   = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return $NewsList;
	}

	public static function getAllNewsVue($page = 1) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('msgs');
		$NewsList = $getData->getDataFromTableOrderPageVue(self::SHOWNEWS_BY_DEFAULT,$page,'id');
		unset($getData);
		return $NewsList;
	}

	public static function getLatestNews($month, $year, $page = 1) {
		$month    = Auxiliary::getIntval($month);
		$year     = Auxiliary::getIntval($year);
		$page     = Auxiliary::getIntval($page);
		$NewsList = [];
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQL($sql);
		$i        = 0;
		while ($row = $result->fetch()) {
			$NewsList[]             = $row;
			$NewsList[$i]['fotoF']  = $row['foto'];
			$size = self::makePhotoSize($row['foto']);
			$NewsList[$i]['width']  = $size['width'];
			$NewsList[$i]['height'] = $size['height'];
			$NewsList[$i]['foto']   = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return $NewsList;
	}

	public static function getNewsById($id) {
		$news   = [];
		$id     = Auxiliary::getIntval($id);
		$sql    = "SELECT * FROM msgs WHERE id=".$id;
		$result = Auxiliary::getSQL($sql);
		$news   = $result->fetch();
		$news['photo']  = "/NewsFoto/".$news['foto'];
		$news['video']  = "//www.youtube.com/v/".$news['videoYT']."?hl=uk_UA&amp;version=3";
		return $news;
	}

	public static function newsOther($id,$cat1,$cat2) {
		$id    = Auxiliary::getIntval($id);
		$cat1  = Auxiliary::getIntval($cat1);
		$cat2  = Auxiliary::getIntval($cat2);
		$News  = [];
		$sql   = "SELECT * FROM msgs  WHERE cat2='".$cat2."' && category='".$cat1."' && id<'".$id."' ORDER BY id  DESC LIMIT 4";
		$result = Auxiliary::getSQL($sql);
		while ($row = $result->fetch()) {
			$News[]  = $row;
		}
		return $News;
	}

	public static function updateCountById($id,$count) {
		$id     = Auxiliary::getIntval($id);
		$count  = Auxiliary::getIntval($count);
		$count +=1;
		$sql    = "UPDATE msgs SET countmsgs=:count WHERE id=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':count',   $count);
		return $result -> execute();			
	}

	public static function createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT) {
		$sql    = "INSERT INTO msgs (title,prew,category,cat2,sourse,msg,foto,top,videoYT)
		 VALUES(:title,:prew,:cat,:cat2,:sourse,:msg,:foto,:top,:videoYT)";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':title',   $title);
		Auxiliary::bindParam($result,':prew',    $prew);
		Auxiliary::bindParam($result,':cat',     $cat);
		Auxiliary::bindParam($result,':cat2',    $cat2);
		Auxiliary::bindParam($result,':sourse',  $sourse);
		Auxiliary::bindParam($result,':top',     $top);
		Auxiliary::bindParam($result,':msg',     $msg);
		Auxiliary::bindParam($result,':foto',    $foto);
		Auxiliary::bindParam($result,':videoYT', $videoYT);
		
		return $result -> execute();		
	}

	public static function updateNews($id,$title,$prew,$category,$cat2,$sourse,$msg,$foto,$top,$videoYT) {
		$sql    = "UPDATE msgs SET title=:title,prew=:prew,category=:category,cat2=:cat2,sourse=:sourse,msg=:msg,foto=:foto,top=:top,videoYT=:videoYT WHERE id=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':title',   $title);
		Auxiliary::bindParam($result,':prew',    $prew);
		Auxiliary::bindParam($result,':category',$category);
		Auxiliary::bindParam($result,':cat2',    $cat2);
		Auxiliary::bindParam($result,':sourse',  $sourse);
		Auxiliary::bindParam($result,':top',     $top);
		Auxiliary::bindParam($result,':msg',     $msg);
		Auxiliary::bindParam($result,':foto',    $foto);
		Auxiliary::bindParam($result,':videoYT', $videoYT);
		
		return $result -> execute();		
	}

	public static function updateNewsWithoutPhoto($id,$title,$prew,$category,$cat2,$sourse,$msg,$top,$videoYT) {
		$sql    = "UPDATE msgs SET title=:title,prew=:prew,category=:category,cat2=:cat2,sourse=:sourse,msg=:msg,top=:top,videoYT=:videoYT WHERE id=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':title',   $title);
		Auxiliary::bindParam($result,':prew',    $prew);
		Auxiliary::bindParam($result,':category',$category);
		Auxiliary::bindParam($result,':cat2',    $cat2);
		Auxiliary::bindParam($result,':sourse',  $sourse);
		Auxiliary::bindParam($result,':top',     $top);
		Auxiliary::bindParam($result,':msg',     $msg);
		Auxiliary::bindParam($result,':videoYT', $videoYT);
		
		return $result -> execute();		
	}

	public static function updateComm($id,$nik,$txt,$email) {
		$sql    = "UPDATE Comment SET nik_com=:nik, email_com=:email, txt_com=:txt WHERE id_com=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':nik',   $nik);
		Auxiliary::bindParam($result,':email', $email);
		Auxiliary::bindParam($result,':txt',   $txt);

		return $result -> execute();			
	}

	public static function showNews($arrNews) {
		include ('views/news/showNews.php');
	}
}
?>