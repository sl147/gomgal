<?php

class FAController
{

	public function actionCreate()
	{

        if(isset($_POST['submit'])) {
	        $name_FA = Auxiliary::filterTXT('post', 'name_FA');
	        $msgs_FA = Auxiliary::filterTXT('post', 'msgs_FA');
	        $log_FA  = 1;
	        $result  = FA::createFA($name_FA,$msgs_FA,$log_FA);
            $idAlbum = FA::getFAName($name_FA);
			$pathdir = "album/".$idAlbum['id_FA'];

		    if (Auxiliary::makeDir($pathdir)) {
				header("Location: /FA/upload/".$idAlbum['id_FA']); exit();
		    } 
		    else {
				print "no dir".$pathdir." read";
 	            header ("Location: /FAcreate");
        	}
		}
		require_once ('views/FA/create.php');
		return true;
	}

	public function actionUpload($id)
	{

        if(isset($_POST['submit'])) {
	        $subscribe = Auxiliary::filterTXT('post', 'subscribe');
	        $fotoName  = Auxiliary::rus2translit($_FILES['photo']['name']);
			$fotoNameS = "s".$fotoName;
			$pathdir   = 'album/'.$id;
			move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
	        $res = FA::savePhoto($id,$subscribe,$fotoName,$fotoNameS);
	        $res = Auxiliary::savePhotoS($fotoName,$pathdir);
        }
		require_once ('views/FA/upload.php');
		return true;	
	}

	public function actionLook($page = 1) {
		$page       = Auxiliary::getIntval($page);
		$total      = Auxiliary::getCount('photoalbum');
		$faList     = FA::getFAAll($page);
		$pagination = new Pagination($total, $page, SHOWFA_BY_DEFAULT, 'page-');
		$metaTags   = 'FA';
		$siteFile   = 'views/FA/look.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionLookOne($id) {		
		$id = Auxiliary::getIntval($id);
		$faList = FA::getFAOne($id);
		$nameFA = FA::getFAId($id);
		$metaTags = 'FA';
		$siteFile = 'views/FA/lookOne.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionEditOne($id)	{		
		$id = Auxiliary::getIntval($id);
		$table  = array(
			'id'   => $id
			);
		$json   = json_encode($table);
		$nameFA = FA::getFAId($id);
		if(isset($_POST['submit'])) {
			$subscr = $_POST['subscr'];
			$file   = $_POST['file'];
		}			
		require_once ('views/FA/editOne.php');
		return true;
	}

	public function actionEdit()
	{
		$faList   = FA::getFA();
		require_once ('views/FA/edit.php');
		return true;
	}

	public function actionDropZone($substr)
	{

		require_once ('views/FA/uploadDZ.php');
		return true;
	}	
}	
?>