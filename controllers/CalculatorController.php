<?php
/**
 * 
 */
class CalculatorController {

	use traitAuxiliary;

		public function __construct()
	{
		$this->InsuranceClass = new Insurance();
	}
	
	private function json($d) {
		$data    = [
		  'type' => $d
		];
		return json_encode($data);
	}

	private function viewMeasures($tab,$h3,$meta) {
		$type    = 4;
		$ip      = $_SERVER['REMOTE_ADDR'];
		$subject = "перехід на ".$h3;
		$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";		
		$send    = $this->sendMail($subject,"sl147@ukr.net",$massage);
		$comment = $this->InsuranceClass->getComment($type);
		if(isset($_POST['submit'])) {
			$typeC   = new classGetData('typeCalculator');			
			$nik     = $this->filterTXT('post', 'nik_com');
			$text    = $this->filterTXT('post', 'txt_com');
	        $ip      = $_SERVER['REMOTE_ADDR'];
	        $result  = Insurance::saveComment($type,$nik,$text,$ip);
			$subject = "Новий коментар ".$typeC->getDataFromTableById($type)['name']." ip=".$ip;
			$to      = "sl147@ukr.net";
			$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";
			$sendd   = $this->sendMail($subject,"sl147@ukr.net",$massage);
	    }				
		require_once ('views/calculator/cMeasures.php');
		return true;
	}

	private function editMeasures($title) {	
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionCSubEdit() {
		$title = 'Редагування груп одиниць виміру';
		require_once ('views/calculator/editSubMeasures.php');
		return true;		
	}

	public function actionEdit() {
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionLength() {
		$res = self::viewMeasures("cLength","калькулятори інші","");
		return true;	
	}

	public function actionViewUsers() {
		$users = Auxiliary::viewIPData();
		require_once ('views/calculator/viewUsers.php');
		return true;		
	}

	private function views2el($tab,$title,$name='',$id='',$isId='',$idVal='') {
		$table = [
			'table' => $tab,
			'name' => $name,
			'id' => $id,
			'isId' => $isId,
			'idVal' => $idVal,
		];
		$json  = json_encode($table);
		$countEl=1;
		require_once ('views/auxiliary/list2El.php');
		return true;
	}

	public function actionTypesCalculator() {
		$t = self::views2el('typeCalculator',"Редагування типів калькуляторів","name","id",false);
		return true;
	}
}
?>