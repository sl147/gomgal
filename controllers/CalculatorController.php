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
	
	private function json($d)
	{
		$data    = [
		  'type' => $d
		];
		return json_encode($data);
	}

	private function viewMeasures($tab,$mass,$meta)
	{
		if ($meta == "") $meta = [];
		$type    = 4;
		$send    = $this->formMail($mass);
		$comment = $this->InsuranceClass->getComment($type);
		if(isset($_POST['submit'])) {
			$nik  = $this->filterTXT('post', 'nik_com');
			$text = $this->filterTXT('post', 'txt_com');
			$send = $this->formMailComment($type,$nik,$text);
	    }				
		require_once ('views/calculator/cMeasures.php');
		return true;
	}

	private function editMeasures($title)
	{	
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionCSubEdit()
	{
		$title = 'Редагування груп одиниць виміру';
		require_once ('views/calculator/editSubMeasures.php');
		return true;		
	}

	public function actionEdit()
	{
		$meta = [];
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionLength()
	{
		$res = self::viewMeasures("cLength","калькулятори інші","");
		return true;	
	}

	public function actionViewUsers()
	{
		$users = Auxiliary::viewIPData();
		require_once ('views/calculator/viewUsers.php');
		return true;		
	}

	private function views2el($tab,$title,$name='',$id='',$isId='',$idVal='')
	{
		$table = [
			'table' => $tab,
			'name'  => $name,
			'id'    => $id,
			'isId'  => $isId,
			'idVal' => $idVal,
		];
		$json  = json_encode($table);
		$countEl=1;
		require_once ('views/auxiliary/list2El.php');
		return true;
	}

	public function actionTypesCalculator()
	{
		$t = self::views2el('typeCalculator',"Редагування типів калькуляторів","name","id",false);
		return true;
	}
}
?>