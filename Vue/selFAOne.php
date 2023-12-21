<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FAOne.php');

$data = [];
$pr   = array();
$MK   = new FAOne();
$id   = intval(trim(strip_tags($_GET['id'])));
$pr   = $MK->getFAOneVue($id);

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