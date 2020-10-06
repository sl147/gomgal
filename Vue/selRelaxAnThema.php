<?php
require_once ('../models/Relax.php');

$cat       = $_GET['cat'];
$page      = $_GET['page'];
$SHOWRELAX = $_GET['SHOWRELAX'];

$data = [];
$pr   = [];
$MK   = new Relax();

$pr   = $MK->getAnThemaVue($cat,$page,$SHOWRELAX);

foreach ($pr as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => $item["msg"],
		'countrl' => $item["countrl"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>