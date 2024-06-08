<?php

/**
* 
*/

class User extends classGetDB {

	public function __construct() {
		$this->friends = new classGetData('friends');
	}

	private function getData($table, $nameID, $page) {
		$getData = new classGetData($table);
		return $getData->selectOrderPage ( SHOWCOMMENT_BY_DEFAULT, $page, $nameID, 'DESC', true );
	}

	public function getUsersComments($page) {
		return $this->getData('ComCl','id',$page);
	}

	public function getUsersWishes($page) {
		return $this->getData('wishCl','id_com',$page);
	}

	public function createUser($login,$password,$name,$surname,$email){
		$names  = ['user_login', 'user_password', 'name', 'surname', 'email'];
		$values = [$login, $password, $name, $surname, $email];
		$this->friends->insertDataToTable( $values, $names);
	}

	public function changeUser($login,$name,$surname,$email) {
		$args = array(
			'name'    => $name,
			'surname' => $surname,
			'email'   => $email
		);
		$this->friends->updateDataInTable( $args, $login, 'user_login');
	}

	public function chekUserData ($login,$password) {
		$userCurrent = $this->getUserByLogin($login);
		if (empty($userCurrent)) return false;
		if ($userCurrent['id'] < 10) {
			$password = md5(md5(trim($password)));
			$sql      = "SELECT * FROM friends  WHERE user_login = '".$login."' AND user_password = '".$password."'";
			$result   = $this->getDB ($sql);
			$user     = $result-> fetch();
			return $user['id'] ?? false;
		}else{
			$sql      = "SELECT * FROM friends  WHERE user_login = '".$login."'";
			$result   = $this->getDB ($sql);
			$user     = $result-> fetch();
			if($user) return (password_verify($password, $user['user_password'])) ? $user['id'] : false;
		}
		return false;
	}

	public function getUserByLogin($login) {
		return $this->friends->selectDataFromTableWHEREFetch( array('user_login' => $login ) ) ?? [];
	}

	public function getUserNameById($id) {
		$user = $this->friends->selectDataFromTableWHEREFetch( array('id' => $id ) );
		return $user['name'] . ' ' . $user['surname'];
	}

	public static function setcookie ($login,$name,$admin) {
		$user = array ( 
			   'login'=> $login,
			   'name' => $name,
			   'admin'=> $admin);
		setcookie ("user", serialize($user), time() + 3600);
	}

	public static function isGuest() {
		return (isset($_COOKIE["user"])) ? unserialize($_COOKIE["user"]) : false;
	}

	public function userCurrent() {
		if (self::isGuest()) {
			return $this->getUserByLogin(self::isGuest()['login']);
		}
		return false;
	}

	public function getUsers() {
		return $this->friends->selectFromTable();	
	}
}