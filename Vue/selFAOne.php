<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$data = array();
$pr   = array();
$MK   = new FA();
$pr   = $MK->getFAOneVue($_GET['id']);
if (count($pr)) {
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
}
else{array_push($data, []);}
echo json_encode($data);