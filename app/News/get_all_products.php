<?php
$response = [];
$getData  = new classGetData('msgs');
$result   = $getData->selectDataFromTable( array(), 'id', 20, 'DESC', false);
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