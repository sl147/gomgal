<?php
/**
* 
*/
class Poster
{
	const SHOWPOSTER_BY_VUE = 6;

	private function getDBVue(){
		require_once ('../models/Auxiliary.php');
		$aux = new Auxiliary();
		return $aux->getDBVue();
	}

	public static function getPosters20() {
		$sql    = "SELECT id_poster,title_p FROM poster WHERE active='0' ORDER BY id_poster DESC LIMIT 20";
		$result = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list ?? [];
	}

	public static function getAllPostersImpotCat($cat) {
		$cat    = Auxiliary::getIntval($cat);
		$sql    = "SELECT * FROM poster WHERE (cat_p = $cat) AND (impot=1) ORDER BY id_poster DESC";
		$result = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	public static function getAllPostersImpot() {
		$sql    = "SELECT * FROM poster WHERE impot=1 ORDER BY id_poster DESC";
		$result = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	public static function getAllPostersAllCat($cat, $page = 1) {
		$cat    = Auxiliary::getIntval($cat);
		$page   = Auxiliary::getIntval($page);
		$offset = (intval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql    = "SELECT * FROM poster WHERE (cat_p = $cat) AND ((NOT impot=1) OR (impot IS NULL)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;			
		}
		return $list ?? [];
	}

	public static function getPostersAll() {
		$db     = self::getDBVue();
		$sql    = "SELECT * FROM poster WHERE ((impot=0) OR (impot IS NULL))";
		$result = $db -> query($sql);
		$i      = 1;
		while ($row = $result->fetch()) {
			$postList[$i]['id']      = $row['id_poster'];
			$postList[$i]['title_p'] = $row['title_p'];
			$i++;			
		}
		return $postList ?? [];
	}

	public static function getAllPostersVue($page = 1) {
		$offset   = ($page - 1) * self::SHOWPOSTER_BY_VUE;
		$db       = self::getDBVue();
		$sql      = "SELECT * FROM poster ORDER BY id_poster DESC LIMIT ".self::SHOWPOSTER_BY_VUE." OFFSET $offset";
		$result   = $db -> query($sql);
		$i=1;
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

	public static function getAllPostersAll($page = 1) {
		$page     = Auxiliary::getIntval($page);
		$offset   = ($page - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql      = "SELECT * FROM poster WHERE ((impot=0) OR (impot IS NULL)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		//$sql      = "SELECT * FROM poster ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		$result  = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;	
		}
		return $list ?? [];
	}

	public static function getFindPosters($txt,$page = 1) {
		$page     = Auxiliary::getIntval($page);
		$offset   = ($page - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql      = "SELECT * FROM poster WHERE (active= 0) and (impot='0') and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQLAux($sql);
		while ($row = $result->fetch()) {
			$list[] = $row;		
		}
		return $list ?? [];
	}

	public static function getFindPostersImpot($txt) {
		$sql  = "SELECT * FROM poster WHERE (active= 0) and (impot='1') and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC";
		$res = Auxiliary::getSQLAux($sql);
		while ($row = $res->fetch()) {
			$list[] = $row;			
		}
		return $list ?? [];
	}

	public static function getFormat($i) {
		return ($i) ? $i : '-';
	}

	public static function getPostersVerify() {
		$result = Auxiliary::getSQLAux("SELECT * FROM catagory");
		while ($row = $result->fetch()) {
			$id_cat                 = $row['id_cat'];
            $count_buy    [$id_cat] = 0;
            $count_sell   [$id_cat] = 0;
            $count_other  [$id_cat] = 0;
            $count_change [$id_cat] = 0;
            $count_job    [$id_cat] = 0;
		}

		$result = Auxiliary::getSQLAux("SELECT * FROM poster");
		while ($row = $result->fetch()) {
		    $type_p = intval($row['type_p']);
		    $cat_p  = intval($row['cat_p']);
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

		$result = Auxiliary::getSQLAux("SELECT * FROM catagory");
		while ($row = $result->fetch()) {
			$id_cat = $row['id_cat'];
            $buy    = $count_buy   [$id_cat];
            $sell   = $count_sell  [$id_cat];
            $other  = $count_other [$id_cat];
            $change = $count_change[$id_cat];
            $job    = $count_job   [$id_cat];

			$sql1   = "UPDATE catagory SET count_buy='".$buy."', count_sell='".$sell."', count_other='".$other."', count_change='".$change."', count_job='".$job."' WHERE id_cat='".$id_cat."'";
			$result1 = $db -> query($sql1);
		}
	}

	public static function getPostersCatEd() {
		$getData = new classGetData('catagory');
		$catList = $getData->getDataFromTableOrder('cat_cat','');
		unset($getData);
		return $catList ?? [];
	}

	public static function getPostersCat() {
		$count_sell_all   = 0;
		$count_buy_all    = 0;
		$count_other_all  = 0;
		$count_change_all = 0;
		$count_job_all    = 0;
		$count_all_all    = 0;
		$result = Auxiliary::getSQLAux("SELECT * FROM catagory ORDER BY cat_cat");
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

	public static function getPosterByRand($rand) {
		$getData = new classGetData('poster');
		$elem    = $getData->getDataFromTableByNameFetch ($rand,'rand_p');
		unset($getData);
		return $elem;
	}

	public static function getPosterById($id) {
		$id      = Auxiliary::getIntval($id);
		$getData = new classGetData('poster');
		$elem    = $getData->getDataFromTableByNameFetch ($id,'id_poster');
		unset($getData);
		return $elem;
	}

	public static function plusId($id) {
		return Auxiliary::getSQLAux("UPDATE poster SET count_p = count_p+1".Auxiliary::formSqlAux("id_poster",$id));
	}

	public static function getFindTotalPoster($txt) {
		$sql    = "SELECT count(*) as count FROM poster WHERE LOCATE('".$txt."',msg_p)";
		$result = Auxiliary::getSQLAux($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch()['count'];
	}

	public static function updateFoto ($id,$foto) {
		$result = Auxiliary::getPrepareSQL("UPDATE poster SET foto_p1=:foto".Auxiliary::formSqlAux("id_poster",$id));
		$result -> bindParam(':foto', $foto, PDO::PARAM_STR);			
		return $result -> execute();			
	}

	public static function getPostersByCat($cat) {
		$cat     = Auxiliary::getIntval($cat);
		$getData = new classGetData('catagory');
		$list    = $getData->getDataFromTableByNameFetch($cat,'id_cat');
		return $list;
	}

	public static function getAllTypePost() {
		return ["вибрати тип","куплю","продам","оренда","обмін","послуги"];
	}

	public static function getTypePost($type) {
		$tPos = self::getAllTypePost();
		return $tPos[Auxiliary::getIntval($type)];
	}

	public static function incrType ($cat,$type) {
		$cat          = Auxiliary::getIntval($cat);
		$type         = Auxiliary::getIntval($type);
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

	public static function createPoster($nik,$type,$cat,$email,$msg,$foto,$rand,$cl_ip,$title) {
		$sql    = "INSERT INTO poster (name_p,type_p,cat_p,email_p,msg_p,foto_p1,rand_p,cl_ip,title_p)
		 VALUES(:nik,:type,:cat,:email,:msg,:foto,:rand,:cl_ip,:title)";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':nik',  $nik);
		Auxiliary::bindParam($result,':type', $type);
		Auxiliary::bindParam($result,':email',$email);
		Auxiliary::bindParam($result,':cat',  $cat);
		Auxiliary::bindParam($result,':title',$title);
		Auxiliary::bindParam($result,':rand', $rand);
		Auxiliary::bindParam($result,':msg',  $msg);
		Auxiliary::bindParam($result,':cl_ip',$cl_ip);		
		Auxiliary::bindParam($result,':foto', $foto);
		
		return $result -> execute();		
	}

	public static function changePoster($id,$title,$cat,$type,$name,$email,$impot,$msg,$foto) {	
		$id  = Auxiliary::getIntval($id);
		$cat = Auxiliary::getIntval($cat);
		$sql = "UPDATE  poster SET name_p=:name, email_p=:email, type_p=:type, cat_p=:cat, title_p=:title, impot=:impot, msg_p=:msg, foto_p1=:foto WHERE id_poster=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':name', $name);
		Auxiliary::bindParam($result,':type', $type);
		Auxiliary::bindParam($result,':email',$email);
		Auxiliary::bindParam($result,':cat',  $cat);
		Auxiliary::bindParam($result,':title',$title);
		Auxiliary::bindParam($result,':impot',$impot);
		Auxiliary::bindParam($result,':msg',  $msg);
		Auxiliary::bindParam($result,':foto', $foto);

		return $result -> execute();		
	}

	public static function editFoto ($id,$title,$cat,$type,$name,$email,$impot,$msg,$foto) {
		$id  = Auxiliary::getIntval($id);
		$cat = Auxiliary::getIntval($cat);
		$sql = "UPDATE poster SET name_p=:name, email_p=:email, type_p=:type, cat_p=:cat, title_p=:title, impot=:impot, msg_p=:msg, foto_p1=:foto WHERE id_poster=$id";
		$result = Auxiliary::getPrepareSQL($sql);
		Auxiliary::bindParam($result,':name', $name);
		Auxiliary::bindParam($result,':type', $type);
		Auxiliary::bindParam($result,':email',$email);
		Auxiliary::bindParam($result,':cat',  $cat);
		Auxiliary::bindParam($result,':title',$title);
		Auxiliary::bindParam($result,':impot',$impot);
		Auxiliary::bindParam($result,':msg',  $msg);
		Auxiliary::bindParam($result,':foto', $foto);
		
		return $result -> execute();			
	}

	public static function showLineMenuPoster($http,$alt,$title) {
		include ('views/poster/showLineMenuPoster.php');
	}

	public static function showNoPhoto($title) {
		include ('views/poster/showNoPhoto.php');
	}

	public static function showPosterAll($posterItem) {
		foreach ($posterItem as $item) {			
			include ('views/poster/showPosterAll.php');
		}
	}

	public static function showPhoto($list) {
		$file = 'posterFoto/'.$list["foto_p1"];
		include ('views/poster/showPhoto.php');
	}
}
?>