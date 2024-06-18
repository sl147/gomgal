<?php

/**
 * 
 */

class AuxiliaryVue {

	public function __construct( string $table) {
		$this->table = new classGetData($table);
	}

	public function sel2El( string $name, string $id, string $idVal, bool $isId) {
		return $this->table->getData2ElVue($id,$name,$idVal);
	}

	public function addVue2El( string $name, string $nameEl) {
		return $this->table->insertDataToTable( array($name), array($nameEl), true);	
	}
	
	public function updateVue2El ( int $id, string $name, string $nameEl, string $nameId) {
		$args = array(
			 $nameEl  => $name,
		);
		return $this->table->updateDataInTable( $args, array( $nameId=>$id), true);		
	}

	public function delVue2El(int $id, string $name_Id) {
		$this->table->deleteDataFromTable( array( $name_Id=>$id), true);

		if ($tab == "poster") $res = $this->delFilePoster($id);		
	}

	private function delFilePoster( int $id) {
		$poster = $this->getPosterById($id);
		$res    = $this->delFileVue($poster["foto_p1"],"posterFoto");	
	}

	private function getPathFile( string $file, string $folder, string $delim="") {
		return "./".$folder."/".$delim.$file;
	}

	public function delFileVue( string $file, string $folder) {
		$fdel  = $this->getPathFile($file,$folder);
		$str  = explode( '/', $file );
		$file = '';
		for ($i=0; $i < count($str)-1; $i++) { 
			$file .= $str[$i].'/';
		}
		$file .= 's_'.$str[count($str)-1];
		$fdelS = $this->getPathFile($file,$folder);
		if (file_exists($fdel))  unlink($fdel);
		if (file_exists($fdelS)) unlink($fdelS);
	}
}