<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Vote.php');

$data       = [];
$MK         = new Vote();
$vote       = $MK->getVoteVue();
$listVote   = $MK->getTxtVoteVue($vote['idrl']);

foreach ($listVote as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => $item["msg"],
		'countrl' => $item["countrl"],
		'name'    => $vote['namerl'],
	);
	array_push($data, $new_item);
}
echo json_encode($data);