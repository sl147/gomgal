<?php
/**
* 
*/
class Video extends classGetDB {

	use traitAuxiliary;
	const SHOWVIDEO_BY_DEFAULT_Vue = 25;
	
	public function __construct() {
		$this->progrnk = new classGetData('progrnk');
	}

	public  function getVideo(int $page) {

		$result  = $this->progrnk->selectOrderPage (SHOWVIDEO_BY_DEFAULT, $page, 'prid');
		$i       = 0;
		while ($row = $result->fetch()) {			
			$list[] = $row;
			$list[$i]['value']  = "//www.youtube.com/v/".$row['pridYT']."?hl=uk_UA&amp;version=3";
			//$list[$i]['value']  = "https://www.youtube.com/watch?v=".$row['pridYT'];
			$i++;
		}
		return $list ?? [];
	}

	public function getVideoVue(int $page = 1) {
		return $this->progrnk->selectOrderPageVue( self::SHOWVIDEO_BY_DEFAULT_Vue, $page, 'prid', 'DESC', true);
	}

	public function updateVideoVue (int $id, string $idYT, string $title) {
		$args = array(
			'pridYT' => $idYT,
			'prhar'  => $title,
		);
		return $this->progrnk->updateDataInTable( $args, array( 'prid'=>$id),  true);
	}

	public function addVideoVue (string $idYT, string $title) {
		return $this->progrnk->insertDataToTable( array($idYT, $title), array('pridYT', 'prhar'), true);
	}
}