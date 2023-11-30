<?php
/**
* 
*/
class Poster  extends classGetDB
{
	use traitAuxiliary;

	public function getPosters20()
	{
		$result = $this->getDB("SELECT id_poster,title_p FROM poster WHERE active='0' ORDER BY id_poster DESC LIMIT 20");
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list ?? [];
	}

	public  function getAllPostersImpotCat($cat)
	{
		$cat    = $this->getIntval($cat);
		$result = $this->getDB("SELECT * FROM poster WHERE (cat_p = $cat) AND (impot=1) AND (active=0) ORDER BY id_poster DESC");
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	public function getAllPostersImpot()
	{
		$result = $this->getDB("SELECT * FROM poster WHERE (impot=1) AND (active=0) ORDER BY id_poster DESC");
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	public  function getAllPostersAllCat($cat, $page = 1)
	{
		$cat    = $this->getIntval($cat);
		$offset = ($this->getIntval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql    = "SELECT * FROM poster WHERE (cat_p = $cat) AND (active=0) AND ((NOT impot=1) OR (impot IS NULL)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		$result = $this->getDB($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	private function getListArr($sql)
	{
		$result = $this->getDB($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;	
		}
		return $list ?? [];
	}

	public function getAllPostersAll($page = 1)
	{
		$offset = ($this->getIntval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql    = "SELECT * FROM poster WHERE ((impot=0) OR (impot IS NULL))AND (active = 0)  ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";

		return $this->getListArr($sql);
	}

	public  function getFindPosters($txt,$page = 1)
	{
		$offset   = ($this->getIntval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql      = "SELECT * FROM poster WHERE (active= 0) and ((impot=0) OR (impot IS NULL)) and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		return $this->getListArr($sql);
	}

	public  function getFindPostersImpot($txt)
	{
		$sql  = "SELECT * FROM poster WHERE (active= 0) and (impot='1') and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC";
		return $this->getListArr($sql);
	}

	public  function getFormat($i) {
		return ($i) ? $i : '-';
	}

	public  function getPostersVerify()
	{
		$result = $this->getDB("SELECT * FROM catagory");
		while ($row = $result->fetch()) {
			$id_cat                 = $row['id_cat'];
            $count_buy    [$id_cat] = 0;
            $count_sell   [$id_cat] = 0;
            $count_other  [$id_cat] = 0;
            $count_change [$id_cat] = 0;
            $count_job    [$id_cat] = 0;
		}

		$result = $this->getDB("SELECT * FROM poster");
		while ($row = $result->fetch()) {
		    $type_p = $this->getIntval($row['type_p']);
		    $cat_p  = $this->getIntval($row['cat_p']);
		    if ($type_p && $cat_p) {
	   			switch ($type_p) {
				    case 1:
				        $count_buy[$cat_p]    +=1;
				        break;
				    case 2:
				        $count_sell[$cat_p]   +=1;
				        break;
				    case 3:
				        $count_other[$cat_p]  +=1;
				        break;
				    case 4:
				        $count_change[$cat_p] +=1;
				        break;
				    case 5:
				        $count_job[$cat_p]    +=1;
				        break;		
				}
			}
		}

		$result = $this->getDB("SELECT * FROM catagory");
		while ($row = $result->fetch()) {
			$id_cat = $row['id_cat'];
            $buy    = $count_buy   [$id_cat];
            $sell   = $count_sell  [$id_cat];
            $other  = $count_other [$id_cat];
            $change = $count_change[$id_cat];
            $job    = $count_job   [$id_cat];

			$sql1   = "UPDATE catagory SET count_buy='".$buy."', count_sell='".$sell."', count_other='".$other."', count_change='".$change."', count_job='".$job."' WHERE id_cat='".$id_cat."'";
			$result1 = $this->getDB($sql1);
		}
	}

	public  function getPostersCatEd()
	{
		$getData = new classGetData('catagory');
		$catList = $getData->getDataFromTableOrder('cat_cat','');
		unset($getData);
		return $catList ?? [];
	}

	public function getPostersCat()
	{
		$count_sell_all   = 0;
		$count_buy_all    = 0;
		$count_other_all  = 0;
		$count_change_all = 0;
		$count_job_all    = 0;
		$count_all_all    = 0;
		$result = $this->getDB("SELECT * FROM catagory ORDER BY cat_cat");
		$i      = 1;
		while ($row = $result->fetch()) {
			$catList[$i]['id']           = $row['id_cat'];
			$catList[$i]['cat_cat']      = $row['cat_cat'];
			$catList[$i]['count_buy']    = self::getFormat($row['count_buy']);
			$catList[$i]['count_sell']   = self::getFormat($row['count_sell']);
			$catList[$i]['count_other']  = self::getFormat($row['count_other']);
			$catList[$i]['count_change'] = self::getFormat($row['count_change']);
			$catList[$i]['count_job']    = self::getFormat($row['count_job']);
			$count_all                   = $row['count_buy'] + $row['count_sell'] + $row['count_other'] + $row['count_change'] + $row['count_job'];
			$catList[$i]['count_all']    = self::getFormat($count_all);

			$count_buy_all   +=  $row['count_buy'];
			$count_sell_all  +=  $row['count_sell'];
			$count_other_all +=  $row['count_other'];
			$count_change_all+=  $row['count_change'];
			$count_job_all   +=  $row['count_job'];
			$count_all_all   +=  $count_all;
			$i++;
		}
			$catList[$i]['id']           = 0;
			$catList[$i]['cat_cat']      = 'all';
			$catList[$i]['count_buy']    = self::getFormat($count_buy_all);
			$catList[$i]['count_sell']   = self::getFormat($count_sell_all);
			$catList[$i]['count_other']  = self::getFormat($count_other_all);
			$catList[$i]['count_change'] = self::getFormat($count_change_all);
			$catList[$i]['count_job']    = self::getFormat($count_job_all);
			$catList[$i]['count_all']    = self::getFormat($count_all_all);
		return $catList;
	}

	public  function getPosterByRand($rand)
	{
		$getData = new classGetData('poster');
		$elem    = $getData->getDataFromTableByNameFetch2WHERE ($rand,'rand_p',0,'active');
		unset($getData);
		return $elem;
	}

	public  function getPosterById($id)
	{
		$getData = new classGetData('poster');
		$elem    = $getData->getDataFromTableByNameFetch2WHERE ($this->getIntval($id),'id_poster',0,'active');
		unset($getData);
		return $elem ?? [];
	}

	public  function plusId($id)
	{
		return $this->getDB("UPDATE poster SET count_p = count_p+1".$this->formSql("id_poster",$id));
	}

	public  function getFindTotalPoster($txt) {
		$sql    = "SELECT count(*) as count FROM poster WHERE (LOCATE('".$txt."',msg_p)) AND (active=0)";
		$result = $this->getDB($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public function updateFoto ($id,$foto)
	{
		$result = $this->getPrepareSQL("UPDATE poster SET foto_p1=:foto".$this->formSql("id_poster",$id));
		$result -> bindParam(':foto', $foto, PDO::PARAM_STR);			
		return $result -> execute();			
	}

	public  function getPostersByCat($cat)
	{
		$cat     = $this->getIntval($cat);
		$getData = new classGetData('catagory');
		$list    = $getData->getDataFromTableByNameFetch($cat,'id_cat');
		return $list ?? [];
	}

	public function getAllTypePost()
	{
		return ["вибрати тип","куплю","продам","оренда","обмін","послуги"];
	}

	public  function getTypePost($type)
	{
		$tPos = self::getAllTypePost();
		return $tPos[$this->getIntval($type)];
	}

	public  function incrType ($cat,$type)
	{
		$cat          = $this->getIntval($cat);
		$type         = $this->getIntval($type);
		$db           = Db::getConnection();
		$row          = self::getPostersByCat($cat);
		$count_buy    = $row['count_buy'];
		$count_sell   = $row['count_sell'];
		$count_other  = $row['count_other'];
		$count_change = $row['count_change'];
		$count_job    = $row['count_job'];
	   	switch ($type) {
			case 1:
			    $count = $count_buy+1;
			    $var   = 'count_buy';
			    break;
			case 2:
			    $count = $count_sell+1;
			    $var   = 'count_sell';
			    break;
			case 3:
			    $count = $count_other+1;
			    $var   = 'count_other';
			    break;
			case 4:
			    $count = $count_change+1;
			    $var   = 'count_change';
			    break;
			case 5:
			    $count = $count_job+1;
			    $var   = 'count_job';
        	break;		
		}
		$sql    = "UPDATE catagory SET ".$var."=:count WHERE id_cat=$cat";
		$result = $db -> prepare($sql);
		$result -> bindParam(':count', $count, PDO::PARAM_STR);
		
		return $result -> execute();
	}

	public function createPoster($nik,$type,$cat,$email,$msg,$foto,$rand,$cl_ip,$title) {
		$sql    = "INSERT INTO poster (name_p,type_p,cat_p,email_p,msg_p,foto_p1,rand_p,cl_ip,title_p)
		 VALUES(:nik,:type,:cat,:email,:msg,:foto,:rand,:cl_ip,:title)";

		$result = $this->getPrepareSQL($sql);
        $result -> bindParam(':nik',   $nik,   PDO::PARAM_STR);
        $result -> bindParam(':type',  $type,  PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':cat',   $cat,   PDO::PARAM_STR);
        $result -> bindParam(':title', $title, PDO::PARAM_STR);
        $result -> bindParam(':rand',  $rand,  PDO::PARAM_STR);
        $result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);
        $result -> bindParam(':cl_ip', $cl_ip, PDO::PARAM_STR);
        $result -> bindParam(':foto',  $foto,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public function changePoster($id,$title,$cat,$type,$name,$email,$impot,$msg,$foto)
	{	
		$id  = $this->getIntval($id);
		$cat = $this->getIntval($cat);
		$sql = "UPDATE  poster SET name_p=:name, email_p=:email, type_p=:type, cat_p=:cat, title_p=:title, impot=:impot, msg_p=:msg, foto_p1=:foto WHERE id_poster=$id";

		$result = $this->getPrepareSQL($sql);
        $result -> bindParam(':name',  $name,  PDO::PARAM_STR);
        $result -> bindParam(':type',  $type,  PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':cat',   $cat,   PDO::PARAM_STR);
        $result -> bindParam(':title', $title, PDO::PARAM_STR);
        $result -> bindParam(':impot', $impot, PDO::PARAM_STR);
        $result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);
        $result -> bindParam(':foto',  $foto,  PDO::PARAM_STR);

		return $result -> execute();		
	}

	public function editFoto ($id,$title,$cat,$type,$name,$email,$impot,$msg,$foto)
	{
		$id  = $this->getIntval($id);
		$cat = $this->getIntval($cat);
		$sql = "UPDATE poster SET name_p=:name, email_p=:email, type_p=:type, cat_p=:cat, title_p=:title, impot=:impot, msg_p=:msg, foto_p1=:foto WHERE id_poster=$id";

		$result = $this->getPrepareSQL($sql);
        $result -> bindParam(':name',  $name,  PDO::PARAM_STR);
        $result -> bindParam(':type',  $type,  PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':cat',   $cat,   PDO::PARAM_STR);
        $result -> bindParam(':title', $title, PDO::PARAM_STR);
        $result -> bindParam(':impot', $impot, PDO::PARAM_STR);
        $result -> bindParam(':msg',   $msg,   PDO::PARAM_STR);
        $result -> bindParam(':foto',  $foto,  PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public function showLineMenuPoster($http,$alt,$title)
	{
		include ('views/poster/showLineMenuPoster.php');
	}

	public  function showNoPhoto($title)
	{
		include ('views/poster/showNoPhoto.php');
	}

	public  function showPosterAll($posterItem)
	{
		foreach ($posterItem as $item) {			
			include ('views/poster/showPosterAll.php');
		}
	}

	public  function showPhoto($list)
	{
		$file = 'posterFoto/'.$list["foto_p1"];
		include ('views/poster/showPhoto.php');
	}
}
?>