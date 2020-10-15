<?php

class FAController
{

	public function actionCreate()
	{

        if(isset($_POST['submit'])) {
        	$aux    = new Auxiliary();
			$fa     = new FA();
	        $name_FA = $aux->filterTXT('post', 'name_FA');
	        $msgs_FA = $aux->filterTXT('post', 'msgs_FA');
	        $log_FA  = 1;
	        $result  = $fa->createFA($name_FA,$msgs_FA,$log_FA);
            $idAlbum = $fa->getFAName($name_FA);
			$pathdir = "album/".$idAlbum['id_FA'];

		    if ($aux->makeDir($pathdir)) {
				header("Location: /FA/upload/".$idAlbum['id_FA']); exit();
		    } 
		    else {
				print "no dir".$pathdir." read";
 	            header ("Location: /FAcreate");
        	}
        	unset($aux);
			unset($fa);
		}
		require_once ('views/FA/create.php');
		return true;
	}

	public function actionUpload($id)
	{
        if(isset($_POST['submit'])) {
        	$aux    = new Auxiliary();
			$fa     = new FA();	
	        $subscribe = $aux->filterTXT('post', 'subscribe');
	        $fotoName  = $aux->rus2translit($_FILES['photo']['name']);
			$fotoNameS = "s".$fotoName;
			$pathdir   = 'album/'.$id;
			move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
	        $res = $fa->savePhoto($id,$subscribe,$fotoName,$fotoNameS);
	        $res = $aux->savePhotoS($fotoName,$pathdir);
	        unset($aux);
			unset($fa);
        }
		require_once ('views/FA/upload.php');
		return true;	
	}

	public function actionLook($page = 1)
	{
		$aux    = new Auxiliary();
		$fa     = new FA();	
		$page       = $aux->getIntval($page);
		$total      = $aux->getCount('photoalbum');
		$faList     = $fa->getFAAll($page);
		$pagination = new Pagination($total, $page, SHOWFA_BY_DEFAULT, 'page-');
		$metaTags   = 'FA';
		$siteFile   = 'views/FA/look.php';
		unset($aux);
		unset($fa);
		
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionLookOne($id) {
		$aux    = new Auxiliary();
		$fa     = new FA();		
		$id     = $aux->getIntval($id);
		$faList = $fa->getFAOne($id);
		$nameFA = $fa->getFAId($id);
		$metaTags = 'FA';
		$siteFile = 'views/FA/lookOne.php';
		unset($aux);
		unset($fa);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionEditOne($id)
	{		
		$aux    = new Auxiliary();
		$fa     = new FA();	
		$id = $aux->getIntval($id);
		$table  = array(
			'id'   => $id
			);
		$json   = json_encode($table);
		$nameFA = $fa->getFAId($id);
		if(isset($_POST['submit'])) {
			$subscr = $_POST['subscr'];
			$file   = $_POST['file'];
		}
		unset($aux);
		unset($fa);			
		require_once ('views/FA/editOne.php');
		return true;
	}

	public function actionEdit()
	{
		$fa     = new FA();
		$faList = $fa->getFA();
		unset($fa);
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