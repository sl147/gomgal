<?php

class PosterController {

	public function actionIndex() {
		$posterCat = Poster::getPostersCat();
		$siteFile  = 'views/poster/index.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterFind($page = 1) {
		$page = Auxiliary::getIntval($page);
		if(isset($_POST['submit'])) {
			$findTXT        = trim(strip_tags(Auxiliary::filterTXT('post', 'name_f')));
			$posterImpotant = Poster::getFindPostersImpot($findTXT);
			$posterAll      = Poster::getFindPosters($findTXT,$page);
			$total          = Poster::getFindTotalPoster($findTXT);
			$pagination     = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
			$siteFile       = 'views/poster/catAll.php';			
		}
		else {
			$siteFile = 'views/poster/find.php';
		}
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');		
		return true;
	}

	public function actionPosterCatFull($cat, $page = 1) {
		$page           = Auxiliary::getIntval($page);
		$posterImpotant = Poster::getAllPostersImpotCat($cat);
		$posterAll      = Poster::getAllPostersAllCat($cat,$page);
		$total          = Auxiliary::getCountAtr('poster', 'cat_p',$cat);
		$pagination     = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
		$siteFile       = 'views/poster/catAll.php';
		$metaTags       = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterFull($page = 1)	{
		//$page           = Auxiliary::getIntval($page);
		$posterImpotant = Poster::getAllPostersImpot();
		$posterAll      = Poster::getAllPostersAll($page);
		$total          = Auxiliary::getCount('poster');
		$pagination     = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
		$siteFile       = 'views/poster/catAll.php';
		$metaTags       = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterOne($id = 1) {
		$id        = Auxiliary::getIntval($id);
		$posterOne = Poster::getPosterById($id);
		$res       = Poster::plusId($id);
		$file      = 'posterFoto/'.$posterOne["foto_p1"];
		$siteFile  = 'views/poster/one.php';
		$metaTags  = 'poster';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}	

	public function actionAdd() {
		$tPos    = Poster::getAllTypePost();
		$count   = count($tPos)-1;
		$catList = Poster::getPostersCat();
		$fruit   = array_pop($catList);
		if(isset($_POST['submit'])) {
			$nik   = Auxiliary::filterTXT('post', 'nik');
			$type  = Auxiliary::filterTXT('post', 'type');
			$cat   = Auxiliary::filterTXT('post', 'category');
			$title = Auxiliary::filterTXT('post', 'title');
			$msg   = Auxiliary::filterTXT('post', 'msg');
			$email = Auxiliary::filterEmail('post', 'email');
			
			$foto  = $_FILES['file']['name'];
			$ip    = $_SERVER['REMOTE_ADDR'];
			$rand  = rand(11111,99999);
			$res   = Poster::createPoster($nik,$type,$cat,$email,$msg,$foto,$rand,$ip,$title);
			$id    = Poster::getPosterByRand($rand);			
			$jpg   = explode('.', $_FILES['file'] ['name']);
			$fotoN = $id['id_poster'].'.'.$jpg[count($jpg)-1];
			$res   = Poster::updateFoto($id['id_poster'],$fotoN);
			$res   = Auxiliary::savePhoto($fotoN,'posterFoto');
			$res   = Poster::incrType($cat,$type);

			header("Location: /posterFull");
		}

		$siteFile = 'views/poster/add.php';
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterEdit($page = 1) {
		$page  = Auxiliary::getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування оголошень";
		$total = Auxiliary::getCount('poster');
		$pagination = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/poster/posterEdit.php');
		return true;
	}

	public function actionPosterEditOne($id, $page = 1) {
		$id          = Auxiliary::getIntval($id);
		$page        = Auxiliary::getIntval($page);		
		$title       = "редагування оголошення";
		$post        = Poster::getPosterById($id);
		$posterCat   = Poster::getPostersCatEd();
		$idCat       = $post['cat_p'];
		$type_p      = $post['type_p'];
		$foto_name   = $post['foto_p1'];
	$post['fotoN']   = $post['foto_p1'];
	$post['foto_p1'] = "/posterFoto/".$post['foto_p1'];
		$typePost    = Poster::getAllTypePost();
		$typePost[0] = $typePost[$type_p];
		$cat         = Poster::getPostersByCat($idCat);
		array_unshift($posterCat,$cat);

        if(isset($_POST['submit'])) {
        	$idm     = Auxiliary::filterINT  ('post', 'id_m');
	        $title_p = Auxiliary::filterTXT  ('post', 'title_p');
	        $cat     = Auxiliary::filterINT  ('post', 'category');
	        $type    = Auxiliary::filterINT  ('post', 'type');
	        $name    = Auxiliary::filterTXT  ('post', 'name');
	        $email   = Auxiliary::filterEmail('post', 'email');
	        $msg     = Auxiliary::filterTXT  ('post', 'msg');
	        $impot   = isset($_POST['impot']) ? 1 : 0;
	        $FotoDel = isset($_POST['FotoDel']) ? 1 : 0;
	        if ($type == 0) {$type = $type_p;}

	        if (!empty($_FILES['file']['tmp_name'])) {
	            $fotoL    = Auxiliary::rus2translit($_FILES['file']['name']);
	            $pathdir  = ROOT."/posterFoto";
	            $res      = Auxiliary::savePhoto($fotoL,$pathdir);
	            $res      = Poster::changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,$fotoL);
	        }
	        else {
	            if ($FotoDel == 1) {
	                    $result = Poster::changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,"");
	                    $res = Auxiliary::delFile($post['fotoN'],"posterFoto");
	            }
	            else {
	                    $result = Poster::changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,$foto_name);
	            }
	        }
			header ("Location: /posterEdit/page-".$page);
		}
		
		require_once ('views/poster/posterEditOne.php');
		return true;
	}

	public function actionPosterVerify() {		
		$t  = Poster::getPostersVerify();

		require_once ('views/poster/posterVerify.php');
		return true;
	}
}	
?>