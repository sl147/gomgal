<?php
$response = [];
$result = Auxiliary::getSQL("SELECT * FROM msgs_relax ORDER BY countrl  DESC LIMIT 20");
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'    => $row["id"],
			'msg'   => $row["msg"],
		'countrl'   => $row["countrl"],
		);
		array_push($response, $new_item);
	}
	echo json_encode($response);
}
else {
	$response["success"] = 0;
    $response["message"] = "No product found";

    echo json_encode($response);
}
?>