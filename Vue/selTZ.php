<?php
require_once ('../models/Insurance.php');

$data = [];
$MK   = new Insurance();

$pr   = $MK->getTypeTZ();

foreach ($pr as $item) {
  	$new_item = array(
		'id'   => $item["id"],
		'name' => $item["name"],
		'type' => $item["type"],
		'k1'   => $item["k1"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);

?>