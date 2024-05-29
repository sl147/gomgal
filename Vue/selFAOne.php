<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/FA.php');

$MK   = new FA();
$pr   = $MK->getFAOneVue(intval(trim(strip_tags($_GET['id']))));
$data = array();

foreach ($pr as $item) {
  	$new_item = array(
		    'id'   => $item["id_foto"],
	   'subscribe' => $item["subscribe"],
		'fotoName' => $item["fotoName"],
		'fotoNames' => $item["fotoNameS"],
		  'isFile' => true, //$item["isFile"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);