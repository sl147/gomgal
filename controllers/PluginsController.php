<?php

/**
 * 
 */

class PluginsController {

	use traitAuxiliary;

	public function __construct()	{
		require_once ('models/Insurance.php');
		$this->InsuranceClass = new Insurance();
		$this->lang = "en";
	}

	public function actionLicensekey($license_key){
/*		if( require ('classes/classGetDB.php') == 0) {
			$lk = 'no classGetDB';
			
			require_once ('views/plugins/license.php');
		 	return true;
		}else{
			$lk = 'yes classGetDB';
			
			require_once ('views/plugins/license.php');
		 	return true;
		}*/
		$lk = $license_key.' start';
		require_once ('classes/classGetDB.php');
		require_once ('classes/classGetData.php');
		require_once ('components/Db.php');
		//$db = new Db();
		$getData = new classGetData('plugins_license_key');
		$res = $getData->selectWhereGetRow($license_key, 'license_key', false);
		//$lk = $value['license_key'];
		//$res = $getData->selectFromTable(true);
		foreach ($res as $key => $value) {
			$lk = $value['license_key'];
			$pl = $value['plugin'];
		}
/*		$sql    = "SELECT * FROM plugins_license_key WHERE license_key=$license_key";
		$result = $db::getConnection() -> query($sql);
		$reslk  = [];
		while ($row = $result->fetch()) {
			$lk = $row['license_key'];
			$pl = $row['plugin'];
			$reslk[]   = $row;
		}*/
		require_once ('views/plugins/license.php');
		return true;
	}
	
	public function actionTopBarRun() {
		$comment = [];
		if(isset($_POST['submit'])) {
			$nik   = $this->sl147_clean($_POST['nik_com']);
			$text  = $this->sl147_clean($_POST['txt_com']);
			$email = $this->sl147_clean($_POST['email_com']);
			$ip    = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';
			$res   = $this->InsuranceClass->saveComment( 4, $nik,$text,$ip,$email );

			$subject = "new comment on plugin site";
			$massage = "nik: ".$nik."\r\n"."email: ".$email."\r\n".$text;
			$res   = $this->mailing (SLMAIL,$subject,$massage);
		}
		$comment = $this->InsuranceClass->getComment(4);
		$lang = $this->lang;
		require_once ('views/plugins/topBar.php');
		return true;
	}

	public function translate( string $text) :string {
		if (file_exists('controllers/Language/trans_' . $this->lang. '.po')){
			$lines = file('controllers/Language/trans_' . $this->lang. '.po');
			$is_line = false;

			foreach ($lines as $line_num => $line) {
				$ln = explode('"', $line);
				if($is_line) return $ln[1];
				$pos1 = stripos($ln[0], 'msgid');
				if ($pos1 !== false) {
					$pos2 = stripos($ln[1], $text);
					if ($pos2 !== false) $is_line = true;
				}
			}
		}
		return $text;
	}

	public function actionTopBarLang( $lang = "en" ) {
		$this->lang = $lang;
		$this->actionTopBarRun();
	}
}