<?php
/**
* 
*/
class VideoController
{
	use traitAuxiliary;

	public function __construct()
	{
		$this->total = $this->getCount('progrnk');
	}

	public function actionIndex($page = 1)
	{
		$count_ads  = 0;
		$page       = $this->getIntval($page);
		$video      = new Video();
		$videoList  = $video->getVideo($page);
		$siteFile   = 'views/video/index.php';
		$metaTags   = 'відео Галичини';
		$pagination = new Pagination($this->total, $page, SHOWVIDEO_BY_DEFAULT, 'page-');
		unset($video);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionChangeVideo($page = 1)
	{
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page,
			);			
		$json  = json_encode($table);		
		$pagination = new Pagination($this->total, $page, SHOWVIDEO_BY_DEFAULT, 'page-');
		require_once ('views/video/changeVideo.php');
		return true;
	}
}
?>