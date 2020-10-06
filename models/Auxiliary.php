<?php
/**
* 
*/
class Auxiliary {

	public function getDBVue(){
		require_once ('../components/Db.php');
		$base   = new Db();
		return $base ->getConnectionVue();
		//$db     = $base ->getConnectionVue();
		//unset($base);
		//return $db;
	}

	public static function getSQL($sql) {
		$db = Db::getConnection();
		return $db -> query($sql);
	}

	public static function getSQLVue($sql) {
		$db  = self::getDBVue();
		return $db -> query($sql);
	}

	public static function getPrepareSQL($sql) {
		$db = Db::getConnection();
		return $db -> prepare($sql);
	}

	public static function getPrepareSQLVue($sql) {
		$db  = self::getDBVue();
		return $db -> prepare($sql);
	}

	public static function getIntval ($i) {
		$i = intval($i);
        return ($i > 0) ? $i : 1;
	}

	public static function getCount($table) {
		$sql    = "SELECT count(*) as count FROM ".$table;
		$result = self::getSQL($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function getCountAtr($table, $atr, $value) {
		$value  = self::getIntval($value);
		$sql    = "SELECT count(*) as count FROM ".$table." WHERE ".$atr."=$value";
		$result = self::getSQL($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function updateVue2El ($id, $name, $tab, $nameEl, $nameId) {
		$id     = self::getIntval($id);
		$sql    = "UPDATE ".$tab." SET ".$nameEl."=:name WHERE ".$nameId."=$id";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

		public static function delVue2El($id, $tab, $nameId) {
		$id     = self::getIntval($id);
		$sql    = "DELETE FROM ".$tab." WHERE ".$nameId." = ".$id;
		$result = self::getSQLVue($sql);
		if ($tab == "poster") {
			$res = self::delFilePoster($id);
		}
		//видалення файлу фото
	}

	public static function addVue2El($name, $tab, $nameEl) {
		$sql    = "INSERT INTO ".$tab." (".$nameEl.") VALUES(:name)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function addElVote($name,$cat) {
		$cat    = self::getIntval($cat);
		$sql    = "INSERT INTO vote (msg,category) VALUES(:name, :cat)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':cat',  $cat,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function addVote($id) {
		$id  = self::getIntval($id);
		$sql = "UPDATE vote SET countrl = countrl + 1 WHERE id ='".$id."'";
		
		return self::getSQLVue($sql);		
	}

	public static function addVue($tab, $arr, $count) {	
		$db     = self::getDBVue();
		$sql = "INSERT INTO ".$tab." ("+$arr[1]+") VALUES("+$arr[2]+")";
		
		return self::getSQLVue($sql);	
	}

	public static function getVoteVueAd() {
		$sql    = "SELECT * FROM catVote";
		$result = self::getSQLVue($sql);
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']   = $row['idrl'];
			$voteList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $voteList;
	}

	public static function getVoteVue() {
		$sql    = "SELECT * FROM catVote WHERE active=1 LIMIT 1";
		$result = self::getSQLVue($sql);
		while ($row = $result->fetch()) {
			$voteList['id']   = $row['idrl'];
			$voteList['name'] = $row['namerl'];
		}
		return $voteList;
	}

	public static function getTxtVoteVue($id) {
		$id      = self::getIntval($id);
		$voteTxt = [];
		$sql     = "SELECT * FROM vote WHERE category=".$id." ORDER BY countrl DESC";
		$result  = self::getSQLVue($sql);
		while ($row = $result->fetch()) {
			$voteTxt[]=$row;
		}
		return $voteTxt;
	}

	public static function activated($id) {
		$id     = self::getIntval($id);
	    $sql    = "UPDATE catVote SET active=0 WHERE active=1";
		$result = self::getSQL($sql);
		$sql    = "UPDATE catVote SET active=1 WHERE idrl=$id";
		$result = self::getSQL($sql);			
	}

	public static function getAllVote() {
		$result = self::getSQL("SELECT * FROM catVote");
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']     = $row['idrl'];;
			$voteList[$i]['title']  = $row['namerl'];
			$voteList[$i]['active'] = $row['active'];
			$i++;
		}
		return $voteList;
	}

	public static function getVote() {
		$sql    = "SELECT * FROM catVote WHERE active=1 LIMIT 1";
		$result = self::getSQL($sql);
		while ($row = $result->fetch()) {
			$voteList['id']   = $row['idrl'];
			$voteList['name'] = $row['namerl'];
		}
		return $voteList;
	}

	public static function getTxtVote($id) {
		$id      = self::getIntval($id);
		$voteTxt = [];
		$sql     = "SELECT * FROM vote WHERE category=".$id." ORDER BY countrl DESC";
		$result  = self::getSQL($sql);
		while ($row = $result->fetch()) {
			$voteTxt[]=$row;
		}
		return $voteTxt;
	}

	public static function updateVoteVue ($id,$name) {
		$id     = self::getIntval($id);
		$sql    = "UPDATE catVote SET namerl=:name WHERE idrl=$id";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function getMonth() {
		return ["січень","лютий","березень","квітень","травень","червень","липень","серпень","вересень","жовтень","листопад","грудень"];
	}

	public static function getPost() {
		$arr          = Poster::getPosters20();
		//var_export($arr);
		$j            = rand (0,count($arr)-1);
		$pst['id']    = $arr[$j]['id_poster'];
		$pst['title'] = $arr[$j]['title_p'];
		return $pst;
	}

	public static function filterINT($type, $field) {
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

	public static function filterTXT($type, $field) {
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

	public static function filterEmail($type, $field) {
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
	
	public static function rus2translit($string) {
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
        'ь' => "",  'ы' => 'y',   'ъ' => "",
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
        'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ' ' => '_',   'і' => 'i',  'І' => 'I',
    );
    return strtr($string, $converter);		
	}

	public static function sendMail($subject,$to,$massage) {
		$from    = "info@gomgal.lviv.ua";
		$headers = "From: $from\r\nReplay-To: $from\r\nContent-Type: text/plain; charset=utf-8\r\n ";
		return mail($to,$subject,$massage,$headers);
	}	

	public static function makeDir($path) {
		if (!file_exists($path)) {
			return (!mkdir($path,0755, true)) ? false : true;	
		}
		return true;				
	}

	public static function isFile($file) {
		return 	(file_exists($file)) ? true : false;
	}

	public static function delFile($file,$folder) {
		$fdel  = "./".$folder."/".$file;
		$fdelS = "./".$folder."/s_".$file;
		if (self:: isFile($fdel))  unlink($fdel);
		if (self:: isFile($fdelS)) unlink($fdelS);
	}

	public static function delFileVue($file,$folder) {
		$fdel  = "../".$folder."/".$file;
		$fdelS = "../".$folder."/s_".$file;
		if (self:: isFile($fdel))  unlink($fdel);
		if (self:: isFile($fdelS)) unlink($fdelS);
	}

	private static function delFilePoster($id) {
		$poster = self::getPosterById($id);
		$res    = self::delFileVue($poster["foto_p1"],"posterFoto");	
	}

	public static function getPosterById($id) {
		$id     = self::getIntval($id);
		$sql    = "SELECT * FROM poster WHERE id_poster = ".$id;
		$result = self::getSQLVue($sql);
		return $result->fetch();
	}
	public static function changePhoto($nameFile,$pathdir) {
		include_once 'components/classSimpleImage.php';
        $fns    = $pathdir."/".$nameFile;
        $fnSmal = $pathdir."/"."s".'_'.$nameFile;				
        $image  = new SimpleImage();
        $image->load($fns);
        $image->resizeToWidth(100);
        $image->resizeToHeight(100);
        $image->save($fnSmal);  
	}

    public static function savePhotoS($nameFile,$pathdir) {      
        $res = self::makeDir($pathdir);
        $res = self::changePhoto($nameFile,$pathdir);    
    }

    public static function savePhoto($nameFile, $pathdir) {
        $res = self::makeDir($pathdir);
        move_uploaded_file ($_FILES['file'] ['tmp_name'],$pathdir."/".$nameFile); 
        $res = self::changePhoto($nameFile,$pathdir);             
    }

	public static function sel2El($tab,$name,$id,$idVal,$isId) {
/*		$sql = "SELECT * FROM ".$tab." ORDER BY ".$name;
		if ($idVal) {
			$sql .= " WHERE ".$id."=".$idVal;
		}*/
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData($tab);
		$NewsList = $getData->getData2ElVue($id,$name,$idVal);
		unset($getData);
		return $NewsList;
	}

	public static function getMTags() {
		$list = [];
		$sql     = "SELECT * FROM meta_tags";
		$result  = self::getSQL($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list;
	}

	public static function getMTagsByUrl($url) {
		$sql     = "SELECT * FROM meta_tags WHERE url_name = '".$url."'";
		$result  = self::getSQL($sql);
		return $result->fetch();

	}

	public static function getMTagsByID($id) {
		$id      = self::getIntval($id);
		$list    = [];
		$sql     = "SELECT * FROM meta_tags WHERE id = $id";
		$result  = self::getSQL($sql);
		return $result->fetch();

	}

	private static function saveMT($url_name,$title,$descr,$keywords,$sql,$follow) {
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':url_name', $url_name, PDO::PARAM_STR);
		$result -> bindParam(':title',   $title,     PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,     PDO::PARAM_STR);
		$result -> bindParam(':keywords',$keywords,  PDO::PARAM_STR);	
		$result -> bindParam(':follow',  $follow,    PDO::PARAM_STR);	
		return $result -> execute();
	}

	public static function editMetaTags($id,$url_name,$title,$descr,$keywords,$follow) {
		$sql = "UPDATE meta_tags SET url_name=:url_name,title=:title,descr=:descr,keywords=:keywords,follow=:follow WHERE id=$id";
		$r = self::saveMT($url_name,$title,$descr,$keywords,$sql,$follow);	
	}
	
	public static function saveMTags ($url_name,$title,$descr,$keywords,$follow) 
	{
		$sql = "INSERT INTO meta_tags (url_name,title,descr,keywords,follow)
		 VALUES(:url_name,:title,:descr,:keywords,:follow)";
		$r = self::saveMT($url_name,$title,$descr,$keywords,$sql,$follow);			
	}
		public static function bindParam($res,$name,$value) {
		return $res -> bindParam($name, $value,  PDO::PARAM_STR);	
	}

	public static function showGroupMenu($nameElMenu,$href,$arrData) {
		include ('views/layouts/showGroupMenu.php');
	}

	public static function showElementMenu($href,$title,$titleText) {
		include ('views/layouts/showElementMenu.php');
	}

	public static function showMainElMenu($href,$title,$titleText) {
		include ('views/layouts/showMainElMenu.php');
	}

	public static function showMainCaretMenu($nameElMenu) {
		include ('views/layouts/showMainCaretMenu.php');
	}

	public static function showReklama($http,$src,$alt,$title) {
		include ('views/layouts/showReklama.php');
	}

	public static function showReklamaArg($http,$class,$alt,$title) {
		include ('views/layouts/showReklamaArg.php');
	}

	public static function showRelaxRandom($type) {
		include ('views/layouts/showRelaxRandom.php');
	}

	public static function showCountry($http,$alt,$title) {
		include ('views/layouts/showCountry.php');
	}

	public static function showLivecount() {
		include ('views/layouts/showLivecount.php');
	}

	public static function showArchive() {
		include ('views/layouts/showArchive.php');
	}

	public static function showReklRand() {
		$post=Auxiliary::getPost();
		include ('views/layouts/showReklRand.php');
	}

	public static function showVote() {
		include ('views/layouts/showVote.php');
	}

	public static function showNews() {
		include ('views/layouts/showNews.php');
	}

	public static function showCountryOne() {
		include ('views/layouts/showCountryOne.php');
	}

	public static function showFacebook() {
		include ('views/layouts/showFacebook.php');
	}

	public static function showMeta($metaTags, $news = 1) {
		if ($metaTags == "") {
			$meta['title']    = "Гомін Галичични";
			$meta['keywords'] = 'Дрогобич';
			$meta['descr']    = 'новини Дрогобич Трускавець';
		}
		elseif ($metaTags == "poster") {
			$meta['title']    = $news["title_p"];
			$meta['keywords'] = 'оголошення Трускавець Дрогобич';
			$meta['descr']    = $news["msg_p"];
		}
		elseif ($metaTags == "newsOne") {
			$meta['title']    = $news['title'];
			$meta['keywords'] = 'Дрогобич';
			$meta['descr']    = $news['prew'];
		}
		else {
			$meta = self::getMTagsByUrl($metaTags);	
		}
		
		include ('views/layouts/showMeta.php');
	}

	public static function up() {
		echo '<div id="topcontrol" style="position: fixed; z-index: 100500; bottom: 155px; right: 5px; cursor: pointer; opacity: 1;" title="вверх"><img src="/image/r7.png"></div>';
	}

	public static function getSpam() {
		$getData  = new classGetData("spamTab");
		$spamList = $getData->getDataFromTable();
		unset($getData);
		return $spamList;		
	}
}
?>