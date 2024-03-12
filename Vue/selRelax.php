<?php
//require_once ('../classes/classGetDB.php');
//require_once ('../classes/traitAuxiliary.php');
require_once ('../models/RelaxVue.php');

$cat       = intval($_GET['cat']);
$page      = intval($_GET['page']);
$SHOWRELAX = intval($_GET['SHOWRELAX']);

$data = [];
$MK   = new RelaxVue();
$pr   = $MK->getRelaxVue($cat,$page,$SHOWRELAX);

foreach ($pr as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => strip_tags($item["msg"]),
		'countrl' => $item["countrl"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);