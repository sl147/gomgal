<?php
/**
* Клас для новин
*/
class News
{
	use traitAuxiliary;
	const SHOWNEWS_BY_DEFAULT = 25;	

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

	public static function getCatNews() : array
	{
		$getData = new classGetData('catmsgs');
		$catList = $getData->getData2El('idcm','namecm');
		unset($getData);
		return $catList;
	}

	public static function getNews() {
		$getData = new classGetData('msgs');
		$result  = $getData->getDataFromTableOrderWithOutRow('id', 25);
		unset($getData);
		$i       = 1;
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
		$getData = new classGetDB();
		$result  = $getData->getDB("SELECT * FROM msgs WHERE top=1 ORDER BY id  DESC LIMIT 1");
		unset($getData);
		$topNews = $result->fetch();
		$topNews['width']  = 0;
		$topNews['height'] = 0;
		$size    = self::makePhotoSize($topNews['foto']);
		$topNews['width']  = $size['width'];
		$topNews['height'] = $size['height'];
		$topNews['foto']  = "NewsFoto/".$topNews['foto'];

		return $topNews;
	}

	public function getTotalNewsCat(int $cat, int $month, int $year) : int
	{
		$cat    = $this->getIntval($cat);
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$getData = new classGetDB();
		$sql    = "SELECT count(*) as count FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = $getData->getDB($sql);
		unset($getData);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getTotalNewsArchive($month, $year) {
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$getData = new classGetDB();
		$sql    = "SELECT count(*) as count FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."'";
		$result = $getData->getDB($sql);
		unset($getData);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getTotalNews($month, $year, $id=1) {
		$month = $this->getIntval($month);
		$year  = $this->getIntval($year);
		$id    = $this->getIntval($id);
		$getData = new classGetDB();
		$sql   = "SELECT count(*) as count FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = $getData->getDB($sql);
		unset($getData);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public  function getLatestNewsArchive($month, $year, $page = 1) {
		$month    = $this->getIntval($month);
		$year     = $this->getIntval($year);
		$page     = $this->getIntval($page);
		$getData = new classGetDB();
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."' ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = $getData->getDB($sql);
		unset($getData);
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

	public function getLatestNewsCat($cat, $month, $year, $page = 1) {
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$cat    = $this->getIntval($cat);
		$page   = $this->getIntval($page);
		$getData = new classGetDB();
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = $getData->getDB($sql);
		unset($getData);
		$i = 0;
		while ($row = $result->fetch()) {
			$NewsList[]             = $row;
			$size = self::makePhotoSize($row['foto']);
			$NewsList[$i]['width']  = $size['width'];
			$NewsList[$i]['height'] = $size['height'];
			$NewsList[$i]['foto']   = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return $NewsList ?? [];
	}

	public function getLatestNews($month, $year, $page = 1)
	{
		$month    = $this->getIntval($month);
		$year     = $this->getIntval($year);
		$page     = $this->getIntval($page);
		$getData = new classGetDB();
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = $getData->getDB($sql);
		unset($getData);
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
		return $NewsList ?? [];
	}

	public static function getNewsById($id)
	 {
		$getData        = new classGetData('msgs');
		$list           = $getData->getDataFromTableByNameFetch($id,'id');
		$list['photo']  = "/NewsFoto/".$list['foto'];
		$list['video']  = "//www.youtube.com/v/".$list['videoYT']."?hl=uk_UA&amp;version=3";
		unset($getData);
		return $list ?? [];
	}

	public function newsOther($id,$cat1,$cat2)
	{
		$id    = $this->getIntval($id);
		$cat1  = $this->getIntval($cat1);
		$cat2  = $this->getIntval($cat2);
		$getData = new classGetDB();
		$sql   = "SELECT * FROM msgs  WHERE cat2='".$cat2."' && category='".$cat1."' && id<'".$id."' ORDER BY id  DESC LIMIT 8";
		$result = $getData->getDB($sql);
		unset($getData);
		while ($row = $result->fetch()) {
			$News[]  = $row;
		}
		return $News ?? [];
	}

	public function updateCountById($id,$count)
	{
		$count  = $this->getIntval($count);
		$count +=1;
		$result = Auxiliary::getPrepareSQL("UPDATE msgs SET countmsgs=:count".Auxiliary::formSqlAux("id",$id));
		Auxiliary::bindParam($result,':count',   $count);
		return $result -> execute();			
	}

	public static function createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT)
	{
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

	public static function updateNews($id,$title,$prew,$category,$cat2,$sourse,$msg,$foto,$top,$videoYT)
	{
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

	public static function updateNewsWithoutPhoto($id,$title,$prew,$category,$cat2,$sourse,$msg,$top,$videoYT)
	{
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

	public static function updateComm($id,$nik,$txt,$email)
	{
		$sql    = "UPDATE Comment SET nik_com=:nik, email_com=:email, txt_com=:txt WHERE id_com=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':nik',   $nik);
		Auxiliary::bindParam($result,':email', $email);
		Auxiliary::bindParam($result,':txt',   $txt);

		return $result -> execute();			
	}

	public static function showNews($arrNews)
	{
		include ('views/news/showNews.php');
	}
}
?>