<?php
class FAController {
	use traitAuxiliary;
	public function __construct() {
		$this->FAClass = new FA();
		$photoalbum_t  = new classGetData('photoalbum');
		$this->total   = $photoalbum_t->selectCount(false);
	}

	public function actionLook( int $page = 1) {
		$page       = $this->check_index_page($this->getIntval($page), $this->total, SHOWFA_BY_DEFAULT);
		$faList     = $this->FAClass->getFAAll($page);
		$pagination = new Pagination($this->total, $page, SHOWFA_BY_DEFAULT, 'page-');
		$meta     = $this->getMeta();
		$siteFile   = 'views/FA/look.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionLookOne( int $id) {	
		$id     = $this->getIntval($id);
		$faList = $this->FAClass->getFAOne($id);
		if( empty($faList)) return;
		$nameFA = $this->FAClass->getFAId($id);
		$metaTags = 'FA';
		$siteFile = 'views/FA/lookOne.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionCreate() {
        if(isset($_POST['submit'])) {
	        $name_FA = $this->filterTXT('post', 'name_FA');
	        $msgs_FA = $this->filterTXT('post', 'msgs_FA');
	        $log_FA  = 1;
	        $result  = $this->FAClass->createFA($name_FA,$msgs_FA,$log_FA);
	        header ("Location: /FAedit");			
		}
		require_once ('views/FA/create.php');
		return true;
	}

	public function actionUpload( int $id) {
        if(isset($_POST['submit'])) {
	        $subscribe = $this->filterTXT('post', 'subscribe');
	        $fotoName  = $this->rus2translit($_FILES['photo']['name']);
			$fotoNameS = "s".$fotoName;
			$pathdir   = 'album/'.$id;
			move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
	        $res = $this->FAClass->insertPhoto($id,$subscribe,$fotoName,$fotoNameS);
        }
		require_once ('views/FA/upload.php');
		return true;	
	}

	public function actionEditOne( int $id) {
		if(isset($_POST['submit'])) {
			if ($_FILES['photo'] ['tmp_name']) {
				$id        = $this->filterINT('post', 'if_photo');
				$subscribe = $this->filterTXT('post', 'desc_photo');
				$fotoName  = $this->rus2translit($_FILES['photo']['name']);
				$pathdir   = 'album/'.$id;
				$res  = $this->makeDir($pathdir);
				move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
				$res = $this->FAClass->insertPhoto($id, $subscribe, $this->convertNameToWebp($fotoName));
				$this->webpImage('./'.$pathdir."/".$fotoName);
				unlink('./'.$pathdir."/".$fotoName);
			}
			header ("Location: /faEditOne/$id");
		}
		
		$id = $this->getIntval($id);
		$table  = array(
			'id'   => $id
			);
		$json   = json_encode($table);
		$nameFA = $this->FAClass->getFAId($id);
		if(isset($_POST['submit'])) {
			$subscr = $this->filterTXT('post', 'subscr');
			$file   = $this->filterTXT('post', 'file');
		}		
		require_once ('views/FA/editOne.php');
		return true;
	}

	public function actionEdit( int $page = 1) {
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);			
		$json  = json_encode($table);
		$pagination = new Pagination($this->total, $page, 25, 'page-');
		require_once ('views/FA/edit.php');
		return true;
	}

	public function actionDropZone($substr)	{
		require_once ('views/FA/uploadDZ.php');
		return true;
	}

	public function actionFAAdd_Photo() {
		if(isset($_POST['submit'])) {
			header ("Location: /FAedit");
		}
	}
}