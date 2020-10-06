<?php

class APIController {

	public function actionSaveNews() {
		require_once ('app/Contakt/saveNews.php');
			return true;
	}

	public function actionPoster() {
		require_once ('app/Poster/get_all_posters.php');
			return true;
	}

	public function actionPosterById() {
		require_once ('app/Poster/getPosterById.php');
			return true;
	}

	public function actionNews() {
		require_once ('app/News/get_all_products.php');
			return true;
	}

	public function actionNewsWithParam() {
		require_once ('app/News/getNewsWithParam.php');
			return true;
	}

	public function actionNewsById() {
		require_once ('app/News/getNewsById.php');
			return true;
	}

	public function actionNewsByPageLim($page=1, $limit=10) {
		$response = [];
	//$page   = $_GET['page'];
	//$limit  = $_GET['limit'];
	$offset   = ($page - 1) * $limit;
	$sql      = "SELECT * FROM msgs ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset;
	$result = Auxiliary::getSQL($sql);
	if ($result) {

		while ($row = $result->fetch()) {
			$new_item = array(
			  'id'    => $row["id"],
			  'title' => $row["title"],
			  'msg'   => $row["msg"],
			 'foto'   => $row["foto"],
			);
			array_push($response, $new_item);
		}
		echo json_encode($response);
	}
	else {
	$response["success"] = "01";
	$response["message"] = "No saving";
	echo json_encode($response);
	}
//		require_once ('app/News/getNewsByPageLim.php');
			return true;
	}

	public function actionDoz() {
		require_once ('app/Doz/get_doz.php');
			return true;
	}

	public function actionApiUpdateCountdoz() {
		require_once ('app/Doz/updateCountDoz.php');
			return true;
	}

	public function actionApiDozWithParam() {
		require_once ('app/Doz/get_doz_with_par.php');
			return true;
	}
}
?>