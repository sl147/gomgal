<?php
require_once ('../models/Auxiliary.php');

$data = array();
$pr   = array();

$MK   = new Auxiliary();

$pr   = $MK->getTxtVoteVue($_GET['id']);

foreach ($pr as $item) {
  	$new_item = array(
		   'id'   => $item["id"],
		    'name' => $item["msg"],
		'countrl' => $item["countrl"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>