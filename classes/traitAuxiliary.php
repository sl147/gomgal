<?php

/**
 *  traitAuxiliary
 */

trait traitAuxiliary {

	public function formSql($atr,$value) {
		return " WHERE ".$atr." = '".$value."'";
	}

	public function formSql2($atr1,$value1,$atr2,$value2) {
		return " WHERE (".$atr1." = '".$value1."') AND (".$atr2." = '".$value2."')";
	}

	public function getIntval ($i) : int {
        return intval($i) ? intval($i) : 1;
	}

	public function getCount($table) {
		$getDB  = new classGetDB();
		$result = $getDB->getDB("SELECT count(*) as count FROM ".$table);
		unset($getDB);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getCountAtr($table, $atr, $value) {
		$getDB  = new classGetDB();
		$result = $getDB->getDB("SELECT count(*) as count FROM ".$table.self::formSql($atr,$value));
		unset($getDB);
		$result -> setFetchMode(PDO::FETCH_ASSOC);

		return $result->fetch()['count'];
	}

	public function filterINT($type, $field) {
		switch($type) {
			case 'get':
			$field = filter_input(INPUT_GET, $field, FILTER_VALIDATE_INT);
			break;

			case 'post':
			$field = filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT); 
			break;

			default:
			break;
		}

		return $field;
	}

	public function filterTXT($type, $field) {
		switch($type) {
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
			break;

			default:
			break;
		}

		return $output;
	}



