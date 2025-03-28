<?php

//use \classes\traitAuxiliary as traitAuxiliary;

class FA  extends classGetDB {

	use traitAuxiliary;
	const SHOWFA_BY_DEFAULT_Vue = 25;
	
	public function __construct() {
		$this->photoalbum   = new classGetData('photoalbum');
		$this->photoInAlbum = new classGetData('photoInAlbum');
	}
	public function createFA( string $name, string $msgs, string $log) {
		return $this->photoalbum->insertDataToTable(
				array( $this->sl147_clean($name), $this->sl147_clean($msgs), $this->sl147_clean($log)),
				array( 'name_FA','msgs_FA','log_FA')							
			);	
	}	

	public function insertPhoto( int $id, string $subscribe, string $fotoName, string $fotoNames="") {
		return $this->photoInAlbum->insertDataToTable(
							array( $id, $this->sl147_clean($subscribe), $fotoName, $fotoNames),
							array('id_album','subscribe','fotoName','fotoNameS')
						);	
	}

	public function getFAId( int $id) {
		return $this->photoalbum->selectDataFromTable( array('id_FA'=>$id), '', 0, 'DESC', false,false, true);
	}

	public function getFAAll(int $page = 1) {
		$result = $this->photoalbum->selectDataFromTable( array(), 'id_FA', SHOWFA_BY_DEFAULT, 'DESC', false, false, false, true, $page);
		$i      = 1;
		while ($row = $result->fetch()) {			
			$faList[$i]['id']   = $row['id_FA'];
			$faList[$i]['name'] = $row['name_FA'];
			$faList[$i]['msgs'] = $row['msgs_FA'];
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

	public function getFAOne(int $id) {
		$result  = $this->photoInAlbum->selectDataFromTable( array( "id_album"=>$id), '', 0, 'DESC', false, false);
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

	public function getFAVue( int $page = 1 ) {
		return $this->photoalbum->selectDataFromTable( array(), 'id_FA', self::SHOWFA_BY_DEFAULT_Vue, 'DESC', true, true, false, true, $page);
	}

	public function getFAOneVue( int $id ) {
		return $this->photoInAlbum->selectDataFromTable( array( 'id_album' => $id ), '', 0, 'DESC', true, true);
	}

	public function updateFAOneVue( int $id, string $subscribe )	{
		return $this->photoInAlbum->updateDataInTable( array( 'subscribe' => $this->sl147_clean($subscribe) ), array( 'id_foto'=>$id), true);
	}

	public function updateFAVue( int $id, string $title_FA, string $descr_FA )	{
		return $this->photoalbum->updateDataInTable( 
			array( 'name_FA' => $this->sl147_clean($title_FA), 'msgs_FA' => $this->sl147_clean($descr_FA) ),
			array( 'id_FA' => $id),
			true);
	}

	public function deleteFAOne( int $id ) {
		return $this->photoInAlbum->deleteDataFromTable( array( 'id_foto'=>$id), true);
	}

	public function deleteFAOnePhoto( $id, $fotoName, $fotoNames, $idAlbum ){
		$fdel = '/album/'. $idAlbum .'/'.$fotoName;
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