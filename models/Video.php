<?php
/**
* 
*/
class Video extends classGetDB
{	

	use traitAuxiliary;

	const SHOWVIDEO_BY_DEFAULT = 6;

	private static function reqAux() {
		require_once ('../models/AuxiliaryVue.php');
		return new AuxiliaryVue();
	}

	public  function getVideo($page) {
		$getData = new classGetData('progrnk');
		$offset  = ($this->getIntval($page) - 1) * self::SHOWVIDEO_BY_DEFAULT;
		$result = $getData->getDataByOffsetWithOutRow ('prid',self::SHOWVIDEO_BY_DEFAULT,$offset);
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
		$offset = ($page - 1) * self::SHOWVIDEO_BY_DEFAULT;
		$sql    = "SELECT * FROM progrnk ORDER BY prid DESC LIMIT ".self::SHOWVIDEO_BY_DEFAULT." OFFSET $offset";
		$result = self::reqAux()->getSQLAuxVue($sql);
		$i      = 0;
		while ($row = $result->fetch()) {
			  $list[$i]['id']  = $row['prid'];
			 $list[$i]['idYT'] = $row['pridYT'];
			$list[$i]['title'] = $row['prhar'];		
			$i++;
		}
		unset($MK);
		return $list ?? [];
	}

	public static function updateVideoVue ($id,$idYT,$title) {
		$sql    = "UPDATE progrnk SET pridYT=:idYT, prhar=:title WHERE prid=$id";
		$result = self::reqAux()->getPrepareSQLVue($sql);
		$result -> bindParam(':idYT',  $idYT,  PDO::PARAM_STR);
		$result -> bindParam(':title', $title, PDO::PARAM_STR);
		unset($MK);
		return $result -> execute();
	}

	public static function addVideoVue ($idYT,$title) {
		$sql    = "INSERT INTO progrnk (pridYT,prhar)
		                VALUES(:idYT,:title)";
		$result = self::reqAux()->getPrepareSQLVue($sql);
		$result -> bindParam(':idYT',  $idYT,  PDO::PARAM_STR);
		$result -> bindParam(':title', $title, PDO::PARAM_STR);
		unset($MK);
		return $result -> execute();			
	}
}
?>