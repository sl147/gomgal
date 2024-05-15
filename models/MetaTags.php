<?php

/**
 * 
 */

class MetaTags{

	public function __construct() {
		$this->getDB = new classGetDB();
	}

	public function getMTags() {
		$result = $this->getDB->getDB("SELECT * FROM meta_tags");
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list ?? [];
	}

	public function getMTagsByID($id) {
		$result = $this->getDB->getDB("SELECT * FROM meta_tags WHERE id=".$id);
		return $result->fetch();
	}

	private function saveMT($url_name,$title,$descr,$keywords,$sql,$follow) {
		$result = $this->getDB->getPrepareSQL($sql);
		$result -> bindParam(':url_name', $url_name, PDO::PARAM_STR);
		$result -> bindParam(':title',   $title,     PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,     PDO::PARAM_STR);
		$result -> bindParam(':keywords',$keywords,  PDO::PARAM_STR);	
		$result -> bindParam(':follow',  $follow,    PDO::PARAM_STR);	
		return $result -> execute();
	}

	public function editMetaTags($id,$url_name,$title,$descr,$keywords,$follow) {
		$sql = "UPDATE meta_tags SET url_name=:url_name,title=:title,descr=:descr,keywords=:keywords,follow=:follow WHERE id=$id";
		$r = $this->saveMT($url_name,$title,$descr,$keywords,$sql,$follow);	
	}

	public function saveMTags ($url_name,$title,$descr,$keywords,$follow) {
		$sql = "INSERT INTO meta_tags (url_name,title,descr,keywords,follow)
		 VALUES(:url_name,:title,:descr,:keywords,:follow)";
		$r = $this->saveMT($url_name,$title,$descr,$keywords,$sql,$follow);			
	}

	public function getMTagsByUrl($url) {
		$result = $this->getDB->getDB("SELECT * FROM meta_tags WHERE url_name = '".$url."'");
		return $result->fetch();
	}

	public function showMeta($metaTags, $news = 1) {
		if ($metaTags == "") {
			$meta['title']    = "Гомін Галичични";
			$meta['keywords'] = 'Дрогобич';
			$meta['descr']    = 'новини Дрогобич Трускавець';
		}elseif ($metaTags == "poster") {
			$meta['title']    = $news["title_p"];
			$meta['keywords'] = 'безкоштовні безплатні оголошення Трускавець Дрогобич';
			$meta['descr']    = $news["msg_p"];
		}elseif ($metaTags == "newsOne") {
			$meta['title']    = $news['title'];
			$meta['keywords'] = 'Дрогобич';
			$meta['descr']    = $news['prew'];
		}else {
			$meta = $this->getMTagsByUrl($metaTags);	
		}
		include ('views/layouts/showMeta.php');
	}
}