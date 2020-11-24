<?php
/**
* 
*/
class VideoController
{
	use traitAuxiliary;

/*	public $aux;

	public function __construct()
	{
		$this->$aux = new Auxiliary();
	}*/

	public function actionIndex($page = 1)
	{
	
		$page       = $this->getIntval($page);
		$video      = new Video();
		$videoList  = $video->getVideo($page);
		$siteFile   = 'views/video/index.php';
		$metaTags   = 'відео Галичини';
		$total      = Auxiliary::getCount('progrnk');
		$pagination = new Pagination($total, $page, Video::SHOWVIDEO_BY_DEFAULT, 'page-');
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
		$total = Auxiliary::getCount('progrnk');		
		$pagination = new Pagination($total, $page, Video::SHOWVIDEO_BY_DEFAULT, 'page-');
		require_once ('views/video/changeVideo.php');
		return true;
	}
}
?>