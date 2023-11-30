<?php
require_once ('../models/Insurance.php');

$data = [];
$MK   = new Insurance();
$pr   = $MK->getReestrTZ();

foreach ($pr as $item) {
  	$new_item = array(
		'id'   => $item["id"],
		'name' => $item["name"],
		'k2'   => $item["k2"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);

?>