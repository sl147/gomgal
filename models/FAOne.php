<?php

class FAOne {

	use traitAuxiliary;
	const SHOWFA_BY_DEFAULT_Vue = 25;

	public function getFAOneVue($id) {
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('photoInAlbum');
		$list = $getData->getDataFromTableByNameAllVue ($id,'id_album');
		unset($getData);
		return $list ?? [];
	}

	public function updateFAOneVue ($id,$subscribe)	{
		$getDB  = new classGetDB();
		$sql    = "UPDATE photoInAlbum SET subscribe=:subscribe WHERE id_foto =:id";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':id',         $id,        PDO::PARAM_INT );
		$result -> bindParam(':subscribe',  $subscribe, PDO::PARAM_STR);
		unset($getDB);
		return $result -> execute();
	}

	public function deleteFAOneVue ($id) {
		$getDB  = new classGetDB();
		$sql    = "DELETE FROM photoInAlbum WHERE id_foto =:id";
		$result = $getDB->getPrepareSQLVue($sql);
		$result -> bindParam(':id',         $id,        PDO::PARAM_INT );
		unset($getDB);
		return $result -> execute();
	}
}