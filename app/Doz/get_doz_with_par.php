<?php
$response = [];
if (isset($_POST['cat'])) {
	$cat    = $_POST['cat'];
	$result = Auxiliary::getSQLAux("SELECT * FROM msgs_relax WHERE category=".$cat." ORDER BY countrl  DESC LIMIT 20");
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
}
?>