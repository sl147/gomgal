<?php
/**
* 
*/
//use \classes\traitAuxiliary as traitAuxiliary;
class FA  extends classGetDB
{
	use traitAuxiliary;
	
	private function getDBVueFa(){
		require_once ('../models/Auxiliary.php');
		$aux = new Auxiliary();
		return $aux->getDBVue();
	}

	public function createFA($name,$msgs,$log) {
		$sql = "INSERT INTO photoalbum (name_FA,msgs_FA,log_FA);
		 VALUES(:name,:msgs,:log)";
		$result = $this->getDB($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':msgs', $msgs, PDO::PARAM_STR);
		$result -> bindParam(':log',  $log,  PDO::PARAM_STR);
		return $result -> execute();		
	}	

	public function savePhoto($id,$subscribe,$fotoName,$fotoNameS) {
		$sql    = "INSERT INTO photoInAlbum (id_album,subscribe,fotoName,fotoNameS)
		 VALUES(:id_album,:subscribe,:fotoName,:fotoNameS)";
		$result = $this->getDB($sql);
		$result -> bindParam(':id_album',  $id,  PDO::PARAM_STR);
		$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
		$result -> bindParam(':fotoName',  $fotoName,  PDO::PARAM_STR);
		$result -> bindParam(':fotoNameS', $fotoNameS, PDO::PARAM_STR);
		return $result -> execute();		
	}

	public static function getFAName($name) {
		$getData  = new classGetData('photoalbum');
		$NewsList = $getData->getDataFromTableByNameFetch($name,'name_FA');
		unset($getData);
		return $NewsList;
	}

	public static function getFAId($id) {
		$getData  = new classGetData('photoalbum');
		$NewsList = $getData->getDataFromTableByNameFetch($id,'id_FA');
		unset($getData);
		return $NewsList;
	}

/*	public static function getFA() {
		echo "here getFA";
		$sql    = "SELECT * FROM photoalbum, photoInAlbum WHERE photoInAlbum.id_album = photoalbum.id_FA";
		$result = Auxiliary::getSQLAux($sql);
=======
	public function getFAName($name)
	{
		$result = $this->getDB("SELECT * FROM photoalbum".$this->formSql("name_FA",$name)." LIMIT 1");
		return $result->fetch();
	}

	public function getFAId($id)
	{
		$result = $this->getDB("SELECT * FROM photoalbum".$this->formSql("id_FA",$id)." LIMIT 1");
		return $result->fetch();
	}

	public function getFA() {
		$result = $this->getDB("SELECT * FROM photoalbum, photoInAlbum WHERE photoInAlbum.id_album = photoalbum.id_FA");
>>>>>>> local
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$faList[$i]['foto'] = $row["fotoName"];
			$faList[$i]['fns']  ='/album/'.$row['id_FA'].'/'.$row["fotoName"];			
			$i++;
		}
		return $faList ?? [];
	}*/

	public static function getFAAll($page = 1) {
		$offset = ($this->getIntval($page) - 1) * SHOWFA_BY_DEFAULT;
		$getData  = new classGetData('photoalbum');
		$result = $getData->getDataByOffsetWithOutRow('id_FA',SHOWFA_BY_DEFAULT,$offset);
		unset($getData);
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$foto = self::getFAOne($row['id_FA']);
			$faList[$i]['foto'] = $foto[1]["fotoName"];
			$faList[$i]['fns']  =$foto[1]["fotoNameS"];
			$i++;
		}
		return $faList ?? [];
	}

	public static function getFAOne($id) {
		$getData = new classGetData('photoInAlbum');
		$result  = $getData->getDataFromTableByNameWithOutRow ($id,"id_album");
		unset($getData);
		$i       = 1;
		while ($row = $result->fetch()) {			
			$faOne[$i]['id']        = $row['id_foto'];
			$faOne[$i]['subscribe'] = $row['subscribe'];
			$faOne[$i]['fotoName']  = '../album/'.$id.'/'.$row['fotoName'];
			$faOne[$i]['fotoNameS'] = '../album/'.$id.'/'.$row['fotoNameS'];
			$i++;
		}

		return $faOne ?? [];
	}
	
	public function getFAVue()
	{
		$db     = self::getDBVueFa();
		$result = $db -> query("SELECT * FROM photoalbum ORDER BY id_FA DESC");
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$i++;
		}
		return $faList ?? [];
	}

	public function getFAOneVue($id)
	{
		$db     = self::getDBVueFa();
		$sql    = "SELECT * FROM photoInAlbum WHERE id_album=".$id;
		$result = $db -> query($sql);
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faOne[$i]['id']        = $row['id_foto'];
			$faOne[$i]['subscribe'] = $row['subscribe'];
			$faOne[$i]['fotoName']  = '../album/'.$id.'/'.$row['fotoName'];
			$faOne[$i]['isFile']    = file_exists ($faOne[$i]['fotoName']);
			$i++;
		}
		return $faOne ?? [];
	}

	public function updateFAVue ($id,$subscribe)
	{
		if(intval($id)) {
			$db     = self::getDBVueFa();
			$sql    = "UPDATE photoInAlbum SET subscribe=:subscribe WHERE id_foto=$id";
			$result = $db -> prepare($sql);
			$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
			
			return $result -> execute();
		}
	}
}