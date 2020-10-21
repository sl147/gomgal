<?php
/**
* 
*/
class PosterVue
{
	const SHOWPOSTER_BY_VUE = 6;

	public function __construct()
	{
		require_once ('../classes/classGetDB.php');
	}

	public  function getAllPostersVue($page = 1) {
		$offset   = ($page - 1) * self::SHOWPOSTER_BY_VUE;
		$sql        = "SELECT * FROM poster ORDER BY id_poster DESC LIMIT ".self::SHOWPOSTER_BY_VUE." OFFSET $offset";
		$classGetDB = new classGetDB();
		$result     = $classGetDB->getDBVue($sql);
		unset($getData);
		$i          = 1;
		while ($row = $result->fetch()) {
			$postList[$i]['id']       = $row['id_poster'];
			$postList[$i]['title_p']  = $row['title_p'];
			$postList[$i]['type_p']   = $row['type_p'];
			$postList[$i]['date_p']   = $row['date_p'];
			$postList[$i]['foto_p1']  = $row['foto_p1'];
			$postList[$i]['count_p']  = $row['count_p'];
			$i++;			
		}
		return $postList ?? [];
	}
}