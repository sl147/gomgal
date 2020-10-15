<?php

//declare(strict_types=1);

/**
* 
*/


class Relax extends classGetDB
{	

	use traitAuxiliary;

	public function getRelaxId($id)
	{
		$getData = new classGetData('catrelax');
		$cat     = $getData->getDataFromTableByNameFetch ($this->getIntval($id),'idrl');
		unset($getData);
		return $cat;
	}

	public function getRelax()
	{
		$getData = new classGetData('catrelax');
		$result  = $getData->getDataFromTable(2);
		unset($getData);
		$i       = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $relaxList ?? [];
	}

	public function getAnList()
	{
		$result = $this->getDB("SELECT * FROM catan ORDER BY namerl");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$relaxList[$i]['id']   = $row['idrl'];
			$relaxList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $relaxList ?? [];
	}


	private function getRelaxMsg($cat)
	{
		$cat    = $this->getIntval($cat);
		$result = $this->getDB("SELECT * FROM msgs_relax WHERE category=$cat and CHAR_LENGTH(msg)<400 and countrl>10");
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return $list ?? [];
	}

	public function getRelaxRandom($cat)
	{
		$arr = self::getRelaxMsg($cat);
		if (count($arr) > 0) {
			$j   = rand (0,count($arr)-1);
			return $arr[$j]['msg'];
		}
	}

	public function addNewAn($teman, $msg)
	{
		$teman  = $this->getIntval($teman);
        $sql    = "INSERT INTO msgs_relax (teman,msg) VALUES(:teman, :msg)";
        $result = $this->getPrepareSQL($sql);
        $result -> bindParam(':teman', $teman, PDO::PARAM_STR);
        $result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);

        return $result -> execute();		
	}

	public function getRelaxAll($page)
	{
		$getData = new classGetData('msgs_relax');
		$offset  = ($this->getIntval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$comList = $getData->getDataByOffset ('id',SHOWPOSTER_BY_DEFAULT,$offset);
		unset($getData);
		return $comList;
	}

	public function getRelaxOne($id)
	{
		$getData = new classGetData('msgs_relax');
		$comList = $getData->getDataFromTableByNameFetch ($this->getIntval($id),'id');
		unset($getData);
		return $comList;
	}

	public function updateRelax($id, $msg, $cat)
	{
		$cat    = $this->getIntval($cat);
		$result = $this->getPrepareSQL("UPDATE msgs_relax SET msg = :msg, category = :cat".$this->formSql("id",$this->getIntval($id)));
		$result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);
		$result -> bindParam(':cat',   $cat,   PDO::PARAM_STR);
		return $result -> execute();			
	}

	public function updateCountRelax($id, $count)
	{
		$result = $this->getPrepareSQL("UPDATE msgs_relax SET countrl = :count".$this->formSql("id",$this->getIntval($id)));
		$result -> bindParam(':count',   $count,   PDO::PARAM_STR);
		return $result -> execute();			
	}
}