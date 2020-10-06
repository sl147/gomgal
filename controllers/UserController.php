<?php

class UserController
{
	const SHOWCOMMENT_BY_DEFAULT = 25;
	
	public function actionIndex() {
		if(isset($_POST['submit'])) {
	        $login    = Auxiliary::filterTXT('post', 'login');;
	        $password = Auxiliary::filterTXT('post', 'password');
	        $errors   = false;
			$userId   = User::chekUserData($login,$password);
			if ($userId == false) {
				$errors []= "не вірний логін або пароль";
			}
			else {
				$user = User::getUserByLogin($login);
				$res  = User::setcookie($login,$user['name'],$user['admin']);
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
			$login    = Auxiliary::filterTXT('post', 'login');
			$password = md5(md5(trim(Auxiliary::filterTXT('post', 'password'))));
			$name     = Auxiliary::filterTXT('post', 'name');
			$surname  = Auxiliary::filterTXT('post', 'surname');
			$email    = Auxiliary::filterEmail('post', 'email');
			$result   = User::createUser($login,$password,$name,$surname,$email);
			$subject  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
			$to       = "sl147@ukr.net";
			$massage  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
			$res      = Auxiliary::sendMail($subject,$to,$massage);
			$res      = User::setcookie($login,$name,0);
					
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
		$userCurrent = User::userCurr();
		if ($userCurrent) {
			if(isset($_POST['submit'])) {
				$login    = $userCurrent['user_login'];
				$password = md5(md5(trim(Auxiliary::filterTXT('post', 'password'))));
				$name     = Auxiliary::filterTXT('post', 'name');
				$surname  = Auxiliary::filterTXT('post', 'surname');
				$email    = Auxiliary::filterEmail('post', 'email');
				$result   = User::changeUser($login,$name,$surname,$email);
				$subject  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
				$to       = "sl147@ukr.net";
				$massage  = "Новий відвідувач www.gomgal.lviv.ua ".$name;
				$res      = Auxiliary::sendMail($subject,$to,$massage);
				$res      = User::setcookie($login,$name,0);
						
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
		$page       = Auxiliary::getIntval($page);		
		$title      = "перегляд новин клієнтів";
		$total      = Auxiliary::getCount('ComCl');
		$comms      = User::getUsersComments($page);
		$pagination = new Pagination($total, $page, SHOWCOMMENT_BY_DEFAULT, 'page-');
		
		require_once ('views/user/userNews.php');
		return true;
	}

	public function actionUserWishes($page = 1) {
		$page       = Auxiliary::getIntval($page);		
		$title      = "перегляд побажань клієнтів";
		$total      = Auxiliary::getCount('wishCl');
		$comms      = User::getUsersWishes($page);

		require_once ('views/user/userWishes.php');
		return true;
	}

}	
?>