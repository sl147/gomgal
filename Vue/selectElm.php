<?php
require_once ('../models/Vote.php');

$id   = trim(strip_tags($_GET['id']));
$pr   = array();
$MK   = new Vote();

$pr   = $MK->getTxtVoteVue($id);
$data = array();
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

?>