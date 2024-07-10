<?php


class NewsController {	

	use traitAuxiliary;

	public $newsClass;

	public function __construct() {
		$this->newsClass = new News();
	}

	private function addFilesSubFolder3($folder){
		echo "<br>folder3:".$folder;
		return true;
	}
	private function addFilesSubFolder2 ($folder, $NewsList) {
		echo "<br>folder2:".$folder;
		$files = scandir($folder);
		$j = 0;
		for ($i=0; $i < count($files); $i++) {
			if ( ($files[$i] == '.') || ($files[$i] == '..') ) continue;
			if ( is_dir($folder.'/'.$files[$i]) ) {
				$arr = $this->addFilesSubFolder3($folder.'/'.$files[$i]);
			}else{
				if ( !in_array( $files[$i], $NewsList)){
					echo "<br>".$folder." : ".$files[$i];
					$j ++;
					$arr[$j] =$folder.'/'.$files[$i];
				}
			}		
		}
		return $arr;
	}

	private function addFilesSubFolder1 ($folder, $NewsList) {
		echo "<br>folder1:".$folder;
		$files = scandir($folder);
		$j = 0;
		for ($i=0; $i < count($files); $i++) {
			if ( ($files[$i] == '.') || ($files[$i] == '..') ) continue;
			if ( is_dir($folder.'/'.$files[$i]) ) {
				$arr = $this->addFilesSubFolder2($folder.'/'.$files[$i], $NewsList);
			}			
		}
		return $arr;
	}

	public function actionCheckFilesNews() {
		$getData = new classGetData('msgs');
		$result  = $getData->selectDataFromTable( array(), "", 0, 'DESC', false);
		unset($getData);

		$i       = 1;
		while ($row = $result->fetch()) {
			$NewsList[$i]['id']        = $row['id'];
			$NewsList[$i]['top']       = $row['top'];
			$NewsList[$i]['title']     = ucfirst (mb_strtolower ($row['title'], 'UTF-8'));
			$NewsList[$i]['titleengl'] = $row['titleengl'];
			$NewsList[$i]['datetime']  = $row['datetime'];
			$NewsList[$i]['fotoF']     = $row['foto'];
			$NewsList[$i]['foto']      = "NewsFoto/".$row['foto'];
			$i++;
		}

		$news  = [];
		$j = 0;
foreach ($NewsList as $item) {
	if ( ! empty($item['foto'])) {
		
		if ( ! file_exists( $item['foto'])) {
			$j ++;
			$news[$j] = $item['id']; 
		}
/*		$new_item = array (
			'id'    => $item['id'],
		'photo'     => $item['photo']
		);
		array_push($data, $new_item);*/
	}
}
require_once ('views/news/checkFiles.php');

/*		$files = scandir('NewsFoto');
		$j = 0;
		$news = [];
		for ($i=0; $i < count($files); $i++) { 
			if ( ($files[$i] == '.') || ($files[$i] == '..') ) continue;
			if ( is_dir("NewsFoto/".$files[$i]) ) {
				$arr = $this->addFilesSubFolder1("NewsFoto/".$files[$i], $NewsList);
				$news = array_merge($news, $arr);
				$j = count($news) - 1;
				continue;
			}
			
			if ( !in_array( $files[$i], $NewsList)){
				$j ++;
				$news[$j] =$files[$i];
 			}
		}
		sort($news);
		require_once ('views/news/checkFiles.php');*/
		return true;	
	}

	private function getSubmit(int $id, OBJECT $com) {
		$txt_com   = $this->filterTXT('post','txt_com');
		$nik_com   = $this->filterTXT('post','nik_com');
		$email_com = $this->filterEmail('post','email_com');
		if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {			
			$ip_com  = $_SERVER['REMOTE_ADDR'];
			if ($com->insComment($id,$txt_com,$nik_com,$email_com,$ip_com)) {
				$this->mailToClient($email_com,'Дякуєм за Ваш коментар.');
				$subject = "Новий коментар до id=".$id." ip=".$ip_com;
				$massage = "Новий коментар з ".$_SERVER['HTTP_REFERER']."\r\n Для затвердження перейдіть за посиланням https://www.gomgal.lviv.ua/newsCommentEdit"; 
				$mail    = $this->mailing(BanMAIL, $subject, $massage);
				$mail    = $this->mailing(SLMAIL, $subject, $massage);
			}
		}
		else {
			$subject = "haks зі сторінки fullnew";
			$massage = $subject." https://www.gomgal.lviv.ua/Fullnewsfile.php?newsid=".$id."\r\n".$txt_com."\r\n".$nik_com."\r\n".$email_com;				
			$mail = $this->mailing(SLMAIL, $subject, $massage);
		}	
	}

