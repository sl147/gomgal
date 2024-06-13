<?php


class PosterController {

	use traitAuxiliary;

	public function __construct() {
		$this->poster   = new Poster();
	}

	public function actionIndex() {
		$posterCat = $this->poster->getPostersCat();
		$siteFile  = 'views/poster/index.php';
		$meta      = $this->getMeta();
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterFind($page = 1) {		
		if(isset($_POST['submit'])) {
			$findTXT        = '';
			$posterImpotant = [];
			$posterAll      = [];
			$total          = 0;
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {
				$findTXT        = trim(strip_tags($this->filterTXT('post', 'name_f')));
				$posterImpotant = $this->poster->getFindPostersImpot($findTXT);
				$posterAll      = $this->poster->getFindPosters($findTXT,$page);
				$total          = $this->poster->getFindTotalPoster($findTXT); 
				$pagination     = new Pagination($total, $this->getIntval($page), SHOWPOSTER_BY_DEFAULT, 'page-');
				$siteFile       = 'views/poster/catAll.php';							
			}else {
				$subject = "haks зі сторінки poster find";
				$massage = $subject;
				$mail    = $this->sendMail($subject,SLMAIL,$massage);
				$siteFile = 'views/poster/find.php';
			}				
		} else {
			$siteFile = 'views/poster/find.php';
		}
		$metaTags = '';
		$token = $this->getToken();
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);		
		return true;
	}

	private function getMetaWithSubPoster($poster) {
		$mt = new MetaTags();	
		$a  = explode("/",trim($_SERVER["REQUEST_URI"],'/'));
		$b  = $mt->getMTagsByUrl($a[0]);
		$b['title'] .= ' - '. $poster->getPostersByCat($a[1])['cat_cat'];
		return $b;
	}

