<?php
/**
* 
*/
class AuxiliaryController {

	private function json($txt,$title) {
		$table  = array(
			'table' => $txt
			);
		$json  = json_encode($table);
		require_once ('views/auxiliary/list2El.php');
		return true;
	}

	public function actionMetaTags() {
		$title    = "Редагування метатегів";
		$MTlist   = Auxiliary::getMTags();

		require_once ('views/auxiliary/viewMTags.php');
		unset($getData);
		return true; 
	}

	public function actionMetaTagsNew() {
		$title = "Додавання нового метатегу";
		if(isset($_POST['submit'])) {
			$url_name = Auxiliary::filterTXT('post', 'url_name');
			$title    = Auxiliary::filterTXT('post', 'title');
			$descr    = Auxiliary::filterTXT('post', 'descr');
			$keywords = Auxiliary::filterTXT('post', 'keywords');
			$follow   = Auxiliary::filterTXT('post', 'follow');

			$result   = Auxiliary::saveMTags($url_name,$title,$descr,$keywords,$follow);
			header("Location: /metaTags");
		}
		require_once ('views/auxiliary/addMTags.php');
		return true; 
	}

	public function actionMetaTagsOne($id) {
		$id = Auxiliary::getIntval($id);
		if(isset($_POST['submit'])) {
			$url_name = Auxiliary::filterTXT('post', 'url_name');
			$title    = Auxiliary::filterTXT('post', 'title');
			$descr    = Auxiliary::filterTXT('post', 'descr');
			$keywords = Auxiliary::filterTXT('post', 'keywords');
			$follow   = Auxiliary::filterTXT('post', 'follow');

			$res      = Auxiliary::editMetaTags($id,$url_name,$title,$descr,$keywords,$follow);
			header("Location: /metaTags");
		}

		$MTOne   = Auxiliary::getMTagsByID($id);

		require_once ('views/auxiliary/changeOneMetaTags.php');
		return true;
	}
}
?>