<?php
/**
* 
*/
class MetaTagsController {

	use traitAuxiliary;
	private $MT;

	function __construct()
	{
		$this->MT = new MetaTags();
	}

	public function actionMetaTags()
	{
		
		$title  = "Редагування метатегів";
		$MTlist = $this->MT->getMTags();

		require_once ('views/auxiliary/viewMTags.php');
		return true; 
	}

	private function edMT($var,$id=1)
	{
		if(isset($_POST['submit'])) {
			$url_name = $this->filterTXT('post', 'url_name');
			$title    = $this->filterTXT('post', 'title');
			$descr    = $this->filterTXT('post', 'descr');
			$keywords = $this->filterTXT('post', 'keywords');
			$follow   = $this->filterTXT('post', 'follow');
			if ($var == 1) $res = $this->MT->saveMTags($url_name,$title,$descr,$keywords,$follow);
			if ($var == 2) $res = $this->MT->editMetaTags($id,$url_name,$title,$descr,$keywords,$follow);
			header("Location: /metaTags");
		}
	}

	public function actionMetaTagsNew()
	{
		$title = "Додавання нового метатегу";
		$this->edMT(1);
		require_once ('views/auxiliary/addMTags.php');
		return true; 
	}

	public function actionMetaTagsOne($id)
	{
		$id = $this->getIntval($id);
		$this->edMT(2,$id);
		$MTOne   = $this->MT->getMTagsByID($id);

		require_once ('views/auxiliary/changeOneMetaTags.php');
		return true;
	}
}
?>