	public function actionIndex($cat=1, $page = 1) {
		$cat        = $this->getIntval($cat);
		$page       = $this->getIntval($page);
		$mt         = new MetaTags();
		$month      = date('n');
		$year       = date('Y');
		$topNews    = $this->newsClass->getNewsTop();
		$total      = $this->newsClass->getTotalNews( $month, $year, $cat);
		$allNewscat = $this->newsClass->getLatestNewsCat($cat, $month, $year, $page);
		if( empty($allNewscat)) return;		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$meta       = $mt->getMTagsByUrl('main');
		$meta['title'] .= '|'.$this->newsClass->getCatEl($cat)['namecm'];
		$var        = 1;
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionArchive($month, $year, $page = 1)	{
		$page       = $this->getIntval($page);
		$topNews    = $this->newsClass->getNewsTop();
		$total      = $this->newsClass->getTotalNews($month, $year);
		$allNewscat = $this->newsClass->getLatestNews($month, $year, $page);		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
		$metaTags   = 'news';
		$var        = 1;
		$siteFile   = 'views/news/index.php';
		require_once ('views/layouts/siteIndex.php');
		unset($pagination);
		return true;
	}

	public function actionFullnew($id) {
		$mt   = new MetaTags();
		$com  = new Comment();
		$id   = $this->getIntval($id);

		if(isset($_POST['submit'])) $this->getSubmit($id, $com);

		$token     = $this->getToken();
		$news      = $this->newsClass->getNewsById($id);
		$newsCount = $this->newsClass->updateCountById($id,$news['countmsgs']);	
		$newsOther = $this->newsClass->newsOther($id,$news['category'],$news['cat2']);
		$comm      = $com->getCommentsById($id);
		$meta      = $mt->getMTagsByUrl('fullnew');
		$meta['title'] = $this->getMetaTitle($news['title']);
		$meta['descr'] = $news['prew'];
		$meta['keywords'] = $this->getMetaKeywords($news['title'],$news['category'],$news['cat2']);
		$fb = 'https://www.gomgal.lviv.ua/Fullnew/'.$id;
		$siteFile  = 'views/news/fullNew.php';
		unset($com);
		unset($mt);
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionnewsPrint($id) {
		$id   = $this->getIntval($id);
		$news = $this->newsClass->getNewsById($id);
		require_once ('views/news/newsPrint.php');
		return true;
	}

	public function actionNewsAdd() {
		$tPos = $this->newsClass->getCatNews();
		if(isset($_POST['submit'])) {
			$title   = $this->filterTXT('post', 'title');
			$prew    = $this->filterTXT('post', 'prew');
			$top     = isset($_POST['top']) ? 1 : 0;
			$cat     = $this->filterINT('post', 'category');
			$cat2    = $this->filterINT('post', 'category2');
			$msg     = $_POST['msg'];
			$sourse  = $this->filterTXT('post', 'sourse');
			$videoYT = $this->filterTXT('post', 'videoYT');
			$foto    = "";
			if (!empty($_FILES['file']['tmp_name'])) {
				$foto  = $this->rus2translit($_FILES['file']['name']);	
				$foto  = $this->savePhoto($foto, ROOT."/NewsFoto",date('y'),date('m'));
			}
			$res = $this->newsClass->createNews($title,$prew,$cat,$cat2,$sourse,$msg,$foto,$top,$videoYT);
		}
		require_once ('views/news/add.php');
		return true;
	}

	public function actionNewsCommentEdit($page = 1) {
		$com   = new Comment();
		$page  = $this->getIntval($page);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);

		if( (isset($_POST['submit'])) && (isset($_POST['id']))) $res = $com->delComment($this->filterTXT('post', 'id'));
		if( (isset($_POST['submit'])) && (isset($_POST['active']))) $res = $com->changeActiveComment($this->filterTXT('post', 'active'), $this->filterTXT('post', 'id_change'));
	
		$title = "перегляд коментарів клієнтів";
		$comment_t = new classGetData('Comment');
		$total = $comment_t->selectCount(false);
		$comms = $com->getComments($page);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');
		unset($com);
		require_once ('views/news/newsCommentEdit.php');
		unset($pagination);
		return true;
	}

	public function actionNewsEdit( $page = 1) {
		$page  = $this->getIntval($page);
		$msgs_t = new classGetData('msgs');
		$total = $msgs_t->selectCount(false);
		$table = array(
			'page' => $page
			);
		$json  = json_encode($table);		
		$title = "редагування новин";		
		$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT_EDIT, 'page-');
		require_once ('views/news/newsEdit.php');
		unset($pagination);
		return true;
	}

