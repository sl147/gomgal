<?php

/**
* Клас для новин
*/

class News {

	use traitAuxiliary;
	const SHOWNEWS_BY_DEFAULT_Vue=30;

	public function __construct() {
		$this->msgs    = new classGetData('msgs');
		$this->catmsgs = new classGetData('catmsgs');
	}

	private function makePhotoSize( string $foto) :array {
		$fotoSize = [];
		$fotoSize['width'] = $fotoSize['height'] = 0;
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
		return (array) $fotoSize;
	}

	public function getCatNews() :array {
		$result = $this->catmsgs->selectDataFromTable( array(), 'namecm', 0, 'ASC', false);
		$i  = 0;
		while ($row = $result->fetch()) {
			$list[$i]['id']   = $row['idcm'];
			$list[$i]['name'] = $row['namecm'];
			$i++;
		}
		return $list ?? [];
	}

	public function getCatEl( int $cat ) {
		return $this->catmsgs->selectDataFromTable( array( 'idcm'=>$cat), "", 0, 'DESC', false, false, true);
	}

	public function getFindTotalNews( string $txt ) :int{
		return (int) $this->msgs->selectFindNews($txt)->rowCount();
	}

	public function getNewsFind( string $txt) :array {
		$result = $this->msgs->selectFindNews($txt);
		$i      = 0;
		while ($row = $result->fetch()) {
			$NewsList[]            = $row;
			$NewsList[$i]['title'] = ucfirst (mb_strtolower ($row['title'], 'UTF-8'));
			$NewsList[$i]['fotoF'] = $row['foto'];
			$NewsList[$i]['foto']  = "NewsFoto/".$row['foto'];
			$size                  = $this->makePhotoSize($row['foto']);
			$NewsList[$i]['width'] = $size['width'];
			$NewsList[$i]['height']= $size['height'];
			$i++;
		}
		return (array) $NewsList ?? [];
	}

	public function getAllNewsVue( int $page = 1) {
		return $this->msgs->selectDataFromTable( array(), 'id', self::SHOWNEWS_BY_DEFAULT_Vue, 'DESC', true, true, false, true, $page);
	}

	public function getNews() : array {
		$result = $this->msgs->selectDataFromTable( array(), 'id', 25, 'DESC', false, false, false, true, 1);
		$i      = 0;
		while ($row = $result->fetch()) {
			$NewsList[]            = $row;
			$NewsList[$i]['title'] = ucfirst (mb_strtolower ($row['title'], 'UTF-8'));
			$NewsList[$i]['fotoF'] = $row['foto'];
			$NewsList[$i]['foto']  = "NewsFoto/".$row['foto'];
			$i++;
		}
		return (array) $NewsList ?? [];
	}

	private function addPhotoSize( array $arrNews, string $photo) :array{
		$size              = $this->makePhotoSize($photo);
		$arrNews['width']  = $size['width'];
		$arrNews['height'] = $size['height'];
		return $arrNews;
	}

	public function getNewsTop() :array {
		$topNews         = $this->msgs->selectDataFromTable( array('top'=>1), 'id', 1, 'DESC', false, false, true);
		$topNews         = $this->addPhotoSize( $topNews, $topNews['foto']);
		$topNews['foto'] = "NewsFoto/".$topNews['foto'];
		
		return (array) $topNews ?? [];
	}

	public function getTotalNews(int $month, int $year, int $cat = 0) :int {
		return (int) $this->msgs->selectTotalNews($month, $year, $cat);
	}

	public function getLatestNewsCat( int $cat, int $month, int $year, int $page = 1) :array{
		$NewsList = [];
		$result = $this->msgs->selectLatestNewsCat( $cat, $month, $year, $page, SHOWNEWS_BY_DEFAULT);
		$i      = 0;
		while ($row = $result->fetch()) {
			$NewsList[]           = $row;
			$NewsList[$i]         = $this->addPhotoSize( $NewsList[$i], $row['foto']);
			$NewsList[$i]['foto'] = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return (array) $NewsList;
	}

	public function getLatestNews( int $month, int $year, int $page = 1) :array {
		$result = $this->msgs->selectNews($month, $year, $page, SHOWNEWS_BY_DEFAULT);
		$i      = 0;
		while ($row = $result->fetch()) {
			$NewsList[]            = $row;
			$NewsList[$i]['fotoF'] = $row['foto'];
			$NewsList[$i]          = $this->addPhotoSize( $NewsList[$i], $row['foto']);
			$NewsList[$i]['foto']  = "NewsFoto/".$row['foto'];			
			$i++;
		}
		return $NewsList ?? [];
	}

	public function getNewsById( int $id) :array {
		$list = $this->msgs->selectDataFromTable( array( 'id'=>$id), "", 0, 'DESC', false, false, true);
		$list['photo']  = "/NewsFoto/".$list['foto'];
		$list['video']  = "//www.youtube.com/v/".$list['videoYT']."?hl=uk_UA&amp;version=3";
		unset($getData);
		return (array) $list ?? [];
	}

	public function newsOther( int $id, int $cat1, int $cat2) {
		return $this->msgs->selectNewsOther( $id, $cat1, $cat2);
	}

	public function updateCountById( int $id, int $count) {
		return $this->msgs->updateDataInTable( array ( 'countmsgs' => $count + 1), array( 'id'=>$id));		
	}

	public function createNews( string $title, string $prew, int $category, int $cat2, string $sourse, string $msg, string $foto, int $top, string $videoYT) {
		
		return $this->msgs->insertDataToTable(
					array( $title, $prew, $category, $cat2, $sourse, $top, $msg, $foto, $videoYT),
					array( 'title','prew','category','cat2','sourse','top','msg','foto','videoYT')
				);	
	}

	public function updateNews( int $id, string $title, string $prew, int $category, int $cat2, string $sourse, string $msg, string $foto, int $top, string $videoYT) {
		$args = array(
			'title'    => $title,
			'prew'     => $prew,
			'category' => $category,
			'cat2'     => $cat2,
			'sourse'   => $sourse,
			'top'      => $top,
			'msg'      => $msg,
			'videoYT'  => $videoYT,
		);
		if ( $foto ) array_push($args, array ( 'foto' => $foto ));
		return $this->msgs->updateDataInTable( $args, array('id'=>$id));
	}

	public static function showNews($arrNews) {
		if (!empty($arrNews)) include ('views/news/showNews.php');
	}
}