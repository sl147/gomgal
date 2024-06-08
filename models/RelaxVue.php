<?php

class RelaxVue{

	public function __construct()	{
		require_once ('../classes/classGetDB.php');
		$this->classGetDB = new classGetDB();
	}

	public function getRelaxVue($cat = 1, $page = 1, $SHOWRELAX = 1){
		$offset  = ($page - 1) * $SHOWRELAX;
		if ($cat == 0)	{
			$sql = "SELECT * FROM msgs_relax ORDER BY id DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		}
		else {
			$sql = "SELECT * FROM msgs_relax WHERE category=$cat ORDER BY countrl DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		}
		$result  = $this->classGetDB->getDBVue($sql);
		$i = 0;
		while ($row = $result->fetch()) {
			$relaxList[$i]['id']  = $row['id'];
			$relaxList[$i]['msg'] = $row['msg'];
		$relaxList[$i]['countrl'] = $row['countrl'];
		    $relaxList[$i]['sql'] = $sql;
			$i++;
		}
		return $relaxList ?? [];
	}

	public  function getLikeVue($id,$count)	{
		return $this->classGetDB->getDBVue("UPDATE msgs_relax SET countrl='".$count."' WHERE id='".$id."'");
	}

	public function getAnThemaVue($teman = 1,$page = 1, $SHOWRELAX = 1)	{
		$offset     = ($page - 1) * $SHOWRELAX;
		$sql        = "SELECT * FROM msgs_relax  WHERE teman=$teman ORDER BY countrl DESC LIMIT ".$SHOWRELAX." OFFSET $offset";
		$result     = $this->classGetDB->getDBVue($sql);
		while ($row = $result->fetch()) {
			$relaxList[] = $row;
		}
		return $relaxList ?? [];
	}

	
/*	public function updateCountRelax( int $id, int $count) :bool {
		$result = $this->getPrepareSQL("UPDATE msgs_relax SET countrl = :count".$this->formSql( "id", $this->getIntval($id)));
		$result -> bindParam(':count',   $count, PDO::PARAM_INT);
		return $result -> execute();			
	}*/
}