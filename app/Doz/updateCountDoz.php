<?php
$response = [];
if (isset($_POST['id'])) {
	$id    = $_POST['id'];
    $count = $_POST['count'];
    $r     = new Relax();
    $res   = $r->updateCountRelax($id, $count);
    if ($res) {
        $response["success"] = 1;
        $response["message"] = "successfully updated. id=".$id."  count=".$count;
       
	} else {
	    $response["success"] = 0;
	    $response["message"] = "Something wrong1";
	}
}
else {
	    $response["success"] = 0;
	    $response["message"] = "Something wrong2";
}
	echo json_encode($response);
?>