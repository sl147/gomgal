<?php
$response = [];
$result   = News::getNewsById($id);
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'      => $row["id"],
			'top'     => $row["top"],
			'msg'   => $row["msg"],
		);
		array_push($response["products"], $new_item);
	}
	$response["success"] = 1;
}
else {
	$response["success"] = 0;
    $response["message"] = "No product found";   
}
echo json_encode($response);
?>