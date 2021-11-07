<?php
/**
* Клас для новин
*/
class News extends classGetDB
{
	use traitAuxiliary;

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
		return $catList ?? [];
	}
	
	public static function getCatEl($cat)
	{
		$getData = new classGetData('catmsgs');
		$catList = $getData->getDataFromTableByNameFetch ($cat,'idcm');
		unset($getData);
		return $catList ?? [];
	}

	public  function getFindTotalNews($txt) {
		$sql    = "SELECT count(*) as count FROM msgs WHERE (LOCATE('".$txt."',msg)) OR (LOCATE('".$txt."',title))";
		$result = $this->getDB($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getNewsFind($txt)
	{
		$sql    = "SELECT * FROM msgs WHERE (LOCATE('".$txt."',msg)) OR (LOCATE('".$txt."',title)) OR (LOCATE('".$txt."',prew))";
		$result = $this->getDB($sql);
		$i      = 1;
		while ($row = $result->fetch()) {
			$NewsList[$i]['id']        = $row['id'];
			$NewsList[$i]['top']       = $row['top'];
			$NewsList[$i]['title']     = ucfirst (mb_strtolower ($row['title'], 'UTF-8'));
			$NewsList[$i]['titleengl'] = $row['titleengl'];
			$NewsList[$i]['datetime']  = $row['datetime'];
			$NewsList[$i]['prew']      = $row['prew'];
			$NewsList[$i]['sourse']    = $row['sourse'];
			$NewsList[$i]['countmsgs'] = $row['countmsgs'];
			$NewsList[$i]['fotoF']     = $row['foto'];
			$NewsList[$i]['foto']      = "NewsFoto/".$row['foto'];
			$NewsList[$i]['width']     = 0;
			$NewsList[$i]['height']    = 0;
			$size                      = self::makePhotoSize($row['foto']);
			$NewsList[$i]['width']     = $size['width'];
			$NewsList[$i]['height']    = $size['height'];
			$i++;
		}
		return $NewsList ?? [];
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
		return $NewsList ?? [];
	}

	public function getNewsTop() {
		$result  = $this->getDB("SELECT * FROM msgs WHERE top=1 ORDER BY id  DESC LIMIT 1");
		$topNews = $result->fetch();
		$topNews['width']  = 0;
		$topNews['height'] = 0;
		$size    = self::makePhotoSize($topNews['foto']);
		$topNews['width']  = $size['width'];
		$topNews['height'] = $size['height'];
		$topNews['foto']  = "NewsFoto/".$topNews['foto'];

		return $topNews ?? [];
	}

	public function getTotalNewsCat(int $cat, int $month, int $year) : int
	{
		$cat    = $this->getIntval($cat);
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$sql    = "SELECT count(*) as count FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = $this->getDB($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getTotalNewsArchive($month, $year) {
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$sql    = "SELECT count(*) as count FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."'";
		$result = $this->getDB($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getTotalNews($month, $year, $id=1) {
		$month = $this->getIntval($month);
		$year  = $this->getIntval($year);
		$id    = $this->getIntval($id);
		$sql   = "SELECT count(*) as count FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."')";
		$result = $this->getDB($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public  function getLatestNewsArchive($month, $year, $page = 1) {
		$month    = $this->getIntval($month);
		$year     = $this->getIntval($year);
		$page     = $this->getIntval($page);
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE month(datetime) = '".$month."' and year(datetime) = '".$year."' ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = $this->getDB($sql);
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
		return $NewsList ?? [];
	}

	public function getLatestNewsCat($cat, $month, $year, $page = 1) {
		$month  = $this->getIntval($month);
		$year   = $this->getIntval($year);
		$cat    = $this->getIntval($cat);
		$page   = $this->getIntval($page);
		$offset = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql    = "SELECT * FROM msgs WHERE ((category=$cat) or (cat2=$cat)) and (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result = $this->getDB($sql);
		$i      = 0;
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
		$offset   = ($page - 1) * SHOWNEWS_BY_DEFAULT;
		$sql      = "SELECT * FROM msgs WHERE (month(datetime) = '".$month."') and (year(datetime) = '".$year."') ORDER BY countmsgs DESC LIMIT ".SHOWNEWS_BY_DEFAULT." OFFSET $offset";
		$result   = $this->getDB($sql);
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
		$sql   = "SELECT * FROM msgs  WHERE cat2='".$cat2."' && category='".$cat1."' && id<'".$id."' ORDER BY id  DESC LIMIT 10";
		$result = $this->getDB($sql);
		while ($row = $result->fetch()) {
			$News[]  = $row;
		}
		return $News ?? [];
	}

	public function updateCountById($id,$count)
	{
		return $this->getDB("UPDATE msgs SET countmsgs=$count+1".$this->formSql("id",$id));		
	}

	public function createNews($title,$prew,$category,$cat2,$sourse,$msg,$foto,$top,$videoYT)
	{
		$sql    = "INSERT INTO msgs (title,prew,category,cat2,sourse,msg,foto,top,videoYT)
		 VALUES(:title,:prew,:category,:cat2,:sourse,:msg,:foto,:top,:videoYT)";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':title',   $title,   PDO::PARAM_STR);
		$result -> bindParam(':prew',    $prew,    PDO::PARAM_STR);
		$result -> bindParam(':category',$category,PDO::PARAM_INT);
		$result -> bindParam(':cat2',    $cat2,    PDO::PARAM_INT);
		$result -> bindParam(':sourse',  $sourse,  PDO::PARAM_STR);
		$result -> bindParam(':top',     $top,     PDO::PARAM_STR);
		$result -> bindParam(':msg',     $msg,     PDO::PARAM_STR);
		$result -> bindParam(':foto',    $foto,    PDO::PARAM_STR);
		$result -> bindParam(':videoYT', $videoYT, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function updateNews($id,$title,$prew,$category,$cat2,$sourse,$msg,$foto,$top,$videoYT)
	{
		$sql    = "UPDATE msgs SET title=:title,prew=:prew,category=:category,cat2=:cat2,sourse=:sourse,msg=:msg,foto=:foto,top=:top,videoYT=:videoYT WHERE id=$id";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':title',   $title,   PDO::PARAM_STR);
		$result -> bindParam(':prew',    $prew,    PDO::PARAM_STR);
		$result -> bindParam(':category',$category,PDO::PARAM_INT );
		$result -> bindParam(':cat2',    $cat2,    PDO::PARAM_INT );
		$result -> bindParam(':sourse',  $sourse,  PDO::PARAM_STR);
		$result -> bindParam(':top',     $top,     PDO::PARAM_STR);
		$result -> bindParam(':msg',     $msg,     PDO::PARAM_STR);
		$result -> bindParam(':foto',    $foto,    PDO::PARAM_STR);
		$result -> bindParam(':videoYT', $videoYT, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function updateNewsWithoutPhoto($id,$title,$prew,$category,$cat2,$sourse,$msg,$top,$videoYT)
	{
		$sql    = "UPDATE msgs SET title=:title,prew=:prew,category=:category,cat2=:cat2,sourse=:sourse,msg=:msg,top=:top,videoYT=:videoYT WHERE id=$id";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':title',   $title,   PDO::PARAM_STR);
		$result -> bindParam(':prew',    $prew,    PDO::PARAM_STR);
		$result -> bindParam(':category',$category,PDO::PARAM_INT );
		$result -> bindParam(':cat2',    $cat2,    PDO::PARAM_INT );
		$result -> bindParam(':sourse',  $sourse,  PDO::PARAM_STR);
		$result -> bindParam(':top',     $top,     PDO::PARAM_STR);
		$result -> bindParam(':msg',     $msg,     PDO::PARAM_STR);
		$result -> bindParam(':videoYT', $videoYT, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function updateComm($id,$nik,$txt,$email)
	{
		$sql    = "UPDATE Comment SET nik_com=:nik, email_com=:email, txt_com=:txt WHERE id_com=$id";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':nik',   $nik,   PDO::PARAM_STR);
		$result -> bindParam(':email', $email, PDO::PARAM_STR);
		$result -> bindParam(':txt',   $txt,   PDO::PARAM_STR);

		return $result -> execute();			
	}

	public static function showNews($arrNews)
	{
		if (!empty($arrNews))
		{
			include ('views/news/showNews.php');
		}
	}
}
?>