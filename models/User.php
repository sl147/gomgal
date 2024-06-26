<?php

/**
* 
*/

class User extends classGetDB {

	public function __construct() {
		$this->friends = new classGetData('friends');
	}

	private function userGetData( string $table, string $nameID, int $page ) {
		$getData = new classGetData($table);
		return $getData->selectDataFromTable( array(), $nameID, SHOWCOMMENT_BY_DEFAULT, 'DESC', true, false, false, true, $page);
	}

	public function getUsersComments( int $page ) {
		return $this->userGetData( 'ComCl', 'id', $page );
	}

	public function getUsersWishes( int $page) {
		return $this->userGetData( 'wishCl', 'id_com', $page );
	}

	public function createUser( string $login, string $password, string $name, string $surname, string $email){
		$names  = ['user_login', 'user_password', 'name', 'surname', 'email'];
		$values = [$login, $password, $name, $surname, $email];
		$this->friends->insertDataToTable( $values, $names);
	}

	public function changeUser( string $login, string $name, string $surname, string $email) {
		$args = array(
			'name'    => $name,
			'surname' => $surname,
			'email'   => $email
		);
		$this->friends->updateDataInTable( $args, array('user_login'=>$login));
	}

	public function chekUserData ( string $login, string $password) {
		$userCurrent = $this->getUserByLogin($login);
		if (empty($userCurrent)) return false;
		if ($userCurrent['id'] < 10) {
			$password = md5(md5(trim($password)));
			return $this->friends->selectDataFromTable( array( 'user_login'=>$login, 'user_password'=>$password), "", 0, 'DESC', false, false, true);
		}else{
			$user = $this->friends->selectDataFromTable( array( 'user_login'=>$login), "", 0, 'DESC', false, false, true);
			if($user) return (password_verify($password, $user['user_password'])) ? $user['id'] : false;
		}
		return false;
	}

	public function getUserByLogin( string $login) {
		return $this->friends->selectDataFromTable( array( 'user_login'=>$login), "", 0, 'DESC', false, false, true) ?? [];
	}

	public function getUserNameById( int $id) {
		$user = $this->friends->selectDataFromTable( array('id' => $id ), "", 0, 'DESC', false, false, true);
		return $user['name'] . ' ' . $user['surname'];
	}

	public static function setcookie ( string $login, string $name, int $admin) {
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
		return $this->friends->selectDataFromTable( array(), "");
	}
}