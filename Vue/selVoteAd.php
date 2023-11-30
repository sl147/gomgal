<?php
require_once ('../models/Vote.php');

$vote = [];
$MK   = new Vote();
$vote = $MK->getVoteVueAd();
$data = [];

foreach ($vote as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'name'    => $item['name'],
	);
	array_push($data, $new_item);
}
	echo json_encode($data);
?>