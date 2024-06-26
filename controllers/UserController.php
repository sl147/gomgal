<?php


class UserController {

	use traitAuxiliary;

	public function __construct() {
		$this->user = new User();
	}
	public function actionIndex() {
		if(isset($_POST['submit'])) {
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {
		        $login    = $this->filterTXT('post', 'login');;
		        $password = $this->filterTXT('post', 'password');
		        $errors   = false;
				$userId   = $this->user->chekUserData($login,$password);
				if ($userId == false) $errors []= "не вірний логін або пароль"; 
				else {
					$user = $this->user->getUserByLogin($login);
					$res  = $this->user->setcookie($login,$user['name'],$user['admin']);
					if ($user['admin'] == 1) {
						header("Location:/newsEdit");
						 exit();
					} else { 
						header("Location: /"); exit();			
					}
				}				
			}else {
				$subject = "haks зі сторінки логування";
				$massage = $subject;
				$mail    = $this->mailing(SLMAIL, $subject, $massage);
			}
		}
		$token = $this->getToken();
		$siteFile = 'views/user/index.php';
		$meta     = $this->getMeta();
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionAuthor() {
		if(isset($_POST['submit'])) {
			if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {
				$login    = $this->filterTXT('post', 'login');
				$password = password_hash(trim($this->filterTXT('post', 'password')), PASSWORD_DEFAULT);
				$name     = $this->filterTXT('post', 'name');
				$surname  = $this->filterTXT('post', 'surname');
				$email    = $this->filterEmail('post', 'email');
				$result   = $this->user->createUser($login,$password,$name,$surname,$email);
				$res      = $this->user->setcookie($login,$name,0);
				$subject  = "Новий користувач на сайті ".$name;
				$mail     = $this->mailing(BanMAIL, $subject, $subject);		
			}else {
				$subject = "haks зі сторінки реєстрації";
			}
			$massage = $subject;
			$mail    = $this->mailing(SLMAIL, $subject, $massage);
			header("Location: /"); exit();
		}
		$token    = $this->getToken();
		$siteFile = 'views/user/author.php';
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionUnreg() {
		if (isset($_COOKIE['user'])) {
			setcookie ("user",'', time() - 3600);
			header("Location: /"); exit();
		}
	}

	public function actionChangeData() {
		$userCurrent = $this->user->userCurrent();
		if ($userCurrent) {
			if(isset($_POST['submit'])) {
				if (!empty($_POST['_token']) && $this->tokensMatch($_POST['_token'])) {
					$login    = $userCurrent['user_login'];
					$password = ($userCurrent['id'] < 10) ? md5(md5(trim($this->filterTXT('post', 'password')))) : password_hash(trim($this->filterTXT('post', 'password')),PASSWORD_DEFAULT);
					$name     = $this->filterTXT('post', 'name');
					$surname  = $this->filterTXT('post', 'surname');
					$email    = $this->filterEmail('post', 'email');
					$result   = $this->user->changeUser($login,$name,$surname,$email);
					$res      = $this->user->setcookie($login,$name,0);
					$subject  = "Редагування даних відвідувача ".$name;
					$mail     = $this->mailing(BanMAIL, $subject, $massage);
				} else {
					$subject = "haks зі сторінки редагування даних";
				}
				$massage = $subject;
				$mail    = $this->mailing(SLMAIL, $subject, $massage);
				header("Location: /"); exit();
			}
			$token = $this->getToken();
			$siteFile = 'views/user/changeData.php';
			$metaTags = '';
			require_once ('views/layouts/siteIndex.php');
			return true;
		} else {
			header("Location: /");
		}
	}

	private function view_Comment_Wishes(  $page = 1, string $title, array $comms, string $table, string $file) {
		$getDB      = new classGetData( $table );
		$total      = $getDB->selectCount( false);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');
		require_once ($file);
		return true;
	}

	public function actionUserComment( $page = 1) {
		$this->view_Comment_Wishes(
			$page,
			"перегляд новин клієнтів",
			$this->user->getUsersComments($this->getIntval($page)),
			'ComCl',
			'views/user/userNews.php'
		);
		return true;
	}

	public function actionUserWishes( $page = 1) {
		$this->view_Comment_Wishes( 
			$page,
			"перегляд побажань клієнтів",
			$this->user->getUsersWishes($this->getIntval($page)),
			'wishCl',
			'views/user/userWishes.php'
		);
		return true;
	}

	public function actionUsersView() {
		$users = $this->user->getUsers();
		require_once ('views/user/userView.php');
		return true;
	}
}