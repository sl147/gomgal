<?php
/**
* 
*/
class FA {

	private function getDBVue(){
		require_once ('../models/Auxiliary.php');
		$aux = new Auxiliary();
		return $aux->getDBVue();
	}

	public static function createFA($name,$msgs,$log) {
		$sql    = "INSERT INTO photoalbum (name_FA,msgs_FA,log_FA)
		 VALUES(:name,:msgs,:log)";
		$result = Auxiliary::getPrepareSQL($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':msgs', $msgs, PDO::PARAM_STR);
		$result -> bindParam(':log',  $log,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}	

	public static function savePhoto($id,$subscribe,$fotoName,$fotoNameS) {
		$sql    = "INSERT INTO photoInAlbum (id_album,subscribe,fotoName,fotoNameS)
		 VALUES(:id_album,:subscribe,:fotoName,:fotoNameS)";
		$result = Auxiliary::getPrepareSQL($sql);
		$result -> bindParam(':id_album',  $id,  PDO::PARAM_STR);
		$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
		$result -> bindParam(':fotoName',  $fotoName,  PDO::PARAM_STR);
		$result -> bindParam(':fotoNameS', $fotoNameS, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function getFAName($name) {
		$sql    = "SELECT * FROM photoalbum WHERE name_FA='".$name."' LIMIT 1";
		$result = Auxiliary::getSQL($sql);
		return $result->fetch();
	}

	public static function getFAId($id) {
		$id     = Auxiliary::getIntval($id);
		$FA     = [];
		$sql    = "SELECT * FROM photoalbum WHERE id_FA='".$id."' LIMIT 1";
		$result = Auxiliary::getSQL($sql);
		return $result->fetch();
	}

	public static function getFA() {
		$sql    = "SELECT * FROM photoalbum, photoInAlbum WHERE photoInAlbum.id_album = photoalbum.id_FA";
		$result = Auxiliary::getSQL($sql);
		$faList =[];
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$faList[$i]['foto'] = $row["fotoName"];
			$faList[$i]['fns']  ='/album/'.$row['id_FA'].'/'.$row["fotoName"];			
			$i++;
		}
		return $faList;
	}

	public static function getFAAll($page = 1) {
		$page   = Auxiliary::getIntval($page);
		$offset = (intval($page) - 1) * SHOWFA_BY_DEFAULT;
		$sql    = "SELECT * FROM photoalbum ORDER BY id_FA DESC LIMIT ".SHOWFA_BY_DEFAULT." OFFSET $offset";
		$result = Auxiliary::getSQL($sql);
		$faList =[];
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$foto = self::getFAOne($row['id_FA']);
			$faList[$i]['foto'] = $foto[1]["fotoName"];
			//$faList[$i]['fns']  ='/album/'.$row['id_FA'].'/'.$row["fotoName"];
			//$faList[$i]['fns']  ='/album/'.$row['id_FA'].'/'.$foto[1]["fotoName"];
			$faList[$i]['fns']  =$foto[1]["fotoNameS"];
			$i++;
		}
		return $faList;
	}

	public static function getFAOne($id) {
		$id     = Auxiliary::getIntval($id);
		$sql    = "SELECT * FROM photoInAlbum WHERE id_album=".$id;
		$result = Auxiliary::getSQL($sql);
		$i      = 1;
		$faOne  = [];
		while ($row = $result->fetch()) {			
			$faOne[$i]['id']        = $row['id_foto'];
			$faOne[$i]['subscribe'] = $row['subscribe'];
			$faOne[$i]['fotoName']  = '../album/'.$id.'/'.$row['fotoName'];
			$faOne[$i]['fotoNameS'] = '../album/'.$id.'/'.$row['fotoNameS'];
			$i++;
		}
		return $faOne;
	}
	
	public static function getFAVue() {
		$db     = self::getDBVue();
		$sql    = "SELECT * FROM photoalbum ORDER BY id_FA DESC";
		$result = $db -> query($sql);
		$i      = 1;
		$faList = [];
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$i++;
		}
		return $faList;
	}

	public static function getFAOneVue($id) {
		//$id     = Auxiliary::getIntval($id);
		$db     = self::getDBVue();
		$sql    = "SELECT * FROM photoInAlbum WHERE id_album=".$id;
		$result = $db -> query($sql);
		$i      = 1;
		$faOne  = [];
		while ($row = $result->fetch()) {			
			$faOne[$i]['id']        = $row['id_foto'];
			$faOne[$i]['subscribe'] = $row['subscribe'];
			$faOne[$i]['fotoName']  = '../album/'.$id.'/'.$row['fotoName'];
			$faOne[$i]['isFile']    = file_exists ($faOne[$i]['fotoName']);
			$i++;
		}
		return $faOne;
	}

	public static function updateFAVue ($id,$subscribe) {
		if(intval($id)) {
			$db     = self::getDBVue();
			$sql    = "UPDATE photoInAlbum SET subscribe=:subscribe WHERE id_foto=$id";
			$result = $db -> prepare($sql);
			$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
			
			return $result -> execute();
		}
	}
}
?>