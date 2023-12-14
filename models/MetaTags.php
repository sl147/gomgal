<?php

/**

 * 

 */

class MetaTags

{



	public function getMTags() {

		$getDB  = new classGetDB();

		$result = $getDB->getDB("SELECT * FROM meta_tags");

		unset($getDB);

		while ($row = $result->fetch()) {

			$list[]=$row;

		}

		return $list ?? [];

	}



	public function getMTagsByID($id) {

		$getDB  = new classGetDB();

		$result = $getDB->getDB("SELECT * FROM meta_tags WHERE id=".$id);

		unset($getDB);

		return $result->fetch();

	}



	private static function saveMT($url_name,$title,$descr,$keywords,$sql,$follow) {

		$getDB  = new classGetDB();

		$result = $getDB->getPrepareSQL($sql);

		$result -> bindParam(':url_name', $url_name, PDO::PARAM_STR);

		$result -> bindParam(':title',   $title,     PDO::PARAM_STR);

		$result -> bindParam(':descr',   $descr,     PDO::PARAM_STR);

		$result -> bindParam(':keywords',$keywords,  PDO::PARAM_STR);	

		$result -> bindParam(':follow',  $follow,    PDO::PARAM_STR);	

		return $result -> execute();

	}



	public function editMetaTags($id,$url_name,$title,$descr,$keywords,$follow) {

		$sql = "UPDATE meta_tags SET url_name=:url_name,title=:title,descr=:descr,keywords=:keywords,follow=:follow WHERE id=$id";

		$r = self::saveMT($url_name,$title,$descr,$keywords,$sql,$follow);	

	}

	

	public function saveMTags ($url_name,$title,$descr,$keywords,$follow) 

	{

		$sql = "INSERT INTO meta_tags (url_name,title,descr,keywords,follow)

		 VALUES(:url_name,:title,:descr,:keywords,:follow)";

		$r = self::saveMT($url_name,$title,$descr,$keywords,$sql,$follow);			

	}

	public static function getMTagsByUrl($url) {
		//echo "req:".explode("/",trim($_SERVER["REQUEST_URI"],'/'))[0];
		//echo "url:".$url.";";
		$getDB  = new classGetDB();

		$result = $getDB->getDB("SELECT * FROM meta_tags WHERE url_name = '".$url."'");

		unset($getDB);

		return $result->fetch();

	}



	public function showMeta($metaTags, $news = 1)

	{

		if ($metaTags == "") {

			$meta['title']    = "Гомін Галичични";

			$meta['keywords'] = 'Дрогобич';

			$meta['descr']    = 'новини Дрогобич Трускавець';

		}

		elseif ($metaTags == "poster") {

			$meta['title']    = $news["title_p"];

			$meta['keywords'] = 'безкоштовні безплатні оголошення Трускавець Дрогобич';

			$meta['descr']    = $news["msg_p"];

		}

		elseif ($metaTags == "newsOne") {

			$meta['title']    = $news['title'];

			$meta['keywords'] = 'Дрогобич';

			$meta['descr']    = $news['prew'];

		}

		else {

			$meta = self::getMTagsByUrl($metaTags);	

		}

		

		include ('views/layouts/showMeta.php');

	}

}