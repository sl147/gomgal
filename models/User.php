<?php
/**
* 
*/
class User extends classGetDB
{

	private static function getData($table, $nameID, $page) {
		$getData = new classGetData($table);
		$offset  = ($page - 1) * SHOWCOMMENT_BY_DEFAULT;
		$comList = $getData->getDataByOffset ($nameID,SHOWCOMMENT_BY_DEFAULT,$offset);
		unset($getData);
		return $comList ?? [];
	}

	public static function getUsersComments($page) {
		return self::getData('ComCl','id',$page);
	}

	public static function getUsersWishes($page) {
		return self::getData('wishCl','id_com',$page);
	}

	public function createUser($login,$password,$name,$surname,$email) {
		$sql    = "INSERT INTO friends (user_login,user_password,name,surname,email)
		 VALUES(:login,:password,:name,:surname,:email)";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':login',    $login,    PDO::PARAM_STR);
		$result -> bindParam(':password', $password, PDO::PARAM_STR);
		$result -> bindParam(':name',     $name,     PDO::PARAM_STR);
		$result -> bindParam(':surname',  $surname,  PDO::PARAM_STR);
		$result -> bindParam(':email',    $email,    PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function changeUser($login,$name,$surname,$email) {
		$sql    = "UPDATE  friends SET email=:email, name=:name, surname=:surname WHERE user_login='".$login."'";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':name',     $name,     PDO::PARAM_STR);
		$result -> bindParam(':surname',  $surname,  PDO::PARAM_STR);
		$result -> bindParam(':email',    $email,    PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function chekUserData ($login,$password) {
		$userCl      = new User();
		$userCurrent = $userCl->getUserByLogin($login);
		$id          = $userCurrent['id'];
		if ($id < 10)
		{
			$password = md5(md5(trim($password)));
			$sql      = "SELECT * FROM friends  WHERE user_login = '".$login."' AND user_password = '".$password."'";
			$result   = $this->getDB ($sql);
			$user     = $result-> fetch();
			return $user['id'] ?? false;
		}
		else
		{
			$sql      = "SELECT * FROM friends  WHERE user_login = '".$login."'";
			$result   = $this->getDB ($sql);
			$user     = $result-> fetch();
			if($user)
			{
				return (password_verify($password, $user['user_password'])) ? $user['id'] : false;			
			}

		}
		return false;
	}
	
	public static function getUserByLogin($login) {
		$getData = new classGetData('friends');
		$result  = $getData->getDataFromTableByNameFetch ($login,'user_login');
		unset($getData);
		return $result ?? [];
	}

	public static function setcookie ($login,$name,$admin) {
		$user = array ( 
			   'login'=> $login,
			   'name' => $name,
			   'admin'=> $admin);
		$str  = serialize($user);
		setcookie ("user",$str,time() + 3600);
	}

	public static function isGuest() {
		return (isset($_COOKIE["user"])) ? unserialize($_COOKIE["user"]) : false;
	}

	public static function userCurr() {
		if (self::isGuest()) {
			$login  = self::isGuest()['login'];
			return self::getUserByLogin($login);
		}
	}

	public static function getAllUserNewsVue($page = 1) {
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
	}
}
?>