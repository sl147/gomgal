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
/*		$this->tab = [
			'Details' => $this->Translate('Details'),
			'Reviews' => $this->Translate('Reviews'),
			'Installation' => $this->Translate('Installation')
		]*/
	}

	public static function saveComment ($type,$nik,$text,$ip)	{
		$db     = Db::getConnection();
		$sql    = "INSERT INTO CommentCalculators (type,nik,text,ip)
		           VALUES(:type,:nik,:text,:ip)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':type', $type, PDO::PARAM_STR);
		$result -> bindParam(':nik' , $nik,  PDO::PARAM_STR);
		$result -> bindParam(':text', $text, PDO::PARAM_STR);
		$result -> bindParam(':ip'  , $ip,   PDO::PARAM_STR);
		
		return $result -> execute();			
	}
	
	public function actionTopBarRun() {
		$comment = [];
		if(isset($_POST['submit'])) {
			
			$nik  = $this->filterTXT( 'post', 'nik_com' );
			$text = $this->filterTXT( 'post', 'txt_com' );
			$ip   = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';
			$res  = $this->InsuranceClass->saveComment( 4, $nik,$text,$ip );
		}
		
		$comment = $this->InsuranceClass->getComment(4);
		$lang = $this->lang;
		require_once ('views/plugins/topBar.php');
		return true;
	}
	


	public function translate($text){
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