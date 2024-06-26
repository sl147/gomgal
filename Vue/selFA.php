<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/FA.php');

$MK   = new FA();
$pr   = $MK->getFAVue(trim(strip_tags($_GET['page'])));
$data = array();

foreach ($pr as $item) {
	$new_item = array(
		'id_FA'   => $item["id_FA"],
		'name_FA' => $item["name_FA"],
		'msgs_FA' => $item["msgs_FA"],
		'log_FA'  => $item["log_FA"],
		'is_item' => true,
		'count'=> count($pr)
	);
	array_push($data, $new_item);
}
echo json_encode($data);
