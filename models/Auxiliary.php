<?php
/**
* 
*/
//namespace models;
//declare(strict_types = 1);

class Auxiliary
{

	use traitAuxiliary;

	public static function getMonth()
	{
		return ["січень","лютий","березень","квітень","травень","червень","липень","серпень","вересень","жовтень","листопад","грудень"];
	}

	public static function isFile($file)
	{
		return 	(file_exists($file)) ? true : false;
	}

	private static function getPathFile($file,$folder,$delim="")
	{
		return "./".$folder."/".$delim.$file;
	}

	public static function delFileVue($file,$folder) {
		$fdel  = self::getPathFile($file,$folder);
				$str  = explode( '/', $file );
		$file = '';
		for ($i=0; $i < count($str)-1; $i++) { 
			$file .= $str[$i].'/';
		}
		$file .= 's_'.$str[count($str)-1];
		$fdelS = self::getPathFile($file,$folder);
		if (self:: isFile($fdel))  unlink($fdel);
		if (self:: isFile($fdelS)) unlink($fdelS);
	}

	public static function getPosterById($id) {
		$result = self::getSQLAuxVue("SELECT * FROM poster WHERE id_poster=".$id);
		return $result->fetch();
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

	public static function showKurs() {
		$ch = curl_init('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($json, true);
		include ('views/layouts/showKurs.php');
	}

	public static function showWeatherPol() {
		include ('views/layouts/showWeatherPol.php');
	}

	public static function showWeather() {
		include ('views/layouts/showWeather.php');
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