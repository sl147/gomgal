<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Relax.php');

$data = array();
$MK   = new Relax();
$pr   = $MK->getRelaxVue(
				intval($_GET['cat']),
				intval($_GET['page']),
				intval($_GET['SHOWRELAX'])
			);

foreach ($pr as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => strip_tags($item["msg"]),
		'countrl' => $item["countrl"],
		'cat'     => $item["category"]
	);
	array_push($data, $new_item);
}
echo json_encode($data);