<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$data = [];
$pr   = array();
$MK   = new FA();
$id   = intval(trim(strip_tags($_GET['id'])));
$pr   = $MK->getFAOneVue($id);
if (count($pr)) {
	$i=1;
	foreach ($pr as $item) {
	  	$new_item = array(
			    'id'   => $item["id_foto"],
		   'subscribe' => $item["subscribe"],
			'fotoName' => $item["fotoName"],
			'fotoNames' => $item["fotoNameS"],
			  'isFile' => true, //$item["isFile"],
		);
		array_push($data, $new_item);
		$i++;
		if ($i=2) break;
	}
/*	$new_item = array(
			    'id'   => "id_foto",
		   'subscribe' => "subscribe",
			'fotoName' => "fotoName",
			'fotoNames' =>"fotoNameS",
			  'isFile' => count($pr)
		);
		array_push($data, $new_item);*/
}
else{
$new_item = array(
			    'id'   => "else id_foto",
		   'subscribe' => "else subscribe",
			'fotoName' => "else fotoName",
			'fotoNames' =>"else fotoNameS",
			  'isFile' => count($pr)
		);
		array_push($data, $new_item);
}

/*$new_item = array(
			    'id'   => "id_foto",
		   'subscribe' => "subscribe",
			'fotoName' => "fotoName",
			'fotoNames' =>"fotoNameS",
			  'isFile' => count($pr)
		);
		array_push($data, $new_item);*/

echo json_encode($data);