	private static function objArraySearch($array, $index, $value) {
	        foreach($array as $arrayInf) {
	        	if ($arrayInf[$index] == $value) return $arrayInf;
	        }
	        return null;
	}

	public function actionNewsEditOne($id, $page = 1) {
		$page   = $this->getIntval($page);
		$id     = $this->getIntval($id);
		$title  = "редагування новин";
		$msgs_t = new classGetData('msgs');
		if( $msgs_t->selectCount( false, array( 'id' => $id ), true, false ) ) {
			$isId    = true;
			$allNews = $this->newsClass->getNewsById($id,$page);
			$tPos    = $this->newsClass->getCatNews();
			$tPos2   = $tPos;
			$photo   = $allNews['foto'];
			$type1   = $allNews['category'];
			$type2   = $allNews['cat2'];			
			$cat1['id'] = $type1;
			$pos = $this->objArraySearch($tPos,'id',$type1);
			$cat1['name'] = $pos['name'];
			array_unshift($tPos, $cat1);
			$pos = $this->objArraySearch($tPos,'id',$type2);
			$cat2['name'] = $pos['name'];
			array_unshift($tPos2, $cat2);
			if(isset($_POST['submit'])) {
				$title   = $this->filterTXT('post', 'title');
				$prew    = $this->filterTXT('post', 'prew');
				$top     = isset($_POST['top']) ? 1 : 0;
				$cat     = $this->filterINT('post', 'category');
				$cat2    = $this->filterINT('post', 'category2');
				$msg     = $_POST['msg'];
				$sourse  = $this->filterTXT('post', 'sourse');
				$videoYT = $this->filterTXT('post', 'videoYT');
				$FotoDel = $this->filterTXT('post', 'FotoDel');
			        $cat     = ($cat   == 0) ? $type1 : $cat;
			        $cat2    = ($cat2  == 0) ? $type2 : $cat2;

			        if (!empty($_FILES['file']['tmp_name'])) {
			            $fotoL = $this->rus2translit($_FILES['file']['name']);
			            $fotoL = $this->savePhoto($fotoL,ROOT."/NewsFoto",date("y",strtotime($allNews['datetime'])), date("m",strtotime($allNews['datetime'])));
			            $res   = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,$fotoL,$top,$videoYT);
			        } else {
			            if ($FotoDel) {
			                    $res = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,"",$top,$videoYT);
			                    $res = $this->delFile($photo,"NewsFoto");
			            } else {
			            				$res = $this->newsClass->updateNews($id,$title,$prew,$cat,$cat2,$sourse,$msg,"",$top,$videoYT);
			            }
			        }
				header("Location: /newsEdit");
			}			
		} else {
			$isId    = false;
		}
		require_once ('views/news/newsEditOne.php');
		return true;
	}

	public function actionNewsEditID() {
		if(isset($_POST['submit'])) header("Location: /newsEditOne/".$this->filterINT('post', 'id'));

		require_once ('views/news/newsEditID.php');
		return true;
	}

	public function actionFindNews($page = 1) {
		if (isset($_POST['submit'])) {
			$txt_find  = $this->filterTXT('post','name_f');
			$mt         = new MetaTags();
			$page       = $this->getIntval($page);
			$month      = date('n');
			$year       = date('Y');
			$topNews    = [];
			$total      = $this->newsClass->getFindTotalNews($txt_find);
			$allNewscat = $this->newsClass->getNewsFind($txt_find);	
			$pagination = new Pagination($total, $page, SHOWNEWS_BY_DEFAULT, 'page-');
			$meta       = $mt->getMTagsByUrl('main');
			$var        = 0;
			$siteFile   = 'views/news/index.php';
			require_once ('views/layouts/siteIndex.php');
			unset($pagination);
			return true;
		}
	}

