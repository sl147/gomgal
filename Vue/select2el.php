<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/AuxiliaryVue.php');

$data = [];
$MK   = new AuxiliaryVue(trim(strip_tags($_GET['tab'])));

$pr   = $MK->sel2El(trim(strip_tags($_GET['name'])),
					trim(strip_tags($_GET['id'])),
					trim(strip_tags($_GET['idVal'])),
					trim(strip_tags($_GET['isId'])));

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