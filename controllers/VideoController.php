<?php
/**
* 
*/
class VideoController
{
	
	public function actionIndex()
	{
		$videoList = Video::getVideo();
		$siteFile  = 'views/video/index.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionChangeVideo($page = 1) {
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