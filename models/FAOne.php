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
}