public function actionFB_SDK(){
	require_once 'facebook/vendor/autoload.php';
	$fb = new Facebook\Facebook([
  'app_id' => '553789431437151',
  'app_secret' => '8174d68853d30433d2f8f965b7605f62',
  'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // Помилка відповіді з Facebook
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // Помилка SDK Facebook
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
echo "<pre>";
var_dump($helper);
echo "</pre>";
//print_r($helper);


if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Отримайте інформацію про користувача
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'ID: ' . $user['id'];
echo 'Name: ' . $user['name'];

}
public function actionFB_SDK3(){
  //session_start();
  require_once 'facebook/vendor/autoload.php';

  Facebook\FacebookSession::setDefaultApplication('553789431437151', '8174d68853d30433d2f8f965b7605f62');
  $facebook = new Facebook\FacebookRedirectLoginHelper('www.gomgal.lviv.ua');

  try {
   if($session = $facebook->getSessionFromRedirect()) {
    $_SESSION['facebook'] = $session->getToken();
    header('Location index.php');
   }

   if(isset($_SESSION['facebook'])) {
    $session = new Facebook\FacebookSession($_SESSION['facebook']);
    $request = new Facebook\FacebookRequest($session, 'GET', '/me');
    $request = $request->execute();
    $user = $request->getGraphObject()->asArray();
   }

  } catch(Facebook\FacebookRequestException $e) {
   // если facebook вернул ошибку
  } catch(\Exception $e) {
   // Локальная ошибка
  }
}

public function actionFB_SDK4() {
	require_once 'facebook/vendor/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => '{553789431437151}',
  'app_secret' => '{8174d68853d30433d2f8f965b7605f62}',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me', '{889da2896485cd02b577322775334acf}');
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
echo 'Logged in as ' . $me->getName();
}


public function actionFB_SDK2() {
//session_start();
		require_once 'facebook/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '553789431437151',
  'app_secret' => '8174d68853d30433d2f8f965b7605f62',
  'default_graph_version' => 'v12.0',
  // Додайте довірені відомості для доступу до сторінки
  'default_access_token' => '889da2896485cd02b577322775334acf',
]);
try {
  // Параметри поста
  $params = [
    'message' => 'Це текст вашого поста',
    'link' => 'https://example.com', // Посилання на ваш сайт або іншу сторінку
    // Додаткові параметри можуть бути додані тут, відповідно до документації Graph API
  ];

  // Запит на виставлення поста на сторінці Facebook
  $response = $fb->post('/me/feed', $params);

  // Отримання ID виставленого поста
  $graphNode = $response->getGraphNode();
  echo 'Пост був опублікований з ID: ' . $graphNode['id'];
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // Помилка відповіді Graph API
  echo 'Графічний API повернув помилку: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // Помилка SDK Facebook
  echo 'Facebook SDK викинув помилку: ' . $e->getMessage();
}

/*
error_reporting(E_ALL);
ini_set("display_errors", 1);

$fb = new Facebook\Facebook([
	  'app_id' => '553789431437151', //Замените на ваш id приложения
	  'app_secret' => '8174d68853d30433d2f8f965b7605f62' ,//Ваш секрет приложения
	  'default_access_token' => '889da2896485cd02b577322775334acf',
	  ]);


$helper = $fb->getRedirectLoginHelper();*/

//Добавьте разрешение publish_actions, чтобы постить от имени пользователя, а не от имени страницы
/*$permissions = ['manage_pages','publish_pages'];

$loginUrl = $helper->getLoginUrl('https://www.gomgal.lviv.ua/main', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Вход</a>';*/


}

	public function actionFB_SDK1() {


		//session_start();
		require_once 'facebook/vendor/autoload.php';
		$fb = new \Facebook\Facebook([
		  'app_id' => '553789431437151',
		  'app_secret' => '8174d68853d30433d2f8f965b7605f62',
		  'default_graph_version' => 'v2.10',
		  //'default_access_token' => '889da2896485cd02b577322775334acf', // optional
		]);


$access_token = "889da2896485cd02b577322775334acf";
$result = $fb->api(
    '/me/feed/',
    'post',
    array('access_token' => $access_token, 'message' => 'Playing around with FB Graph..')
);
$siteFile  = 'views/news/newsFB.php';
require_once ('views/layouts/siteIndex.php');
return;
?>
<script>
  logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        alert('You are logged in & cookie set!');
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
  window.fbAsyncInit = function() {
    FB.init({
      appId: '553789431437151',
      cookie: true, // This is important, it's not enabled by default
      version: 'v2.10'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>


<?php

$helper = $fb->getCanvasHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
  exit;
}

// Logged in
echo '<h3>Signed Request</h3>';
var_dump($helper->getSignedRequest());

echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());


/*$linkData = [
  'link' => 'https://www.gomgal.lviv.ua/Fullnew/6667',
  'message' => 'User provided message',
  ];

try {
  // Returns a `Facebook\Response` object
  $response = $fb->post('/me/feed', $linkData, '889da2896485cd02b577322775334acf');
  $siteFile  = 'views/news/newsFB.php';
require_once ('views/layouts/siteIndex.php');
} catch(Facebook\Exception\ResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exception\SDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

		
$graphNode = $response->getGraphNode();*/

//require_once ('views/news/newsFB.php');

/*$siteFile  = 'views/news/newsFB.php';
require_once ('views/layouts/siteIndex.php');
		return true;*/

	}
}