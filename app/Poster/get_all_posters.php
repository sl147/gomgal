<?php
$response = [];
$result = Auxiliary::getSQLAux("SELECT id_poster,title_p FROM poster WHERE active='0' ORDER BY id_poster DESC LIMIT 20");
if ($result) {
	while ($row = $result->fetch()) {
		$new_item = array(
			'id'    => $row["id_poster"],
			'title' => $row["title_p"],
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