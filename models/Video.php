<?php
/**
* 
*/
class Video
{	

	use traitAuxiliary;

	const SHOWVIDEO_BY_DEFAULT = 6;

	public function __construct() {
		require_once ('../classes/classGetDB.php');
	}

	public  function getVideo($page) {
		$getData = new classGetData('progrnk');
		$offset  = ($this->getIntval($page) - 1) * self::SHOWVIDEO_BY_DEFAULT;
		$result  = $getData->getDataByOffsetWithOutRow ('prid',self::SHOWVIDEO_BY_DEFAULT,$offset);
		unset($getData);
		$i       = 0;
		while ($row = $result->fetch()) {			
			$list[] = $row;
			$list[$i]['value']  = "//www.youtube.com/v/".$row['pridYT']."?hl=uk_UA&amp;version=3";
			$i++;
		}
		return $list ?? [];
	}

	public static function getVideoVue($page=1) {
		$getDB  = new classGetDB();
		$offset = ($page - 1) * self::SHOWVIDEO_BY_DEFAULT;
		$sql    = "SELECT * FROM progrnk ORDER BY prid DESC LIMIT ".self::SHOWVIDEO_BY_DEFAULT." OFFSET $offset";
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
		$sql    = "UPDATE progrnk SET pridYT=:idYT, prhar=:title WHERE prid=$id";
		$result = $getDB->getPrepareSQLVue($sql);
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
?>