<?php
require_once ('../models/Auxiliary.php');

$vote = array();
//$pr   = array();
$MK   = new Auxiliary();

$vote = $MK->getVoteVueAd();
//$pr   = $MK->getTxtVoteVue($vote['id']);
$data = array();

foreach ($vote as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'name'    => $item['name'],
	);
	array_push($data, $new_item);
}
	echo json_encode($data);
?>