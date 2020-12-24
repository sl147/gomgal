<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../models/Video.php');
$page = $_GET['page'];

$MK   = new Video();
$pr   = $MK->getVideoVue($page);
$data = [];

foreach ($pr as $item) {
  	$new_item = array(
		'id'    => $item["id"],
		'idYT'  => $item["idYT"],
		'title' => $item["title"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>