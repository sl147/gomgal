<?php
$response = [];
$result   = News::getNewsById($id);
//$result = Auxiliary::getSQLAux("SELECT * FROM msgs ORDER BY id  DESC LIMIT 10");
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'      => $row["id"],
			'top'     => $row["top"],
			'msg'   => $row["msg"],
		);
		
		//$response["product"] = [];
		array_push($response["products"], $new_item);
		
		//array_push($response, $new_item);
	}
	$response["success"] = 1;
	echo json_encode($response);
}
else {
	$response["success"] = 0;
    $response["message"] = "No product found";

    echo json_encode($response);
}
?>