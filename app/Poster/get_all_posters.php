<?php
$response = [];
$getDB  = new classGetDB();
$result = $getDB->getDB("SELECT id_poster,title_p FROM poster WHERE active='0' ORDER BY id_poster DESC LIMIT 20");
unset($getDB);
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'    => $row["id_poster"],
			'title' => $row["title_p"],
		);
		array_push($response, $new_item);
	}	
}
else {
	$response["success"] = 0;
    $response["message"] = "No product found";
}
echo json_encode($response);
?>