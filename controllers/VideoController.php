<?php

class VideoController {
	use traitAuxiliary;

	public function __construct() {
		$this->progrnk = new classGetData('progrnk');
		$this->total = $this->progrnk->selectCount( false);
	}

	public function actionIndex( $page = 1 ) {
		$count_ads  = 0;
		$page       = $this->getIntval($page);
		$video      = new Video();
		$videoList  = $video->getVideo($page);
		$siteFile   = 'views/video/index.php';
		$metaTags   = 'відео Галичини';
		$meta       = $this->getMeta();
		$pagination = new Pagination($this->total, $page, SHOWVIDEO_BY_DEFAULT, 'page-');
		unset($video);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionChangeVideo( $page = 1 ) {
		$page  = $this->getIntval($page);		
		$json  = json_encode( array( 'page' => $page ) );		
		$pagination = new Pagination($this->total, $page, SHOWVIDEO_BY_DEFAULT_ADMIN, 'page-');
		require_once ('views/video/changeVideo.php');
		return true;
	}
}