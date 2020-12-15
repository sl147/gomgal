<?php

class PosterController
{
	use traitAuxiliary;

	public function actionIndex()
	{
		$poster    = new Poster();
		$posterCat = $poster->getPostersCat();
		unset($poster);
		$siteFile  = 'views/poster/index.php';
		$metaTags  = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterFind($page = 1)
	{		
		if(isset($_POST['submit'])) {
			$poster         = new Poster();
			$findTXT        = trim(strip_tags($this->filterTXT('post', 'name_f')));
			$posterImpotant = $poster->getFindPostersImpot($findTXT);
			$posterAll      = $poster->getFindPosters($findTXT,$page);
			$total          = $poster->getFindTotalPoster($findTXT);
			$pagination     = new Pagination($total, $this->getIntval($page) , SHOWPOSTER_BY_DEFAULT, 'page-');
			unset($poster);
			$siteFile       = 'views/poster/catAll.php';
		}
		else {
			$siteFile = 'views/poster/find.php';
		}
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);		
		return true;
	}

	public function actionPosterCatFull($cat, $page = 1)
	{
		$cat = $this->getIntval($cat);
		$poster    = new Poster();
		$aux    = new Auxiliary();
		$posterImpotant = $poster->getAllPostersImpotCat($cat);
		$posterAll      = $poster->getAllPostersAllCat($cat,$page);
		$total          = $aux->getCountAtr('poster', 'cat_p',$cat);
		unset($poster);
		unset($aux);
		$pagination     = new Pagination($total, $this->getIntval($page), SHOWPOSTER_BY_DEFAULT, 'page-');
		$siteFile       = 'views/poster/catAll.php';
		$metaTags       = '';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionPosterFull($page = 1)
	{
		$poster    = new Poster();
		$aux    = new Auxiliary();
		$posterImpotant = $poster->getAllPostersImpot();
		$posterAll      = $poster->getAllPostersAll($this->getIntval($page));
		$total          = $aux->getCount('poster');
		$pagination     = new Pagination($total, $this->getIntval($page), SHOWPOSTER_BY_DEFAULT, 'page-');
		unset($poster);
		unset($aux);
		$siteFile       = 'views/poster/catAll.php';
		$metaTags       = '';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionPosterOne($id = 1)
	{
		$poster    = new Poster();
		$id        = $this->getIntval($id);
		$posterOne = $poster->getPosterById($id);
		$res       = $poster->plusId($id);
		$file      = 'posterFoto/'.$posterOne["foto_p1"];
		$siteFile  = 'views/poster/one.php';
		$metaTags  = 'poster';
		unset($poster);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}	

	public function actionAdd()
	{
		$poster  = new Poster();
		$aux     = new Auxiliary();
		$tPos    = $poster->getAllTypePost();
		$count   = count($tPos)-1;
		$catList = $poster->getPostersCat();
		$fruit   = array_pop($catList);
		if(isset($_POST['submit'])) {
			$nik   = $this->filterTXT('post', 'nik');
			$type  = $this->filterTXT('post', 'type');
			$cat   = $this->filterTXT('post', 'category');
			$title = $this->filterTXT('post', 'title');
			$msg   = $this->filterTXT('post', 'msg');
			$email = $this->filterEmail('post', 'email');
			
			$foto  = $_FILES['file']['name'];
			$ip    = $_SERVER['REMOTE_ADDR'];
			$rand  = rand(11111,99999);
			$res   = $poster->createPoster($nik,$type,$cat,$email,$msg,$foto,$rand,$ip,$title);
			$id    = $poster->getPosterByRand($rand);			
			$jpg   = explode('.', $_FILES['file'] ['name']);
			$fotoN = $id['id_poster'].'.'.$jpg[count($jpg)-1];
			$res   = $poster->updateFoto($id['id_poster'],$fotoN);
			$res   = $aux->savePhoto($fotoN,'posterFoto');
			$res   = $poster->incrType($cat,$type);
			unset($poster);
			unset($aux);
			header("Location: /posterFull");
		}

		$siteFile = 'views/poster/add.php';
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterEdit($page = 1)
	{
		$aux    = new Auxiliary();
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування оголошень";
		$total = $aux->getCount('poster');
		unset($aux);
		$pagination = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/poster/posterEdit.php');
		unset($pagination);
		return true;
	}

	public function actionPosterEditOne($id, $page = 1)
	{
		$poster    = new Poster();
		$aux    = new Auxiliary();
		$id          = $this->getIntval($id);
		$page        = $this->getIntval($page);		
		$title       = "редагування оголошення";
		$post        = $poster->getPosterById($id);
		$posterCat   = $poster->getPostersCatEd();
		$idCat       = $post['cat_p'];
		$type_p      = $post['type_p'];
		$foto_name   = $post['foto_p1'];
	$post['fotoN']   = $post['foto_p1'];
	$post['foto_p1'] = "/posterFoto/".$post['foto_p1'];
		$typePost    = $poster->getAllTypePost();
		$typePost[0] = $typePost[$type_p];
		$cat         = $poster->getPostersByCat($idCat);
		array_unshift($posterCat,$cat);

        if(isset($_POST['submit'])) {
        	$idm     = $this->filterINT  ('post', 'id_m');
	        $title_p = $this->filterTXT  ('post', 'title_p');
	        $cat     = $this->filterINT  ('post', 'category');
	        $type    = $this->filterINT  ('post', 'type');
	        $name    = $this->filterTXT  ('post', 'name');
	        $email   = $this->filterEmail('post', 'email');
	        $msg     = $this->filterTXT  ('post', 'msg');
	        $impot   = isset($_POST['impot']) ? 1 : 0;
	        $FotoDel = isset($_POST['FotoDel']) ? 1 : 0;
	        if ($type == 0) {$type = $type_p;}

	        if (!empty($_FILES['file']['tmp_name'])) {
	            $fotoL    = $this->rus2translit($_FILES['file']['name']);
	            $pathdir  = ROOT."/posterFoto";
	            $res      = $aux->savePhoto($fotoL,$pathdir);
	            $res      = $poster->changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,$fotoL);
	        }
	        else {
	            if ($FotoDel == 1) {
	                    $result = $poster->changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,"");
	                    $res = $aux->delFile($post['fotoN'],"posterFoto");
	            }
	            else {
	                    $result = $poster->changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,$foto_name);
	            }
	        }
			header ("Location: /posterEdit/page-".$page);
		}
		unset($aux);
		unset($poster);
		require_once ('views/poster/posterEditOne.php');
		return true;
	}

	public function actionPosterVerify()
	{
		$poster = new Poster();		
		$t      = $poster->getPostersVerify();
		unset($poster);
		require_once ('views/poster/posterVerify.php');
		return true;
	}
}	
?>