	public function actionPosterCatFull($cat, $page = 1) {
		$cat            = $this->getIntval($cat);
		$posterImpotant = $this->poster->getAllPostersImpotCat($cat);
		$posterAll      = $this->poster->getAllPostersAllCat($cat,$page);
		if( empty($posterAll)) return;
		$total          = $this->getCountAtr('poster', 'cat_p',$cat);
		$pagination     = new Pagination($total, $this->getIntval($page), SHOWPOSTER_BY_DEFAULT, 'page-');
		$siteFile       = 'views/poster/catAll.php';
		$meta           = $this->getMetaWithSubPoster($this->poster);
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	private function getCountPoster(){
		$getDB  = new classGetDB();
		$result = $getDB->getDB("SELECT count(*) as count FROM poster WHERE ((impot=0) OR (impot IS NULL))AND (active = 0)");
		unset($getDB);
		$result -> setFetchMode(PDO::FETCH_ASSOC);

		return $result->fetch()['count'];
	}

	public function actionPosterFull($page = 1) {
		$posterImpotant = $this->poster->getAllPostersImpot();
		$posterAll      = $this->poster->getAllPostersAll($this->getIntval($page));
		//$total          = $this->getCount('poster');
		$total          = $this->getCountPoster('poster');
		$pagination     = new Pagination($total, $this->getIntval($page), SHOWPOSTER_BY_DEFAULT, 'page-');
		$siteFile       = 'views/poster/catAll.php';
		$metaTags       = '';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	private function sl147_get_email($email) {
		$a = explode("@",$email);
		$before = substr($a[0], 0, 1) ."<span class='sl147_anti_spam'>sl147 anti spam</span>".substr($a[0], 1); 
		$after = substr($a[1], 0, 1) ."<span class='sl147_anti_spam'>sl147 anti spam</span>".substr($a[1], 1); 
		return $before. "@".$after."<span class='sl147_anti_spam'>sl147 anti spam</span>";
	}

	public function actionPosterOne($id = 1) {
		$id        = $this->getIntval($id);
		$posterOne = $this->poster->getPosterById($id);
		if(empty($posterOne)) return;
		$res       = $this->poster->plusId($id);
		$title = $posterOne['title_p'];
		$meta['title'] = $this->getMetaTitle($posterOne['title_p']);
		$meta['descr'] = $posterOne['title_p'];
		$meta['keywords'] = $this->getMetaKeywords($posterOne['msg_p']);
		$file      = 'posterFoto/'.$posterOne["foto_p1"];
		$siteFile  = 'views/poster/one.php';
		$metaTags  = 'poster';
		$poster_email = $this->sl147_get_email($posterOne['email_p']);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}	

	public function actionAdd() {
		$tPos    = $this->poster->getAllTypePost();
		$count   = count($tPos)-1;
		$catList = $this->poster->getPostersCat();
		$fruit   = array_pop($catList);
		if(isset($_POST['submit'])) {
			$nik   = $this->sl147_clean($_POST['nik']);//$this->filterTXT('post', 'nik');
			$type  = $this->filterINT('post', 'type');
			$type  = ($type == 0 ) ? 1 : $type;
			$cat   = $this->filterINT('post', 'category');
			$title = $this->sl147_clean($_POST['title']);//$this->filterTXT('post', 'title');
			$msg   = $this->sl147_clean($_POST['msg']);//$this->filterTXT('post', 'msg');
			$email = $this->filterEmail('post', 'email');
			$foto  = $_FILES['file']['name'];
			$ip    = $_SERVER['REMOTE_ADDR'];
			$rand  = rand(11111,99999);
			$res   = $this->poster->createPoster($nik,$type,$cat,$email,$msg,$foto,$rand,$ip,$title);
			$id    = $this->poster->getPosterByRand($rand);			
			$jpg   = explode('.', $_FILES['file'] ['name']);
			$fotoN = $id['id_poster'].'.'.$jpg[count($jpg)-1];
			$fotoN = $this->savePhoto($fotoN, ROOT."/posterFoto",date('y'),date('m'));
			$res   = $this->poster->updateFoto($id['id_poster'],$fotoN);
			$res   = $this->poster->incrementTypeCategory($cat,$type);
			header("Location: /posterFull");
		}
		$siteFile = 'views/poster/add.php';
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionPosterEdit( int $page = 1) {
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування оголошень";
		$total = $this->getCount('poster');
		$pagination = new Pagination($total, $page, SHOWPOSTER_BY_DEFAULT, 'page-');
		require_once ('views/poster/posterEdit.php');
		unset($pagination);
		return true;
	}

	public function actionPosterEditOne( int $id, int $page = 1) {
		$id          = $this->getIntval($id);
		$page        = $this->getIntval($page);		
		$title       = "редагування оголошення";
		$post        = $this->poster->getPosterById($id);
		$posterCat   = $this->poster->getPostersCatEd();
		$idCat       = $post['cat_p'];
		$type_p      = $post['type_p'];
		$foto_name   = $post['foto_p1'];
		$post['fotoN']   = $post['foto_p1'];
		$post['foto_p1'] = "/posterFoto/".$post['foto_p1'];
		$typePost    = $this->poster->getAllTypePost();
		$typePost[0] = $typePost[$type_p];
		$cat         = $this->poster->getPostersByCat($idCat);
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
	        if ($type == 0) $type = $type_p;
	        if (!empty($_FILES['file']['tmp_name'])) {
	            $jpg   = explode('.', $_FILES['file'] ['name']);
	            $fotoN = $id.'.'.$jpg[count($jpg)-1];
				$fotoN = $this->savePhoto($fotoN,ROOT."/posterFoto",date("y",strtotime($post['date_p'])), date("m",strtotime($post['date_p'])));
				$res   = $this->poster->updateFoto($id,$fotoN);
	        } else {
	            if ($FotoDel == 1) {
	                    $result = $this->poster->changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,"");
	                    $res = $this->delFile($foto_name,"posterFoto");
	            } else {
	                    $result = $this->poster->changePoster($idm,$title_p,$cat,$type,$name,$email,$impot,$msg,$foto_name);
	            }
	        }
			header ("Location: /posterEdit/page-".$page);
		}
		require_once ('views/poster/posterEditOne.php');
		return true;
	}

	public function actionPosterVerify() {	
		$t = $this->poster->getPostersVerify();
		require_once ('views/poster/posterVerify.php');
		return true;
	}
}