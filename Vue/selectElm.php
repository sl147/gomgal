<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Vote.php');

$data = array();
$pr   = array();
$MK   = new Vote();
$pr   = $MK->getTxtVoteVue(trim(strip_tags($_GET['id'])));

if (!empty($pr)) {
	foreach ($pr as $item) {
	  	$new_item = array(
			'id'      => $item["id"],
			'msg'     => $item["msg"],
			'countrl' => $item["countrl"],
		);
		array_push($data, $new_item);
	}
}
else {
	  	$new_item = array(
			'id'      => 0,
			'msg'     => "ще немає голосування",
			'countrl' => "",
		);
		array_push($data, $new_item);
}
echo json_encode($data);