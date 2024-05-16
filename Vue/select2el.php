<?php
require_once ('../models/AuxiliaryVue.php');

$data = [];
$tab  = trim(strip_tags($_GET['tab']));
$name = trim(strip_tags($_GET['name']));
$id   = trim(strip_tags($_GET['id']));
$idVal= trim(strip_tags($_GET['idVal']));
$isId = trim(strip_tags($_GET['isId']));
$MK   = new AuxiliaryVue();
$pr   = $MK->sel2El($tab,$name,$id,$idVal,$isId);

foreach ($pr as $item) {
			$new_item  = array(
			'id'       => $item['id'],
			'name'     => $item['name'],
			'isPlus'   => false,
			'isid'     => $isId,
			);
			array_push($data, $new_item);	
}
echo json_encode($data);