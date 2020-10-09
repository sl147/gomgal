<?php
$response = [];
$result = Auxiliary::getSQLAux("SELECT * FROM msgs ORDER BY id  DESC LIMIT 20");
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'    => $row["id"],
			'title' => $row["title"],
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