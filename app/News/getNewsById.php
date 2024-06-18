<?php
$response = [];
if (isset($_POST['id'])) {
	$getData = new classGetData('msgs');
	$result  = $getData->selectWhere( array( 'id' => $_POST['id']) );
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
}