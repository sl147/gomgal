<?php
$response = [];
if (isset($_GET['page'])) {
	$page   = $_GET['page'];
	$limit  = $_GET['limit'];
	$offset = ($page - 1) * $limit;
	$sql    = "SELECT * FROM msgs ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset;
	$getDB  = new classGetDB();
	$result = $getDB->getDB($sql);
	unset($getDB);
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
	}
	else {
	$response["success"] = "01";
	$response["message"] = "No saving";
	}
}
else {
	$response["success"] = "02";
	$response["message"] = "No saving";
}
echo json_encode($response);
?>