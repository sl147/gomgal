<?php
$response = [];
if (isset($_POST['id'])) {
	$id    = $_POST['id'];
	$s      = "SELECT * FROM msgs WHERE id=".$id;
	$result = Auxiliary::getSQL($s);
	if ($result) {
		while ($row = $result->fetch()) {
			$new_item = array(
			  'id'    => $row["id"],
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
				'id'    => $s,
				'msg'   => $id,
				'foto'  => "foto",
			);
array_push($response, $new_item);
echo json_encode($response);
	}
	else {
		$new_item = array(
			    'id'    => $s,
				'msg'   => $id,
				'foto'  => "foto",
			);
array_push($response, $new_item);
echo json_encode($response);
	}*/
}
?>