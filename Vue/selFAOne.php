<?php
require_once ('../models/FA.php');

$data = array();
$pr   = array();

$MK   = new FA();

$pr   = $MK->getFAOneVue($_GET['id']);

foreach ($pr as $item) {
  	$new_item = array(
		    'id'   => $item["id"],
	   'subscribe' => $item["subscribe"],
		'fotoName' => $item["fotoName"],
		  'isFile' => $item["isFile"],
	);
	array_push($data, $new_item);
}
	echo json_encode($data);
?>