	public function filterEmail($type, $field) {

		switch($type) {
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_EMAIL);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL); 
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL); 
			break;

			default:
			break;
		}
		return $output;
	}



	public function rus2translit($string) {

	    $converter = array(
	        'а' => 'a',   'б' => 'b',   'в' => 'v',
	        'г' => 'g',   'д' => 'd',   'е' => 'e',
	        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
	        'и' => 'i',   'й' => 'y',   'к' => 'k',
	        'л' => 'l',   'м' => 'm',   'н' => 'n',
	        'о' => 'o',   'п' => 'p',   'р' => 'r',
	        'с' => 's',   'т' => 't',   'у' => 'u',
	        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
	        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
	        'ь' => "",    'ы' => 'y',   'ъ' => "",
	        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
	        'А' => 'A',   'Б' => 'B',   'В' => 'V',
	        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
	        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
	        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
	        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
	        'О' => 'O',   'П' => 'P',   'Р' => 'R',
	        'С' => 'S',   'Т' => 'T',   'У' => 'U',
	        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
	        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
	        'Ь' => "",    'Ы' => 'Y',   'Ъ' => "",
	        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	        ' ' => '_',   'і' => 'y',   'І' => 'Y',
	        'ї' => 'yi',  'Ї' => 'YI',  "'" => '',
	        '"' => ''
	    );
	    return strtr($string, $converter);		
	}

	public function makeDir($path) {
		if (!file_exists($path)) {
			return (!mkdir($path,0755, true)) ? false : true;	
		}
		return true;				
	}

	private function changePhotoWSlash($nameFile,$pathdir) {
		include_once 'components/classSimpleImage.php';
        $fns    = $pathdir."/".$nameFile;
        $fnSmal = $pathdir."/"."s".$nameFile;
        $image  = new SimpleImage();
        $image->load($fns);
        $image->resizeToWidth(100);
        $image->resizeToHeight(100);
        $image->save($fnSmal);
        unset($image);  
	}

    public function savePhoto($nameFile, $pathdir,$year, $month) {
    	$pathdir .= '/'.$year.'/'.$month;
        $res      = $this->makeDir($pathdir);
        move_uploaded_file ($_FILES['file'] ['tmp_name'],$pathdir."/".$nameFile); 
        $destination = $this->webpImage($pathdir."/".$nameFile);
		unlink($pathdir."/".$nameFile);
        return $year.'/'.$month.'/'.$this->convertNameToWebp($destination);
    }

	private function getPathFile($file,$folder,$delim="") {
		return "./".$folder."/".$delim.$file;
	}

	public function delFile($file,$folder) {

		$fdel = $this->getPathFile($file,$folder);
		$str   = explode( '/', $file );
		$fileS = '';
		for ($i=0; $i < count($str)-1; $i++) { 
			$fileS .= $str[$i].'/';
		}
		$fileS .= 's_'.basename($file);
		$fdelS  = $this->getPathFile($fileS,$folder);

		if (file_exists($fdel))  unlink($fdel);
		if (file_exists($fdelS)) unlink($fdelS);
	}
	
	private function webpImage($source, $quality = 100, $removeOld = false) {
        $pathdir     = pathinfo($source, PATHINFO_DIRNAME);
        $name        = pathinfo($source, PATHINFO_FILENAME);
        $destination = $pathdir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info        = getimagesize($source);
        $isAlpha     = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        return $destination;
    }

    private function convertNameToWebp($filename) {
    	$name = pathinfo($filename, PATHINFO_FILENAME);
    	return $name . '.webp';
    }

	public function isSpam($nik,$ip,$email,$txt) {
		$spams = $this->getSpam();
		foreach ($spams as $spam) {
			if (strpos($nik,   $spam["name"]) !== false) return true;
			if (strpos($txt,   $spam["name"]) !== false) return true;
			if (strpos($email, $spam["name"]) !== false) return true;
			if (strpos($ip,    $spam["name"]) !== false) return true;
		}
		return  false;
	}

	private function getSpam() {
		$getData  = new classGetData("spamTab");
		return $getData->getDataFromTable();		
	}

	public function getToken( $strength = 16) {
	$input	 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $token = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $token .= $random_character;
    }
    $_SESSION['token'] = $token;
    return $token;
}

	public function tokensMatch($token)	{
		if ( isset($_SESSION['token']) ) {
			if ( $_SESSION['token'] == $token ) return true;
		}
		return false;
	}

	public static function getIPData($ip) {
		$ch = curl_init('http://ipwhois.app/json/'.$ip);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		return json_decode($json, true);
	}

	public static function saveIPData($ipwhois_result, $width,$htpreferer) {
		$country_code = $ipwhois_result['country_code'];
		$city         = $ipwhois_result['city'];
		$sql      = "SELECT * FROM usersIP  WHERE country_code = :country_code AND city = :city AND width = :width AND htpreferer = :htpreferer";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':country_code', $country_code, PDO::PARAM_STR);
		$result -> bindParam(':city',         $city,         PDO::PARAM_STR);
		$result -> bindParam(':width',        $width,        PDO::PARAM_STR);
		$result -> bindParam(':htpreferer',   $htpreferer,   PDO::PARAM_STR);
		$result -> execute();
		$user = $result-> fetch();
		if ($user) {
			$count = $user['count'] + 1;
			$sql = "UPDATE usersIP SET count=:count WHERE id=".$user["id"];
			$result = Db::getConnection() -> prepare($sql);
			$result -> bindParam(':count', $count, PDO::PARAM_STR);	
		}
		else {
			$sql = "INSERT INTO usersIP (country_code,city,width,htpreferer)
			 VALUES(:country_code,:city,:width,:htpreferer)";
			$result = Db::getConnection() -> prepare($sql);
			$result -> bindParam(':country_code', $country_code, PDO::PARAM_STR);
			$result -> bindParam(':city',         $city,         PDO::PARAM_STR);
			$result -> bindParam(':width',        $width,        PDO::PARAM_STR);
			$result -> bindParam(':htpreferer',   $htpreferer,   PDO::PARAM_STR);
		}
		return $result -> execute();
	}

	public function getMetaKeywords($text, $cat1="",$cat2="") {
		$arrStr   = explode(".", $text);// текст оголошення по словах по крапках
		$keywords = '';
		foreach ($arrStr as $strArr) { // слово
			$arrTxt = explode(" ", $strArr);
			foreach ($arrTxt as $value) {
				$str = "";
				$add = false;
				for ($i = 0; $i < mb_strlen($value, 'UTF-8'); $i++) {
				    $symbol = mb_substr($value, $i, 1, 'UTF-8');				    
				    if (ord($symbol) > 47) {
						$str .= $symbol;
						$add = true;
					}
				}
				if ((mb_strlen($str, 'UTF-8') > 2) && ($add)) $keywords .= $str.", ";
				if (mb_strlen($keywords, 'UTF-8') > 100) return $keywords.GOMGAL;
			}
		}
		if (!(empty($cat1))) $keywords .= $this->newsClass->getCatEl($cat1)['namecm'].', ';		
		if (!(empty($cat2))) $keywords .= $this->newsClass->getCatEl($cat2)['namecm'].', ';

		return $keywords.GOMGAL;
	}

	public function getMetaTitle($title) {
		return mb_substr($title,0,55,'UTF-8').GOMGAL;
	}

	private function getMeta() {
		$mt = new MetaTags();	
		$a  = explode("/",trim($_SERVER["REQUEST_URI"],'/'));
		$b  = $mt->getMTagsByUrl($a[0]);
		return $b;
	}

	private function getMetaWithSubSite() {
		$mt = new MetaTags();	
		$a  = explode("/",trim($_SERVER["REQUEST_URI"],'/'));
		for ($i=0; $i < count($a); $i++) { 
			if ($i > 0 ) {$b .= "/".$a[$i];}
			else {$b = $a[$i];}
		}
		$c = $mt->getMTagsByUrl($b);
		return $c;
	}

	public function plusClickButton($type) {
		$getData  = new classGetData("countClickButton");
		$result = $getData->getDataFromTableByNameFetch ($type,"id_button");
		if ($result) {
			$count = $result["count"] + 1;
			return $getData->updateDataFromTableByName ($type, "id_button", $count,"count");
		}
		else {
			return $getData->insertDataToTableByName ($type, "id_button","count");
		}
	}

	public function getCountClickButton() {
		$sql = "SELECT Type.id, Type.name, Count.count FROM typeButton AS Type LEFT JOIN countClickButton AS Count ON Count.id_button = Type.id ORDER BY Type.id";
		return Db::getConnection() -> query($sql);
	}

	public function sendMail($subject,$to,$massage) {
		$indicesServer = array('PHP_SELF',
			'argv',
			'argc',
			'GATEWAY_INTERFACE',
			'SERVER_ADDR',
			'SERVER_NAME',
			'SERVER_SOFTWARE',
			'SERVER_PROTOCOL',
			'REQUEST_METHOD',
			'REQUEST_TIME',
			'REQUEST_TIME_FLOAT',
			'QUERY_STRING',
			'DOCUMENT_ROOT',
			'HTTP_ACCEPT',
			'HTTP_ACCEPT_CHARSET',
			'HTTP_ACCEPT_ENCODING',
			'HTTP_ACCEPT_LANGUAGE',
			'HTTP_CONNECTION',
			'HTTP_HOST',
			'HTTP_REFERER',
			'HTTP_USER_AGENT',
			'HTTPS',
			'REMOTE_ADDR',
			'REMOTE_HOST',
			'REMOTE_PORT',
			'REMOTE_USER',
			'REDIRECT_REMOTE_USER',
			'SCRIPT_FILENAME',
			'SERVER_ADMIN',
			'SERVER_PORT',
			'SERVER_SIGNATURE',
			'PATH_TRANSLATED',
			'SCRIPT_NAME',
			'REQUEST_URI',
			'PHP_AUTH_DIGEST',
			'PHP_AUTH_USER',
			'PHP_AUTH_PW',
			'AUTH_TYPE',
			'PATH_INFO',
			'ORIG_PATH_INFO'
		) ;
        $massage .= "\r\n";

		return $this->mailing($to,$subject,$massage);
	}

	private function mailing ($to,$subject,$massage) {
		$from    = "info@gomgal.lviv.ua";
		$headers = "From: $from\r\nReplay-To: $from\r\nContent-Type: text/plain; charset=utf-8\r\n ";
		return mail($to,$subject,$massage,$headers);
	}

	private function formMailToSend($mass,$txt) {
		$width   = (isset($_COOKIE['sw'])) ? $_COOKIE['sw'] : 1000;
		$ip      = $_SERVER['REMOTE_ADDR'];
		$getIPData = $this->getIPData($ip);
        $massage = $mass;
        $subject = $massage;
        $subject .= ($width < 993) ? " із мобільного" : '';
        $massage .= "з країни ".$getIPData['country_code']." з міста ".$getIPData['city']."\r\n";
        $massage .= 'ширина екрану: '.$width."\r\n";
        $massage .= $txt.$_SERVER['HTTP_REFERER']."\r\n";

        if (!empty($_SERVER['HTTP_REFERER'])) $send = $this->sendMail($subject,SLMAIL,$massage);
	}

	public function formMail($mass) {
		$txt  = 'перехід з сайту: ';
		$mass = "перехід на ".$mass."\r\n";
		$send = $this->formMailToSend($mass, $txt);
	}

	public function formMailComment($type,$nik,$text) {
		$typeC  = new classGetData('typeCalculator');
		$ins    = new Insurance();
		$ip     = $_SERVER['REMOTE_ADDR'];
        $result = $ins->saveComment($type,$nik,$text,$ip);
        $txt    = 'Новий коментар: ';
		$mass   = "Новий коментар: \r\n";
		$send   = $this->formMailToSend($mass, $txt);
	}

	public function mailToClient($email,$subject) {
		if ($email) {
			$massage = $subject." Завжди раді зустрічі з Вами на нашому сайті https://www.gomgal.lviv.ua/";
			$mail    = $this->mailing($email,$subject,$massage);
		}
	}

	private function check_index_page ( $page, $total, $show ) :int {
		$page = $this->getIntval($page);
		return (int) ($page > ( ($total / $show) + 1 )) ? 1 : $page;
	}
}