<?php
/**
* 
*/
//namespace models;
//declare(strict_types = 1);

class Auxiliary
{

	use traitAuxiliary;

	public static function getSQLAux($sql)
	{
		return Db::getConnection() -> query($sql);
	}

	public static function getPrepareSQL($sql)
	{
		$db = Db::getConnection();
		return $db -> prepare($sql);
	}

	public static function getCount($table)
	{
		$sql    = "SELECT count(*) as count FROM ".$table;
		$result = self::getSQLAux($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function formSqlAux($atr,$value)
	{
		return " WHERE ".$atr." = ".$value;
	}

	public static function getCountAtr($table, $atr, $value)
	{
		$sql    = "SELECT count(*) as count FROM ".$table.self::formSqlAux($atr,$value);
		$result = self::getSQLAux($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function getVoteVueAd()
	{
		$result = self::getSQLAuxVue("SELECT * FROM catVote");
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']   = $row['idrl'];
			$voteList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $voteList;
	}

	public static function activated($id)
	{
		self::getSQLAux("UPDATE catVote SET active=0".self::formSqlAux("active",1));
		self::getSQLAux("UPDATE catVote SET active=1".self::formSqlAux("idrl",$id));			
	}

	public static function getAllVote()
	{
		$result = self::getSQLAux("SELECT * FROM catVote");
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']     = $row['idrl'];;
			$voteList[$i]['title']  = $row['namerl'];
			$voteList[$i]['active'] = $row['active'];
			$i++;
		}
		return $voteList ?? [];
	}

	public static function updateVoteVue ($id,$name)
	{
		$result = self::getPrepareSQLVue("UPDATE catVote SET namerl=:name".self::formSqlAux("idrl",$id));
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function getMonth()
	{
		return ["січень","лютий","березень","квітень","травень","червень","липень","серпень","вересень","жовтень","листопад","грудень"];
	}

	public static function makeDir($path)
	{
		if (!file_exists($path)) {
			return (!mkdir($path,0755, true)) ? false : true;	
		}
		return true;				
	}

	public static function isFile($file) {
		return 	(file_exists($file)) ? true : false;
	}

	private static function getPathFile($file,$folder,$delim=""){
		return "./".$folder."/".$delim.$file;
	}

	public static function delFile($file,$folder) {
		$fdel  = self::getPathFile($file,$folder);
		$fdelS = self::getPathFile($file,$folder,"s");
		if (self:: isFile($fdel))  unlink($fdel);
		if (self:: isFile($fdelS)) unlink($fdelS);
	}

	public static function delFileVue($file,$folder) {
		$fdel  = self::getPathFile($file,$folder);
		$fdelS = self::getPathFile($file,$folder,"s");
		if (self:: isFile($fdel))  unlink($fdel);
		if (self:: isFile($fdelS)) unlink($fdelS);
	}

	public static function getPosterById($id) {
		$result = self::getSQLAuxVue("SELECT * FROM poster".self::formSqlAux("id_poster",$id));
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

	public static function getMTags() {
		$result  = self::getSQLAux("SELECT * FROM meta_tags");
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list ?? [];
	}

	public static function getMTagsByUrl($url) {
		$result  = self::getSQLAux("SELECT * FROM meta_tags WHERE url_name = '".$url."'");
		return $result->fetch();

	}

	public static function getMTagsByID($id) {
		$result  = self::getSQLAux("SELECT * FROM meta_tags".self::formSqlAux("id",$id));
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
		$poster       = new Poster();
		$arr          = $poster->getPosters20();
		unset($poster);
		$j            = rand (0,count($arr)-1);
		$pst['id']    = $arr[$j]['id_poster'];
		$pst['title'] = $arr[$j]['title_p'];
		$post         = $pst;
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

	public static function showMeta($metaTags, $news = 1)
	{
		if ($metaTags == "") {
			$meta['title']    = "Гомін Галичични";
			$meta['keywords'] = 'Дрогобич';
			$meta['descr']    = 'новини Дрогобич Трускавець';
		}
		elseif ($metaTags == "poster") {
			$meta['title']    = $news["title_p"];
			$meta['keywords'] = 'безкоштовні безплатні оголошення Трускавець Дрогобич';
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

	public static function up()
	{
		echo '<div id="topcontrol" style="position: fixed; z-index: 100500; bottom: 155px; right: 5px; cursor: pointer; opacity: 1;" title="вверх"><img src="/image/r7.png"></div>';
	}

	public static function getSpam()
	{
		$getData  = new classGetData("spamTab");
		$spamList = $getData->getDataFromTable();
		unset($getData);
		return $spamList;		
	}
}
?>