<?php

class UserController
{
	use traitAuxiliary;

	const SHOWCOMMENT_BY_DEFAULT = 25;
	
	public function actionIndex() {
		if(isset($_POST['submit'])) {
			$userCl   = new User();
	        $login    = $this->filterTXT('post', 'login');;
	        $password = $this->filterTXT('post', 'password');
	        $errors   = false;
			$userId   = $userCl->chekUserData($login,$password);
			if ($userId == false) {
				$errors []= "не вірний логін або пароль";
			}
			else {
				$user = $userCl->getUserByLogin($login);
				$res  = $userCl->setcookie($login,$user['name'],$user['admin']);
				if ($user['admin'] == 1) {
					header("Location:/newsEdit"); exit();
				}
				else { 
					header("Location: /"); exit();			
				}
			}
		}

		$siteFile = 'views/user/index.php';
		$metaTags = '';
		require_once ('views/layouts/siteIndex.php');
		return true;
	}

	public function actionAuthor() {
		if(isset($_POST['submit'])) {
			$aux = new Auxiliary();
			$userCl = new User();
			$login    = $this->filterTXT('post', 'login');
			$password = md5(md5(trim($this->filterTXT('post', 'password'))));
			$name     = $this->filterTXT('post', 'name');
			$surname  = $this->filterTXT('post', 'surname');
			$email    = $this->filterEmail('post', 'email');
			$result   = $userCl->createUser($login,$password,$name,$surname,$email);
			$subject  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
			$to       = "sl147@ukr.net";
			$massage  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
			$res      = $aux->sendMail($subject,$to,$massage);
			$res      = $userCl->setcookie($login,$name,0);
			unset($userCl);
			unset($aux);		
			header("Location: /"); exit();
		}

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
		$userCl = new User();
		$aux = new Auxiliary();
		$userCurrent = $userCl->userCurr();
		if ($userCurrent) {
			if(isset($_POST['submit'])) {
				$login    = $userCurrent['user_login'];
				$password = md5(md5(trim($this->filterTXT('post', 'password'))));
				$name     = $this->filterTXT('post', 'name');
				$surname  = $this->filterTXT('post', 'surname');
				$email    = $this->filterEmail('post', 'email');
				$result   = $userCl->changeUser($login,$name,$surname,$email);
				$subject  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
				$to       = "sl147@ukr.net";
				$massage  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
				$res      = $aux->sendMail($subject,$to,$massage);
				$res      = $userCl->setcookie($login,$name,0);
				unset($userCl);
				unset($aux);
				header("Location: /"); exit();
			}

			$siteFile = 'views/user/changeData.php';
			$metaTags = '';
			require_once ('views/layouts/siteIndex.php');
			return true;
		}
		else {
			header("Location: /");
		}
	}

	public function actionUserComment($page = 1) {
		$page       = $this->getIntval($page);		
		$title      = "перегляд новин клієнтів";
		$total      = Auxiliary::getCount('ComCl');
		$comms      = User::getUsersComments($page);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');
		
		require_once ('views/user/userNews.php');
		return true;
	}

	public function actionUserWishes($page = 1) {	
		$title      = "перегляд побажань клієнтів";
		$total      = Auxiliary::getCount('wishCl');
		$comms      = User::getUsersWishes($this->getIntval($page));

		require_once ('views/user/userWishes.php');
		return true;
	}

}	
?>