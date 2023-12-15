<?php

//use \classes\traitAuxiliary as traitAuxiliary;

class FA  extends classGetDB {

	use traitAuxiliary;
	const SHOWFA_BY_DEFAULT_Vue = 25;
	
	public function createFA($name,$msgs,$log) {
		$sql = "INSERT INTO photoalbum (name_FA,msgs_FA,log_FA)
		 VALUES(:name,:msgs,:log)";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':msgs', $msgs, PDO::PARAM_STR);
		$result -> bindParam(':log',  $log,  PDO::PARAM_STR);
		return $result -> execute();		
	}	

	public function insertPhoto($id,$subscribe,$fotoName,$fotoNameS="") {
		$sql    = "INSERT INTO photoInAlbum (id_album,subscribe,fotoName,fotoNameS)
		 VALUES(:id_album,:subscribe,:fotoName,:fotoNameS)";
		$result = $this->getPrepareSQL($sql);
		$result -> bindParam(':id_album',  $id,  PDO::PARAM_STR);
		$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
		$result -> bindParam(':fotoName',  $fotoName,  PDO::PARAM_STR);
		$result -> bindParam(':fotoNameS', $fotoNameS, PDO::PARAM_STR);
		return $result -> execute();		
	}

	public static function getFAName($name)	{
		$getData  = new classGetData('photoalbum');
		$NewsList = $getData->getDataFromTableByNameFetch($name,'name_FA');
		unset($getData);
		return $NewsList;
	}

	public function getFAId($id) {
		$getData  = new classGetData('photoalbum');
		$NewsList = $getData->getDataFromTableByNameFetch($id,'id_FA');
		unset($getData);
		return $NewsList;
	}

	public function getFAAll($page = 1) {
		$offset  = ($this->getIntval($page) - 1) * SHOWFA_BY_DEFAULT;
		$getData = new classGetData('photoalbum');
		$result  = $getData->getDataByOffsetWithOutRow('id_FA',SHOWFA_BY_DEFAULT,$offset);
		unset($getData);
		$i       = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$foto               = self::getFAOne($row['id_FA']);
			if ( count($foto) ) {
				$faList[$i]['foto'] = $foto[1]["fotoName"];
				$faList[$i]['fns']  = $foto[1]["fotoNameS"];
			}else{
				$faList[$i]['foto'] = '';
				$faList[$i]['fns']  = '';
			}
			$i++;
		}
		return $faList ?? [];
	}

	public function getFAOne($id) {
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

	public function getVideoVue1($page = 1) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('progrnk');
		$list = $getData->getDataFromTableOrderPageVue(self::SHOWFA_BY_DEFAULT_Vue,$page,'prid');
		unset($getData);
		return $list ?? [];
	}

	public function getFAVue($page = 1) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('photoalbum');
		$list = $getData->getDataFromTableOrderPageVue(self::SHOWFA_BY_DEFAULT_Vue,$page,'id_FA');
		unset($getData);
		return $list ?? [];
	}

	public function getFAOneVue($id) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('photoInAlbum');
		$list = $getData->getDataFromTableByNameAllVue ($id,'id_album');
		unset($getData);
		return $list ?? [];
	}

	public function updateFAVue ($id,$name_FA,$msgs_FA)	{
		$getDB  = new classGetDB();
		$sql    = "UPDATE photoalbum SET name_FA=:name, msgs_FA=:msgs WHERE id_FA =$id";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':name',  $name_FA,  PDO::PARAM_STR);
		$result -> bindParam(':msgs', $msgs_FA, PDO::PARAM_STR);
		unset($getDB);
		return $result -> execute();
	}

	public function updateFAOneVue ($id,$subscribe)	{
		$getDB  = new classGetDB();
		$sql    = "UPDATE photoinalbum SET subscribe=:subscribe WHERE id_foto =$id";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':subscribe',  $subscribe,  PDO::PARAM_STR);
		unset($getDB);
		return $result -> execute();
	}

	public function deleteFAOnePhoto( $id, $fotoName, $fotoNames, $idAlbum ){
		$fdel = '../album/'. $idAlbum .'/'.$fotoName;
		unlink($fdel);
		$fdel = '../album/'. $idAlbum .'/'.$fotoNames;
		unlink($fdel);
	}

	public function deleteFAAlbumPhoto( $idAlbum ){
		$dir = '../album/'. $idAlbum ;
		$includes = new FilesystemIterator($dir);

		foreach ($includes as $include) {
			if(is_dir($include) && !is_link($include)) {
				recursiveRemoveDir($include);
			}else {
				unlink($include);
			}
		}
		rmdir($dir);
	}
}