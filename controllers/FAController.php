<?php
class FAController {
	use traitAuxiliary;
	public function __construct() {
		$this->FAClass = new FA();
		$this->total = $this->getCount('photoalbum');
	}

	public function actionLook($page = 1) {
		$page       = $this->getIntval($page);
		$total      = $this->getCount('photoalbum');
		$faList     = $this->FAClass->getFAAll($page);
		$pagination = new Pagination($total, $page, SHOWFA_BY_DEFAULT, 'page-');
		$metaTags   = 'FA';
		$siteFile   = 'views/FA/look.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionLookOne($id) {	
		$id     = $this->getIntval($id);
		$faList = $this->FAClass->getFAOne($id);
		$nameFA = $this->FAClass->getFAId($id);
		$metaTags = 'FA';
		$siteFile = 'views/FA/lookOne.php';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionCreate() {
        if(isset($_POST['submit'])) {
			$fa      = new FA();
	        $name_FA = $this->filterTXT('post', 'name_FA');
	        $msgs_FA = $this->filterTXT('post', 'msgs_FA');
	        $log_FA  = 1;
	        $result  = $fa->createFA($name_FA,$msgs_FA,$log_FA);
            $idAlbum = $fa->getFAName($name_FA);
			$pathdir = "album/".$idAlbum['id_FA'];
		    if ($this->makeDir($pathdir)) {
				header("Location: /FA/upload/".$idAlbum['id_FA']); exit();
		    } 
		    else {
				print "no dir".$pathdir." read";
 	            header ("Location: /FAcreate");
        	}
			unset($fa);
		}
		require_once ('views/FA/create.php');
		return true;
	}

	public function actionUpload($id) {
        if(isset($_POST['submit'])) {
			$fa        = new FA();	
	        $subscribe = $this->filterTXT('post', 'subscribe');
	        $fotoName  = $this->rus2translit($_FILES['photo']['name']);
			$fotoNameS = "s".$fotoName;
			$pathdir   = 'album/'.$id;
			move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
	        $res = $fa->insertPhoto($id,$subscribe,$fotoName,$fotoNameS);
			unset($fa);
        }
		require_once ('views/FA/upload.php');
		return true;	
	}

	public function actionEditOne($id) {
		$fa     = new FA();	
		if(isset($_POST['submit'])) {
			if ($_FILES['photo'] ['tmp_name']) {
				$id = $_POST['if_photo'];
				$subscribe = $this->filterTXT('post', 'desc_photo');
				$fotoName  = $this->rus2translit($_FILES['photo']['name']);
				$pathdir   = 'album/'.$id;
				move_uploaded_file ($_FILES['photo'] ['tmp_name'],$pathdir.'/'.$fotoName);
				$res = $fa->insertPhoto($id,$subscribe,$fotoName);
			}
			header ("Location: /faEditOne/$id");
		}
		
		$id = $this->getIntval($id);
		$table  = array(
			'id'   => $id
			);
		$json   = json_encode($table);
		$nameFA = $fa->getFAId($id);
		if(isset($_POST['submit'])) {
			$subscr = $_POST['subscr'];
			$file   = $_POST['file'];
		}
		unset($fa);			
		require_once ('views/FA/editOne.php');
		return true;
	}

	public function actionEdit($page = 1) {
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page,
			'total'=> $this->total
			);			
		$json  = json_encode($table);
		$pagination = new Pagination($this->total, $page, SHOWFA_BY_DEFAULT, 'page-');
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