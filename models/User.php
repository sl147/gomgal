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
		$offset  = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$comList = $getData->getDataByOffset ($nameID,SHOWCOMMENT_BY_DEFAULT,$offset);
		unset($getData);
		return $comList ?? [];
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
		return $this->friends->getDataFromTableByNameFetch ($login,'user_login') ?? [];
	}

	public function getUserNameById($id) {
		$user  = $this->friends->getDataFromTableByNameFetch ($id,'id');
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

/*	public static function getAllUserNewsVue($page = 1) {
		require_once ('../models/Auxiliary.php');
		$MK     = new Auxiliary();
		$page   = $MK ->getIntval($page);
		$offset = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$sql    = "SELECT * FROM ComCl ORDER BY id DESC LIMIT ".SHOWCOMMENT_BY_DEFAULT." OFFSET $offset";
		$result = $MK ->getSQLVue($sql);
		while ($row = $result->fetch()) {
			$list[] = $row;
		}
		unset($MK);
		return $list ?? [];
	}*/
}