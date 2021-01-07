<?php
/**
 *  traitAuxiliary
 */

trait traitAuxiliary
{
	public function formSql($atr,$value)
	{
		return " WHERE ".$atr." = '".$value."'";
	}

	public function formSql2($atr1,$value1,$atr2,$value2)
	{
		return " WHERE (".$atr1." = '".$value1."') AND (".$atr2." = '".$value2."')";
	}

	public function getIntval ($i) : int
	{
        return intval($i) ?? 1;
	}

	public function getCount($table)
	{
		$getDB  = new classGetDB();
		$result = $getDB->getDB("SELECT count(*) as count FROM ".$table);
		unset($getDB);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function getCountAtr($table, $atr, $value)
	{
		$getDB  = new classGetDB();
		$result = $getDB->getDB("SELECT count(*) as count FROM ".$table.self::formSql($atr,$value));
		unset($getDB);
		$result -> setFetchMode(PDO::FETCH_ASSOC);

		return $result->fetch()['count'];
	}

	private function mailing ($to,$subject,$massage)
	{
		$from    = "info@gomgal.lviv.ua";
		$headers = "From: $from\r\nReplay-To: $from\r\nContent-Type: text/plain; charset=utf-8\r\n ";
		return mail($to,$subject,$massage,$headers);
	}

	public function sendMailToClient($subject,$to,$massage)
	{
		return $this->mailing($to,$subject,$massage);
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

		foreach ($indicesServer as $arg) {
			$massage .= $arg.':';
		    $massage .= (isset($_SERVER[$arg])) ? $_SERVER[$arg]."\r\n" : "--\r\n";
		}
		return $this->mailing($to,$subject,$massage);
	}
	
	public function filterINT($type, $field)
	{
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_INT);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT); 
			break;

			default:
			break;
		}
		return $output;
	}

	public function filterTXT($type, $field)
	{
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 
			break;

			default:
			break;
		}

		return $output;
	}

	public function filterEmail($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_EMAIL);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL); 
			break;

			default:
			break;
		}
		return $output;
	}

	public function rus2translit($string)
	{
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
	        'ї' => 'yi',  'Ї' => 'YI',
	    );
	    return strtr($string, $converter);		
	}

	public function makeDir($path)
	{
		if (!file_exists($path)) {
			return (!mkdir($path,0755, true)) ? false : true;	
		}
		return true;				
	}

	private function changePhoto($nameFile,$pathdir)
	{
		include_once 'components/classSimpleImage.php';
        $fns    = $pathdir."/".$nameFile;
        $fnSmal = $pathdir."/"."s".'_'.$nameFile;
        $image  = new SimpleImage();
        $image->load($fns);
        $image->resizeToWidth(100);
        $image->resizeToHeight(100);
        $image->save($fnSmal);
        unset($image);  
	}

    public function savePhoto($nameFile, $pathdir,$year, $month)
    {
    	$pathdir .= '/'.$year.'/'.$month;
        $res      = $this->makeDir($pathdir);
        move_uploaded_file ($_FILES['file'] ['tmp_name'],$pathdir."/".$nameFile); 
        $res = $this->changePhoto($nameFile,$pathdir);
        return $year.'/'.$month.'/'.$nameFile;             
    }

    public static function savePhotoS($nameFile,$pathdir)
    {      
        $res = $this->makeDir($pathdir);
        $res = $this->changePhoto($nameFile,$pathdir);    
    }

	private function getPathFile($file,$folder,$delim="")
	{
		return "./".$folder."/".$delim.$file;
	}

	public function delFile($file,$folder)
	{
		$fdel = $this->getPathFile($file,$folder);		
		$str  = explode( '/', $file );
		$file = '';
		for ($i=0; $i < count($str)-1; $i++) { 
			$file .= $str[$i].'/';
		}
		$file .= 's_'.$str[count($str)-1];
		$fdelS = $this->getPathFile($file,$folder);
		if (Auxiliary:: isFile($fdel))  unlink($fdel);
		if (Auxiliary:: isFile($fdelS)) unlink($fdelS);
	}
}
?>