<?php
$response = [];
if (isset($_POST['id'])) {
	$getDB  = new classGetDB();
	$result = $getDB->getDB("SELECT * FROM poster WHERE id_poster=".$_POST['id']);
	unset($getDB);
	if ($result) {
		while ($row = $result->fetch()) {
			$new_item = array(
			  'id'    => $row["id_poster"],
			  'msg'   => $row["msg_p"],
			 'foto'   => $row["foto_p1"],
			 'email'   => $row["email_p"],
			 'name'   => $row["name_p"],
			);
			array_push($response, $new_item);
		}
	}
	else {
		$new_item = array(
				'id'    => "no POST id",
				'foto'  => "foto",
			);
		array_push($response, $new_item);		
	}
	echo json_encode($response);
}
?>