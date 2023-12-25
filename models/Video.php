<?php
/**
* 
*/
class Video extends classGetDB {

	use traitAuxiliary;
	const SHOWVIDEO_BY_DEFAULT_Vue = 25;

	public  function getVideo(int $page) {
		$getData = new classGetData('progrnk');
		$offset  = ($this->getIntval($page) - 1) * SHOWVIDEO_BY_DEFAULT;
		$result  = $getData->getDataByOffsetWithOutRow ('prid',SHOWVIDEO_BY_DEFAULT,$offset);
		unset($getData);
		$i       = 0;
		while ($row = $result->fetch()) {			
			$list[] = $row;
			$list[$i]['value']  = "//www.youtube.com/v/".$row['pridYT']."?hl=uk_UA&amp;version=3";
			//$list[$i]['value']  = "https://www.youtube.com/watch?v=".$row['pridYT'];
			$i++;
		}
		return $list ?? [];
	}

	public function getVideoVue($page = 1) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('progrnk');
		$list = $getData->getDataFromTableOrderPageVue(self::SHOWVIDEO_BY_DEFAULT_Vue,$page,'prid');
		unset($getData);
		return $list ?? [];
	}

	public static function getVideoVue1($page=1) {
		$getDB  = new classGetDB();
		$offset = (intval($page)  - 1) * self::SHOWVIDEO_BY_DEFAULT_Vue;
		$sql    = "SELECT * FROM progrnk ORDER BY prid DESC LIMIT ".self::SHOWVIDEO_BY_DEFAULT_Vue." OFFSET $offset";
		$result = $getDB->getDBVue($sql);
		$i      = 0;
		while ($row = $result->fetch()) {
			  $list[$i]['id']  = $row['prid'];
			 $list[$i]['idYT'] = $row['pridYT'];
			$list[$i]['title'] = $row['prhar'];		
			$i++;
		}
		unset($getDB);
		return $list ?? [];
	}

	public static function updateVideoVue ($id,$idYT,$title) {
		$getDB  = new classGetDB();
		$sql    = "UPDATE progrnk SET pridYT=:idYT, prhar=:title WHERE prid=:id";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':id',     $id,   PDO::PARAM_INT);
		$result -> bindParam(':idYT',  $idYT,  PDO::PARAM_STR);
		$result -> bindParam(':title', $title, PDO::PARAM_STR);
		unset($getDB);
		return $result -> execute();
	}

	public static function addVideoVue ($idYT,$title) {
		$getDB  = new classGetDB();
		$sql    = "INSERT INTO progrnk (pridYT,prhar)
		                VALUES(:idYT,:title)";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':idYT',  $idYT,  PDO::PARAM_STR);
		$result -> bindParam(':title', $title, PDO::PARAM_STR);
		unset($getDB);
		return $result -> execute();			
	}
}