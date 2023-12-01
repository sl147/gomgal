<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$data = array();
$pr   = array();
$MK   = new FA();
$pr   = $MK->getFAVue();

foreach ($pr as $item) {
	$new_item = array(
		'id_FA'   => $item["id_FA"],
		'name_FA' => $item["name_FA"],
		'msgs_FA' => $item["msgs_FA"],
		'log_FA'  => $item["log_FA"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);