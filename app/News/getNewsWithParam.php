<?php
$response = [];
if (isset($_POST['cat'])) {
	$cat    = $_POST['cat'];
	$s      = "SELECT * FROM msgs WHERE category='".$cat."' ORDER BY id DESC LIMIT 13";
	$result = Auxiliary::getSQL($s);
	if ($result) {
			$new_item = array(
				'id'    => $s,
				'top'   => $cat,
				'title' => "title",
				'msg'   => "msg",
				'foto'  => "foto",
			);

			array_push($response, $new_item);

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
/*	else {
		$response["success"] = 0;
	    $response["message"] = "No product found";

	    echo json_encode($response);

	    			$new_item = array(
				'id'    => $row["id"],
			    'top'   => $row["top"],
			  'title'   => $row["title"],
			    'msg'   => $row["msg"],
			   'foto'   => $row["foto"],
			);

	}*/
}
?>