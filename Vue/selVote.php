<?php
require_once ('../models/Auxiliary.php');

$vote       = [];
$listVote   = [];
$data       = [];
$MK         = new Auxiliary();
$vote       = $MK->getVoteVue();
$listVote   = $MK->getTxtVoteVue($vote['id']);

foreach ($listVote as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => $item["msg"],
		'countrl' => $item["countrl"],
		'name'    => $vote['name'],
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>