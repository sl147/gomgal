<?php

/**
 * 
 */

class MetaTags{

	public function __construct() {
		$this->meta_tags = new classGetData('meta_tags');
	}

	public function getMTags() {
		return $this->meta_tags->selectFromTable() ?? [];
	}

	public function getMTagsByID(int $id) {
		$args = array(
			'id' => $id
		);
		return $this->meta_tags->selectDataFromTableWHEREFetch( $args );
	}

	public function editMetaTags(int $id, string $url_name, string $title, string $description, string $keywords, string $follow) {
		$args = array(
			'url_name' => $url_name,
			'title'    => $title,
			'descr'    => $description,
			'keywords' => $keywords,
			'follow'   => $follow,
		);
		$this->meta_tags->updateDataInTable( $args, array('id'=>$id));
	}

	public function saveMTags (string $url_name, string $title, string $description, string $keywords, string $follow) {
		$names  = ['url_name', 'title', 'descr', 'keywords', 'follow'];
		$values = [$url_name, $title, $description, $keywords, $follow];
		$this->meta_tags->insertDataToTable( $values, $names);	
	}

	public function getMTagsByUrl( string $url) {
		$args = array(
			'url_name' => $url
		);
		return $this->meta_tags->selectDataFromTableWHEREFetch( $args );
	}

/*	public function showMeta($metaTags, $news = 1) {
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
	}*/
}