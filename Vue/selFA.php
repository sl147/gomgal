<?php
require_once ('../models/FA.php');

$data = array();
$pr   = array();
$MK   = new FA();

$pr   = $MK->getFAVue();

foreach ($pr as $item) {
  	$new_item = array(
		'id'   => $item["id"],
		'name' => $item["name"],
	);
	array_push($data, $new_item);
}
	echo json_encode($data);
?>